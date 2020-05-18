<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Pengguna</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dahboard</a></li>
			<li><a href="<?= base_url('Admin/pengguna'); ?>">Pengguna</a></li>
			<li class="active">Ubah</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $this->session->flashdata('info');?>
				<form id="formValidate" class="formValidate" method="post" action="<?= base_url('Admin/pengguna_ubah_exe');?>">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Ubah Pengguna</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="nama">Nama</label>
								<input type="hidden" id="id_tb_pengguna" name="id_tb_pengguna" value="<?= $pengguna->id_tb_pengguna; ?>" required>
								<input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= $pengguna->nama_pengguna; ?>" placeholder="Masukan Nama" required>
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username_pengguna" name="username_pengguna" value="<?= $pengguna->username_pengguna; ?>" placeholder="Masukan username" required>
							</div>
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" class="form-control" id="email_pengguna" name="email_pengguna" value="<?= $pengguna->email_pengguna; ?>" placeholder="Masukan E-mail" required>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password_pengguna" name="password_pengguna" placeholder="Masukan Password">
								<code>Silahkan diisi jika ingin merubah password</code>
							</div>
							<div class="form-group">
								<label for="no_hp">No HP</label>
								<input type="text" class="form-control" id="nohp_pengguna" name="nohp_pengguna" value="<?= $pengguna->nohp_pengguna; ?>" placeholder="Masukan No HP" required>
							</div>
							<div class="form-group">
								<label for="jenis_kelamin">Jenis Kelamin</label>
								<select class="form-control" id="sex_pengguna" name="sex_pengguna" required>
									<option value="<?= $pengguna->sex_pengguna; ?>"><?= $pengguna->sex_pengguna; ?></option>
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<textarea class="form-control" id="alamat_pengguna" name="alamat_pengguna" placeholder="Masukan Alamat" rows="4" required><?= $pengguna->alamat_pengguna; ?></textarea>
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
<script>
    $(function () {
        $("#formValidate").validate({
            rules: {
                nama_pengguna: { required: true, lettersonly: true },username_pengguna: { required: true, },
                email_pengguna: { required: true, email:true }, nohp_pengguna: { required: true, digits: true },
            },
            messages: {
                nama_pengguna: { required: "Silahkan diisi...", lettersonly: "Hanya boleh huruf..." }, username_pengguna: { required: "Silahkan diisi...", },
                email_pengguna: { required: "Silahkan diisi...", email: "E-mail tidak valid..." }, nohp_pengguna: { required: "Silahkan diisi...", digits: "Hanya boleh angka..." },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) { $(placement).append(error) }
                else { error.insertAfter(element); }
            }
        });
    });
</script>
