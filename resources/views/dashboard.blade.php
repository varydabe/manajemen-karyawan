<!doctype html>
<html lang="en">
<head>
    <title>Dashboard Analytic - Manajemen Karyawan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<h3 style="text-align: center; margin: 70px;">Dashborad Analytic</h3>
<div class="row">
    <div class="col-sm-6" style="">
        <div id="piechart" style="width: 700px; height: 500px; border: #1a202c"></div>
    </div>
    <div class="col-sm-6" style="">
        <div id="chart_div" style="width: 700px; height: 500px;"></div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var dataPieChart = google.visualization.arrayToDataTable([
            ["Jenis Kelamin", "Jumlah Karyawan"],
            ['Male', {{$karyawan_male}}],
            ["Female", {{$karyawan_female}}]
        ]);

        var pieOptions = {
            title: 'Jenis Kelamin Karyawan',
            is3D: true,
        };

        var pieChart = new google.visualization.PieChart(document.getElementById('piechart'));

        pieChart.draw(dataPieChart, pieOptions);

        var dataHistogram = google.visualization.arrayToDataTable(
            {!! $jabatan !!}
          );

        var histoOptions = {
            title: 'Histogram Jabatan Pegawai',
            bars: 'Horizontal',
            legend: { position: 'none' },

        };

        var histogramChart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        histogramChart.draw(dataHistogram, histoOptions);
    }

</script>
</body>
</html>
