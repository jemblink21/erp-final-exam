<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpb_model extends CI_Model {

	var $table = 'penerimaan_barang';
	var $column_order = array('no_bpb','nama_gudang','nama_supplier','tanggal','keterangan',null); //set column field database for datatable orderable
	var $column_search = array('no_bpb','nama_gudang','nama_supplier','tanggal','keterangan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('no_bpb' => 'asc'); // default order 

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _get_datatables_query()
	{
		$this->db->select('a.no_bpb, b.nama_gudang, c.nama_supplier, a.tanggal, a.keterangan');	
		$this->db->from('penerimaan_barang a');
		$this->db->join('gudang b', 'a.id_gudang = b.id_gudang');
        $this->db->join('supplier c', 'a.id_supplier = c.id_supplier');

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
		$this->db->where('no_bpb',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function baca_tabel_bpb($id){
		$this->db->select('a.no_bpb, b.nama_supplier, c.nama_gudang, a.no_po, a.tanggal, a.keterangan');
		$this->db->from('penerimaan_barang a');
		$this->db->join('supplier b', 'a.id_supplier = b.id_supplier', 'left');
		$this->db->join('gudang c', 'a.id_gudang = c.id_gudang', 'left');
		$this->db->where('a.no_bpb', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_bpb_detail($id){
		$this->db->select('a.no_po_detail, a.no_po, a.kode_barang, b.nama_barang, a.deskripsi, a.jumlah, c.nama_satuan');
		$this->db->from('penerimaan_barang_detail a');
		$this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
		$this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
		$this->db->where('a.no_bpb', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
    
    public function baca_tabel_po($id)
	{
		$this->db->select('no_po as id, no_po as text');
		$this->db->from('pembelian_barang');
		$this->db->where('id_supplier',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function baca_tabel_po_detail($id)
	{
		$this->db->select('a.kode_barang as id, b.nama_barang as text, a.no_po_detail');
		$this->db->from('pembelian_barang_detail a');
		$this->db->join('master_barang b', 'b.kode_barang = a.kode_barang', 'left');
		$this->db->where('a.no_po', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function baca_tabel_barang_detail($id)
	{
		$query = $this->db->query('SELECT SUM(a.jumlah - COALESCE((SELECT SUM(jumlah) FROM penerimaan_barang_detail WHERE no_po_detail = "'.$id.'"),0)) jumlah, b.nama_satuan FROM pembelian_barang_detail a LEFT JOIN satuan_barang b ON b.id_satuan = (SELECT id_satuan FROM master_barang WHERE kode_barang = (SELECT kode_barang FROM pembelian_barang_detail WHERE no_po_detail = "'.$id.'")) WHERE a.no_po_detail = "'.$id.'"');
		return $query->row();
	}

	public function get_last_no_bpb($data)
	{
		$this->db->select('no_bpb');
		$this->db->from('penerimaan_barang');
		$this->db->like('no_bpb', $data, 'after');
		$this->db->order_by('no_bpb', 'desc');
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

	public function delete_bpb_detail($id)
	{
		$this->db->query('DELETE FROM penerimaan_barang_detail WHERE no_bpb = "'.$id.'"');
	}
	public function delete_bpb($id)
	{	
		$this->db->query('DELETE FROM penerimaan_barang WHERE no_bpb = "'.$id.'"');
		// echo $this->db->last_query();
	}

	public function delete_stock($id)
	{
		$this->db->query('DELETE FROM stock WHERE no_ref ="'.$id.'"');
	}

	public function update($where, $data, $table)
	{
		$this->db->update($table, $data, 'no_bpb="'.$where.'"');
		return $this->db->affected_rows();
	}
}