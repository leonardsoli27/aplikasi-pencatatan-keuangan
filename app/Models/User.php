<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_kelompok',
        'nama_kelompok',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'kode_kelompok';

    public $incrementing = false;

    protected $keyType = 'string';

    public function Pendapatan()
    {
        return $this->hasMany('App\Models\Pendapatan', 'kode_kelompok');
    }

    public function Pengeluaran()
    {
        return $this->hasMany('App\Models\Pengeluaran', 'kode_kelompok');
    }
}
