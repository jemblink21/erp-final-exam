<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<!-- <title>Surat Permintaan Barang</title> -->
	
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
            Return Pembelian Barang <br>
            
            <table id="supplier">
				<tbody>
					<tr>
					<?php foreach ($data as $rpb) { ?>
							<td>Supplier</td>
							<td>:</td>
							<td><?php echo $rpb['nama_supplier'];?></td>
                    </tr>
                    <tr>
                        <td>No. PO</td>
                        <td>:</td>
                        <td><?php echo $rpb['no_po'];?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $rpb['alamat'];?></td>
                    </tr>
				</tbody>
			</table>
			</div>
			
			<table id="meta">
                <tr>
                    <td class="meta-head">No. RPB</td>
                    <td>
                        <?php echo $rpb['no_rpb']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Lokasi Gudang</td>
                    <td><?php echo $rpb['nama_gudang'];?>
                </tr>
                <tr>
                    <td class="meta-head">No. BPB</td>
                    <td><?php echo $rpb['no_bpb'];?>
                </tr>
                <tr>
                    <td class="meta-head">Tanggal</td>
                    <td>
                    <?php 
                        $tanggal = strtotime($rpb['tanggal']);
                        $o_tanggal = date("d/m/Y", $tanggal);
                        echo $o_tanggal; 
                    ?>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Keterangan</td>
                    <td><?php echo $rpb['keterangan']; ?></td>
                </tr>
            <?php } ?>
			</table>
		<table id="items">
		  <tr>
			  <th>No</th>
		      <th>Kode Barang</th>
		      <th>Nama Barang</th>
		      <th>Deskripsi</th>
		      <th>Jumlah</th>
			  <th>Satuan</th>
		  </tr>
			<?php 
				$no = '1'; 
				foreach($data2 as $barang){ ?>
		  <tr class="item-row">
			  <td style="text-align:center;"><?php echo $no;?></td>
		      <td style="padding-left:10px;"><?php echo $barang['kode_barang'];?></td>
		      <td class="description"><?php echo $barang['nama_barang'];?></td>
		      <td><?php echo $barang['deskripsi'];?></td>
		      <td style="text-align:center;"><?php echo $barang['jumlah'];?></td>
			  <td style="text-align:center;"><?php echo $barang['nama_satuan']?></td>
			  
		  </tr>
			<?php
				$no++;
			}
			?>
		  
		</table>
		
		<div id="ttd">
			<div class="ttd-bpb">
				Yang Menyerahkan
				<br><br><br><br>
				______________
			</div>
			<div class="ttd-bpb">
				Mengetahui
				<br><br><br><br>
				______________
            </div>
            <div class="ttd-bpb">
				Yang Menerima
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
