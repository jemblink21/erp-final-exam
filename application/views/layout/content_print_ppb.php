<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Daftar Permintaan Pembelian Barang</title>
	<link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-ppb/style.css")?>' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-ppb/print.css")?>' media="print" />
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
		Daftar Permintaan Pembelian Barang <br>
		
		</div>
		
		<div class="line"></div>
		<div class="clearfix"></div>
		<div id="content" style="font-size:14px;border-bottom:1px solid #000;">
			<div class="col1">Tanggal</div>
			<div class="col2">No. PPB</div>
			<div class="col3">Peminta</div>
			<div class="col4">Keterangan</div>
			<div class="clearfix"></div>
		</div>
		
		<?php
			$countppb = count($data['PPB']);
			for ($i=0;$i<$countppb;$i++)
			{
		?>
			<div id="content">
				<div class="col1">
					
					<?php 
					$date = $data['PPB'][$i]['tanggal'];
					echo '<u>'.date("d M Y", strtotime($date)).'</u>'; ?>
				</div>
			<?php
				$ppb = $data['PPB'][$i]['no_ppb'];
			?>
				<div class="col2">
					<?php echo '<u>'.$ppb.'</u>'; ?>
				</div>
				<div class="col3">
				<?php 
					echo '<u>'.$data['PPB'][$i]['nama_departemen'].'</u>'.'<br>'.
					$data['PPB'][$i]['nama_pegawai']; 
				?>
				</div>
				<div class="col4">
					<?php echo '<u>'.$data['PPB'][$i]['keterangan'].'</u>'; ?>
				</div>
				<?php 
				$countppbdetail = count($data[$ppb]);
				for ($z=0;$z<$countppbdetail;$z++){
				?>
				<div class="clearfix"></div>
				<div class="cols1"></div>
				<div class="cols2">
					<?php echo $data[$ppb][$z]['kode_barang']; ?>
				</div>
				<div class="cols3">
					<?php echo $data[$ppb][$z]['nama_barang']; ?>
				</div>
				<div class="cols4">
					<?php 
						echo $data[$ppb][$z]['jumlah'].' ';
						echo $data[$ppb][$z]['nama_satuan'];
					?>
				</div>
				<div class="cols5">
					<?php echo $data[$ppb][$z]['keterangan']; ?>
				</div>
				<div class="clearfix"></div>
				<?php
					}
				?>
			 	
			</div>
			<div class="clearfix"></div>
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
				Kepala Bagian
				<br><br><br><br>
				______________
			</div>
			<div class="ttd-row">
				Pemohon
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