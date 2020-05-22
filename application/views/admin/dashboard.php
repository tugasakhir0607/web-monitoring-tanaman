<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12 col-md-3">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?= $tanaman; ?></h3>
						<p>Daftar Tanaman</p>
					</div>
					<div class="icon">
						<i class="fa fa-tree"></i>
					</div>
					<a href="<?= base_url("Admin/daftar_tanaman");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?= $pengguna; ?></h3>
						<p>Pengguna</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="<?= base_url("Admin/pengguna");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Grafik Penanaman dan Pengguna Tahun <?= date('Y'); ?></h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="chart">
							<canvas id="barChart" style="height:230px"></canvas>
						</div>
					</div>
					<div class="box-footer">
						<span class="label label-success">Data Penanaman</span>
						<span class="label label-info">Data Pengguna</span>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
    $(function () {
        var areaChartData = {
            labels: <?= json_encode($dt_bulan) ; ?>,
            datasets: [
                {
                    label: "Tanaman",
                    fillColor: "#00a65a",
                    strokeColor: "#00a65a",
                    pointColor: "#00a65a",
                    pointStrokeColor: "#00a65a",
                    pointHighlightFill: "#00a65a",
                    pointHighlightStroke: "#00a65a",
                    data: <?= json_encode($dt_tanaman) ; ?>
                },
                {
                    label: "Pengguna",
                    fillColor: "#00c0ef",
                    strokeColor: "#00c0ef",
                    pointColor: "#00c0ef",
                    pointStrokeColor: "#00c0ef",
                    pointHighlightFill: "#00c0ef",
                    pointHighlightStroke: "#00c0ef",
                    data: <?= json_encode($dt_pengguna) ; ?>
                }
            ]
        };

        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    });
</script>
