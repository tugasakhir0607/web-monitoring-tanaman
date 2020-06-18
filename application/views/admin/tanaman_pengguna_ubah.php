<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Tanaman Detail</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?= base_url('Admin/tanaman'); ?>">Tanaman Pengguna Ubah</a></li>
			<li class="active">Ubah</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $this->session->flashdata('info');?>
				<form id="formValidate" class="formValidate" method="post" action="<?= base_url('Admin/tanaman_pengguna_ubah_exe');?>">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Ubah Pengguna</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="nama_tanaman">Nama Tanaman</label>
								<input type="text" class="form-control" id="nama_tanaman" name="nama_tanaman" value="<?= $tanaman->nama_tanaman; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="nama">Nama Pengguna</label>
								<input type="hidden" id="id_tb_tanaman" name="id_tb_tanaman" value="<?= $tanaman->id_tb_tanaman; ?>">
								<select class="form-control" id="id_tb_pengguna" name="id_tb_pengguna" required>
									<option value="<?= $pengguna->id_tb_pengguna; ?>"><?= $pengguna->nama_pengguna; ?></option>
									<?php foreach($data as $item): ?>
										<option value="<?= $item->id_tb_pengguna; ?>"><?= $item->nama_pengguna; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Simpan</button>
							<button type="button" onclick="history.back()" class="btn btn-danger pull-right" style="margin-right: 1px">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
