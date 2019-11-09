<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Mutasi Persediaan</title>
	<link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-mutasi/style.css")?>' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-mutasi/print.css")?>' media="print" />
	<script type='text/javascript' src='<?php echo base_url("assets/js/js-invoice/jquery-1.3.2.min.js")?>'></script>
	<script type='text/javascript' src='<?php echo base_url("assets/js/js-invoice/example.js")?>'></script>

</head>

<body>

	<div id="page-wrap">
		<div style="clear:both"></div>
		<div id="date-ppb">
		<?php
		// $tAwal = $tAwal['tAwal'];
		// $tAkhir = $data['tAkhir'];
		echo date("d M Y", strtotime($tAwal)).' - '.date("d M Y", strtotime($tAkhir)); 
		?>
		<br>
		Lokasi Gudang : <?= $gudang ?>
		</div>
		<div id="customer-title">
		PT. GEMAH MAKMUR SEJAHTERA <br>
		Mutasi Persediaan
		</div>
		
		<div class="line"></div>
		<div class="clearfix"></div>
		<div id="content" style="font-size:12px;border-bottom:1px solid #000;">
			<div class="col2">Kode Barang</div>
			<div class="col3">Nama Barang</div>
			<div class="col2">Saldo Awal</div>
			<div class="col2">Penerimaan</div>
			<div class="col2">Pengeluaran</div>
			<div class="col2">Saldo Akhir</div>
			<div class="clearfix"></div>
		</div>

		<?php
			foreach ($data as $list){
		?>
		<div id="content-isi">
			<div class="cols2"><?= $list['kode_barang']?></div>
			<div class="cols3"><?= $list['nama_barang']?></div>
			<div class="cols2"><?= $list['saldo_awal']?></div>
			<div class="cols2"><?= $list['penerimaan']?></div>
			<div class="cols2"><?= $list['pengeluaran']?></div>
			<div class="cols2"><?= $list['saldo_akhir'].' '.$list['nama_satuan']?></div>
			<div class="clearfix"></div>
		</div>
		<?php
			}
		?>


		<div class="line"></div>
		
		<div id="ttd">
			<div class="ttd-row">
				Pimpinan Pabrik
				<br><br><br><br>
				______________
			</div>
			<div class="ttd-row">
				Mengetahui
				<br><br><br><br>
				______________
			</div>
			<div class="ttd-row">
				Dibuat Oleh
				<br><br><br><br>
				______________
			</div>	
		</div>
		
		<div id="terms">
		  <p><?php echo date('d M Y  H:i:s'); ?></p>
		</div>

	</div>
</body>

</html>