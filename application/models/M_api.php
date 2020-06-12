<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model
{

	public function inputPengguna($input){
		return $this->db->insert('tb_pengguna',$input);
	}

	public function login($where)
	{
		return $this->db->get_where('tb_pengguna',$where);
	}

	public function inputSensor($input){
		return $this->db->insert('tb_sensor',$input);
	}

	public function inputTanaman($input){
		$this->db->insert('tb_tanaman',$input);
		$id = $this->db->insert_id();
		$input['id_tb_tanaman'] = $id;
		$input['waktu'] = date('Y-m-d H:i:s');
		return $this->db->insert('tb_evaluasi',$input);
	}

	public function updateTanaman($where,$update){
		return $this->db->where($where)->update('tb_tanaman',$update);
	}

    public function getTanaman($where){
        return $this->db->order_by('id_tb_tanaman',"DESC")->get_where('tb_tanaman',$where);
    }

    public function getTanamanDetail($where){
        return $this->db->get_where('tb_tanaman',$where);
    }

    public function getKelembaban($where,$offset=NULL){
        if (!empty($offset)){
        	$this->db->limit(20,$offset);
		}
		return $this->db->order_by('id_tb_sensor',"DESC")
			->get_where('tb_sensor',$where);
    }

    public function getPenyiraman($where,$offset=NULL){
		if (!empty($offset)){
			$this->db->limit(20,$offset);
		}
        return $this->db->order_by('id_tb_sensor',"DESC")
			->get_where('tb_sensor',$where);
    }
	
	public function getGrafikKelembapan($where){
		return $this->db->select('date(waktu) as wkt, CEIL(AVG(kelembapan)) as jml')->group_by('date(waktu)')
			->get_where('tb_sensor',$where);
	}
	
	public function getGaleri($where){
		return $this->db->order_by('id_tb_galeri',"DESC")
			->get_where('tb_galeri',$where);
	}

	public function inputGaleri($input){
		return $this->db->insert('tb_galeri',$input);
	}

	public function updateGaleri($where,$update)
	{
		return $this->db->where($where)->update('tb_galeri',$update);
	}

	public function updateProfil($where,$update)
	{
		return $this->db->where($where)->update('tb_pengguna',$update);
	}

	public function getEvaluasi($where)
	{
		return $this->db->select('tb_tanaman.nama_tanaman, tb_tanaman.deskripsi_tanaman, DATE(tb_tanaman.waktu) as tgl_penanaman,
			tb_pengguna.nama_pengguna,
			tb_evaluasi.*')
		->join('tb_tanaman','tb_tanaman.id_tb_tanaman = tb_evaluasi.id_tb_tanaman')
		->join('tb_pengguna','tb_pengguna.id_tb_pengguna = tb_tanaman.id_tb_pengguna')
		->where($where)->get('tb_evaluasi');
	}

	public function updateEvaluasi($where,$update)
	{
		return $this->db->where($where)->update('tb_evaluasi',$update);
	}

}
