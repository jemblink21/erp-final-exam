<div class="right_col" role="main">
<div class="clearfix"></div>

<div id="content_bstb" class="row">
    <div class="col-md-12 col-sm-12 col-xs-12"><!--awal div sub kotak -->
      <div class="x_panel"><!-- awal div x_panel -->
        <div class="x_title"><!-- awal div x_title -->
          <h2>Pengeluaran Barang</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li>
              <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
              </a>
            </li>
            <li>
              <a class="close-link">
                <i class="fa fa-close"></i>
              </a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div><!-- akhir div x_title -->
        <div class="x_content"><!-- awal div x_content -->
          <form action="#" id="form" class="form-horizontal form-label-left" novalidate>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noBSTB">
                No. BSTB <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-6">
                <input type="text" placeholder="Otomatis" id="noBSTB" name="noBSTB" 
                required="required" class="form-control col-md-7 col-xs-12" value="" readonly>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gudang">
                Lokasi Gudang <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <select class="form-control select2_single" id="gudang" name="gudang" style="width:100%;">
                    <option></option>
                    <?php foreach ($data4 as $gudang) { ?>
                        <option value="<?php echo $gudang['id_gudang']; ?>">
                            <?php echo $gudang['id_gudang']; ?> - 
                            <?php echo $gudang['nama_gudang']; ?>
                        </option>
                    <?php } ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departemen">
                Departemen Pemakai <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <select class="form-control select2_single" id="departemen" name="departemen" style="width:100%;">
                    <option></option>
                    <?php foreach ($data as $departemen) {?>
                    <option value="<?php echo $departemen['id_departemen'];?>">
                      <?php echo $departemen['nama_departemen'];?>
                    </option>
                    <?php } ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="peminta">
                Nama Penerima <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <select class="form-control select2_single" id="peminta" name="peminta" style="width:100%;">
                    <option></option>
                    <?php foreach ($data2 as $pegawai) { ?>
                    <option value="<?php echo $pegawai['id_pegawai']; ?>">
                        <?php echo $pegawai['nama_pegawai']; ?>
                    </option>
                    <?php } ?> 
                </select>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">
                Keterangan
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
              <textarea class="form-control" rows="2" placeholder="Keterangan" 
              id="keterangan" name="keterangan"></textarea>
              </div>
            </div>

            <div class="ln_solid"></div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">
                Kategori Barang <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <select class="form-control select2_kategori" id="kategori" name="kategori" style="width:100%;">
                    <option></option>
                    <?php foreach ($data3 as $kategori) { ?>
                    <option value="<?php echo $kategori['id_kategori']; ?>">
                        <?php echo $kategori['nama_kategori']; ?>
                    </option>
                    <?php } ?>  
                </select>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noSPB">
                No. SPB <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <select class="form-control select2_spb" id="noSPB" name="noSPB" style="width:100%;">
                    <option></option>
                </select>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">
                Barang 
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                  <select class="form-control select2_barang" id="barang" name="barang" style="width:100%;">
                    <option></option>
                  </select>
              </div>
              <a href="javascript:void(0);" onclick="getBarang()">
                  <span class="glyphicon glyphicon-refresh" style="padding:9px;"></span>
              </a>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">
                Jumlah 
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" max="" min="0" data-min_max data-min="0" data-max="" data-toggle="just_number">
              </div>  
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">
                Satuan 
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                  <input type="text" class="form-control" id="satuan" name="satuan" readonly> 
              </div>  
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">
                Deskripsi 
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                  <textarea class="form-control" rows="2" placeholder="Deskripsi" id="deskripsi" name="deskripsi"></textarea>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <button type="button" class="btn btn-success add-row">Tambah</button>
                  <button type="button" class="btn" onClick="clearTable()">Bersihkan</button>
                  <button type="button" class="btn delete-row btn-danger">Hapus</button>
              </div>
            </div>
          
            <div class="ln_solid"></div>

            <div class="item form-group">
              <table id="tableBarang" class="table table-striped table-bordered table-condensed" cellspacing="0" style="width:100%;">
                <thead>
                  <tr>
                    <th class="text-center" style="width:10%;">Action</th>
                    <th class="text-center" style="width:15%;">No. SPB</th>
                    <th class="text-center" style="width:15%;">Kode Barang</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center"style="width:20%">Deskripsi</th>
                    <th class="text-center"style="width:10%;">Jumlah</th>
                    <th class="text-center" style="width:10%;">Satuan</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Simpan</button>
                  <button type="button" class="btn btn-warning" onclick="cancel()">Batal</button>
              </div>
            </div>

          </form><!-- akhir #form -->
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

    

    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js')?>"></script>
    
    <!-- select2 -->
    <script src="<?php echo base_url('assets/vendors/select2/dist/js/select2.full.min.js')?>"></script>
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Pilih",
        });
        $(".select2_barang").select2({
          placeholder: "Pilih No. SPB",
        });
        $(".select2_kategori").select2({
          placeholder: "Pilih",
        });
        $(".select2_spb").select2({
          placeholder: "Pilih kategori barang terlebih dahulu",
        });

        $('#jumlah').keydown( function(e){
          var min = parseInt($(this).attr('min'));
          var max = parseInt($(this).attr('max'));
          var val = parseInt($(this).val());
          if(val > max)
          {
              $(this).val(max);
              return false;
          }
          else if(val < min)
          {
              $(this).val(min);
              return false;
          }
        });

        $('#input').keyup( function(e){
          var min = parseInt($(this).attr('min'));
          var max = parseInt($(this).attr('max'));
          var val = parseInt($(this).val());
          if(val > max)
          {
              $(this).val(max);
              return false;
          }
          else if(val < min)
          {
              $(this).val(min);
              return false;
          }
        });

        $(document).on('keydown', '[data-toggle=just_number]', function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
              // Allow: Ctrl+A
              (e.keyCode == 65 && e.ctrlKey === true) ||
              // Allow: Ctrl+C
              (e.keyCode == 67 && e.ctrlKey === true) ||
              // Allow: Ctrl+X
              (e.keyCode == 88 && e.ctrlKey === true) ||
              // Allow: home, end, left, right
              (e.keyCode >= 35 && e.keyCode <= 39)) {
                  // let it happen, don't do anything
                  return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
        });

      });

    function cancel(){
        location.reload();
    }

    $('.select2_kategori').on('select2:select', function (e) {
        clearBarang();
        getSPB();
    });

    $('.select2_spb').on('select2:select', function (e) {
        getBarang();
    });

    $('.select2_barang').on('select2:select', function (e) {
        getDetailBarang();
    });

    function clearBarang(){
      $('.select2_barang').empty().trigger("change");
      $('.select2_barang').append("<option></option>");
      $('.select2_barang').val(null).trigger('change');
      $("#satuan").val("");
      $('#deskripsi').val("");
      $('#jumlah').val("");
    }

    function clear(){
      $('.select2_single').append("<option></option>");
      $('.select2_single').val(null).trigger('change');
      $('#keterangan').val("");
      $('.select2_kategori').append("<option></option>");
      $('.select2_kategori').val(null).trigger('change');
      $('.select2_spb').empty().trigger("change");
      $('.select2_spb').append("<option></option>");
      $('.select2_spb').val(null).trigger('change');
      clearBarang();

      $(".select2_single").select2({
        placeholder: "Pilih",
      });
      $(".select2_barang").select2({
        placeholder: "Pilih No. SPB",
      });
      $(".select2_kategori").select2({
        placeholder: "Pilih",
      });
      $(".select2_spb").select2({
        placeholder: "Pilih kategori barang terlebih dahulu",
      });
    }

    function getSPB(){
      $('.select2_spb').empty().trigger('change');
      $('.select2_spb').append('<option></option>');
      $('.select2_spb').val(null).trigger('change');
      clearBarang();
      var id = $('.select2_kategori').val();
      $.ajax({
          url : "<?php echo site_url('inventory/get_spb')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
              $('.select2_spb').select2({
                  data:data,
                  placeholder: "Pilih No. SPB",
              });
          }   
      });
    }

    function getBarang()
    {
      clearBarang();
      var id = $('.select2_spb').val();
      $.ajax({
          url : "<?php echo site_url('inventory/get_barang_spb')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
              $('.select2_barang').select2({
                  data:data,
                  placeholder: "Pilih Barang",
              });
          }   
      });
    }

    function getDetailBarang(){
      var id = $('.select2_barang').select2('data')[0].no_PB_detail;
      $.ajax({
            url : "<?php echo site_url('inventory/get_detail_barang')?>/"+ id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
              $('#jumlah').val(data.jumlah);
              $('#jumlah').attr({
                  "max" : data.jumlah,
                  "data-max" : data.jumlah,
              });
              $('#satuan').val(data.nama_satuan);
            }   
      });
    }

    $(".add-row").click(function(){
      var no_spb = $('.select2_spb').select2('data')[0].text;
      var kode = $('.select2_barang').select2('data')[0].id;
      var barang = $('.select2_barang').select2('data')[0].text;
      var no_spb_detail = $('.select2_barang').select2('data')[0].no_PB_detail;
      var deskripsi = $("#deskripsi").val();
      var jumlah = $("#jumlah").val();
      var satuan =  $("#satuan").val();
      if (barang !== "" && jumlah !== "")
      {
          var markup = "<tr><td class='id_spb'>"+ no_spb_detail +"</td><td class='text-center'><input type='checkbox' name='record'></td><td class='text-center'>" + no_spb + "</td><td class='text-center'>" + kode + "</td><td>" + barang + "</td><td>"+ deskripsi +"</td><td class='text-center'>" + jumlah + "</td><td class='text-center'>"+ satuan + "</td></tr>";
          $("table tbody").append(markup);
          $('.id_spb').hide();
          $('.select2_barang').append("<option></option>");
          $('.select2_barang').val(null).trigger('change');
          $('#jumlah').val(null);
          $("#satuan").val("");
          $("#deskripsi").val("");
      }
    });

    function clearTable()
    {
      var table = document.getElementById("tableBarang");
      //or use :  var table = document.all.tableid;
      for(var i = table.rows.length - 1; i > 0; i--)
      {
          table.deleteRow(i);
      }
    }

    $(".delete-row").click(function(){
        $("table tbody").find('input[name="record"]:checked').each(function(){
            $(this).parents("tr").remove();
        });

    });

    function save(){
      $.ajax({
            url : "<?php echo site_url('inventory/ajax_add_bstb')?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if (data.inputerror)
                {
                    alert('Error adding / update data');
                    $('html, body').animate({ scrollTop: $('#content_bstb').offset().top }, 'slow');
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                } else {
                    var no_bstb = data.no_bstb;
                    var id_gudang = data.id_gudang;
                    var rowCount = $('#tableBarang >tbody >tr').length;
                    var table = $('table tbody');
                    table.find('tr').each(function (i, el){
                        var $tds = $(this).find('td'),
                        no_PB_detail = $tds.eq(0).text(),
                        no_spb = $tds.eq(2).text(),
                        kode_barang = $tds.eq(3).text(),
                        deskripsi = $tds.eq(5).text(),
                        jumlah = $tds.eq(6).text();
                        if (i>rowCount-1) return false;
                        $.ajax({
                            url : "<?php echo site_url('inventory/ajax_add_bstb_detail')?>",
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                no_PB_detail: no_PB_detail,
                                id_gudang: id_gudang,
                                no_bstb: no_bstb,
                                no_spb: no_spb,
                                kode_barang : kode_barang,
                                jumlah : jumlah,
                                deskripsi : deskripsi,
                            }
                        });
                    });
                    clear();
                     // reset form on modals
                    clearTable();
                    $('html, body').animate({ scrollTop: $('#content_bstb').offset().top }, 'slow');
                    swal(
                        'Good job!',
                        'Data has been save!',
                        'success'
                    );
                    for (var i = 0; i < $('.has-error').length; i++) 
                    {
                        $('.has-error').removeClass('has-error');
                    }
                    window.open("<?php echo site_url('inventory/print_bstb/')?>"+no_bstb, '_blank', "width=500, height=500");
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
      });
    }

    </script>
  </body>
</html>