<?php
class Ppb_model extends CI_Model {

	var $table = 'permintaan_pembelian';
	var $column_order = array('no_ppb','nama_gudang','nama_departemen','nama_pegawai','tanggal', 'keterangan',null); //set column field database for datatable orderable
	var $column_search = array('no_ppb','nama_gudang','nama_departemen','nama_pegawai','tanggal', 'keterangan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('no_ppb' => 'asc'); // default order 

	public function __construct() {
		parent::__construct();

		//memuat library database
		$this->load->database();
    }

    public function get_last_no_ppb($data)
	{
		$this->db->select('no_ppb');
		$this->db->from('permintaan_pembelian');
		$this->db->like('no_ppb', $data, 'after');
		$this->db->order_by('no_ppb', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	private function _get_datatables_query()
	{
		$this->db->select('a.no_ppb, b.nama_gudang, c.nama_departemen, d.nama_pegawai, a.tanggal, a.keterangan');	
		$this->db->from('permintaan_pembelian a');
		$this->db->join('gudang b', 'a.id_gudang = b.id_gudang');
        $this->db->join('departemen c', 'a.id_departemen = c.id_departemen');
        $this->db->join('pegawai d', 'a.id_pegawai = d.id_pegawai');

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
		$this->db->where('no_ppb',$id);
		$query = $this->db->get();

		return $query->row();
	}


	public function baca_tabel_ppb_detail($id){
		$this->db->select('a.no_ppb_detail, a.kode_barang, b.nama_barang, a.keterangan, a.jumlah, c.nama_satuan');
		$this->db->from('permintaan_pembelian_detail a');
		$this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
		$this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
		$this->db->where('a.no_ppb', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data, $table)
	{
		$this->db->update($table, $data, 'no_ppb="'.$where.'"');
		// echo $this->db->last_query();
		return $this->db->affected_rows();
	}

	public function delete_by_id($id, $table)
	{
		$this->db->where('no_ppb', $id);
		$this->db->delete($table);
	}
	public function delete_ppb($id)
	{	
		$this->db->query('DELETE FROM permintaan_pembelian WHERE no_ppb = "'.$id.'"');
		// echo $this->db->last_query();
	}
	public function delete_ppb_detail($id)
	{
		$this->db->query('DELETE FROM permintaan_pembelian_detail WHERE no_ppb = "'.$id.'"');
	}
}