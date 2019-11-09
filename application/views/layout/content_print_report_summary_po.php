<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Summary of Purchase Report - PT. GMS</title>
	<link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-summary-po/style.css")?>' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-summary-po/print.css")?>' media="print" />
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
		echo date("d M Y", strtotime($tAwal)).' - '.date("d M Y", strtotime($tAkhir)); 
		?>
		</div>
		<div id="customer-title">
		PT. GEMAH MAKMUR SEJAHTERA <br>
		<i>Summary of Purchase Report</i> <br>
		
		</div>
		
		<div class="line"></div>
		<div class="clearfix"></div>
		<div id="content" style="font-size:12px;border-bottom:1px solid #000;">
			<div class="col2">No. PO</div>
			<div class="col1">Tanggal</div>
			<div class="col1">Kode Barang</div>
			<div class="col3 text-center">Nama Barang</div>
			<div class="col1">Jumlah</div>
			<div class="col1 text-center">Harga</div>
			<div class="col1 text-center">Total</div>
			<div class="clearfix"></div>
		</div>
		<?php
			$count_summary = count($data['summary']);
			for ($i=0;$i<$count_summary;$i++)
			{
		?>
				<?php if ($i == '0'){ ?>
				<div id="content-isi">
					<div style="font-size:14px;font-weight:bold">
						<u><?php echo strtoupper($data['summary'][$i]['nama_supplier']); ?></u>
					</div>
				</div>
				<?php } else if($data['summary'][$i]['id_supplier'] != $data['summary'][$i-1]['id_supplier']){ ?>
				<div id="content-isi">
					<div style="font-size:14px;font-weight:bold;margin-top:5px;">
						<u><?php echo strtoupper($data['summary'][$i]['nama_supplier']); ?></u>
					</div>
				</div>
				<?php } ?>
				<div id="content-isi">
					<div class="cols2"><?= $data['summary'][$i]['no_po']?></div>
					<div class="cols1"><?php $date = $data['summary'][$i]['tanggal']; echo date("d M Y", strtotime($date));?></div>
					<div class="cols1"><?= $data['summary'][$i]['kode_barang']?></div>
					<div class="cols3"><?= $data['summary'][$i]['nama_barang']?></div>
					<div class="cols1"><?= $data['summary'][$i]['jumlah'].' '. $data['summary'][$i]['nama_satuan']?></div>
					<div class="cols1">Rp. <?= $data['summary'][$i]['harga']?></div>
					<div class="cols1">Rp. <?= $data['summary'][$i]['total']?></div>
					<div class="clearfix"></div>
				</div>
		<?php
			}
		?>
		<!-- <div id="content-isi">
			<div style="font-size:14px;font-weight:bold">
				<u>SURYA SARANA DINAMIKA, PT.</u>
			</div>
		</div> -->

		<!-- <div id="content-isi">
			<div class="cols2">PSK-GMS-1905-001</div>
			<div class="cols1">15 Jan 2019</div>
			<div class="cols1">CL-BEA-001</div>
			<div class="cols3">Bearing 6001 ZZ/SKF FAG</div>
			<div class="cols1">20 buah</div>
			<div class="cols1">Rp. 10.000</div>
			<div class="cols1">Rp. 200.000</div>
			<div class="clearfix"></div>
		</div>
		<div id="content-isi">
			<div class="cols2">PSK-GMS-1905-001</div>
			<div class="cols1">15 Jan 2019</div>
			<div class="cols1">CL-BEA-001</div>
			<div class="cols3">Bearing 6001 ZZ/SKF FAG TUTUP POLOS</div>
			<div class="cols1">20 buah</div>
			<div class="cols1">Rp. 10.000</div>
			<div class="cols1">Rp. 10.000.000</div>
			<div class="clearfix"></div>
		</div> -->
		

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