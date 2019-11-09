<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->helper('url');
		    $this->load->model('Master_model');
        $this->model = $this->Master_model;

        $this->load->model('Report_model');
        $this->report = $this->Report_model;

        if (!$this->session->has_userdata('username')) {
          $this->session->set_flashdata('result_login','Anda belum login');
          redirect('login');
        }
    }

    public function index() {
		$data = array( 'title' => 'Report - PT. GMS');
		$this->load->view('layout/wrapper_master', $data);
    }
    
    public function ppb() {
        $data = $this->model->baca_tabel("gudang");
        $data = array ( 'data' => $data,
                        'title' => 'Report Daftar Permintaan Pembelian - PT. GMS');
        $this->load->view('layout/wrapper_report_ppb', $data);
    }

    public function print_ppb(){
        $tAwal = date("Y-m-d", strtotime($this->input->post('tAwal')));
        $tAkhir = date("Y-m-d", strtotime($this->input->post('tAkhir')));
        $gudang = $this->input->post('gudang');

        $data = $this->report->report_ppb($tAwal, $tAkhir, $gudang);
        $output = array();
        $output['PPB'] = $data;
        $output['tAwal'] = $tAwal;
        $output['tAkhir'] = $tAkhir; 
        foreach ($data as $ppb){
          $dat = $this->report->report_ppb_detail($ppb['no_ppb']);
          $output[$ppb['no_ppb']] = $dat;
        };
        // echo json_encode($output);

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "ppb";
        $data3 = array ( 'data' => $output
                        );
        $this->pdf->load_view('layout/content_print_ppb', $data3);
    }

    public function stock(){
      $data = $this->model->baca_tabel("gudang");
      $data2 = $this->model->baca_tabel("kategori_barang");
      $data = array ( 'data' => $data,
                      'data2' => $data2,
                      'title' => 'Kartu Stock Persediaan - PT. GMS');
      $this->load->view('layout/wrapper_report_stock', $data);
    }

    public function print_stock(){
        $tAwal = date("Y-m-d", strtotime($this->input->post('tAwal')));
        $tAkhir = date("Y-m-d", strtotime($this->input->post('tAkhir')));
        $gudang = $this->input->post('gudang');
        $barang = $this->input->post('barang');

        $data = $this->report->report_stock($tAwal, $tAkhir, $gudang, $barang);
        $total = $this->report->total_stock($tAwal, $tAkhir, $gudang, $barang);
        $saldo = $this->report->saldo_awal($tAwal, $tAkhir, $gudang, $barang);

        // $this->load->view('layout/content_print_stock', $data2);

        $output = array( 'tAwal' => $tAwal,
                          'tAkhir' => $tAkhir,
                          'gudang' => $gudang,
                          'stock' => $data,
                          'total' => $total,
                          'saldo' => $saldo,
        );
        // echo json_encode($output);

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "ppb";
        $data2 = array ( 'data' => $output
                        );
        $this->pdf->load_view('layout/content_print_stock', $data2);
    }

    public function po_outstanding(){
      $data = $this->model->baca_tabel("gudang");
      $data2 = $this->model->baca_tabel("supplier");
      $data = array ('data' => $data,
                    'data2' => $data2,
                    'title' => 'Purchase Order Outstanding Report - PT. GMS');
      $this->load->view('layout/wrapper_report_po_outstanding', $data);
    }

    public function print_po_outstanding(){
      $tAwal = date("Y-m-d", strtotime($this->input->post('tAwal')));
      $tAkhir = date("Y-m-d", strtotime($this->input->post('tAkhir')));
      $gudang = $this->input->post('gudang');
      $idSupplier = $this->input->post('supplier');

      $data = $this->report->report_po_outstanding($tAwal, $tAkhir, $gudang, $idSupplier);

      $output = array( 'tAwal' => $tAwal,
                        'tAkhir' => $tAkhir,
                        'gudang' => $gudang,
                        'outstanding' => $data
        );
      
      
      $this->load->library('pdf');
      $this->pdf->setPaper('legal', 'landscape');
      $this->pdf->filename = "po_outstanding";
      $data2 = array ( 'data' => $output
                      );
      // echo json_encode($data2);
      $this->pdf->load_view('layout/content_print_report_po_outstanding', $data2);
    }

    public function summary_po() {
      $data2 = $this->model->baca_tabel("supplier");
      $data = array ('data2' => $data2,
                    'title' => 'Summary Of Purchase Report - PT. GMS');
      $this->load->view('layout/wrapper_report_summary_po', $data);
    }

    public function print_summary_po(){
      $tAwal = date("Y-m-d", strtotime($this->input->post('tAwal')));
      $tAkhir = date("Y-m-d", strtotime($this->input->post('tAkhir')));
      $idSupplier = $this->input->post('supplier');

      $data = $this->report->report_summary_po($tAwal, $tAkhir, $idSupplier);

      $output = array( 'tAwal' => $tAwal,
                        'tAkhir' => $tAkhir,
                        'summary' => $data
        );
      
      $this->load->library('pdf');
      $this->pdf->setPaper('A4', 'portrait');
      $this->pdf->filename = "summary_po";
      $data2 = array ( 'data' => $output
                      );
      // echo json_encode($data2);
      $this->pdf->load_view('layout/content_print_report_summary_po', $data2);
    }

    public function po_by_supplier(){
      $data2 = $this->model->baca_tabel("supplier");
      $data = array ('data2' => $data2,
                    'title' => 'Purchase Report By Supplier - PT. GMS');
      $this->load->view('layout/wrapper_report_po_by_supplier', $data);
    }

    public function print_po_by_supplier(){
      $tAwal = date("Y-m-d", strtotime($this->input->post('tAwal')));
      $tAkhir = date("Y-m-d", strtotime($this->input->post('tAkhir')));
      $idSupplier = $this->input->post('supplier');

      $data = $this->report->report_po_by_supplier($tAwal, $tAkhir, $idSupplier);
      
      $output = array( 'tAwal' => $tAwal,
                        'tAkhir' => $tAkhir,
                        'listing' => $data
        );
      
      $this->load->library('pdf');
      $this->pdf->setPaper('A4', 'portrait');
      $this->pdf->filename = "po_by_supplier";
      $data2 = array ( 'data' => $output
                      );
      // echo json_encode($data2);
      $this->pdf->load_view('layout/content_print_report_po_by_supplier', $data2);
    }

    public function mutasi(){
      $data = $this->model->baca_tabel("gudang");
      $data = array ('data' => $data,
                    'title' => 'Mutasi Persediaan - PT. GMS');
      $this->load->view('layout/wrapper_report_mutasi', $data);
    }

    public function print_mutasi(){
      $tAwal = date("Y-m-d", strtotime($this->input->post('tAwal')));
      $tAkhir = date("Y-m-d", strtotime($this->input->post('tAkhir')));
      $gudang = $this->input->post('gudang');

      $data = $this->report->report_mutasi($tAwal, $tAkhir, $gudang);
      // foreach ($data as $data){
      //   echo $data['kode_barang'].' '.$data['saldo_awal'].'<br>';
      // }
      $data2 = array( 'tAwal' => $tAwal,
                        'tAkhir' => $tAkhir,
                        'gudang' => $gudang,
                        'data' => $data
        );
      
      $this->load->library('pdf');
      $this->pdf->setPaper('A4', 'portrait');
      $this->pdf->filename = "mutasi_persediaan";
      // $data2 = array ( 'data' => $output
      //                 );
      // echo json_encode($data2);
      $this->pdf->load_view('layout/content_print_report_mutasi', $data2);
    }
}