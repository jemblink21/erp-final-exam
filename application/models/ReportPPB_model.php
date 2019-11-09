<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportPPB_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    public function report_ppb($tAwal, $tAkhir, $gudang){
        $query = $this->db->query('SELECT * FROM permintaan_pembelian WHERE tanggal >= "'.$tAwal.'" AND tanggal <= "'.$tAkhir.'" AND id_gudang like "'.$gudang.'"');
		return $query->result_array();
    }

    public function report_ppb_detail($no_ppb){
        $this->db->select('*');
        $this->db->from('permintaan_pembelian_detail');
        $this->db->where('no_ppb', $no_ppb);
        $query = $this->db->get();
        return $query->result_array();
    }
}