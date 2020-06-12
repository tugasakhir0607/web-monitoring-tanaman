<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Monitoring Tanaman</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url("assets/backend/bootstrap/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url("assets/backend/plugins/datatables/dataTables.bootstrap.css")?>">
	<link rel="stylesheet" href="<?= base_url("assets/backend/dist/css/AdminLTE.min.css")?>">

	<script src="<?= base_url("assets/backend/dist/js/app.min.js")?>"></script>
</head>
<body onload="window.print();">
<div class="wrapper">
	<section class="invoice">
		<div class="row">
			<div class="col-sm-12">
				<center>
					<h3><b>Laporan Pengguna</b></h3>
				</center>
				<hr>
			</div>
			<div class="col-sm-12" style="margin-top: 30px;">
				<div class="row">
					<div class="col-sm-6">
						<table style="font-size: medium">
							<tbody>
							<tr>
								<td>Tahun</td>
								<td style="padding: 0px 10px;">:</td>
								<td><?= $tahun; ?></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<table id="example1" class="table table-bordered table-striped" style="margin: 20px 0px;">
					<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>No HP</th>
						<th>E-mail</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
						<th>Tanggal Daftar</th>
					</tr>
					</thead>
					<tbody>
					<?php $no=0;  foreach ($data->result() as $item): $no++;?>
						<tr>
							<td><?= $no;?></td>
							<td><?= $item->nama_pengguna;?></td>
							<td><?= $item->nohp_pengguna;?></td>
							<td><?= $item->email_pengguna;?></td>
							<td><?= $item->sex_pengguna;?></td>
							<td><?= $item->alamat_pengguna;?></td>
							<td><?= $item->waktu;?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
</body>
</html>
