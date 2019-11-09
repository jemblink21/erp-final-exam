<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Daftar Permintaan Pembelian Barang</title>
	<link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-stock/style.css")?>' />
	
	<script type='text/javascript' src='<?php echo base_url("assets/js/js-invoice/jquery-1.3.2.min.js")?>'></script>
	<script type='text/javascript' src='<?php echo base_url("assets/js/js-invoice/example.js")?>'></script>

</head>

<body>

	<div id="page-wrap">
		<div style="clear:both"></div>
		<div id="date-ppb">
		<?php
		$tAwal = $data['tAwal'];
		$tAkhir = $data['tAkhir'];
        echo date("d M Y", strtotime($tAwal)).' - '.date("d M Y", strtotime($tAkhir)).'<br>Lokasi Gudang : '.$data['gudang']; 
        
		?>
		</div>
		<div id="customer-title">
		PT. GEMAH MAKMUR SEJAHTERA <br>
		Kartu Stok Persediaan <br>
		
		</div>
		
		<div class="line"></div>
		<div class="clearfix"></div>
		<div id="content" style="font-size:14px;border-bottom:1px solid #000;">
			<div class="col1">Tanggal</div>
			<div class="col2">No. Ref</div>
			<div class="col3">Nama Barang</div>
            <div class="col4">Jumlah</div>
            <div class="col5">Keterangan</div>
			<div class="clearfix"></div>
        </div>
		<div id="isi">
			<div class="col1"><?php echo date('d M Y', strtotime($tAwal))?></div>
			<div class="col2"></div>
			<div class="col3"><?php echo $data['saldo']['0']['nama_barang']?></div>
            <div class="col4" style="text-align:right;font-weight:bold;"><?php echo $data['saldo']['0']['jumlah'].' '.$data['saldo']['0']['nama_satuan']?></div>
            <div class="col5" style="font-weight:bold;">Saldo Awal</div>
			<div class="clearfix"></div>
        </div>
        <?php
			$count = count($data['stock']);
			for ($x=0;$x<$count;$x++)
			{
		?>
		
        <div id="isi">
			<div class="col1"><?php echo date('d M Y', strtotime($data['stock'][$x]['tanggal']))?></div>
			<div class="col2"><?php echo $data['stock'][$x]['no_ref']?></div>
			<div class="col3"><?php echo $data['stock'][$x]['nama_barang']?></div>
            <div class="col4" style="text-align:right;"><?php echo $data['stock'][$x]['jumlah'].' '.$data['stock'][$x]['nama_satuan']?></div>
            <div class="col5"></div>
			<div class="clearfix"></div>
        </div>

		<?php
			}
		?>
		
        <div class="line"></div>
        <div style="float:left;text-align:right;width:550px;font-weight:bold;margin-right:30px;">
			<?php echo $data['total']['0']['jumlah'].' '.$data['total']['0']['nama_satuan'];?>
		</div>
		<div style="float:left;width:100px;font-weight:bold;">Saldo Akhir</div>
        <div class="clearfix"></div>
		<div class="line"></div>
		<div id="terms">
		  <p><?php echo date('d M Y  H:i:s'); ?></p>
		</div>

	</div>
</body>

</html>