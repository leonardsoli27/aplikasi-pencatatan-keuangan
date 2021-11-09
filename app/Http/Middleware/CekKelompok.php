<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekKelompok
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $kode_kelompok)
    {
        if ($request->user()->kode_kelompok == $kode_kelompok) {
            return $next($request);
        }

        return redirect('/');
    }
}
