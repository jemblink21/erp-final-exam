<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-pb/style.css")?>' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/css/css-pb/print.css")?>' media="print" />
	<script type='text/javascript' src='<?php echo base_url("assets/js/js-invoice/jquery-1.3.2.min.js")?>'></script>
	<script type='text/javascript' src='<?php echo base_url("assets/js/js-invoice/example.js")?>'></script>

</head>

<body>

	<div id="page-wrap">
		<div style="clear:both"></div>
			<div id="customer-title">
			PT. GEMAH MAKMUR SEJAHTERA <br>
			PURCHASE ORDER <br>
			<table id="supplier">
				<tbody>
					<tr>
					<?php foreach ($data as $po) { ?>
							<td>Supplier</td>
							<td>:</td>
							<td><?php echo $po['nama_supplier'];?></td>
					</tr>
					<tr>
							<td></td>
							<td></td>
							<td><?php echo $po['alamat'];?></td>			
					</tr>
				</tbody>
			</table>
			</div>
			
			<table id="meta">
					<tr>
							<td class="meta-head">No. PO</td>
							<td>
									<?php echo $po['no_po']; ?>
							</td>
					</tr>
					<tr>

							<td class="meta-head">Tanggal</td>
							<td>
							<?php 
									$tanggal = strtotime($po['tanggal']);
									$o_tanggal = date("d/m/Y", $tanggal);
									echo $o_tanggal; 
							?>
							</td>
					</tr>
					<tr>
						<td class="meta-head">Keterangan</td>
						<td><?php echo $po['keterangan']; ?></td>
					</tr>
					
			</table>

			
						
		
		<table id="items">
		  <tr>
			  	<th>No</th>
		      <th>Nama Barang</th>
		      <th>Deskripsi</th>
		      <th>Jumlah</th>
					<th>Harga</th>
					<th>Total</th>
		  </tr>
			<?php 
				$no = '1'; 
				foreach($data2 as $barang){ ?>
		  <tr class="item-row">
			  <td style="text-align:center;"><?php echo $no;?></td>
		      <td class="description"><?php echo $barang['nama_barang'];?></td>
		      <td><?php echo $barang['deskripsi'];?></td>
		      <td style="text-align:center;"><?php echo $barang['jumlah'].' '.$barang['nama_satuan'];?></td>
					<td style="text-align:left;"><?php echo 'Rp. '.number_format($barang['harga'],0,",",".");?></td>
					<td style="text-align:left;"><?php echo 'Rp. '.number_format($barang['jumlah']*$barang['harga'],0,",",".");?></td>
			  
		  </tr>
			<?php
				$no++;
			}
			?>
			<tr class="item-row" style="outline: thin solid !important">
				<td colspan="4"></td>
				<td style="text-align:center;font-weight:bold;">Total Harga</td>
				<td style="font-weight:bold;"><?php echo 'Rp. '.number_format($po['total_harga'],0,",",".");?></td>
<?php } ?>
			</tr>
		  
		</table>
		
		<div id="ttd">
			<div class="alamat">
				<table>
					<tbody>
						<tr>
							<td>Alamat Kirim</td>
							<td>:</td>
							<td>Jl. Karimun Jawa, Gedang Anak, Kab.Semarang</td>
						</tr>
						<tr>
							<td>No. Telepon</td>
							<td>:</td>
							<td>(024) 62262525</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="ttd-row-po">
				Hormat Kami
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
