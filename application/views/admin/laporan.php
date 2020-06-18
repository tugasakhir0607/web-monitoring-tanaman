<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Laporan</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dahboard</a></li>
			<li class="active">Laporan</li>
		</ol>
	</section>
	<section class="content connectedSortable">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar Pengguna</h3>
					</div>
					<div class="box-body">
						<form id="formValidate" class="formValidate" method="get" action="<?= base_url('Admin/laporan_pengguna');?>" target="_blank">
							<div class="form-group">
								<label for="tahun">Tahun</label>
								<select class="form-control" id="tahun" name="tahun">
									<?php foreach ($tahun_pengguna as $it_pengguna):?>
										<option value="<?= $it_pengguna->tahun; ?>"><?= $it_pengguna->tahun; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary pull-right" style="margin: 1px" name="tipe" value="excel">CETAK EXCEL</button>
								<button type="submit" class="btn btn-primary pull-right" style="margin: 1px" name="tipe" value="pdf">CETAK PDF</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar Tanaman</h3>
					</div>
					<div class="box-body">
						<form id="formValidate" class="formValidate" method="get" action="<?= base_url('Admin/laporan_tanaman');?>" target="_blank">
							<div class="form-group">
								<label for="tahun">Tahun</label>
								<select class="form-control" id="tahun" name="tahun">
									<?php foreach ($tahun_tanaman as $it_tanaman):?>
										<option value="<?= $it_tanaman->tahun; ?>"><?= $it_tanaman->tahun; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary pull-right" style="margin: 1px" name="tipe" value="excel">CETAK EXCEL</button>
								<button type="submit" class="btn btn-primary pull-right" style="margin: 1px" name="tipe" value="pdf">CETAK PDF</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
