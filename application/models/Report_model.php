<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    public function report_ppb($tAwal, $tAkhir, $gudang){
        // $query = $this->db->query('SELECT * FROM permintaan_pembelian WHERE tanggal >= "'.$tAwal.'" AND tanggal <= "'.$tAkhir.'" AND id_gudang like "'.$gudang.'"');
        $this->db->select('a.no_ppb, a.id_gudang, b.nama_pegawai, c.nama_departemen, a.tanggal, a.keterangan');
        $this->db->from('permintaan_pembelian a');
        $this->db->join('pegawai b', 'a.id_pegawai = b.id_pegawai', 'left');
        $this->db->join('departemen c', 'c.id_departemen = a.id_departemen', 'left');
        $this->db->where('a.tanggal >=', $tAwal);
        $this->db->where('a.tanggal <=', $tAkhir);
        $this->db->like('a.id_gudang', $gudang);
        $this->db->order_by('a.tanggal', 'ASC');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->result_array();
    }

    public function report_ppb_detail($no_ppb){
        $this->db->select('a.no_ppb_detail, a.no_ppb, a.kode_barang, b.nama_barang, a.jumlah, a.keterangan, c.nama_satuan');
        $this->db->from('permintaan_pembelian_detail a');
        $this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
        $this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
        $this->db->where('a.no_ppb', $no_ppb);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function report_stock($tAwal, $tAkhir, $gudang, $barang){
        $this->db->select('a.tanggal, a.no_ref, a.kode_barang, b.nama_barang, a.jumlah, c.nama_satuan');
        $this->db->from('stock a');
        $this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
        $this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
        $this->db->where('date(a.tanggal) >=', $tAwal);
        $this->db->where('date(a.tanggal) <=', $tAkhir);
        $this->db->like('a.id_gudang', $gudang);
        $this->db->like('a.kode_barang', $barang);
        $this->db->order_by('a.tanggal', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
        // echo $this->db->last_query();
    }

    public function total_stock($tAwal, $tAkhir, $gudang, $barang){
        $this->db->select('sum(a.jumlah) as jumlah, c.nama_satuan');
        $this->db->from('stock a');
        $this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
        $this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
        $this->db->where('date(a.tanggal) <=', $tAkhir);
        $this->db->like('a.id_gudang', $gudang);
        $this->db->like('a.kode_barang', $barang);
        $query = $this->db->get();
        return $query->result_array();
        // echo $this->db->last_query();
    }

    public function saldo_awal($tAwal, $tAkhir, $gudang, $barang){
        $this->db->select('b.nama_barang, sum(a.jumlah) as jumlah, c.nama_satuan');
        $this->db->from('stock a');
        $this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
        $this->db->join('satuan_barang c', 'b.id_satuan = c.id_satuan', 'left');
        $this->db->where('date(a.tanggal) <', $tAwal);
        $this->db->like('a.id_gudang', $gudang);
        $this->db->like('a.kode_barang', $barang);
        $query = $this->db->get();
        return $query->result_array();
        // echo $this->db->last_query();
    }

    public function report_po_outstanding($tAwal, $tAkhir, $gudang, $idSupplier){
        $this->db->select('a.no_ppb, a.no_ppb_detail, g.tanggal as tanggal_ppb, b.nama_barang, a.jumlah, d.nama_supplier, f.tanggal as tanggal_po, f.no_po, c.no_ppb_detail as po_no_ppb_detail, c.no_po_detail, c.jumlah as jumlah_po, e.no_bpb, h.tanggal as tanggal_bpb, e.no_po_detail as bpb_no_po_detail, e.jumlah as jumlah_bpb');
        $this->db->from('permintaan_pembelian_detail a');
        $this->db->join('permintaan_pembelian g', 'g.no_ppb = a.no_ppb', 'left');
        $this->db->join('master_barang b', 'a.kode_barang = b.kode_barang', 'left');
        $this->db->join('pembelian_barang_detail c', 'c.no_ppb_detail = a.no_ppb_detail', 'left');
        $this->db->join('pembelian_barang f', 'f.no_po = c.no_po', 'left');
        $this->db->join('supplier d', 'd.id_supplier = f.id_supplier', 'left');
        $this->db->join('penerimaan_barang_detail e', 'e.no_po_detail = c.no_po_detail', 'left');
        $this->db->join('penerimaan_barang h', 'h.no_bpb = e.no_bpb', 'left');
        $this->db->where('date(g.tanggal) >=', $tAwal);
        $this->db->where('date(g.tanggal) <=', $tAkhir);
        $this->db->like('g.id_gudang', $gudang);
        if ($idSupplier != ""){
            $this->db->like('f.id_supplier', $idSupplier);
        };
        $this->db->order_by('g.tanggal', 'ASC');
        $this->db->order_by('b.nama_barang', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
        // echo $this->db->last_query();
    }

    public function report_summary_po($tAwal, $tAkhir, $idSupplier){
        $this->db->select('a.id_supplier, a.no_po, a.tanggal, b.kode_barang, c.nama_barang, b.jumlah, e.nama_satuan, b.harga, (b.jumlah * b.harga) as total, d.nama_supplier');
        $this->db->from('pembelian_barang a');
        $this->db->join('pembelian_barang_detail b', 'a.no_po = b.no_po', 'left');
        $this->db->join('master_barang c', 'b.kode_barang = c.kode_barang', 'left');
        $this->db->join('satuan_barang e', 'c.id_satuan = e.id_satuan', 'left');
        $this->db->join('supplier d', 'a.id_supplier = d.id_supplier', 'left');
        $this->db->where('date(a.tanggal) >=', $tAwal);
        $this->db->where('date(a.tanggal) <=', $tAkhir);
        if ($idSupplier != ""){
            $this->db->like('a.id_supplier', $idSupplier);
        };
        $this->db->order_by('a.id_supplier', 'ASC');
        $this->db->order_by('a.tanggal', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
        // echo $this->db->last_query();
    }

    public function report_po_by_supplier($tAwal, $tAkhir, $idSupplier){
        $this->db->select('a.no_po, a.id_supplier, b.nama_supplier, a.tanggal, a.keterangan, c.kode_barang, d.nama_barang, c.jumlah as jumlah_po, e.no_bpb, e.jumlah as jumlah_bpb');
        $this->db->from('pembelian_barang a');
        $this->db->join('supplier b', 'a.id_supplier = b.id_supplier', 'left');
        $this->db->join('pembelian_barang_detail c', 'c.no_po = a.no_po', 'left');
        $this->db->join('master_barang d', 'd.kode_barang = c.kode_barang', 'left');
        $this->db->join('penerimaan_barang_detail e', 'c.no_po_detail = e.no_po_detail', 'left');
        $this->db->where('date(a.tanggal) >=', $tAwal);
        $this->db->where('date(a.tanggal) <=', $tAkhir);
        if ($idSupplier != ""){
            $this->db->like('a.id_supplier', $idSupplier);
        };
        $this->db->order_by('a.tanggal', 'ASC');
        $this->db->order_by('a.no_po', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
        // echo $this->db->last_query();        
    }

    public function report_mutasi($tAwal, $tAkhir, $gudang){
        $query = $this->db->query("SELECT `a`.`id_gudang`, `a`.`kode_barang`, `b`.`nama_barang`,
        IFNULL((SELECT sum(jumlah) FROM stock WHERE date(tanggal) < '$tAwal' AND id_gudang LIKE '%$gudang%' AND kode_barang LIKE `a`.`kode_barang` GROUP BY kode_barang),0) AS saldo_awal, 
        IFNULL((SELECT sum(jumlah) FROM stock WHERE jumlah > 0 AND date(tanggal) >= '$tAwal' AND date(tanggal) <= '$tAkhir' AND id_gudang LIKE '%$gudang%' AND kode_barang LIKE `a`.`kode_barang` GROUP BY kode_barang),0) as penerimaan, 
        IFNULL((SELECT sum(jumlah) FROM stock WHERE jumlah < 0 AND date(tanggal) >= '$tAwal' AND date(tanggal) <= '$tAkhir' AND id_gudang LIKE '%$gudang%' AND kode_barang LIKE `a`.`kode_barang` GROUP BY kode_barang),'-0')*'-1' as pengeluaran, 
        IFNULL(SUM(a.jumlah), 0) as saldo_akhir, `c`.`nama_satuan` FROM `stock` `a` LEFT JOIN `master_barang` `b` ON `a`.`kode_barang` = `b`.`kode_barang` LEFT JOIN `satuan_barang` `c` ON `b`.`id_satuan` = `c`.`id_satuan` 
        WHERE date(a.tanggal) <= '$tAkhir' AND `a`.`id_gudang` LIKE '%$gudang%' ESCAPE '!' GROUP BY a.kode_barang ORDER BY `b`.`nama_barang` ASC");
        return $query->result_array();
        // echo $this->db->last_query();
    }
}