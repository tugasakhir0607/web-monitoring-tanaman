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
