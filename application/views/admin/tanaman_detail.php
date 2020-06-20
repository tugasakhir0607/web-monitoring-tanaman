<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Penanaman</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dahboard</a></li>
			<li><a href="<?= base_url('Admin/penanaman'); ?>">Penanaman</a></li>
			<li class="active">Detail</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#penanaman" data-toggle="tab">Penanaman</a></li>
						<li><a href="#pengguna" data-toggle="tab">Pengguna</a></li>
						<li><a href="#penyiraman" data-toggle="tab">Penyiraman</a></li>
<!--						<li><a href="#pemupukan" data-toggle="tab">Pemupukan</a></li>-->
						<li><a href="#kelembaban" data-toggle="tab">Kelembaban</a></li>
						<li><a href="#galeri" data-toggle="tab">Galeri</a></li>
						<li><a href="#evaluasi" data-toggle="tab">Evaluasi</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="penanaman">
							<div class="tab-content">
								<div class="form-group">
									<label for="nama_tanaman">Nama Tanaman</label>
									<input type="text" class="form-control" id="nama_tanaman" name="nama_tanaman" value="<?= $tanaman->nama_tanaman; ?>" disabled>
								</div>
								<div class="form-group">
									<label for="penyiraman_perhari">Penyiraman Perhari</label>
									<input type="text" class="form-control" id="penyiraman_perhari" name="penyiraman_perhari" value="<?= $tanaman->penyiraman_tanaman; ?>" disabled>
								</div>
								<div class="form-group" style="display: none">
									<label for="pemupukan_perminggu">Pemupukan Perminggu</label>
									<input type="text" class="form-control" id="pemupukan_perminggu" name="pemupukan_perminggu" value="<?= $tanaman->pemupukan_tanaman; ?>" disabled>
								</div>
								<div class="form-group">
									<label for="tanggal_penanaman">Tanggal Penanaman</label>
									<input type="text" class="form-control" id="tanggal_penanaman" name="tanggal_penanaman" value="<?= $tanaman->waktu; ?>" disabled>
								</div>
								<div class="form-group">
									<label for="deskripsi_tanaman">Deskripsi Tanaman</label>
									<textarea class="form-control" id="deskripsi_tanaman" name="deskripsi_tanaman" placeholder="Masukan Deskripsi Tanaman" rows="5" disabled><?= $tanaman->deskripsi_tanaman; ?></textarea>
								</div>
								<div class="form-group">
									<a href="<?= base_url('Admin/tanaman_pengguna_ubah/'.$tanaman->id_tb_pengguna."/".$tanaman->id_tb_tanaman); ?>" class="btn btn-primary">Ubah Pengguna</a>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="pengguna">
							<div class="form-group">
								<label for="nama">Nama</label>
								<input type="text" class="form-control" id="nama" name="nama" value="<?= $tanaman->nama_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" value="<?= $tanaman->username_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="no_hp">No HP</label>
								<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $tanaman->nohp_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" class="form-control" id="email" name="email" value="<?= $tanaman->nohp_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="jenis_kelamin">Jenis Kelamin</label>
								<input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= $tanaman->sex_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" rows="4" disabled><?= $tanaman->alamat_pengguna; ?></textarea>
							</div>
						</div>
						<div class="tab-pane" id="penyiraman">
							<a href="<?= base_url('Admin/laporan_penyiraman_excel/'.$tanaman->id_tb_tanaman); ?>" class="btn btn-primary" style="margin: 5px;">CETAK EXCEL</a>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>Tanggal Penyiraman</th>
									<th>Jam Penyiraman</th>
								</tr>
								</thead>
								<tbody>
								<?php $no_siram=1; foreach ($penyiraman as $item_siram):?>
									<tr>
										<td><?= $no_siram++; ?></td>
										<td><?= $item_siram->tgl; ?></td>
										<td><?= $item_siram->wkt; ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
<!--						<div class="tab-pane" id="pemupukan">-->
<!--							<table id="example2" class="table table-bordered table-striped">-->
<!--								<thead>-->
<!--								<tr>-->
<!--									<th>No</th>-->
<!--									<th>Tanggal Pemupukan</th>-->
<!--									<th>Jam Pemupukan</th>-->
<!--								</tr>-->
<!--								</thead>-->
<!--								<tbody>-->
<!--								--><?php //for ($i=1;$i<=30;$i++):?>
<!--									<tr>-->
<!--										<td>--><?//= $i; ?><!--</td>-->
<!--										<td>25 Februari 2020</td>-->
<!--										<td>0--><?//= $i; ?><!--:10</td>-->
<!--									</tr>-->
<!--								--><?php //endfor; ?>
<!--								</tbody>-->
<!--							</table>-->
<!--						</div>-->
						<div class="tab-pane" id="kelembaban">
							<a href="<?= base_url('Admin/laporan_kelembaban_excel/'.$tanaman->id_tb_tanaman); ?>" class="btn btn-primary" style="margin: 5px;">CETAK EXCEL</a>
							<table id="example3" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>Kelembaban</th>
									<th>Pompa</th>
									<th>Keterangan</th>
									<th>Waktu</th>
								</tr>
								</thead>
								<tbody>
								<?php $no_sensor=0; foreach ($sensor as $it_sensor): $no_sensor++;?>
									<tr>
										<td><?= $no_sensor; ?></td>
										<td><?= $it_sensor->kelembapan; ?></td>
										<td><?= $it_sensor->pompa; ?></td>
										<td><?= $it_sensor->keterangan; ?></td>
										<td><?= $it_sensor->waktu; ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">Grafik Kelembaban</h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="chart">
										<canvas id="barChart" style="height:230px !important;"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="galeri">
							<div class="row margin-bottom">
								<?php foreach ($galeri as $it_gal):?>
									<div class="col-sm-6 col-md-4">
										<img class="img-responsive" src="<?= base_url('assets/img/galeri/'.$it_gal->foto); ?>" alt="Photo">
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="tab-pane" id="evaluasi">
							<form action="<?= base_url('Api/downloadEvaluasi'); ?>" method="post" target="_blank">
								<div class="form-group">
									<label for="no_hp">Foto</label>
									<input type="hidden" name="id_tb_tanaman" value="<?= $evaluasi->id_tb_tanaman; ?>">
									<center>
										<img src="<?= base_url('assets/img/evaluasi/'.$evaluasi->foto_evaluasi); ?>" class="img-responsive img-rounded" style="width: 40%;"/>
									</center>
								</div>
								<div class="form-group">
									<label for="nama">Saran Evaluasi</label>
									<textarea class="form-control" rows="6" disabled><?= $evaluasi->saran_evaluasi; ?></textarea>
								</div>
								<div class="form-group">
									<label for="username">Keterangan Evaluasi</label>
									<textarea class="form-control" rows="6" disabled><?= $evaluasi->keterangan_evaluasi; ?></textarea>
								</div>
								<button type="submit" class="btn btn-success pull-right">Cetak PDF</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<style>
	.tab-content>.tab-pane {
		display: block;
		height: 0;
		overflow: hidden;
	}
	.tab-content>.tab-pane.active {
		height: auto;
	}
</style>
<script type="text/javascript">
    $(function () {
        $("#example1").DataTable();
        $("#example2").DataTable();
        $("#example3").DataTable();

        var areaChartData = {
            labels: <?= json_encode($judul) ; ?>,
            datasets: [
                {
                    label: "Digital Goods",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: <?= json_encode($data) ; ?>
                }
            ]
        };

        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[0].fillColor = "#00a65a";
        barChartData.datasets[0].strokeColor = "#00a65a";
        barChartData.datasets[0].pointColor = "#00a65a";
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

