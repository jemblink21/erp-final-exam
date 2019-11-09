<!-- Start navbar -->

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url() ?>" class="site_title"><i class="fa fa-paw"></i> <span>PT. GMS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url('assets/images/img.jpg')?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('nama');?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('index.php/master/barang')?>">Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/master/kategori')?>">Kategori Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/master/satuan')?>">Satuan Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/master/supplier')?>">Supplier</a></li>
                      <li><a href="<?php echo base_url('index.php/master/departemen')?>">Departemen</a></li>
                      <li><a href="<?php echo base_url('index.php/master/gudang')?>">Gudang</a></li>
                      <li><a href="<?php echo base_url('index.php/master/pegawai')?>">Pegawai</a></li>
                    </ul>
                  </li>
                  <!-- menu pruchasing -->
                  <li><a><i class="fa fa-edit"></i> Purchase <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('index.php/purchase/ppb')?>">Permintaan Pembelian</a></li>
                      <li><a href="<?php echo base_url('index.php/purchase/po')?>">Pembelian Barang (PO)</a></li>
                      <li><a href="<?php echo base_url('index.php/purchase/bpb')?>">Penerimaan Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/purchase/rpb')?>">Return Penerimaan Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/purchase/DaftarPPB')?>">Daftar Permintaan Pembelian</a></li>
                      <li><a href="<?php echo base_url('index.php/purchase/DaftarPO')?>">Daftar Pembelian Pembelian</a></li>
                      <li><a href="<?php echo base_url('index.php/purchase/DaftarBPB')?>">Daftar Penerimaan Pembelian</a></li>
                      <li><a href="<?php echo base_url('index.php/purchase/daftarRPB')?>">Daftar Return Penerimaan Barang</a></li>
                    </ul>
                  </li>
                  <!-- menu inventory -->
                  <li><a><i class="fa fa-edit"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('index.php/inventory/pb')?>">Permintaan Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/inventory/bstb')?>">Pengeluaran Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/inventory/returnbstb')?>">Return Pengeluaran Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/inventory/daftarPB')?>">Daftar Permintaan Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/inventory/daftarBSTB')?>">Daftar Pengeluaran Barang</a></li>
                      <li><a href="<?php echo base_url('index.php/inventory/daftarREBSTB')?>">Daftar Return Pengeluaran Barang</a></li>
                    </ul>
                  </li>
                  <!-- report menu -->
                  <li><a><i class="fa fa-edit"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('index.php/report/ppb')?>">Daftar Permintaan Pembelian</a></li>
                      <li><a href="<?php echo base_url('index.php/report/po_outstanding')?>">Purchase Order Outstanding Report</a></li>
                      <li><a href="<?php echo base_url('index.php/report/po_by_supplier')?>">Purchase Report By Supplier</a></li>
                      <li><a href="<?php echo base_url('index.php/report/summary_po')?>">Summary Of Purchase Report</a></li>
                      <li><a href="<?php echo base_url('index.php/report/stock')?>">Kartu Stok Persediaan</a></li>
                      <li><a href="<?php echo base_url('index.php/report/mutasi')?>">Mutasi Persediaan</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('index.php/login/logout')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>