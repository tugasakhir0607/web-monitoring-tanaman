<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Pengguna</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dahboard</a></li>
			<li class="active">Pengguna</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $this->session->flashdata('info');?>
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar Pengguna</h3>
						<a href="<?= base_url('Admin/pengguna_tambah') ?>" class="btn btn-primary pull-right">Tambah</a>
					</div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>No</th>
								<th>Foto Tanaman</th>
								<th>Nama</th>
								<th>No HP</th>
								<th>Jenis Kelamin</th>
								<th>Tanggal Mendaftar</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php $no=1; foreach ($pengguna as $item): ?>
								<tr>
									<td><?= $no++; ?></td>
									<td>
										<?php if ($item->sex_pengguna=="Perempuan"):?>
											<img src="<?= base_url('assets/backend/dist/img/avatar3.png');?>" class="img-responsive img-circle img-bordered" style="width: 80px">
										<?php else: ?>
											<img src="<?= base_url('assets/backend/dist/img/avatar5.png');?>" class="img-responsive img-circle img-bordered" style="width: 80px">
										<?php endif; ?>
									</td>
									<td><a href="<?= base_url('Admin/pengguna_detail/'.$item->id_tb_pengguna); ?>"><?= $item->nama_pengguna; ?></a></td>
									<td><?= $item->nohp_pengguna; ?></a></td>
									<td><?= $item->sex_pengguna; ?></td>
									<td><?= $item->waktu; ?></td>
									<td>
										<a href="<?= base_url('Admin/pengguna_ubah/'.$item->id_tb_pengguna); ?>" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> Edit</a>
										<a href="<?= base_url('Admin/pengguna_hapus_execute/'.$item->id_tb_pengguna); ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Hapus</a>
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
