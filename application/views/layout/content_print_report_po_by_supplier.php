<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Daftar Permintaan Pembelian Barang</title>
	<link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-report-by-supplier/style.css")?>' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-report-by-supplier/print.css")?>' media="print" />
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
		<i>Purchase Report By Supplier</i> <br>
		
		</div>
		
		<div class="line"></div>
		<div class="clearfix"></div>
		<div id="content" style="font-size:12px;border-bottom:1px solid #000;">
			<div class="col1">Kode Barang</div>
			<div class="col3 text-center">Nama Barang</div>
			<div class="col1">Jumlah</div>
			<div class="col2 text-center">No. BPB</div>
			<div class="col2 text-center">Jumlah BPB</div>
			<div class="clearfix"></div>
		</div>

		<?php
			$count_outstanding = count($data['listing']);
			for ($i=0;$i<$count_outstanding;$i++)
			{
				if ($i == '0'){
			?>
				<div id="content-isi" style="font-weight:bold;text-decoration: underline;">
					<div class="cols2"><?= $data['listing'][$i]['no_po'] ?></div>
					<div class="cols4"><?= strtoupper($data['listing'][$i]['nama_supplier']) ?></div>
					<div class="cols2">
						<?php
							$date = $data['listing'][$i]['tanggal'];
							echo date("d M Y", strtotime($date));
						?>
					</div>
					<div class="cols2"><?= $data['listing'][$i]['keterangan'] ?></div>
					<div class="clearfix"></div>
				</div>

			<?php } else {
				$no1 = $data['listing'][$i-1]['no_po'];
				$no2 = $data['listing'][$i]['no_po'];
				if ($no2 == $no1){
					echo "";
				} else {
			?>
				<div id="content-isi" style="font-weight:bold;text-decoration: underline;">
					<div class="cols2"><?= $data['listing'][$i]['no_po'] ?></div>
					<div class="cols4"><?= strtoupper($data['listing'][$i]['nama_supplier']) ?></div>
					<div class="cols2">
						<?php
							$date = $data['listing'][$i]['tanggal'];
							echo date("d M Y", strtotime($date));
						?>
					</div>
					<div class="cols2"><?= $data['listing'][$i]['keterangan'] ?></div>
					<div class="clearfix"></div>
				</div>

			<?php } ?>
		<?php } ?>

		<div class="content-isi">
			<div class="cols1"><?= $data['listing'][$i]['kode_barang'] ?></div>
			<div class="cols3"><?= $data['listing'][$i]['nama_barang'] ?></div>
			<div class="cols1"><?= $data['listing'][$i]['jumlah_po'] ?></div>
			<div class="cols2 text-center"><?= $data['listing'][$i]['no_bpb'] ?></div>
			<div class="cols2 text-center"><?= $data['listing'][$i]['jumlah_bpb'] ?></div>
			<div class="clearfix"></div>
		</div>
				
	<?php } ?>

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