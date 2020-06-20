<?php


class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (isset($this->session->userdata['login_admin_monitoring_tanaman']) != TRUE) {
			redirect(base_url());
		}
		$this->load->library('template');
		$this->load->model('M_admin');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$no=0;
		$dt_bulan = array();
		$dt_data_pengguna = array();
		$dt_data_tanaman = array();
		$bulan = array('01','02','03','04','05','06','07','08','09','10','11','12');
		$bulan_nama = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		foreach ($bulan as $it_bln){
			$where = date('Y')."-".$it_bln;
			$dt_bulan[] = $bulan_nama[$no];
			$dt_data_pengguna[] = $this->M_admin->grafikPengguna($where)->num_rows();
			$dt_data_tanaman[] = $this->M_admin->grafikTanaman($where)->num_rows();
			$no++;
		}

		$data['dt_bulan'] = $dt_bulan;
		$data['dt_pengguna'] = $dt_data_pengguna;
		$data['dt_tanaman'] = $dt_data_tanaman;

		$data['tanaman'] = $this->M_admin->getTanaman()->num_rows();
		$data['pengguna'] = $this->M_admin->getPengguna()->num_rows();
		$this->template->template_admin('admin/dashboard',$data);
	}

	public function pengguna()
	{
		$data['pengguna'] = $this->M_admin->getPengguna()->result();
		$this->template->template_admin('admin/pengguna',$data);
	}

	public function pengguna_tambah()
	{
		$this->template->template_admin('admin/pengguna_tambah');
	}

	public function pengguna_tambah_exe(){
		$input['nama_pengguna'] = $this->input->post('nama_pengguna');
		$input['username_pengguna'] = $this->input->post('username_pengguna');
		$input['password_pengguna'] = md5($this->input->post('password_pengguna'));
		$input['email_pengguna'] = $this->input->post('email_pengguna');
		$input['nohp_pengguna'] = $this->input->post('nohp_pengguna');
		$input['sex_pengguna'] = $this->input->post('sex_pengguna');
		$input['alamat_pengguna'] = $this->input->post('alamat_pengguna');
		$input['waktu'] = date('Y-m-d H:i:s');
		if ($this->M_admin->penggunaTambah($input)){
			$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">Berhasil Menambah Pengguna</div>');
			redirect(base_url('Admin/pengguna'));
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">Gagal Menambah Pengguna</div>');
			redirect(base_url('Admin/pengguna_tambah'));
		}
	}

	public function pengguna_detail()
	{
		$id = $this->uri->segment(3);
		$data['pengguna'] = $this->M_admin->getPenggunaDetail($id)->row();
		$data['tanaman'] = $this->M_admin->getTanamanPengguna($id)->result();
		$this->template->template_admin('admin/pengguna_detail',$data);
	}

	public function pengguna_ubah()
	{
		$id = $this->uri->segment(3);
		$data['pengguna'] = $this->M_admin->getPenggunaDetail($id)->row();
		$this->template->template_admin('admin/pengguna_ubah',$data);
	}

	public function pengguna_hapus_execute(){
		$where['id_tb_pengguna'] = $this->uri->segment(3);
		$update['delflage'] = 0;
		$update['waktu'] = date('Y-m-d H:i:s');
		if ($this->M_admin->penggunaUbah($where,$update)){
			$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">Berhasil Menghapus Pengguna</div>');
			redirect(base_url('Admin/pengguna'));
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">Gagal Menghapus Pengguna</div>');
			redirect(base_url('Admin/pengguna'));
		}
	}

	public function pengguna_ubah_exe(){
		$where['id_tb_pengguna'] = $id = $this->input->post('id_tb_pengguna');
		$update['nama_pengguna'] = $this->input->post('nama_pengguna');
		$update['username_pengguna'] = $this->input->post('username_pengguna');
		$update['email_pengguna'] = $this->input->post('email_pengguna');
		$update['nohp_pengguna'] = $this->input->post('nohp_pengguna');
		$update['sex_pengguna'] = $this->input->post('sex_pengguna');
		$update['alamat_pengguna'] = $this->input->post('alamat_pengguna');
		if (!empty($this->input->post('password_pengguna'))){
			$update['password_pengguna'] = $this->input->post('password_pengguna');
		}
		if ($this->M_admin->penggunaUbah($where,$update)){
			$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">Berhasil Mengubah Pengguna</div>');
			redirect(base_url('Admin/pengguna_detail/'.$id));
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">Gagal Mengubah Pengguna</div>');
			redirect(base_url('Admin/pengguna_detail/'.$id));
		}
	}

	public function tanaman()
	{
		$data['tanaman'] = $this->M_admin->getTanaman()->result();
		$this->template->template_admin('admin/tanaman',$data);
	}

	public function tanaman_detail()
	{
		$id = $this->uri->segment(3);
		$data['tanaman'] = $this->M_admin->getTanamanDetail($id)->row();
		$data['penyiraman'] = $this->M_admin->getTanamanPenyiraman($id)->result();
		$data['galeri'] = $this->M_admin->getTanamanGaleri($id)->result();
		$data['evaluasi'] = $this->M_admin->getTanamanEvaluasi($id)->row();

		$dt_judul = array();
		$dt_data = array();
		$stmt = $this->M_admin->getGrafikSensor()->result();
		foreach ($stmt as $itm){
			$wkt = $itm->wkt;
			$dt_judul[] = "$wkt";
			$dt_data[] = $itm->jml;
		}

		$data['judul'] = $dt_judul;
		$data['data'] = $dt_data;
		$data['sensor'] = $this->M_admin->getSensor()->result();
		$this->template->template_admin('admin/tanaman_detail',$data);
	}

	public function laporan_penyiraman_excel(){
		$id = $this->uri->segment(3);
		$tanaman = $this->M_admin->getTanamanDetail($id)->row();
		$penyiraman = $this->M_admin->getTanamanPenyiraman($id)->result();

		$this->load->library('Excel_generator');
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator('Laporan Penyiraman Tanaman')
			->setLastModifiedBy('Laporan Penyiraman Tanaman')
			->setTitle("Laporan Penyiraman Tanaman")
			->setSubject("Laporan Penyiraman Tanaman")
			->setDescription("Laporan Penyiraman Tanaman")
			->setKeywords("Laporan Penyiraman Tanaman");

		$style_col = array(  'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Penyiraman Tanaman".$tanaman->nama_tanaman);
		$excel->getActiveSheet()->mergeCells('A1:C1');

		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Tanggal");
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "Jam");

		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);

		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		$no = 1;
		$numrow = 4;
		foreach($penyiraman as $item) {
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $item->tgl);
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $item->wkt);

			$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
			$no++;
			$numrow++;
		}

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$excel->getActiveSheet(0)->setTitle("Laporan Penyiraman Tanaman");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Penyiraman Tanaman '.$tanaman->nama_tanaman.'.xlsx"');

		// Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function laporan_kelembaban_excel(){
		$id = $this->uri->segment(3);
		$tanaman = $this->M_admin->getTanamanDetail($id)->row();
		$sensor = $this->M_admin->getSensor()->result();

		$this->load->library('Excel_generator');
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator('Laporan Kelembaban Tanaman')
			->setLastModifiedBy('Laporan Kelembaban Tanaman')
			->setTitle("Laporan Kelembaban Tanaman")
			->setSubject("Laporan Kelembaban Tanaman")
			->setDescription("Laporan Kelembaban Tanaman")
			->setKeywords("Laporan Kelembaban Tanaman");

		$style_col = array(  'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Kelembaban Tanaman".$tanaman->nama_tanaman);
		$excel->getActiveSheet()->mergeCells('A1:E1');

		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Kelembaban");
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "Pompa");
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "Tanaman");
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "Waktu");

		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('4')->setRowHeight(30);
		$excel->getActiveSheet()->getRowDimension('5')->setRowHeight(30);

		$no = 1;
		$numrow = 4;
		foreach($sensor as $item) {
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $item->kelembapan);
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $item->pompa);
			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $item->keterangan);
			$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $item->waktu);

			$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
			$no++;
			$numrow++;
		}

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$excel->getActiveSheet(0)->setTitle("Laporan Kelembaban Tanaman");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Kelembaban Tanaman '.$tanaman->nama_tanaman.'.xlsx"');

		// Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function tanaman_pengguna_ubah()
	{
		$id_tb_pengguna = $this->uri->segment(3);
		$id_tb_tanaman = $this->uri->segment(4);
		$data['tanaman'] = $this->M_admin->getTanamanDetail($id_tb_tanaman)->row();
		$data['pengguna'] = $this->M_admin->getPenggunaDetail($id_tb_pengguna)->row();
		$data['data'] = $this->M_admin->getPengguna()->result();
		$this->template->template_admin('admin/tanaman_pengguna_ubah',$data);
	}

	public function tanaman_pengguna_ubah_exe()
	{
		$id_tb_tanaman = $this->input->post('id_tb_tanaman');
		$id_tb_pengguna = $this->input->post('id_tb_pengguna');

		$where['id_tb_tanaman'] = $id_tb_tanaman;
		$update['id_tb_pengguna'] = $id_tb_pengguna;
		if ($this->M_admin->tanaman_pengguna_ubah($where,$update)){
			$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">Berhasil Mengubah Pengguna</div>');
			redirect(base_url('Admin/tanaman_detail/'.$id_tb_tanaman));
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">Gagal Mengubah Pengguna</div>');
			redirect(base_url('Admin/tanaman_detail/'.$id_tb_pengguna."/".$id_tb_tanaman));
		}
	}

	public function laporan()
	{
		$data['tahun_pengguna'] = $this->M_admin->year_pengguna()->result();
		$data['tahun_tanaman'] = $this->M_admin->year_tanaman()->result();
		$this->template->template_admin('admin/laporan',$data);
	}

	public function laporan_pengguna(){
		$tahun = $this->input->get('tahun');
		$stmt = $this->M_admin->laporan_pengguna($tahun);;
		if ($this->input->get('tipe')=="pdf"){
			$data['data'] = $stmt;
			$data['tahun'] = $tahun;
			$this->load->view('admin/laporan_pengguna',$data);
		} else {
			$this->load->library('Excel_generator');
			$excel = new PHPExcel();
			$excel->getProperties()->setCreator('Laporan Daftar Pengguna')
				->setLastModifiedBy('Laporan Daftar Pengguna')
				->setTitle("Laporan Daftar Pengguna")
				->setSubject("Laporan Daftar Pengguna")
				->setDescription("Laporan Daftar Pengguna")
				->setKeywords("Laporan Daftar Pengguna");

			$style_col = array(  'font' => array('bold' => true),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);

			$style_row = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);

			$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Daftar Pengguna Tahun ".$tahun);
			$excel->getActiveSheet()->mergeCells('A1:G1');

			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
			$excel->setActiveSheetIndex(0)->setCellValue('B3', "Nama");
			$excel->setActiveSheetIndex(0)->setCellValue('C3', "Nomor HP");
			$excel->setActiveSheetIndex(0)->setCellValue('D3', "E-mail");
			$excel->setActiveSheetIndex(0)->setCellValue('E3', "Jenis Kelamin");
			$excel->setActiveSheetIndex(0)->setCellValue('F3', "Alamat");
			$excel->setActiveSheetIndex(0)->setCellValue('G3', "Waktu");

			$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);

			$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
			$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
			$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

			$no = 1;
			$numrow = 4;
			foreach($stmt->result() as $item) {
				$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
				$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $item->nama_pengguna);
				$excel->setActiveSheetIndex(0)->setCellValueExplicit('C' . $numrow, $item->nohp_pengguna, PHPExcel_Cell_DataType::TYPE_STRING);
				$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $item->email_pengguna);
				$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $item->sex_pengguna);
				$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $item->alamat_pengguna);
				$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $item->waktu);

				$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
				$no++;
				$numrow++;
			}

			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$excel->getActiveSheet(0)->setTitle("Laporan Daftar Pengguna");
			$excel->setActiveSheetIndex(0);

			// Proses file excel
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="Laporan Daftar Pengguna.xlsx"');

			// Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		}

	}

	public function laporan_tanaman(){
		$tahun = $this->input->get('tahun');
		$stmt = $this->M_admin->laporan_tanaman($tahun);
		if ($this->input->get('tipe')=="pdf"){
			$tahun = $tahun;
			$data['data'] = $stmt;
			$data['tahun'] = $tahun;
			$this->load->view('admin/laporan_tanaman',$data);
		} else {
			$this->load->library('Excel_generator');
			$excel = new PHPExcel();
			$excel->getProperties()->setCreator('Laporan Daftar Tanaman')
				->setLastModifiedBy('Laporan Daftar Tanaman')
				->setTitle("Laporan Daftar Tanaman")
				->setSubject("Laporan Daftar Tanaman")
				->setDescription("Laporan Daftar Tanaman")
				->setKeywords("Laporan Daftar Tanaman");

			$style_col = array(  'font' => array('bold' => true),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);

			$style_row = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
				)
			);

			$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Daftar Tanaman Tahun ".$tahun);
			$excel->getActiveSheet()->mergeCells('A1:G1');

			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
			$excel->setActiveSheetIndex(0)->setCellValue('B3', "Nama Tanaman");
			$excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Pengguna");
			$excel->setActiveSheetIndex(0)->setCellValue('D3', "Penyiraman Perhari");
			$excel->setActiveSheetIndex(0)->setCellValue('E3', "Deskripsi Tanaman");
			$excel->setActiveSheetIndex(0)->setCellValue('F3', "Tanggal Penanaman");

			$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);

			$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
			$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
			$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

			$no = 1;
			$numrow = 4;
			foreach($stmt->result() as $item) {
				$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
				$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $item->nama_tanaman);
				$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $item->nama_pengguna);
				$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $item->penyiraman_tanaman);
				$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $item->deskripsi_tanaman);
				$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $item->waktu);

				$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
				$no++;
				$numrow++;
			}

			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$excel->getActiveSheet(0)->setTitle("Laporan Daftar Pengguna");
			$excel->setActiveSheetIndex(0);

			// Proses file excel
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="Laporan Daftar Tanaman.xlsx"');

			// Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		}
	}

	public function profil()
	{
		$this->template->template_admin('admin/profil');
	}

	public function profil_ubah_exe(){
		$where['id_tb_pengguna'] = $this->session->userdata('id_tb_pengguna');
		$update['username_pengguna'] = $this->input->post('username_pengguna');
		$update['password_pengguna'] = md5($this->input->post('password_pengguna'));
		if ($this->M_admin->profil_ubah($where,$update)){
			$this->session->set_userdata(array('username'=>$this->input->post('username_pengguna')));
			$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">Berhasil Mengubah Profil</div>');
			redirect(base_url('Admin/profil'));
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">Gagal Mengubah Profil</div>');
			redirect(base_url('Admin/profil'));
		}
	}

	public function log_out(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
