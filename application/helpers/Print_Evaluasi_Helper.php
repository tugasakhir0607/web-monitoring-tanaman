<?php
define('FPDF_FONTPATH',APPPATH .'plugins/font/');
require(APPPATH .'plugins/fpdf.php');

class Print_Evaluasi_Helper extends FPDF
{
  function __construct()
  {
    parent::__construct();
    $ci =& get_instance();
  }
  function judul()
  {
    $this->image('assets/img/motan3.png',27,13,38,18);
    $this->Cell(35);
    $this->cell(0,5,"",0,1);
    $this->Cell(5);
    $this->SetFont('Times','B','18');
    $this->Cell(0,8,"Monitoring Tanaman",0,1,'C');
    $this->Cell(5);
    $this->SetFont('Times','B','14');
    $this->Cell(0,8,"Hasil Evaluasi",0,1,'C');
    $this->Cell(15);
    $this->cell(0,10,"",0,1);
  }

  function garis()
  {
    $this->SetLineWidth(1);
    $this->Line(10,37,200,37);
    $this->SetLineWidth(0);
    $this->Line(10,38,200,38);
  }
  function teks($stmt)
  {
    $this->cell(0,10,"",0,1);
    $this->Cell(10);
    $this->setFont('times','',12);
    $this->cell(0,8,"Pemilik Tanaman                : $stmt->nama_pengguna",0,1);
    $this->Cell(10);
    $this->setFont('times','',12);
    $this->cell(0,8,"Nama Tanaman                   : $stmt->nama_tanaman",0,1);
    $this->Cell(10);
    $this->setFont('times','',12);
    $this->cell(0,8,"Deskripsi Tanaman             : $stmt->deskripsi_tanaman",0,1);
    $this->Cell(10);
    $this->setFont('times','',12);
    $this->cell(0,8,"Tanggal Penanaman            : $stmt->tgl_penanaman",0,1);
    $this->cell(0,10,"",0,1);
    $this->Cell(10);
    $this->setFont('times','BU',14);
    $this->cell(0,8,"Evaluasi",0,1);
    $this->Cell(10);
    $this->setFont('times','',12);
    $this->cell(0,8,"1. Saran                :",0,1);
    $this->Cell(15);
    $this->setFont('times','',12);
    $this->cell(0,8,$stmt->saran_evaluasi,0,1);
    $this->Cell(10);
    $this->setFont('times','',12);
    $this->cell(0,8,"2. Keterangan       :",0,1);
    $this->Cell(15);
    $this->setFont('times','',12);
    $this->cell(0,8,$stmt->keterangan_evaluasi,0,1);
  }
  function penutup()
  {
    $this->cell(0,40,"",0,1);
    $this->Cell(140);
    $this->setFont('times','',12);
    $this->cell(0,8,"Tegal, ".date('d m Y'),0,1);
  }
}
?>
