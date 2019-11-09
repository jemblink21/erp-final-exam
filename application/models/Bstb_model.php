<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bstb_model extends CI_Model {

	var $table = 'pengeluaran_barang';
	var $column_order = array('no_bstb','nama_gudang','nama_departemen','nama_pegawai', 'nama_kategori', 'tanggal', 'keterangan',null); //set column field database for datatable orderable
	var $column_search = array('no_bstb','nama_gudang','nama_departemen','nama_pegawai', 'nama_kategori', 'tanggal', 'keterangan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('no_bstb' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	private function _get_datatables_query()
	{
		$this->db->select('a.no_bstb, b.nama_gudang, c.nama_departemen, d.nama_pegawai, e.nama_kategori, a.tanggal, a.keterangan');	
		$this->db->from('pengeluaran_barang a');
		$this->db->join('gudang b', 'a.id_gudang = b.id_gudang');
		$this->db->join('departemen c', 'a.id_departemen = c.id_departemen');
		$this->db->join('pegawai d', 'a.id_pegawai = d.id_pegawai');
		$this->db->join('kategori_barang e', 'a.id_kategori = e.id_kategori');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('no_bstb',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function baca_tabel_bstb($id){
		$this->db->select('a.no_bstb, b.nama_gudang, c.nama_pegawai, d.nama_departemen, a.tanggal, a.keterangan');
		$this->db->from('pengeluaran_barang a');
		$this->db->join('gudang b', 'b.id_gudang = a.id_gudang', 'left');
		$this->db->join('pegawai c', 'c.id_pegawai = a.id_pegawai', 'left');
		$this->db->join('departemen d', 'd.id_departemen = a.id_departemen', 'left');
		$this->db->where('a.no_bstb', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_bstb_detail($id){
		$this->db->select('a.no_PB_detail, a.no_PB, a.kode_barang, b.nama_barang, a.deskripsi, a.jumlah, c.nama_satuan');
		$this->db->from('pengeluaran_barang_detail a');
		$this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
		$this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
		$this->db->where('a.no_bstb', $id);
		$query = $this->db->get();
		return $query->result_array();
		// echo $this->db->last_query();
	}

	public function baca_tabel_pb($id)
	{
		$this->db->select('no_PB as id, no_PB as text');
		$this->db->from('permintaan_barang');
		$this->db->where('id_kategori',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
    
    public function barang_spb($id){
		$this->db->select('a.kode_barang as id, b.nama_barang as text, a.no_PB_detail');
		$this->db->from('permintaan_barang_detail a');
		$this->db->join('master_barang b', 'a.kode_barang=b.kode_barang', 'left');
		$this->db->where('no_PB', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function baca_tabel_barang_detail($id){
		$query = $this->db->query('SELECT SUM(a.jumlah - COALESCE((SELECT SUM(jumlah) FROM pengeluaran_barang_detail WHERE no_PB_detail = "'.$id.'"),0)) jumlah, b.nama_satuan FROM permintaan_barang_detail a LEFT JOIN satuan_barang b ON b.id_satuan = (SELECT id_satuan FROM master_barang WHERE kode_barang = (SELECT kode_barang FROM permintaan_barang_detail WHERE no_PB_detail = "'.$id.'")) WHERE a.no_PB_detail = "'.$id.'"');
		return $query->row();
	}

	public function get_last_no_bstb($data){
		$this->db->select('no_bstb');
		$this->db->from('pengeluaran_barang');
		$this->db->like('no_bstb', $data, 'after');
		$this->db->order_by('no_bstb', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function save($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();	
	}

	public function update($where, $data, $table)
	{
		$this->db->update($table, $data, 'no_bstb="'.$where.'"');
		return $this->db->affected_rows();
		// echo $this->db->last_query();
	}

	public function delete_bstb($id)
	{	
		$this->db->query('DELETE FROM pengeluaran_barang WHERE no_bstb = "'.$id.'"');
		// echo $this->db->last_query();
	}

	public function delete_bstb_detail($id)
	{
		$this->db->query('DELETE FROM pengeluaran_barang_detail WHERE no_bstb = "'.$id.'"');
		// echo $this->db->last_query();
	}
	public function delete_stock($id)
	{
		$this->db->query('DELETE FROM stock WHERE no_ref = "'.$id.'"');
	}
}