<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Daftar Permintaan Pembelian Barang</title>
	<link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-po/style.css")?>' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-po/print.css")?>' media="print" />
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
        Purchase Order Outstanding Report <br>
		
		</div>
		
		<div class="line"></div>
		<div class="clearfix"></div>
		<div id="content" class="bold" style="font-size:14px;border-bottom:1px solid #000;">
			<div class="col2">No. PPB</div>
			<div class="col">Tanggal</div>
			<div class="col3">Nama Barang</div>
			<div class="col">Jumlah PPB</div>
            <div class="col2">No. PO </div>
			<div class="col">Tanggal</div>
            <div class="col3">Nama Supplier</div>
            <div class="col">Jumlah PO</div>
            <div class="col3">No. BPB</div>
			<div class="col">Tanggal BPB</div>
            <div class="col">Jumlah</div>
			<div class="clearfix"></div>
		</div>

		<?php
			$count_outstanding = count($data['outstanding']);
			for ($i=0;$i<$count_outstanding;$i++)
			{
		?>
				<div class="content-isi">
					<div class="cols2">
						<?php
							$no2 = $data['outstanding'][$i]['no_ppb'];
							if($i == '0'){
								echo $no2;
							} else {
								$no1 = $data['outstanding'][$i-1]['no_ppb'];
								if ($no1 == $no2){
									echo "";
								} else {
									echo $no2;
								}
							}
						?>
					</div>
					<div class="cols">
						<?php 
							$date = $data['outstanding'][$i]['tanggal_ppb'];
							if ($date != ''){
								echo date("d M Y", strtotime($date));
							}
							
						?>
					</div>
					<div class="cols3">
						<?php
							$nama = $data['outstanding'][$i]['nama_barang'];
							$no2 = $data['outstanding'][$i]['no_ppb_detail'];

							if ($i == '0'){
								echo $nama;
							} else {
								$no1 = $data['outstanding'][$i-1]['no_ppb_detail'];
								if ($no1 == $no2){
									echo "";
								} else {
									echo $nama;
								}
							}
						?>
					</div>
					<div class="cols" style="text-align:center;">
						<?php
							$jumlah = $data['outstanding'][$i]['jumlah'];
							$no2 = $data['outstanding'][$i]['no_ppb_detail'];
							if ($i == '0'){
								echo $jumlah;
							} else {
								$no1 = $data['outstanding'][$i-1]['no_ppb_detail'];
								if ($no1 == $no2){
									echo "";
								} else {
									echo $jumlah;
								}
							}
						?>
					</div>
					<div class="cols2">
						<?php
							echo $data['outstanding'][$i]['no_po'];
						?>
					</div>
					<div class="cols">
						<?php 
							$date = $data['outstanding'][$i]['tanggal_po'];
							if ($date != ''){
								echo date("d M Y", strtotime($date));
							}
						?>
					</div>
					<div class="cols3">
						<?php
							echo $data['outstanding'][$i]['nama_supplier'];
						?>
					</div>
					<div class="cols" style="text-align:center;">
						<?php
							echo $data['outstanding'][$i]['jumlah_po'];
						?>
					</div>
					<div class="cols3">
						<?php
							echo $data['outstanding'][$i]['no_bpb'];
						?>
					</div>
					<div class="cols">
						<?php 
							$date = $data['outstanding'][$i]['tanggal_bpb'];
							if ($date != ''){
								echo date("d M Y", strtotime($date));
							}
						?>
					</div>
					<div class="cols" style="text-align:left;">
						<?php
							echo $data['outstanding'][$i]['jumlah_bpb'];
						?>
					</div>
					<div class="clearfix"></div>
				</div>
		<?php
			}
		?>

		
		<div id="terms">
		  <p><?php echo date('d M Y  H:i:s'); ?></p>
		</div>

	</div>
</body>

</html>