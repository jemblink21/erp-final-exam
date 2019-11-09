<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// memuat model
		$this->load->model('Master_model');
		$this->model = $this->Master_model;

		$this->load->model('barang_model', 'barang');
		$this->load->model('kategori_model', 'kategori');
		$this->load->model('satuan_model', 'satuan');
		$this->load->model('supplier_model', 'supplier');
		$this->load->model('departemen_model', 'dept');
		$this->load->model('Gudang_model', 'gudang');
		$this->load->model('Pegawai_model', 'pegawai');
		// memuat helper URL
		$this->load->helper('url'); 

		if (!$this->session->has_userdata('username')) {
			$this->session->set_flashdata('result_login','Anda belum login');
			redirect('login');
		}
	}
	
	public function index() {
		$data = array( 'title' => 'Master - PT. GMS');
		$this->load->view('layout/wrapper_master', $data);
	}

	public function barang() {
		$data = $this->model->baca_tabel("kategori_barang");
		$data2 = $this->model->baca_tabel("satuan_barang");
		$data = array('data' => $data, 
					'data2' => $data2, 
					'title' => 'Master Barang - PT. GMS');
		$this->load->view('layout/wrapper_master_barang', $data);
	}


	public function kategori() {
		$data = array('title' => 'Kategori Barang - PT. GMS');
		$this->load->view('layout/wrapper_kategori_barang', $data);
	}

	public function pegawai(){
		$data = $this->model->baca_tabel("departemen");
		$data = array(	'data' => $data,
						'title' => 'Data Pegawai - PT. GMS');
		$this->load->view('layout/wrapper_pegawai', $data);
	}

	public function satuan() {
		$data = array('title' => 'Satuan Barang - PT. GMS');
		$this->load->view('layout/wrapper_satuan_barang', $data);
		if ($this->input->post('namaSatuan')){
			$nama = $this->input->post('namaSatuan');
			$this->model->tambah_satuan($nama);
		}
	}

	public function supplier() {
		$data = array('title' => 'Supplier - PT. GMS');
		$this->load->view('layout/wrapper_supplier', $data);

		if ($this->input->post('namaSupplier')){
			$nama = $this->input->post('namaSupplier');
			$noTelp = $this->input->post('noTelp');
			$alamat = $this->input->post('alamat');
			$provinsi = $this->input->post('provinsi');
			$email = $this->input->post('email');
			$this->model->tambah_supplier($nama, $noTelp, $alamat, $provinsi,
										$email);
		}
	}

	public function departemen(){
		$data = array('title' => 'Departemen - PT. GMS');
		$this->load->view('layout/wrapper_departemen', $data);

		if ($this->input->post('namaDepartemen')){
			$departemen = $this->input->post('namaDepartemen');
			$this->model->tambah_departemen($departemen);
		}
	}
	
	public function gudang(){
		$data = array('title' => 'Lokasi Gudang - PT. GMS');
		$this->load->view('layout/wrapper_gudang', $data);

		if ($this->input->post('idGudang')){
			$idGudang = $this->input->post('idGudang');
			$namaGudang = $this->input->post('namaGudang');
			$this->model->tambah_gudang($idGudang, $namaGudang);
		}
	}
	// Fungsi lain
	
	//ajax barang
	private function _validate_barang()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('kodeBarang') == '')
        {
            $data['inputerror'][] = 'kodeBarang';
            $data['error_string'][] = 'Kode Barang is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('namaBarang') == '')
        {
            $data['inputerror'][] = 'namaBarang';
            $data['error_string'][] = 'Nama Barang is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('kategoriBarang') == '')
        {
            $data['inputerror'][] = 'kategoriBarang';
            // $data['error_string'][] = 'Please select kategori barang';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('satuan') == '')
        {
            $data['inputerror'][] = 'satuan';
            // $data['error_string'][] = 'Please select satuan barang';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}
	
	public function ajax_list_barang()
	{
		$list = $this->barang->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $barang) {
			$no++;
			$row = array();
			$row[] = $barang->kode_barang;
			$row[] = $barang->nama_barang;
			$row[] = $barang->nama_satuan;
			$row[] = $barang->nama_kategori;
			$row[] = $barang->deskripsi;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_barang('."'".$barang->kode_barang."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_barang('."'".$barang->kode_barang."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->barang->count_all(),
			"recordsFiltered" => $this->barang->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_delete($kode_barang)
	{
		$this->barang->delete_by_id($kode_barang);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_barang($kode_barang)
	{
		$data = $this->barang->get_by_id($kode_barang);
		echo json_encode($data);
	}

	public function ajax_add_barang()
	{
		$this->_validate_barang();
		$data = array(	
			'kode_barang' => $this->input->post('kodeBarang'),
			'nama_barang' => $this->input->post('namaBarang'),
			'id_kategori' => $this->input->post('kategoriBarang'),
			'id_satuan' => $this->input->post('satuan'),
			'deskripsi' => $this->input->post('deskripsi'),	
		);
		$insert = $this->barang->save($data);
		echo json_encode(array("status" => $insert));
	}

	public function ajax_update_barang()
	{
		$this->_validate_barang();
		$data = array(
			'nama_barang' => $this->input->post('namaBarang'),
			'id_kategori' => $this->input->post('kategoriBarang'),
			'id_satuan' => $this->input->post('satuan'),
			'deskripsi' => $this->input->post('deskripsi'),	
		);
		$this->barang->update(array('kode_barang' => $this->input->post('kodeBarang')), $data);
		echo json_encode(array("status" => TRUE));
	}

	//ajax kategori barang
	public function ajax_add_kategori()
	{
		$this->_validate_kategori();
		$data = array(
			'id_kategori' => '',	
			'nama_kategori' => $this->input->post('namaKategori'),
		);
		$insert = $this->kategori->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update_kategori()
	{
		$this->_validate_kategori();
		$data = array(	
			'nama_kategori' => $this->input->post('namaKategori'),
		);
		$this->kategori->update(array('id_kategori' => $this->input->post('idKategori')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_list_kategori()
	{
		$list = $this->kategori->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kategori) {
			$no++;
			$row = array();
			$row[] = $kategori->id_kategori;
			$row[] = $kategori->nama_kategori;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_kategori('."'".$kategori->id_kategori."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_kategori('."'".$kategori->id_kategori."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kategori->count_all(),
			"recordsFiltered" => $this->kategori->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function ajax_delete_kategori($id_kategori)
	{
		$this->kategori->delete_by_id($id_kategori);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_kategori($id_kategori)
	{
		$data = $this->kategori->get_by_id($id_kategori);
		echo json_encode($data);
	}


	private function _validate_kategori()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('namaKategori') == '')
        {
            $data['inputerror'][] = 'namaKategori';
            $data['error_string'][] = 'Nama Kategori is required';
            $data['status'] = FALSE;
		}
		
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}


	//ajax satuan
	public function ajax_add_satuan()
	{
		$this->_validate_satuan();
		$data = array(
			'id_satuan' => '',	
			'nama_satuan' => $this->input->post('namaSatuan'),
		);
		$insert = $this->satuan->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update_satuan()
	{
		$this->_validate_satuan();
		$data = array(	
			'nama_satuan' => $this->input->post('namaSatuan'),
		);
		$this->satuan->update(array('id_satuan' => $this->input->post('idSatuan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_list_satuan()
	{
		$list = $this->satuan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $satuan) {
			$no++;
			$row = array();
			$row[] = $satuan->id_satuan;
			$row[] = $satuan->nama_satuan;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_satuan('."'".$satuan->id_satuan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_satuan('."'".$satuan->id_satuan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->satuan->count_all(),
			"recordsFiltered" => $this->satuan->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function ajax_delete_satuan($id)
	{
		$this->satuan->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_satuan($id)
	{
		$data = $this->satuan->get_by_id($id);
		echo json_encode($data);
	}

	private function _validate_satuan()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('namaSatuan') == '')
        {
            $data['inputerror'][] = 'namaSatuan';
            $data['error_string'][] = 'Nama Satuan is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}

	

	//ajax supplier
	public function ajax_add_supplier()
	{
		$this->_validate_supplier();
		$data = array(
			'id_supplier' => '',	
			'nama_supplier' => $this->input->post('namaSupplier'),
			'no_telp' => $this->input->post('noTelp'),
			'alamat' => $this->input->post('alamat'),
			'provinsi' => $this->input->post('provinsi'),
			'email' => $this->input->post('email'),
		);
		$insert = $this->supplier->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update_supplier()
	{
		$this->_validate_supplier();
		$data = array(	
			'nama_supplier' => $this->input->post('namaSupplier'),
			'no_telp' => $this->input->post('noTelp'),
			'alamat' => $this->input->post('alamat'),
			'provinsi' => $this->input->post('provinsi'),
			'email' => $this->input->post('email'),
		);
		$this->supplier->update(array('id_supplier' => $this->input->post('idSupplier')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_list_supplier()
	{
		$list = $this->supplier->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $supplier) {
			$no++;
			$row = array();
			$row[] = $supplier->id_supplier;
			$row[] = $supplier->nama_supplier;
			$row[] = $supplier->no_telp;
			$row[] = $supplier->alamat;
			$row[] = $supplier->provinsi;
			$row[] = $supplier->email;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_supplier('."'".$supplier->id_supplier."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_supplier('."'".$supplier->id_supplier."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->supplier->count_all(),
			"recordsFiltered" => $this->supplier->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function ajax_delete_supplier($id)
	{
		$this->supplier->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_supplier($id)
	{
		$data = $this->supplier->get_by_id($id);
		echo json_encode($data);
	}

	private function _validate_supplier()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('namaSupplier') == '')
        {
            $data['inputerror'][] = 'namaSupplier';
            $data['error_string'][] = 'Nama Supplier is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat Supplier is required';
            $data['status'] = FALSE;
		}
		
		if($this->input->post('provinsi') == '')
        {
            $data['inputerror'][] = 'provinsi';
            $data['error_string'][] = 'Provinsi Supplier is required';
            $data['status'] = FALSE;
		}
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}

	//ajax departemen
	public function ajax_add_dept()
	{
		$this->_validate_dept();
		$data = array(
			'id_departemen' => '',	
			'nama_departemen' => $this->input->post('namaDept'),
		);
		$insert = $this->dept->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update_dept()
	{
		$this->_validate_dept();
		$data = array(	
			'nama_departemen' => $this->input->post('namaDept'),
		);
		$this->dept->update(array('id_departemen' => $this->input->post('idDept')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_list_dept()
	{
		$list = $this->dept->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $dept) {
			$no++;
			$row = array();
			$row[] = $dept->id_departemen;
			$row[] = $dept->nama_departemen;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_dept('."'".$dept->id_departemen."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_dept('."'".$dept->id_departemen."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dept->count_all(),
			"recordsFiltered" => $this->dept->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function ajax_delete_dept($id)
	{
		$this->dept->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_dept($id)
	{
		$data = $this->dept->get_by_id($id);
		echo json_encode($data);
	}
	private function _validate_dept()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('namaDept') == '')
        {
            $data['inputerror'][] = 'namaDept';
            $data['error_string'][] = 'Nama Departemen is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}


	//ajax gudang
	public function ajax_add_gudang()
	{
		$this->_validate_gudang();
		$data = array(
			'id_gudang' => $this->input->post('idGudang'),	
			'nama_gudang' => $this->input->post('namaGudang'),
		);
		$insert = $this->gudang->save($data);
		echo json_encode(array("status" => $insert));
	}
	public function ajax_update_gudang()
	{
		$this->_validate_gudang();
		$data = array(	
			'nama_gudang' => $this->input->post('namaGudang'),
		);
		$this->gudang->update(array('id_gudang' => $this->input->post('idGudang')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_list_gudang()
	{
		$list = $this->gudang->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $gudang) {
			$no++;
			$row = array();
			$row[] = $gudang->id_gudang;
			$row[] = $gudang->nama_gudang;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_gudang('."'".$gudang->id_gudang."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_gudang('."'".$gudang->id_gudang."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->gudang->count_all(),
			"recordsFiltered" => $this->gudang->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function ajax_delete_gudang($id)
	{
		$this->gudang->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_gudang($id)
	{
		$data = $this->gudang->get_by_id($id);
		echo json_encode($data);
	}

	private function _validate_gudang()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('idGudang') == '')
        {
            $data['inputerror'][] = 'idGudang';
            $data['error_string'][] = 'ID Gudang is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('namaGudang') == '')
        {
            $data['inputerror'][] = 'namaGudang';
            $data['error_string'][] = 'Nama Gudang is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}

	//ajax pegawai
	public function ajax_add_pegawai()
	{
		$this->_validate_pegawai();
		$data = array(
			'id_pegawai' => $this->input->post('idPegawai'),	
			'nama_pegawai' => $this->input->post('namaPegawai'),
			'jabatan' => $this->input->post('jabatan'),
			'id_departemen' => $this->input->post('departemen'),
		);
		$insert = $this->pegawai->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update_pegawai()
	{
		$this->_validate_pegawai();
		$data = array(	
			'nama_pegawai' => $this->input->post('namaPegawai'),
			'jabatan' => $this->input->post('jabatan'),
			'id_departemen' => $this->input->post('departemen'),
		);
		$this->pegawai->update(array('id_pegawai' => $this->input->post('idPegawai')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_list_pegawai()
	{
		$list = $this->pegawai->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pegawai) {
			$no++;
			$row = array();
			$row[] = $pegawai->id_pegawai;
			$row[] = $pegawai->nama_pegawai;
			$row[] = $pegawai->jabatan;
			$row[] = $pegawai->nama_departemen;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_pegawai('."'".$pegawai->id_pegawai."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_pegawai('."'".$pegawai->id_pegawai."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pegawai->count_all(),
			"recordsFiltered" => $this->pegawai->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function ajax_delete_pegawai($id)
	{
		$this->pegawai->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_pegawai($id)
	{
		$data = $this->pegawai->get_by_id($id);
		echo json_encode($data);
	}

	private function _validate_pegawai()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('idPegawai') == '')
		{
			$data['inputerror'][] = 'idPegawai';
			$data['error_string'][] = 'ID Pegawai is required';
			$data['status'] = FALSE;
		}
	
		if($this->input->post('namaPegawai') == '')
		{
			$data['inputerror'][] = 'namaPegawai';
			$data['error_string'][] = 'Nama Pegawai is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jabatan') == '')
		{
			$data['inputerror'][] = 'jabatan';
			$data['error_string'][] = 'Jabatan is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('departemen') == '')
		{
			$data['inputerror'][] = 'departemen';
			// $data['error_string'][] = 'Please select departemen';
			$data['status'] = FALSE;
		}
	
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}

?>