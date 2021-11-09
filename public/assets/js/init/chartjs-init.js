(function ($) {
    "use strict";

    $.ajax({
        url: "/chart",
        method: "GET",
        success: function (data) {

            // Team chart

            var pemasukkan = data['pemasukkan']
            var pengeluaran = data['pengeluaran']
            var jml_pengeluaran = pengeluaran['jumlah']

            var bulan = Object.values(pemasukkan['bulan'])
            var jml_pemasukkan = pemasukkan['jumlah']
            var data_pemasukkan = []
            var data_cod = []

            jml_pemasukkan.forEach(element => {
                data_pemasukkan.push(element[0])
                data_cod.push(element[1])
            });

            var data_pengeluaran = []
            jml_pengeluaran.forEach(element => {
                data_pengeluaran.push(element)
            });


            var ctx = document.getElementById("team-chart");
            // ctx.height = 130;
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bulan,
                    datasets: [{
                            label: "Pendapatan",
                            data: data_pemasukkan,
                            borderColor: "rgba(0, 194, 146, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 194, 146, 0.5)"
                        },
                        {
                            label: "COD",
                            data: data_cod,
                            borderColor: "#96e6a1",
                            borderWidth: "0",
                            backgroundColor: "#d4fc79"
                        },
                        {
                            label: "Pengeluaran",
                            data: data_pengeluaran,
                            borderColor: "rgba(0,0,0,0.09)",
                            borderWidth: "0",
                            backgroundColor: "#f43b47"
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });



})(jQuery);
