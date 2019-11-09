<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
       	$this->load->helper('url');
		$this->load->model('Master_model');
        $this->model = $this->Master_model;
        $this->load->model('Pb_model');
        $this->pb = $this->Pb_model;
        $this->load->model('Bstb_model');
        $this->bstb = $this->Bstb_model;
        $this->load->model('Rebstb_model');
        $this->rebstb = $this->Rebstb_model;

		if (!$this->session->has_userdata('username')) {
			$this->session->set_flashdata('result_login','Anda belum Login!!');
			redirect('login');
		}
	}

	public function index() {
		$data = array( 'title' => 'Inventory - PT. GMS');
		$this->load->view('layout/wrapper_master', $data);
   	}
    
    public function pb() {
        $data = $this->model->baca_tabel("departemen");
        $data2 = $this->model->baca_tabel("pegawai");
        $data3 = $this->model->baca_tabel("master_barang");
        $data4 = $this->model->baca_tabel("kategori_barang");
        $data5 = $this->model->baca_tabel("gudang");
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        'data3' => $data3,
                        'data4' => $data4,
                        'data5' => $data5,
                        'title' => 'Permintaan Barang - PT. GMS');
        $this->load->view('layout/wrapper_pb', $data);
    }

    public function get_barang($id) {
        $list = $this->model->baca_tabel_barang_by_kategori($id);
        echo json_encode($list);
    }

    public function get_satuan($id) {
        $list = $this->model->baca_satuan_barang($id);
        echo json_encode($list);
    }

    public function ajax_add_pb(){
        $this->_validate_pb();
        $gudang = $this->input->post('gudang');
        $noPB = $this->_no_pb($gudang);
        $data = array(
			'no_PB' => $noPB,	
			'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('peminta'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori')
        );
        $table = 'permintaan_barang';
		$insert = $this->model->save($table, $data);
		echo json_encode($data);
    }

    private function _validate_pb()
	{
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if ($this->input->post('gudang') == '')
		{
			$data['inputerror'][] = 'gudang';
            $data['status'] = FALSE;
        }
        if ($this->input->post('departemen') == '')
		{
			$data['inputerror'][] = 'departemen';
            $data['status'] = FALSE;
        }
        if ($this->input->post('peminta') == '')
		{
			$data['inputerror'][] = 'peminta';
            $data['status'] = FALSE;
        }
        
		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
	}

    public function ajax_add_pb_detail()
    {
        $data = array(
            'no_PB' => $this->input->post('no_PB'),
            'kode_barang' => $this->input->post('kodeBarang'),
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('deskripsi')
        );
        $table = 'permintaan_barang_detail';
        $insert = $this->model->save($table, $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _no_pb($gudang){
        $noAwal = 'SPB-'.$gudang.'-'.date('ym').'-';
        $lastNo = $this->model->get_last_no_pb($noAwal);

        if ($lastNo != null){
            $id = (int) substr($lastNo->no_PB, 13, 3);
            $id++;
            $no = $noAwal.sprintf("%03s", $id);
            return $no;
        } else {
            $no = $noAwal.'001';
            return $no;
        }
        
    }

    public function print_pb($id=null){
        if (!isset($id)) show_404();
        $data = $this->model->baca_tabel_pb($id);
        $data2 = $this->model->baca_tabel_pb_detail($id);
        // echo json_encode($data2);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $id.".pdf";
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        );
        $this->pdf->load_view('layout/content_print_pb', $data);
    }
    
    public function daftarPB(){
        $data = $this->model->baca_tabel("departemen");
        $data2 = $this->model->baca_tabel("pegawai");
        $data3 = $this->model->baca_tabel("master_barang");
        $data4 = $this->model->baca_tabel("kategori_barang");
        $data5 = $this->model->baca_tabel("gudang");
        $data = array ('data' => $data,
                        'data2' => $data2,
                        'data3' => $data3,
                        'data4' => $data4,
                        'data5' => $data5,
                        'title' => 'Daftar Permintaan Barang - PT. GMS'
                    );
        $this->load->view('layout/wrapper_daftar_pb', $data);
    }
    // Fungsi lain
    
	public function ajax_list_pb()
	{
		$list = $this->pb->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pb) {
			$no++;
			$row = array();
			$row[] = $pb->no_PB;
			$row[] = $pb->nama_gudang;
			$row[] = $pb->nama_departemen;
            $row[] = $pb->nama_pegawai;
            $row[] = $pb->tanggal;
            $row[] = $pb->keterangan;
            $url = site_url('inventory/print_pb/').$pb->no_PB;
            $row[] = '<a class="btn btn-sm btn-info" href="'.$url.'" title="View" target="_blank"><i class="glyphicon glyphicon-pencil"></i> View</a>
                <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_pb('."'".$pb->no_PB."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_pb('."'".$pb->no_PB."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pb->count_all(),
			"recordsFiltered" => $this->pb->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }

    public function ajax_delete_pb($id)
	{
        // $this->pb->delete_by_id($id, 'permintaan_barang');
        // $this->pb->delete_by_id($id, 'permintaan_barang_detail');
        $this->pb->delete_pb($id);
        $this->pb->delete_pb_detail($id);
		echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_edit_pb($id)
    {
        $data = $this->pb->get_by_id($id);
        $data2 = $this->pb->baca_tabel_pb_detail($id);
        // echo json_encode($data2);
        // echo json_encode($data);

		$output = array(
            "pb" => $data,
			"pbDetail" => $data2
		);
		echo json_encode($output);
    }

    public function ajax_update_pb(){
        $this->_validate_pb();
        $gudang = $this->input->post('gudang');
        $noPB = $this->input->post('noPB');
        // $noAwal = 'SPB-'.$gudang.'-'.date('ym').'-';
        $data = array(
			'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('peminta'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori')
        );
        $table = 'permintaan_barang';
        $this->pb->update($noPB, $data, $table);
        $this->pb->delete_pb_detail($noPB);
		// $insert = $this->model->save($table, $data);
		echo json_encode($data);
    }

    public function ajax_update_pb_detail(){
        $data = array(
            'no_PB' => $this->input->post('no_PB'),
            'kode_barang' => $this->input->post('kodeBarang'),
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('deskripsi')
        );
        $table = 'permintaan_barang_detail';
        $insert = $this->model->save($table, $data);
        echo json_encode($insert);
    }

    public function bstb(){
        $data = $this->model->baca_tabel("departemen");
        $data2 = $this->model->baca_tabel("pegawai");
        $data3 = $this->model->baca_tabel("kategori_barang");
        $data4 = $this->model->baca_tabel("gudang");
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        'data3' => $data3,
                        'data4' => $data4,
                        'title' => 'Pengeluaran Barang - PT. GMS');
        $this->load->view('layout/wrapper_bstb', $data);
    }

    public function get_spb($id){
        $data = $this->bstb->baca_tabel_pb($id);
        echo json_encode($data);
    }

    public function get_barang_spb($id){
        $data = $this->bstb->barang_spb($id);
        echo json_encode($data);
    }

    public function get_detail_barang($id){
        $data = $this->bstb->baca_tabel_barang_detail($id);
        echo json_encode($data);
    }

    public function ajax_add_bstb(){
        $this->_validate_bstb();
        $gudang = $this->input->post('gudang');
        $no_bstb = $this->_no_bstb($gudang);
        $data = array(
			'no_bstb' => $no_bstb,	
			'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('peminta'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori')
        );
        $table = 'pengeluaran_barang';
		$insert = $this->model->save($table, $data);
		echo json_encode($data);

    }

    public function ajax_add_bstb_detail(){
        $data = array(
            'no_bstb' => $this->input->post('no_bstb'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'deskripsi' => $this->input->post('deskripsi'),
            'no_PB' => $this->input->post('no_spb'),
            'no_PB_detail' => $this->input->post('no_PB_detail')
        );
        $table = 'pengeluaran_barang_detail';
        $insert = $this->model->save($table, $data);

        $data2 = array(
            'no_ref' => $this->input->post('no_bstb'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah') * -1,
            'id_gudang' => $this->input->post('id_gudang'),
            'tanggal' => date("Y-m-d H:i:sa"),
        );
        $tabel = 'stock';
        $in = $this->model->save($tabel, $data2);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate_bstb()
	{
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if ($this->input->post('gudang') == '')
		{
			$data['inputerror'][] = 'gudang';
            $data['status'] = FALSE;
        }
        if ($this->input->post('departemen') == '')
		{
			$data['inputerror'][] = 'departemen';
            $data['status'] = FALSE;
        }
        if ($this->input->post('peminta') == '')
		{
			$data['inputerror'][] = 'peminta';
            $data['status'] = FALSE;
        }
        if ($this->input->post('kategori') == '')
		{
			$data['inputerror'][] = 'kategori';
            $data['status'] = FALSE;
        }
        
		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    private function _no_bstb($gudang){
        $noAwal = 'BSTB-'.$gudang.'-'.date('ym').'-';
        $lastNo = $this->bstb->get_last_no_bstb($noAwal);

        if ($lastNo != null){
            $id = (int) substr($lastNo->no_bstb, 14, 3);
            $id++;
            $no = $noAwal.sprintf("%03s", $id);
            return $no;
        } else {
            $no = $noAwal.'001';
            return $no;
        }
    }

    public function daftarBSTB(){
        $data = $this->model->baca_tabel("departemen");
        $data2 = $this->model->baca_tabel("pegawai");
        $data3 = $this->model->baca_tabel("kategori_barang");
        $data4 = $this->model->baca_tabel("gudang");
        $data = array (
                        'data' => $data,
                        'data2' => $data2,
                        'data3' => $data3,
                        'data4' => $data4,
                        'title' => 'Daftar Pengeluaran Barang - PT. GMS'
                    );
        $this->load->view('layout/wrapper_daftar_bstb', $data);
    }

    public function ajax_list_bstb()
	{
		$list = $this->bstb->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $bstb) {
			$no++;
			$row = array();
			$row[] = $bstb->no_bstb;
			$row[] = $bstb->nama_gudang;
			$row[] = $bstb->nama_departemen;
            $row[] = $bstb->nama_pegawai;
            $row[] = $bstb->nama_kategori;
            $row[] = $bstb->tanggal;
            $row[] = $bstb->keterangan;
            $url = site_url('inventory/print_bstb/').$bstb->no_bstb;
            $row[] = '<a class="btn btn-sm btn-info" href="'.$url.'" title="View" target="_blank"><i class="glyphicon glyphicon-pencil"></i> View</a>
                <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_bstb('."'".$bstb->no_bstb."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_bstb('."'".$bstb->no_bstb."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bstb->count_all(),
			"recordsFiltered" => $this->bstb->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }

    public function ajax_edit_bstb($id)
    {
        $data = $this->bstb->get_by_id($id);
        $data2 = $this->bstb->baca_tabel_bstb_detail($id);
		$output = array(
            "bstb" => $data,
			"bstbDetail" => $data2
		);
		echo json_encode($output);
    }

    public function ajax_update_bstb(){
        $this->_validate_bstb();
        $no_bstb = $this->input->post('noBSTB');
        $data = array (
            'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('peminta'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori')
        );
        $table = 'pengeluaran_barang';
        $this->bstb->update($no_bstb, $data, $table);
        $this->bstb->delete_stock($no_bstb);
        $this->bstb->delete_bstb_detail($no_bstb);
		echo json_encode($data);
    }

    public function ajax_delete_bstb($id)
	{
        $this->bstb->delete_bstb($id);
        $this->bstb->delete_bstb_detail($id);
        $this->bstb->delete_stock($id);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($data);
    }

    public function returnbstb(){
        $data = $this->model->baca_tabel("departemen");
        $data2 = $this->model->baca_tabel("pegawai");
        $data3 = $this->model->baca_tabel("pengeluaran_barang");
        $data4 = $this->model->baca_tabel("gudang");
        $data = array (
                'data' => $data,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
                'title' => 'Return Pengeluaran Barang - PT. GMS'
            );
        $this->load->view('layout/wrapper_return_bstb', $data);
    }

    public function get_barang_bstb($id){
        $data = $this->rebstb->get_barang_bstb($id);
        echo json_encode($data);
    }

    public function get_detail_bstb($id){
        $data = $this->rebstb->baca_tabel_bstb_detail($id);
        echo json_encode($data);
    }

    public function ajax_add_rebstb(){
        $this->_validate_rebstb();
        $gudang = $this->input->post('gudang');
        $no_rebstb = $this->_no_rebstb($gudang);
        $data = array(
			'no_rebstb' => $no_rebstb,	
			'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('pegawai'),
            'no_bstb' => $this->input->post('noBSTB'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $table = 'return_pengeluaran_barang';
		$insert = $this->model->save($table, $data);
		echo json_encode($data);
    }

    public function ajax_add_rebstb_detail(){
        $data = array(
            'no_bstb' => $this->input->post('no_bstb'),
            'no_rebstb' => $this->input->post('no_rebstb'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'no_bstb_detail' => $this->input->post('no_bstb_detail'),
            'tanggal' => date('Y-m-d'),
            'deskripsi' => $this->input->post('deskripsi'),
        );
        $table = 'return_pengeluaran_barang_detail';
        $insert = $this->rebstb->save($table, $data);

        $data2 = array(
            'no_ref' => $this->input->post('no_rebstb'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'id_gudang' => $this->input->post('id_gudang'),
            'tanggal' => date("Y-m-d H:i:sa"),
        );
        $tabel = 'stock';
        $in = $this->rebstb->save($tabel, $data2);
        echo json_encode($insert);
    }

    private function _validate_rebstb()
	{
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if ($this->input->post('gudang') == '')
		{
			$data['inputerror'][] = 'gudang';
            $data['status'] = FALSE;
        }
        if ($this->input->post('departemen') == '')
		{
			$data['inputerror'][] = 'departemen';
            $data['status'] = FALSE;
        }
        if ($this->input->post('pegawai') == '')
		{
			$data['inputerror'][] = 'pegawai';
            $data['status'] = FALSE;
        }
        if ($this->input->post('noBSTB') == '')
		{
			$data['inputerror'][] = 'noBSTB';
            $data['status'] = FALSE;
        }
        
		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _no_rebstb($gudang){
        $noAwal = 'REBSTB-'.$gudang.'-'.date('ym').'-';
        $lastNo = $this->rebstb->get_last_no_rebstb($noAwal);

        if ($lastNo != null){
            $id = (int) substr($lastNo->no_rebstb, 16, 3);
            $id++;
            $no = $noAwal.sprintf("%03s", $id);
            return $no;
        } else {
            $no = $noAwal.'001';
            return $no;
        }
    }

    public function daftarREBSTB(){
        $data = $this->model->baca_tabel("departemen");
        $data2 = $this->model->baca_tabel("pegawai");
        $data3 = $this->model->baca_tabel("pengeluaran_barang");
        $data4 = $this->model->baca_tabel("gudang");
        $data = array (
                        'data' => $data,
                        'data2' => $data2,
                        'data3' => $data3,
                        'data4' => $data4,
                        'title' => 'Daftar Return Pengeluaran Barang - PT. GMS'
                    );
        $this->load->view('layout/wrapper_daftar_rebstb', $data);
    }

    public function ajax_list_rebstb(){
        $list = $this->rebstb->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rebstb) {
			$no++;
			$row = array();
			$row[] = $rebstb->no_rebstb;
			$row[] = $rebstb->nama_gudang;
			$row[] = $rebstb->nama_departemen;
            $row[] = $rebstb->nama_pegawai;
            $row[] = $rebstb->tanggal;
            $row[] = $rebstb->keterangan;
            $url = site_url('inventory/print_rebstb/').$rebstb->no_rebstb;
            $row[] = '<a class="btn btn-sm btn-info" href="'.$url.'" title="View" target="_blank"><i class="glyphicon glyphicon-pencil"></i> View</a>
                <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_rebstb('."'".$rebstb->no_rebstb."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_rebstb('."'".$rebstb->no_rebstb."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
        }

        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bstb->count_all(),
			"recordsFiltered" => $this->bstb->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
    
    public function ajax_edit_rebstb($id)
    {
        $data = $this->rebstb->get_by_id($id);
        $data2 = $this->rebstb->baca_tabel_rebstb_detail($id);
		$output = array(
            "rebstb" => $data,
			"rebstbDetail" => $data2
		);
		echo json_encode($output);
    }

    public function ajax_delete_rebstb($id)
	{
        $this->rebstb->delete_rebstb($id);
        $this->rebstb->delete_rebstb_detail($id);
        $this->bstb->delete_stock($id);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($data);
    }

    public function ajax_update_rebstb(){
        $this->_validate_rebstb();
        $no_rebstb = $this->input->post('no_rebstb');
        $data = array (
            'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('pegawai'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'no_bstb' => $this->input->post('noBSTB')
        );
        $table = 'return_pengeluaran_barang';
        $this->rebstb->update($no_rebstb, $data, $table);
        $this->rebstb->delete_rebstb_detail($no_rebstb);
        $this->bstb->delete_stock($no_rebstb);
		echo json_encode($data);
    }

    public function print_bstb($id=null){
        if (!isset($id)) show_404();
        $data = $this->bstb->baca_tabel_bstb($id);
        $data2 = $this->bstb->baca_tabel_bstb_detail($id);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $id.".pdf";
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        );
        $this->pdf->load_view('layout/content_print_bstb', $data);
    }

    public function print_rebstb($id=null){
        if (!isset($id)) show_404();
        $data = $this->rebstb->baca_tabel_rebstb($id);
        $data2 = $this->rebstb->baca_tabel_rebstb_detail($id);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $id.".pdf";
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        );
        $this->pdf->load_view('layout/content_print_rebstb', $data);
    }
}

?>
