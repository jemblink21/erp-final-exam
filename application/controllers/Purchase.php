<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
       	$this->load->helper('url');
		$this->load->model('Master_model');
        $this->model = $this->Master_model;

        $this->load->model('Ppb_model');
        $this->ppb = $this->Ppb_model;

        $this->load->model('Po_model');
        $this->po = $this->Po_model;

        $this->load->model('Bpb_model');
        $this->bpb = $this->Bpb_model;

        $this->load->model('Rpb_model');
        $this->rpb = $this->Rpb_model;

		if (!$this->session->has_userdata('username')) {
			$this->session->set_flashdata('result_login','Anda belum login');
			redirect('login');
		}
	}

	public function index() {
		$data = array( 'title' => 'Purchase - PT. GMS');
		$this->load->view('layout/wrapper_master', $data);
   	}
    
    public function ppb()
    {
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
                        'title' => 'Permintaan Pembelian Barang - PT. GMS');
        $this->load->view('layout/wrapper_ppb', $data);
    }

    public function daftarPPB()
    {
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
                        'title' => 'Daftar Permintaan Pembelian Barang - PT. GMS');
        $this->load->view('layout/wrapper_daftar_ppb', $data);
    }

    private function _validate_ppb()
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

    private function _no_ppb($gudang){
        $noAwal = 'PPB-'.$gudang.'-'.date('ym').'-';
        $lastNo = $this->ppb->get_last_no_ppb($noAwal);

        if ($lastNo != null){
            $id = (int) substr($lastNo->no_ppb, 13, 3);
            $id++;
            $no = $noAwal.sprintf("%03s", $id);
            return $no;
        } else {
            $no = $noAwal.'001';
            return $no;
        }
        
    }
    
    private function _no_po()
    {
        $noAwal = 'PO-GMS-'.date('ym').'-';
        $lastNo = $this->po->get_last_no_po($noAwal);

        if ($lastNo != null){
            $id = (int) substr($lastNo->no_po, 12, 3);
            $id++;
            $no = $noAwal.sprintf("%03s", $id);
            return $no;
        } else {
            $no = $noAwal.'001';
            return $no;
        }
    }
    public function ajax_add_ppb()
    {
        $this->_validate_ppb();
        $gudang = $this->input->post('gudang');
        $noPPB = $this->_no_ppb($gudang);
        // $noAwal = 'SPB-'.$gudang.'-'.date('ym').'-';
        $data = array(
			'no_ppb' => $noPPB,	
			'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('peminta'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori')
        );
        $table = 'permintaan_pembelian';
		$insert = $this->model->save($table, $data);
		echo json_encode($data);
    }

    public function ajax_add_ppb_detail()
    {
        $data = array(
            'no_ppb' => $this->input->post('no_ppb'),
            'kode_barang' => $this->input->post('kodeBarang'),
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('deskripsi')
        );
        $table = 'permintaan_pembelian_detail';
        $insert = $this->model->save($table, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list_ppb()
	{
		$list = $this->ppb->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $ppb) {
			$no++;
			$row = array();
			$row[] = $ppb->no_ppb;
			$row[] = $ppb->nama_gudang;
			$row[] = $ppb->nama_departemen;
            $row[] = $ppb->nama_pegawai;
            $row[] = $ppb->tanggal;
            $row[] = $ppb->keterangan;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_ppb('."'".$ppb->no_ppb."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				    <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_ppb('."'".$ppb->no_ppb."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
	    }

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ppb->count_all(),
			"recordsFiltered" => $this->ppb->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }

    public function ajax_delete_ppb($id)
	{
        $this->ppb->delete_ppb($id);
        $this->ppb->delete_ppb_detail($id);
		echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_ppb($id)
    {
        $data = $this->ppb->get_by_id($id);
        $data2 = $this->ppb->baca_tabel_ppb_detail($id);
        // echo json_encode($data2);
        // echo json_encode($data);

		$output = array(
            "ppb" => $data,
			"ppbDetail" => $data2
		);
		echo json_encode($output);
    }

    public function ajax_update_ppb(){
        $this->_validate_ppb();
        $gudang = $this->input->post('gudang');
        $no_ppb = $this->input->post('noPPB');
        $data = array(
			'id_gudang' => $this->input->post('gudang'),
			'id_departemen' => $this->input->post('departemen'),
            'id_pegawai' => $this->input->post('peminta'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori')
        );
        $table = 'permintaan_pembelian';
        $this->ppb->update($no_ppb, $data, $table);
        $this->ppb->delete_ppb_detail($no_ppb);
		echo json_encode($data);
    }

    public function po()
    {
        $data = $this->model->baca_tabel("supplier");
        $data2 = $this->model->baca_tabel("kategori_barang");
        $data = array (
            'data' => $data,
            'data2' => $data2,
            'title' => 'Pembelian Barang - PT. GMS'
        );
        $this->load->view('layout/wrapper_po', $data);
    }

    private function _validate_po()
	{
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
		$data['status'] = TRUE;
		
        if ($this->input->post('supplier') == '')
		{
			$data['inputerror'][] = 'supplier';
            $data['status'] = FALSE;
        }
        
		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function get_ppb($id)
    {
        $data = $this->po->baca_tabel_ppb($id);
        echo json_encode($data);
    }

    public function get_barang($id)
    {
        $data = $this->po->baca_tabel_ppb_detail($id);
        echo json_encode($data);
    }

    public function get_detail_barang($id)
    {
        $data = $this->po->baca_tabel_barang_detail($id);
        echo json_encode($data);
    }

    public function ajax_add_po()
    {
        $this->_validate_po();
        $no_po = $this->_no_po();
        $data = array (
            'no_po' => $no_po,
            'id_supplier' => $this->input->post('supplier'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori'),
            'total_harga' => $this->input->post('total_harga'),
        );
        $table = 'pembelian_barang';
		$insert = $this->model->save($table, $data);
		echo json_encode($data);
    }

    public function ajax_add_po_detail()
    {
        $data = array(
            'no_ppb_detail' => $this->input->post('no_ppb_detail'),
            'no_po' => $this->input->post('no_po'),
            'no_ppb' => $this->input->post('no_ppb'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga'),
            'deskripsi' => $this->input->post('deskripsi')
        );
        $table = 'pembelian_barang_detail';
        $insert = $this->po->save($table, $data);
        echo json_encode($insert);
    }

    public function DaftarPO()
    {
        $data = $this->model->baca_tabel("supplier");
        $data2 = $this->model->baca_tabel("kategori_barang");
        $data = array (
            'data' => $data,
            'data2' => $data2,
            'title' => 'Daftar Pembelian Barang - PT. GMS'
        );
        $this->load->view('layout/wrapper_daftar_po', $data);
    }

    public function ajax_list_po()
    {
        $list = $this->po->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $po) {
			$no++;
			$row = array();
			$row[] = $po->no_po;
			$row[] = $po->nama_supplier;
			$row[] = $po->tanggal;
            $row[] = $po->keterangan;
            $row[] = $po->nama_kategori;
            $row[] = number_format($po->total_harga, "0", ",", ".");
            $url = site_url('purchase/print_po/').$po->no_po;
            $row[] = '<a class="btn btn-sm btn-info" href="'.$url.'" title="View" target="_blank"><i class="glyphicon glyphicon-pencil"></i> View</a>
                    <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_po('."'".$po->no_po."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				    <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_po('."'".$po->no_po."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->po->count_all(),
			"recordsFiltered" => $this->po->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }

    public function ajax_edit_po($id){
        $data = $this->po->get_by_id($id);
        $data2 = $this->po->baca_tabel_po_detail($id);

		$output = array(
            "po" => $data,
			"poDetail" => $data2
		);
		echo json_encode($output);
    }
    
    public function ajax_update_po(){
        $this->_validate_po();
        $no_po = $this->input->post('noPO');
        $data = array (
            'id_supplier' => $this->input->post('supplier'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_kategori' => $this->input->post('kategori'),
            'total_harga' => $this->input->post('total_harga'),
        );
        $table = 'pembelian_barang';
        $this->po->update($no_po, $data, $table);
        $this->po->delete_po_detail($no_po);
		echo json_encode($data);
    }

    public function ajax_delete_po($id)
	{
        $this->po->delete_po($id);
        $this->po->delete_po_detail($id);
		echo json_encode(array("status" => TRUE));
    }

    //Penerimaan Barang
    public function bpb()
    {
        $data = $this->model->baca_tabel("supplier");
        $data2 = $this->model->baca_tabel("gudang");
        $data = array (
            'data' => $data,
            'data2' => $data2,
            'title' => 'Penerimaan Barang - PT. GMS'
        );
        $this->load->view('layout/wrapper_bpb', $data);
    }

    public function get_po($id)
    {
        $data = $this->bpb->baca_tabel_po($id);
        echo json_encode($data);
    }

    public function get_barang_po($id)
    {
        $data = $this->bpb->baca_tabel_po_detail($id);
        echo json_encode($data);
    }

    public function get_detail_barang_po($id)
    {
        $data = $this->bpb->baca_tabel_barang_detail($id);
        echo json_encode($data);
    }

    private function _validate_bpb()
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

        if ($this->input->post('supplier') == '')
		{
			$data['inputerror'][] = 'supplier';
            $data['status'] = FALSE;
        }

        if ($this->input->post('noPO') == '')
		{
			$data['inputerror'][] = 'noPO';
            $data['status'] = FALSE;
        }
        
		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _no_bpb($gudang){
        $noAwal = 'BPB-'.$gudang.'-'.date('ym').'-';
        $lastNo = $this->bpb->get_last_no_bpb($noAwal);

        if ($lastNo != null){
            $id = (int) substr($lastNo->no_bpb, 13, 3);
            $id++;
            $no = $noAwal.sprintf("%03s", $id);
            return $no;
        } else {
            $no = $noAwal.'001';
            return $no;
        }
        
    }

    public function ajax_add_bpb()
    {
        $this->_validate_bpb();
        $gudang = $this->input->post('gudang');
        $no_bpb = $this->_no_bpb($gudang);
        // $noAwal = 'SPB-'.$gudang.'-'.date('ym').'-';
        $data = array(
			'no_bpb' => $no_bpb,	
            'id_gudang' => $gudang,
            'no_po' => $this->input->post('noPO'),
            'id_supplier' => $this->input->post('supplier'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $table = 'penerimaan_barang';
		$insert = $this->model->save($table, $data);
		echo json_encode($data);
    }

    public function ajax_add_bpb_detail()
    {
        $data = array(
            'no_po_detail' => $this->input->post('no_po_detail'),
            'no_po' => $this->input->post('no_po'),
            'no_bpb' => $this->input->post('no_bpb'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'deskripsi' => $this->input->post('deskripsi')
        );
        $table = 'penerimaan_barang_detail';
        $insert = $this->model->save($table, $data);

        $data2 = array(
            'kode_barang' => $this->input->post('kode_barang'),
            'id_gudang' => $this->input->post('id_gudang'),
            'no_ref' => $this->input->post('no_bpb'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date("Y-m-d H:i:sa"),
        );
        $tabel = 'stock';
        $in = $this->model->save($tabel, $data2);
        echo json_encode($insert);
    }

    public function DaftarBPB()
    {
        $data = $this->model->baca_tabel("supplier");
        $data2 = $this->model->baca_tabel("gudang");
        $data = array (
            'data' => $data,
            'data2' => $data2,
            'title' => 'Daftar Penerimaan Barang - PT. GMS'
        );
        $this->load->view('layout/wrapper_daftar_bpb', $data);
    }

    public function ajax_list_bpb()
    {
        $list = $this->bpb->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $bpb) {
			$no++;
			$row = array();
			$row[] = $bpb->no_bpb;
			$row[] = $bpb->nama_gudang;
			$row[] = $bpb->nama_supplier;
            $row[] = $bpb->tanggal;
            $row[] = $bpb->keterangan;
            $url = site_url('purchase/print_bpb/').$bpb->no_bpb;
            $row[] = '<a class="btn btn-sm btn-info" href="'.$url.'" title="View" target="_blank"><i class="glyphicon glyphicon-pencil"></i> View</a>
                    <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_bpb('."'".$bpb->no_bpb."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				    <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_bpb('."'".$bpb->no_bpb."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bpb->count_all(),
			"recordsFiltered" => $this->bpb->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }

    public function ajax_delete_bpb($id)
	{
        $this->bpb->delete_bpb($id);
        $this->bpb->delete_bpb_detail($id);
        $this->bpb->delete_stock($id);
		echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_bpb($id){
        $data = $this->bpb->get_by_id($id);
        $data2 = $this->bpb->baca_tabel_bpb_detail($id);

		$output = array(
            "bpb" => $data,
			"bpbDetail" => $data2
		);
		echo json_encode($output);
    }

    public function ajax_update_bpb(){
        $this->_validate_bpb();
        $no_bpb = $this->input->post('noBPB');
        $data = array (
            'id_supplier' => $this->input->post('supplier'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan'),
            'id_gudang' => $this->input->post('gudang'),
            'no_po' => $this->input->post('noPO'),
        );
        $table = 'penerimaan_barang';
        $this->bpb->update($no_bpb, $data, $table);
        $this->bpb->delete_bpb_detail($no_bpb);
        $this->bpb->delete_stock($no_bpb);
		echo json_encode($data);
    }

    public function rpb(){
        $data = $this->model->baca_tabel("supplier");
        $data2 = $this->model->baca_tabel("gudang");
        $data = array (
            'data' => $data,
            'data2' => $data2,
            'title' => 'Return Penerimaan Barang - PT. GMS'
        );
        $this->load->view('layout/wrapper_rpb', $data);
    }

    public function get_bpb($id){
        $data = $this->rpb->baca_tabel_bpb($id);
        echo json_encode($data);
    }

    public function get_barang_bpb($id){
        $data = $this->rpb->baca_tabel_bpb_detail($id);
        echo json_encode($data);
    }

    public function get_detail_barang_bpb($id){
        $data = $this->rpb->baca_tabel_barang_detail($id);
        echo json_encode($data);
    }

    public function ajax_add_rpb(){
        $this->_validate_rpb();
        $gudang = $this->input->post('gudang');
        $no_rpb = $this->_no_rpb($gudang);
        $data = array(
            'no_rpb' => $no_rpb,
            'id_gudang' => $this->input->post('gudang'),
            'id_supplier' => $this->input->post('supplier'),
            'no_bpb' => $this->input->post('noBPB'),
            'no_po' => $this->input->post('noPO'),
            'keterangan' => $this->input->post('keterangan'),
            'tanggal' => date('Y-m-d')
        );
        $table = 'return_penerimaan_barang';
		$insert = $this->model->save($table, $data);
		echo json_encode($data);
    }

    public function ajax_add_rpb_detail(){
        $data = array(
            'no_rpb' => $this->input->post('no_rpb'),
            'id_gudang' => $this->input->post('id_gudang'),
            'no_bpb' => $this->input->post('no_bpb'),
            'no_po' => $this->input->post('no_po'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'deskripsi' => $this->input->post('deskripsi'),
            'no_bpb_detail' => $this->input->post('no_bpb_detail'),
            'tanggal' => date('Y-m-d')
        );
        $table = 'return_penerimaan_barang_detail';
        $insert = $this->model->save($table, $data);

        $data2 = array(
            'no_ref' => $this->input->post('no_rpb'),
            'id_gudang' => $this->input->post('id_gudang'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah') * -1,
            'tanggal' => date("Y-m-d H:i:sa"),
        );
        $tabel = 'stock';
        $in = $this->model->save($tabel, $data2);
        echo json_encode($insert);
    }

    private function _validate_rpb()
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

        if ($this->input->post('supplier') == '')
		{
			$data['inputerror'][] = 'supplier';
            $data['status'] = FALSE;
        }

        if ($this->input->post('noBPB') == '')
		{
			$data['inputerror'][] = 'noBPB';
            $data['status'] = FALSE;
        }
        
		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _no_rpb($gudang){
        $noAwal = 'RPB-'.$gudang.'-'.date('ym').'-';
        $lastNo = $this->rpb->get_last_no_rpb($noAwal);

        if ($lastNo != null){
            $id = (int) substr($lastNo->no_rpb, 13, 3);
            $id++;
            $no = $noAwal.sprintf("%03s", $id);
            return $no;
        } else {
            $no = $noAwal.'001';
            return $no;
        }
        
    }

    public function daftarRPB(){
        $data = $this->model->baca_tabel("supplier");
        $data2 = $this->model->baca_tabel("gudang");
        $data = array (
            'data' => $data,
            'data2' => $data2,
            'title' => 'Daftar Return Penerimaan Barang - PT. GMS'
        );
        $this->load->view('layout/wrapper_daftar_rpb', $data);
    }

    public function ajax_list_rpb(){
        $list = $this->rpb->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rpb) {
			$no++;
			$row = array();
			$row[] = $rpb->no_rpb;
			$row[] = $rpb->nama_gudang;
			$row[] = $rpb->nama_supplier;
            $row[] = $rpb->no_bpb;
            $row[] = $rpb->no_po;
            $row[] = $rpb->keterangan;
            $row[] = $rpb->tanggal;
            $url = site_url('purchase/print_rpb/').$rpb->no_rpb;
            $row[] = '<a class="btn btn-sm btn-info" href="'.$url.'" title="View" target="_blank"><i class="glyphicon glyphicon-pencil"></i> View</a>
                    <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_rpb('."'".$rpb->no_rpb."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				    <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_rpb('."'".$rpb->no_rpb."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->rpb->count_all(),
			"recordsFiltered" => $this->rpb->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }

    public function ajax_edit_rpb($id){
        $data = $this->rpb->get_by_id($id);
        $data2 = $this->rpb->baca_tabel_rpb_detail($id);

		$output = array(
            "rpb" => $data,
			"rpbDetail" => $data2
		);
		echo json_encode($output);
    }

    public function ajax_delete_rpb($id){
        $this->rpb->delete_rpb($id);
        $this->rpb->delete_rpb_detail($id);
        $this->bpb->delete_stock($id);
		echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_rpb(){
        $this->_validate_rpb();
        $no_rpb = $this->input->post('noRPB');
        $data = array (
            'id_gudang' => $this->input->post('gudang'),
            'id_supplier' => $this->input->post('supplier'),
            'no_bpb' => $this->input->post('noBPB'),
            'no_po' => $this->input->post('noPO'),
            'tanggal' => date('Y-m-d'),
            'keterangan' => $this->input->post('keterangan')
        );
        $table = 'return_penerimaan_barang';
        $data2 =$this->rpb->update($no_rpb, $data, $table);
        $this->rpb->delete_rpb_detail($no_rpb);
        $this->bpb->delete_stock($no_rpb);
		echo json_encode($data2);
    }

    public function print_po($id=null){
        if (!isset($id)) show_404();
        $data = $this->po->baca_tabel_po($id);
        $data2 = $this->po->baca_tabel_po_detail($id);
        // echo json_encode($data2);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $id.".pdf";
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        );
        $this->pdf->load_view('layout/content_print_po', $data);
    }

    public function print_bpb($id=null){
        if (!isset($id)) show_404();
        $data = $this->bpb->baca_tabel_bpb($id);
        $data2 = $this->bpb->baca_tabel_bpb_detail($id);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $id.".pdf";
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        );
        $this->pdf->load_view('layout/content_print_bpb', $data);
    }

    public function print_rpb($id=null){
        if (!isset($id)) show_404();
        $data = $this->rpb->baca_tabel_rpb($id);
        $data2 = $this->rpb->baca_tabel_rpb_detail($id);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $id.".pdf";
        $data = array ( 'data' => $data,
                        'data2' => $data2,
                        );
        $this->pdf->load_view('layout/content_print_rpb', $data);
    }

}

?>
