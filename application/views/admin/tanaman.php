<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Tanaman</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dahboard</a></li>
			<li class="active">Tanaman</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar Tanaman</h3>
					</div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>No</th>
								<th>Nama Tanaman</th>
								<th>Nama Penanam</th>
								<th>Foto Tanaman</th>
								<th>Tanggal Penanaman</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php $no=0; foreach($tanaman as $item): $no++; ?>
								<tr>
									<td><?= $no; ?></td>
									<td><a href="<?= base_url('Admin/tanaman_detail/'.$item->id_tb_tanaman); ?>"><?= $item->nama_tanaman; ?></a></td>
									<td><?= $item->nama_pengguna; ?></a></td>
									<td><img src="<?= base_url('assets/backend/dist/img/photo2.png');?>" class="img-responsive img-bordered" style="width: 250px"></td>
									<td><?= $item->waktu; ?></td>
									<td>
										<button type="button" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Hapus</button>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
    $(function () {
        $("#example1").DataTable();
    });
</script>
