<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model
{
	public function login($where){
		return $this->db->get_where('tb_pengguna',$where);
	}

    public function getTanaman(){
        return $this->db->get_where('tb_tanaman',array('delflage'=>1));
    }

    public function getSensor(){
        return $this->db->get('tb_sensor');
    }

    public function getGrafikSensor(){
		return $this->db->select('date(waktu) as wkt, AVG(kelembapan) as jml')->group_by('date(waktu)')->get('tb_sensor');
	}

    public function getPengguna(){
		return $this->db->get_where('tb_pengguna',array('type_pengguna'=>"petani",'delflage'=>1));
	}

    public function getPenggunaDetail($id){
		return $this->db->get_where('tb_pengguna',array('id_tb_pengguna'=>$id));
	}

	public function getTanamanPengguna($id){
		return $this->db->get_where('tb_tanaman',array('id_tb_pengguna'=>$id));
	}

	public function getTanamanDetail($id){
		return $this->db->select('tb_tanaman.*, tb_pengguna.nama_pengguna, tb_pengguna.username_pengguna, tb_pengguna.email_pengguna,
				tb_pengguna.nohp_pengguna, tb_pengguna.sex_pengguna, tb_pengguna.alamat_pengguna')
			->join('tb_pengguna','tb_pengguna.id_tb_pengguna = tb_tanaman.id_tb_pengguna')
			->get_where('tb_tanaman',array('tb_tanaman.id_tb_tanaman'=>$id));
	}

	public function getTanamanPenyiraman($id){
		return $this->db->select('DATE(waktu) as tgl, TIME(waktu) as wkt')->order_by('id_tb_tanaman')
			->get_where('tb_sensor',array('id_tb_tanaman'=>$id,'pompa'=>"ON"));
	}

	public function profil_ubah($where,$udpate){
		return $this->db->where($where)->update('tb_pengguna',$udpate);
	}

	public function penggunaTambah($input){
		return $this->db->insert('tb_pengguna',$input);
	}

	public function penggunaUbah($where,$udpate){
		return $this->db->where($where)->update('tb_pengguna',$udpate);
	}
}
