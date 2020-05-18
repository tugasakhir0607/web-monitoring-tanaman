<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (isset($this->session->userdata['login_admin_monitoring_tanaman']) == TRUE) {
			redirect(base_url('Admin'));
		}
		$this->load->model('M_admin');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login_exe(){
		$input = $this->input->post();
		$where['type_pengguna'] = 'admin';
		$where['username_pengguna'] = $input['username'];
		$where['password_pengguna'] = md5($input['password']);
		$stmt = $this->M_admin->login($where);
		if ($stmt->num_rows() > 0){
			$data = $stmt->row();
			$this->session->set_userdata(
				array(
					'id_tb_pengguna'=>$data->id_tb_pengguna,
					'nama'=>$data->nama_pengguna,
					'username'=>$data->username_pengguna,
					'login_admin_monitoring_tanaman'=>true
				)
			);
			redirect(base_url('Admin'));
		} else {
			$this->session->set_flashdata('info','<div class="alert alert-danger alert-dismissable">Username dan Password Tidak diketahui</div>');
			redirect(base_url());
		}
	}
}
