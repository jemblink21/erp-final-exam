<div class="right_col" role="main">
  <div class="clearfix"></div>
  <!-- awal row content ppb-->
  <div id="content_po" class="row">
    <div class="col-md-12 col-sm-12 col-xs-12"><!--awal div sub kotak -->
      <div class="x_panel"><!-- awal div x_panel -->
        <div class="x_title"><!-- awal div x_title -->
          <h2>Pembelian Barang / <i>Purchase Order</i> (PO)</h2>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noPO">
                No. PO <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-6">
                <input type="text" placeholder="Otomatis" id="noPO" name="noPO" 
                required="required" class="form-control col-md-7 col-xs-12" value="" readonly>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier">
                Supplier <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <select class="form-control select2_single" id="supplier" name="supplier" style="width:100%;">
                    <option></option>
                    <?php foreach ($data as $supplier) { ?>
                    <option value="<?php echo $supplier['id_supplier']; ?>">
                        <?php echo $supplier['nama_supplier']; ?>
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
                    <?php foreach ($data2 as $kategori) { ?>
                    <option value="<?php echo $kategori['id_kategori']; ?>">
                        <?php echo $kategori['nama_kategori']; ?>
                    </option>
                    <?php } ?>  
                </select>
                <span class="help-block"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noPPB">
                No. Permintaan Pembelian <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <select class="form-control select2_ppb" id="noPPB" name="noPPB" style="width:100%;">
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
                  <!-- <input type="number" class="form-control" min="0" id="jumlah" name="jumlah" placeholder="Jumlah" required>  -->
                  <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" max="" min="0" data-min_max data-min="0" data-max="" data-toggle="just_number">
              </div>  
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan">
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">
                Harga Satuan Rp.
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                  <input type="number" class="form-control" min="0" id="harga" name="harga" placeholder="Rp" required> 
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
              <table id="table" class="table table-striped table-bordered table-condensed" cellspacing="0" style="width:100%;">
                <thead>
                  <tr>
                    <th class="text-center" style="width:5%;">Action</th>
                    <th class="text-center" style="width:15%">No. PPB</th>
                    <th class="text-center" style="width:10%">Kode</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center"style="width:15%">Deskripsi</th>
                    <th class="text-center"style="width:8%;">Jumlah</th>
                    <th class="text-center" style="width:8%;">Satuan</th>
                    <th class="text-center" style="width:10%;">Harga Satuan</th>
                    <th class="text-center" style="width:10%;">Total Harga</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
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
 
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js')?>"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
    
    <script src="<?php echo base_url('assets/vendors/select2/dist/js/select2.full.min.js')?>"></script>

    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Pilih",
        });
        $(".select2_ppb").select2({
          placeholder: "Pilih Kategori Barang terlebih dahulu",
        });
        $(".select2_barang").select2({
          placeholder: "Pilih No PPB terlebih dahulu",
        });
        $(".select2_kategori").select2({
          placeholder: "Pilih",
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

      $('.select2_kategori').on('select2:select', function (e) {
          $("#satuan").val("");
          $('#deskripsi').val("");
          $('#harga').val("");
          $('#jumlah').val("");
          clearTable();
          getPPB();
      });

      $('.select2_ppb').on('select2:select', function (e) {
          getBarang();
      });
      $('.select2_barang').on('select2:select', function (e) {
        $('#jumlah').attr({
            "data-min" : "0",
            "data-max" : "0",
        });
          getDetailBarang();
      });

      function getPPB()
      {
        $('.select2_ppb').empty().trigger('change');
        $('.select2_ppb').append('<option></option');
        $('.select2_ppb').val(null).trigger('change');
        $('.select2_barang').empty().trigger("change");
        $('.select2_barang').append("<option></option>");
        $('.select2_barang').val(null).trigger('change');
        $("#satuan").val("");
        $('#deskripsi').val("");
        $('#harga').val("");
        $('#jumlah').val("");
        var id = $('.select2_kategori').val();
        $.ajax({
            url : "<?php echo site_url('purchase/get_ppb')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('.select2_ppb').select2({
                    data:data,
                    placeholder: "Pilih No Permintaan Barang",
                });
            }   
        });
      }

      function getBarang()
      {
        $("#satuan").val("");
        $('#deskripsi').val("");
        $('#harga').val("");
        $('#jumlah').val("");
        $('.select2_barang').empty().trigger("change");
        $('.select2_barang').append("<option></option>");
        $('.select2_barang').val(null).trigger('change');
        var id = $('.select2_ppb').val();
        $.ajax({
            url : "<?php echo site_url('purchase/get_barang')?>/" + id,
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

      function getDetailBarang()
      {
          var id = $('.select2_barang').select2('data')[0].no_ppb_detail;
          
          $.ajax({
            url : "<?php echo site_url('purchase/get_detail_barang')?>/"+ id,
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

      function digits(str){ 
          str += '';
          return str.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
      }

      $(".add-row").click(function(){
          
          var no_ppb = $('.select2_ppb').select2('data')[0].text;
          var kode = $('.select2_barang').select2('data')[0].id;
          var barang = $('.select2_barang').select2('data')[0].text;
          var no_ppb_detail = $('.select2_barang').select2('data')[0].no_ppb_detail;
          var deskripsi = $("#deskripsi").val();
          var jumlah = $("#jumlah").val();
          var satuan =  $("#satuan").val();
          var harga = $('#harga').val();
          var total = jumlah*harga;
          harga = digits(harga);
          total = digits(total);
          if (barang !== "" && jumlah !== "" && harga !== "")
          {
              var markup = "<tr><td class='id_ppb'>"+ no_ppb_detail +"</td><td class='text-center'><input type='checkbox' name='record'></td><td class='text-center'>" + no_ppb + "</td><td class='text-center'>" + kode + "</td><td>" + barang + "</td><td>"+ deskripsi +"</td><td class='text-center'>" + jumlah + "</td><td class='text-center'>"+ satuan + "</td><td class='text-center'>" + harga + "</td><td class='text-center subTotal'>" + total + "</td></tr>";
              $("table tbody").append(markup);
              $('.id_ppb').hide();
              $('.select2_barang').append("<option></option>");
              $('.select2_barang').val(null).trigger('change');
              $('#jumlah').val(null);
              $("#satuan").val("");
              $("#deskripsi").val("");
              $('#harga').val(null);
          }
          
          calculateSum();
        });

        function calculateSum()
        {
          var sum = 0;
          // iterate through each td based on class and add the values
          $(".subTotal").each(function() {
              
              var value = $(this).text();
              var valueNew = value.split('.').join("");
              // add only if the value is number
              if(!isNaN(valueNew) && valueNew.length != 0) {
                  sum += parseFloat(valueNew);
              }
          });
          $("table tfoot").empty();
          var footer = "<tr><th colspan='8' class='text-right'>Total</th><td class='text-center' id='grandTotal'>" + digits(sum) + "</td></tr>"
          $("table tfoot").append(footer);
        }

        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]:checked').each(function(){
                    $(this).parents("tr").remove();
                    calculateSum();
            });

        });

      function clearTable()
      {
        var table = document.getElementById("table");
        //or use :  var table = document.all.tableid;
        for(var i = table.rows.length - 1; i > 0; i--)
        {
            table.deleteRow(i);
        }
      }

      function save()
      {
        var total_harga = $('#grandTotal').html();;
        total_harga = total_harga.split('.').join("");
        var data = $('#form').serializeArray();
        data.push({name: 'total_harga', value: total_harga});
        $.ajax({
            url : "<?php echo site_url('purchase/ajax_add_po')?>",
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(data)
            {
                if (data.inputerror)
                {
                    alert('Error adding / update data');
                    $('html, body').animate({ scrollTop: $('#content_po').offset().top }, 'slow');
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                } else {
                    var no_po = data.no_po;
                    var rowCount = $('#table >tbody >tr').length;
                    var table = $('table tbody');
                    table.find('tr').each(function (i, el){
                        var $tds = $(this).find('td'),
                        no_ppb_detail = $tds.eq(0).text(),
                        no_ppb = $tds.eq(2).text(),
                        kode_barang = $tds.eq(3).text(),
                        deskripsi = $tds.eq(5).text(),
                        jumlah = $tds.eq(6).text(),
                        harga = $tds.eq(8).text();
                        harga = harga.split('.').join("");
                        if (i>rowCount-1) return false;
                        $.ajax({
                            url : "<?php echo site_url('purchase/ajax_add_po_detail')?>",
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                no_ppb_detail: no_ppb_detail,
                                no_po: no_po,
                                no_ppb: no_ppb,
                                kode_barang : kode_barang,
                                jumlah : jumlah,
                                harga : harga,
                                deskripsi : deskripsi,
                            }
                        });
                    });
                    
                    clear(); // reset form on modals
                    clearTable();
                    $('html, body').animate({ scrollTop: $('#content_po').offset().top }, 'slow');
                    swal(
                        'Good job!',
                        'Data has been save!',
                        'success'
                    );
                    for (var i = 0; i < $('.has-error').length; i++) 
                    {
                        $('.has-error').removeClass('has-error');
                    }
                    // location.reload();
                    window.open("<?php echo site_url('purchase/print_po/')?>"+no_po, '_blank', "width=500, height=500");
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
          });
      }

      function clear(){
          // $('.select2_single').empty().trigger("change");
          $('.select2_single').append("<option></option>");
          $('.select2_single').val(null).trigger('change');
          $('.select2_ppb').append("<option></option>");
          $('.select2_ppb').val(null).trigger('change');
          $('.select2_kategori').append("<option></option>");
          $('.select2_kategori').val(null).trigger('change');
          $('.select2_barang').empty().trigger("change");
          $('.select2_barang').append("<option></option>");
          $('.select2_barang').val(null).trigger('change');
          $("#satuan").val("");
          $("#keterangan").val("");
          $("#deskripsi").val("");
          $('#jumlah').val(null);
          $('#harga').val(null);
          $(".select2_single").select2({
            placeholder: "Pilih",
          });
          $(".select2_ppb").select2({
            placeholder: "Pilih kategori barang terlebih dahulu",
          });
          $(".select2_barang").select2({
            placeholder: "Pilih kategori barang terlebih dahulu",
          });
          $(".select2_kategori").select2({
            placeholder: "Pilih",
          });
      }
    </script>
  </body>
</html>