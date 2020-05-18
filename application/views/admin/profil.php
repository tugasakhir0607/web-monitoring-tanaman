<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Profil</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dahboard</a></li>
			<li class="active">Profil</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $this->session->flashdata('info');?>
				<form id="formValidate" class="formValidate" method="post" action="<?= base_url('Admin/profil_ubah_exe');?>">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Profil</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username_pengguna" name="username_pengguna" value="<?= $this->session->userdata('nama')?>" placeholder="Masukan Username" required>
							</div>
							<div class="form-group">
								<label for="password">password</label>
								<input type="password" class="form-control" id="password_pengguna" name="password_pengguna" placeholder="Masukan password" required>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Simpan</button>
							<button type="button" class="btn btn-danger pull-right" style="margin-right: 1px">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
