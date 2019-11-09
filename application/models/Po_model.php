<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po_model extends CI_Model {

	var $table = 'pembelian_barang';
	var $column_order = array('no_po','nama_supplier','tanggal','keterangan','nama_kategori', 'total_harga',null); //set column field database for datatable orderable
	var $column_search = array('no_po','nama_supplier','tanggal','keterangan','nama_kategori', 'total_harga'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('no_po' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	private function _get_datatables_query()
	{
		$this->db->select('a.no_po, b.nama_supplier, a.tanggal, a.keterangan, c.nama_kategori, a.total_harga');	
		$this->db->from('pembelian_barang a');
		$this->db->join('supplier b', 'a.id_supplier = b.id_supplier');
        $this->db->join('kategori_barang c', 'a.id_kategori = c.id_kategori');

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
		$this->db->where('no_po',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function baca_tabel_po($id){
		$this->db->select('a.no_po, b.nama_supplier, b.alamat, a.tanggal, a.keterangan, a.total_harga');
		$this->db->from('pembelian_barang a');
		$this->db->join('supplier b', 'a.id_supplier = b.id_supplier', 'left');
		$this->db->where('a.no_po', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_po_detail($id){
		$this->db->select('a.no_ppb_detail, a.no_ppb, a.kode_barang, b.nama_barang, a.deskripsi, a.jumlah, c.nama_satuan, a.harga');
		$this->db->from('pembelian_barang_detail a');
		$this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
		$this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
		$this->db->where('a.no_po', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_ppb($id)
	{
		$this->db->select('no_ppb as id, no_ppb as text');
		$this->db->from('permintaan_pembelian');
		$this->db->where('id_kategori',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
    
    public function baca_tabel_ppb_detail($id)
    {
			$this->db->select('a.kode_barang as id, b.nama_barang as text, a.no_ppb_detail');
			$this->db->from('permintaan_pembelian_detail a');
			$this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
			$this->db->where('no_ppb',$id);
			$query = $this->db->get();
			return $query->result_array();
		}
		
	public function baca_tabel_barang_detail($id)
	{
		$query = $this->db->query('SELECT SUM(a.jumlah - COALESCE((SELECT SUM(jumlah) FROM pembelian_barang_detail WHERE no_ppb_detail = "'.$id.'"),0)) jumlah, b.nama_satuan FROM permintaan_pembelian_detail a LEFT JOIN satuan_barang b ON b.id_satuan = (SELECT id_satuan FROM master_barang WHERE kode_barang = (SELECT kode_barang FROM permintaan_pembelian_detail WHERE no_ppb_detail = "'.$id.'")) WHERE a.no_ppb_detail = "'.$id.'"');
		// $query = $this->db->get();
		// echo $this->db->last_query();
		return $query->row();
	}

	public function get_last_no_po($data)
	{
		$this->db->select('no_po');
		$this->db->from('pembelian_barang');
		$this->db->like('no_po', $data, 'after');
		$this->db->order_by('no_po', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function save($table, $data)
	{
		$this->db->insert($table, $data);
		// echo $this->db->last_query();
		return $this->db->insert_id();	
	}

	public function update($where, $data, $table)
	{
		$this->db->update($table, $data, 'no_po="'.$where.'"');
		return $this->db->affected_rows();
	}

	public function delete_by_id($id, $table)
	{
		$this->db->where('no_po', $id);
		$this->db->delete($table);
	}

	public function delete_po_detail($id)
	{
		$this->db->query('DELETE FROM pembelian_barang_detail WHERE no_po = "'.$id.'"');
	}
	public function delete_po($id)
	{	
		$this->db->query('DELETE FROM pembelian_barang WHERE no_po = "'.$id.'"');
		// echo $this->db->last_query();
	}
}