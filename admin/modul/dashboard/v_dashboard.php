<?php 
$day = date('Y-m-d');
$month = date('m');
$year = date('Y');
//Rekap Harian
$query_rekap_harian = mysqli_query($koneksi, "SELECT SUM(total_pembayaran) as hasil FROM transaksi WHERE status_pembayaran='1' AND DATE(tgl_transaksi)='$day'");
$data_rekap_harian = mysqli_fetch_array($query_rekap_harian);

//Rekap Bulanan
$query_rekap_bulanan = mysqli_query($koneksi, "SELECT SUM(total_pembayaran) as hasil FROM transaksi WHERE status_pembayaran='1' AND MONTH(tgl_transaksi)='$month' AND YEAR(tgl_transaksi)='$year'");
$data_rekap_bulanan = mysqli_fetch_array($query_rekap_bulanan);

//Rekap Tahunan
$query_rekap_tahunan = mysqli_query($koneksi, "SELECT SUM(total_pembayaran) as hasil FROM transaksi WHERE status_pembayaran='1' AND YEAR(tgl_transaksi)='$year'");
$data_rekap_tahunan = mysqli_fetch_array($query_rekap_tahunan);
//Chart Tahunan
$arr_chart = array();
for($i=1;$i<=12;$i++){
    $query_chart = mysqli_query($koneksi, "SELECT SUM(total_pembayaran) as hasil FROM transaksi WHERE status_pembayaran='1' AND MONTH(tgl_transaksi)='$i' AND YEAR(tgl_transaksi)='$year'");
    while($data = mysqli_fetch_array($query_chart)){
        if($data['hasil'] == NULL || $data['hasil'] == 0){
            array_push($arr_chart, 0);
        }else{
            array_push($arr_chart, $data['hasil']);
        }
    }
}
?>
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Harian <?php echo "(" . date('d-m-Y') . ")"; ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($data_rekap_harian['hasil'],0,',','.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="icofont-chart-bar-graph fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan Bulanan <?php echo "(" . date('m-Y') . ")"; ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($data_rekap_bulanan['hasil'],0,',','.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="icofont-chart-bar-graph fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendapatan Tahunan <?php echo "(" . date('Y') . ")"; ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($data_rekap_tahunan['hasil'],0,',','.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="icofont-chart-bar-graph fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rekap Pendapatan Bulanan : Tahun <?php echo date('Y') ?></h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="line_chart_monthly"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <!-- Script Untuk Line Chart Rekap Pemasukan Bulanan -->
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
        // Monthly Chart
        var ctx = document.getElementById("line_chart_monthly");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                datasets: [{
                    label: "Pemasukan",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    // data : [1000,2000,2000,2000,1000,10000,1000,2000,2000,2000,1000,10000],
                    data : [<?php foreach($arr_chart as $value){echo $value.',';} ?>],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Rp.' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });
    </script>