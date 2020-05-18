<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public $result = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_api');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{

	}

	public function api_signup(){
		$input['nama_pengguna'] = $this->input->post('nama_pengguna');
		$input['username_pengguna'] = $this->input->post('username_pengguna');
		$input['email_pengguna'] = $this->input->post('email_pengguna');
		$input['nohp_pengguna'] = $this->input->post('nohp_pengguna');
		$input['sex_pengguna'] = $this->input->post('sex_pengguna');
		$input['alamat_pengguna'] = $this->input->post('alamat_pengguna');
		$input['password_pengguna'] = md5($this->input->post('password_pengguna'));
		$input['waktu'] = date('Y-m-d H:i:s');
		$stmt = $this->M_api->inputPengguna($input);
		if ($stmt){
			array_push($this->result,array('status'=>1));
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_login()
	{
		$where['username_pengguna'] = $this->input->post('username_pengguna');
		$where['password_pengguna'] = md5($this->input->post('password_pengguna'));
		$where['type_pengguna']		= "Petani";
		$cek = $this->M_api->login($where);
		if ($cek->num_rows() > 0) {
			$data = $cek->row();
			$pengguna = array(
				'status'=>1,
				'id_tb_pengguna'=>$data->id_tb_pengguna,
				'nama_pengguna'=>$data->nama_pengguna,
				'username_pengguna'=>$data->username_pengguna,
				'email_pengguna'=>$data->email_pengguna,
				'nohp_pengguna'=>$data->nohp_pengguna,
				'sex_pengguna'=>$data->sex_pengguna,
				'alamat_pengguna'=>$data->alamat_pengguna
			);
			array_push($this->result,$pengguna);
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_inptSensor(){
		$input['kelembapan'] = $kelembapan = $this->input->get('kelembapan');
		$input['pompa'] = $pompa = $this->input->get('pompa');
		$input['keterangan'] = $keterangan = $this->input->get('keterangan');
		$input['waktu'] = date('Y-m-d H:i:s');
		$stmt = $this->M_api->inputSensor($input);
		if ($stmt){
			echo "Sukses - Tersimpan : ".$kelembapan.$pompa.$keterangan;
		} else {
			echo "Gagal";
		}
	}

	public function api_inputTanaman(){
		$uploadPath = './assets/img/tanaman/';
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		$config['file_name'] = date('ymdHis');

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('foto')){
			$fileData = $this->upload->data();
			$nama_foto = $fileData['file_name'];
			$tipe = $fileData['file_type'];
			if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
				$image_data = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_data['full_path'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 822;
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}

			$input['id_tb_pengguna'] = $this->input->post('id_tb_pengguna');
			$input['nama_tanaman'] = $this->input->post('nama_tanaman');
			$input['penyiraman_tanaman'] = $this->input->post('penyiraman_tanaman');
			$input['pemupukan_tanaman'] = $this->input->post('pemupukan_tanaman');
			$input['deskripsi_tanaman'] = $this->input->post('deskripsi_tanaman');
			$input['foto_tanaman'] = $nama_foto;
			$input['waktu'] = date('Y-m-d H:i:s');
			$stmt = $this->M_api->inputTanaman($input);
			if ($stmt){
				array_push($this->result,array('status'=>1));
			} else {
				array_push($this->result,array('status'=>0));
			}
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_getTanaman(){
		$where['id_tb_pengguna']= $this->input->post('id_tb_pengguna');
		$where['delflage']		= 1;
		$stmt = $this->M_api->getTanaman($where)->result();
		$this->setJSON(array('result'=>$stmt));
	}

	public function api_getTanamanDetail(){
		$where['id_tb_tanaman']= $this->input->post('id_tb_tanaman');
		$stmt = $this->M_api->getTanamanDetail($where)->result();
		$this->setJSON(array('result'=>$stmt));
	}

	public function api_updateTanaman(){
	$uploadPath = './assets/img/tanaman/';
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		$config['file_name'] = date('ymdHis');

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('foto')){
			$fileData = $this->upload->data();
			$nama_foto = $fileData['file_name'];
			$tipe = $fileData['file_type'];
			if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
				$image_data = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_data['full_path'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 822;
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
			$update['foto_tanaman'] = $nama_foto;
			$foto_lama = $this->input->post('foto_lama');
			if (file_exists($uploadPath.$foto_lama)) {
				unlink($uploadPath.$foto_lama);
			}
		}

		$where['id_tb_tanaman'] = $this->input->post('id_tb_tanaman');
		$update['nama_tanaman'] = $this->input->post('nama_tanaman');
		$update['penyiraman_tanaman'] = $this->input->post('penyiraman_tanaman');
		$update['pemupukan_tanaman'] = $this->input->post('pemupukan_tanaman');
		$update['deskripsi_tanaman'] = $this->input->post('deskripsi_tanaman');
		$stmt = $this->M_api->updateTanaman($where,$update);
		if ($stmt){
			array_push($this->result,array('status'=>1));
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_updatePenyiraman()
	{
		$where['id_tb_tanaman'] = $this->input->post('id_tb_tanaman');
		$update['stt_siram'] = $this->input->post('stt_siram');
		$stmt = $this->M_api->updateTanaman($where,$update);
		if ($stmt){
			array_push($this->result,array('status'=>1));
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_getKelembaban(){
		$where['id_tb_tanaman'] = $this->input->post('id_tb_tanaman');
		$stmt = $this->M_api->getKelembaban($where)->result();
		$this->setJSON(array('result'=>$stmt));
	}

	public function api_getPenyiraman(){
		$where['id_tb_tanaman'] = $this->input->post('id_tb_tanaman');
		$where['pompa'] = "ON";
		$stmt = $this->M_api->getPenyiraman($where)->result();
		$this->setJSON(array('result'=>$stmt));
	}

	public function api_getGrafikKelembapan(){
		$where['id_tb_tanaman'] = $this->input->post('id_tb_tanaman');
		$stmt = $this->M_api->getGrafikKelembapan($where)->result();
		$this->setJSON(array('result'=>$stmt));
	}

	public function api_getGaleri(){
		$where['id_tb_tanaman'] = $this->input->post('id_tb_tanaman');
		$where['delflage'] = 1;
		$stmt = $this->M_api->getGaleri($where)->result();
		$this->setJSON(array('result'=>$stmt));
	}

	public function api_inputGaleri(){
		$uploadPath = './assets/img/galeri/';
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		$config['file_name'] = date('ymdHis');

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('foto')){
			$fileData = $this->upload->data();
			$nama_foto = $fileData['file_name'];
			$tipe = $fileData['file_type'];
			if ($tipe == "image/jpeg" || $tipe == "image/png" || $tipe == "image/jpg") {
				$image_data = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_data['full_path'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 822;
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}

			$input['id_tb_tanaman'] = $this->input->post('id_tb_tanaman');
			$input['deskripsi'] = $this->input->post('deskripsi');
			$input['foto'] = $nama_foto;
			$input['waktu'] = date('Y-m-d H:i:s');
			$stmt = $this->M_api->inputGaleri($input);
			if ($stmt){
				array_push($this->result,array('status'=>1));
			} else {
				array_push($this->result,array('status'=>0));
			}
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_deleteGaleri(){
		$where['id_tb_galeri'] = $this->input->post('id_tb_galeri');
		$update['delflage'] = 0;
		$stmt = $this->M_api->updateGaleri($where,$update);
		if ($stmt){
			array_push($this->result,array('status'=>1));
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_updateProfil(){
		$where['id_tb_pengguna'] = $this->input->post('id_tb_pengguna');
		$update['nama_pengguna'] = $this->input->post('nama_pengguna');
		$update['username_pengguna'] = $this->input->post('username_pengguna');
		$update['email_pengguna'] = $this->input->post('email_pengguna');
		$update['nohp_pengguna'] = $this->input->post('nohp_pengguna');
		$update['sex_pengguna'] = $this->input->post('sex_pengguna');
		$update['alamat_pengguna'] = $this->input->post('alamat_pengguna');
		$stmt = $this->M_api->updateProfil($where,$update);
		if ($stmt){
			array_push($this->result,array('status'=>1));
		} else {
			array_push($this->result,array('status'=>0));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function api_updatePassword()
	{
		$where['id_tb_pengguna'] = $this->input->post('id_tb_pengguna');
		$password_lama = $this->input->post('password_lama');
		$dt = $this->M_api->login($where)->row();
		if ($dt->password_pengguna == md5($password_lama)) {
			$update['password_pengguna'] = md5($this->input->post('password_ulangi'));
			$stmt = $this->M_api->updateProfil($where,$update);
			if ($stmt){
				array_push($this->result,array('status'=>1));
			} else {
				array_push($this->result,array('status'=>0));
			}
		} else {
			array_push($this->result,array('status'=>2));
		}
		$this->setJSON(array('result'=>$this->result));
	}

	public function setJSON($response)
	{
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}
