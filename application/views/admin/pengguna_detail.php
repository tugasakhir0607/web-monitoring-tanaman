<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Pengguna</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dahboard</a></li>
			<li><a href="<?= base_url('Admin/pengguna'); ?>">Pengguna</a></li>
			<li class="active">Detail</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $this->session->flashdata('info');?>
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#detail_pengguna" data-toggle="tab">Detail Pengguna</a></li>
						<li><a href="#penanaman" data-toggle="tab">Penanaman</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="detail_pengguna">
							<div class="form-group">
								<label for="nama">Nama</label>
								<input type="hidden" id="id" name="id" value="<?= $pengguna->id_tb_pengguna; ?>" >
								<input type="text" class="form-control" id="nama" name="nama" value="<?= $pengguna->nama_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" value="<?= $pengguna->username_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="no_hp">No HP</label>
								<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $pengguna->nohp_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" class="form-control" id="email" name="email" value="<?= $pengguna->email_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="jenis_kelamin">Jenis Kelamin</label>
								<input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= $pengguna->sex_pengguna; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" rows="4" disabled><?= $pengguna->alamat_pengguna; ?></textarea>
							</div>
						</div>
						<div class="tab-pane" id="penanaman">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No</th>
									<th>ID Tanaman</th>
									<th>Nama Tanaman</th>
									<th>Foto Tanaman</th>
									<th>Tanggal Penanaman</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1; foreach ($tanaman as $item):?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $item->id_tb_tanaman; ?></td>
										<td><a href="<?= base_url('Admin/tanaman_detail/'.$item->id_tb_tanaman); ?>"><?= $item->nama_tanaman; ?></a></td>
										<td><img src="<?= base_url('assets/img/tanaman/'.$item->foto_tanaman);?>" class="img-responsive img-bordered" style="width: 250px"></td>
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
		</div>
	</section>
</div>
<script type="text/javascript">
    $(function () {
        $("#example1").DataTable();
    });
</script>

