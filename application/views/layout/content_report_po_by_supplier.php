<div class="right_col" role="main">
  <div class="clearfix"></div>
  <!-- awal row content ppb-->
  <div id="content_stock" class="row">
    <div class="col-md-12 col-sm-12 col-xs-12"><!--awal div sub kotak -->
      <div class="x_panel"><!-- awal div x_panel -->
        <div class="x_title"><!-- awal div x_title -->
          <h2>Purchase Report By Supplier</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link">  <i class="fa fa-close"></i></a> </li>
          </ul>
          <div class="clearfix"></div>
        </div><!-- akhir div x_title -->
        <div class="x_content"><!-- awal div x_content -->
          <form action="<?php echo site_url('report/print_po_by_supplier');?>" method="POST" id="form" class="form-horizontal form-label-left" target="_blank" novalidate>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tAwal">Tanggal Awal <span class="required">*</span></label>
              <fieldset>
                <div class="control-group">
                  <div class="controls">
                    <div class="col-md-3 col-sm-3 col-xs-6 xdisplay_inputx has-feedback">
                      <input type="text" style="width:100%;" class="form-control has-feedback-left" id="tAwal" name="tAwal" placeholder="Tanggal Awal" aria-describedby="inputSuccess2Status2">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tAkhir">Tanggal Akhir <span class="required">*</span></label>
              <fieldset>
                <div class="control-group">
                  <div class="controls">
                    <div class="col-md-3 col-sm-3 col-xs-6 xdisplay_inputx has-feedback">
                      <input type="text" style="width:100%;" class="form-control has-feedback-left" id="tAkhir" name="tAkhir" placeholder="Tanggal Akhir" aria-describedby="inputSuccess2Status2">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier">Supplier <span class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <select class="form-control select2_supplier" id="supplier" name="supplier" style="width:100%;">
                        <option value="">% - Semua Supplier</option>
                        <?php foreach ($data2 as $supplier) { ?>
                            <option value="<?php echo $supplier['id_supplier']; ?>">
                                <?php echo $supplier['nama_supplier']; ?>
                            </option>
                        <?php } ?>    
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <!-- <button type="button" id="btnSave" onclick="lihat()" class="btn btn-primary">Lihat</button> -->
                <input type="submit" class="btn btn-primary" value="Lihat" />
              </div>
            </div>
          </form>
        </div><!-- akhir div x_content -->
      </div><!-- akhir div x_panel -->
    </div><!--akhir div sub kotak -->
  </div><!--akhir row content ppb-->
</div>

<!-- footer content -->
    <footer>
        <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    </div>
</div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>

    <!-- bootstrap-datetimepicker -->    
    
    <script src="<?php echo base_url('assets/vendors/moment/moment.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('assets/vendors/datatables.net/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')?>"></script>
 
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js')?>"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
    
    <script src="<?php echo base_url('assets/vendors/select2/dist/js/select2.full.min.js')?>"></script>
    <script>
      $(document).ready(function() {
        $('#tAwal').daterangepicker({
          singleDatePicker: true,
          format: 'yy-mm-dd'
        });
        $('#tAkhir').daterangepicker({
          singleDatePicker: true,
          format: 'yy-mm-dd'
        });

        $(".select2_supplier").select2({
          placeholder: "% - Semua Supplier",
          allowClear: true,
        });
      });

    </script>
  </body>
</html>