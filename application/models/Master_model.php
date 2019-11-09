<?php

class Master_model extends CI_Model {
	public function __construct() {
		parent::__construct();

		//memuat library database
		$this->load->database();
	}

	public function baca_tabel ($tabel){
		// $query = $this->db->query("SELECT * FROM $tabel");
		$query = $this->db->get($tabel);
		return $query->result_array();
	}

	public function baca_tabel_id($id, $table){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('no_PB', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_pb($id){
		// $this->db->query("SELECT a.no_PB, b.nama_gudang, c.nama_pegawai, d.nama_departemen, a.tanggal, a.keterangan FROM permintaan_barang a LEFT OUTER JOIN gudang b ON a.id_gudang = b.id_gudang LEFT OUTER JOIN pegawai c ON a.id_pegawai = c.id_pegawai LEFT OUTER JOIN departemen d ON a.id_departemen = d.id_departemen WHERE a.no_PB = '$id'");
		$this->db->select('a.no_PB, b.nama_gudang, c.nama_pegawai, d.nama_departemen, a.tanggal, a.keterangan');
		$this->db->from('permintaan_barang a');
		$this->db->join('gudang b', 'a.id_gudang=b.id_gudang', 'left');
		$this->db->join('pegawai c', 'a.id_pegawai=c.id_pegawai', 'left');
		$this->db->join('departemen d', 'a.id_departemen=d.id_departemen', 'left');
		$this->db->where('a.no_PB', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_pb_detail($id){
		$this->db->select('a.kode_barang, b.nama_barang, a.keterangan, a.jumlah, c.nama_satuan');
		$this->db->from('permintaan_barang_detail a');
		$this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
		$this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
		$this->db->where('a.no_PB', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_barang_by_kategori($id){
		$this->db->select('kode_barang as id, nama_barang as text');
		$this->db->from('master_barang');
		$this->db->where('id_kategori',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_satuan_barang($id){
		$this->db->select('nama_satuan');
		$this->db->from('satuan_barang');
		$this->db->join('master_barang', 'master_barang.id_satuan = satuan_barang.id_satuan');
		$this->db->where('kode_barang', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function save($table, $data)
	{
		$this->db->insert($table, $data);
		// echo $this->db->last_query();
		return $this->db->insert_id();
		
	}

	public function get_last_no_pb($data)
	{
		$this->db->select('no_PB');
		$this->db->from('permintaan_barang');
		$this->db->like('no_PB', $data, 'after');
		$this->db->order_by('no_PB', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
}