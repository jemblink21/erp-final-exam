<div class="right_col" role="main">
<div class="clearfix"></div>

<div id="edit_ppb" class="row" style="display:none;">
    <div class="col-md-12 col-sm-12 col-xs-12"><!--awal div sub kotak -->
      <div class="x_panel"><!-- awal div x_panel -->
        <div class="x_title"><!-- awal div x_title -->
          <h2>Permintaan Pembelian Barang</h2>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noPPB">
                No. Permintaan Pembelian <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-6">
                <input type="text" placeholder="Otomatis" id="noPPB" name="noPPB" 
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
                    <?php foreach ($data5 as $gudang) { ?>
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
                Departemen Peminta <span class="required">*</span>
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
                Nama Peminta <span class="required">*</span>
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
                    <?php foreach ($data4 as $kategori) { ?>
                    <option value="<?php echo $kategori['id_kategori']; ?>">
                        <?php echo $kategori['nama_kategori']; ?>
                    </option>
                    <?php } ?>  
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
                  <input type="number" class="form-control" min="0" id="jumlah" name="jumlah" placeholder="Jumlah" required> 
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
              <table id="tableBarang" class="table table-striped table-bordered table-condensed" cellspacing="0" style="width:80%;">
                <thead>
                  <tr>
                    <th class="text-center" style="width:10%;">Action</th>
                    <th class="text-center" style="width:15%;">Kode Barang</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center"style="width:30%">Deskripsi</th>
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

<!-- awal row data permintaan barang-->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>Daftar Permintaan Barang</h2>
	    <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
	    <div class="clearfix"></div>
	  </div>
		<div class="x_content">
		
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No. PPB</th>
					<th>Lokasi Gudang</th>
					<th>Departemen</th>
					<th>Peminta</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
    </div>

	</div>
	</div>
</div>
<!-- akhir row data profile -->

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

    <!-- select2 -->
    <script src="<?php echo base_url('assets/vendors/select2/dist/js/select2.full.min.js')?>"></script>
   
    <!-- /Select2 -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js')?>"></script>
    <script>
            
        var save_method; //for save method string
        var table;

        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('purchase/ajax_list_ppb')?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

            });


            //set input/textarea/select event when change value, remove class error and remove text help block 
            $("input").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function(){
                $(this).parent().parent().removeClass('has-error');
                // $(this).next().empty();
            });

        });

        function delete_ppb(id)
        {
            var x = document.getElementById("edit_ppb");
            x.style.display = "none";
            resetForm();
            swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    closeOnConfirm: false
            }).then(function(isConfirm) {
                    if (isConfirm) {
                    
                    // ajax delete data to database
                    $.ajax({
                    url : "<?php echo site_url('purchase/ajax_delete_ppb')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                            {
                                //if success reload ajax table
                                //$('#modal_form').modal('hide');
                                
                                reload_table();
                                swal(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    );
                            },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert('Error adding / update data');
                                    }
                    });
                 }
            })
        }

        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }
        </script>

        <script>
        $(document).ready(function() {
            $(".select2_single").select2({
            placeholder: "Pilih",
            });
            $(".select2_barang").select2({
            placeholder: "Pilih kategori barang terlebih dahulu",
            });
            $(".select2_kategori").select2({
            placeholder: "Pilih",
            });
        });

        function cancel(){
            location.reload();
        }

        function clear(){
            // $('.select2_single').empty().trigger("change");
            $('.select2_single').append("<option></option>");
            $('.select2_single').val(null).trigger('change');
            // $('.select2_kategori').empty().trigger("change");
            $('.select2_kategori').append("<option></option>");
            $('.select2_kategori').val(null).trigger('change');
            $('.select2_barang').empty().trigger("change");
            $('.select2_barang').append("<option></option>");
            $('.select2_barang').val(null).trigger('change');
            $("#satuan").val("");
            $("#keterangan").val("");
            $("#deskripsi").val("");
            $('#jumlah').val(null);
            $(".select2_single").select2({
            placeholder: "Pilih",
            });
            $(".select2_barang").select2({
            placeholder: "Pilih kategori barang terlebih dahulu",
            });
            $(".select2_kategori").select2({
            placeholder: "Pilih",
            });
        }

        function getBarang()
        {
            $('.select2_barang').empty().trigger("change");
            $('.select2_barang').append("<option></option>");
            $('.select2_barang').val(null).trigger('change');
            $("#satuan").val("");
            var id = $('.select2_kategori').val();
            $.ajax({
                url : "<?php echo site_url('inventory/get_barang')?>/" + id,
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

        $('.select2_kategori').on('select2:select', function (e) {
            clearTable();
            getBarang();
        });

        $('.select2_barang').on('select2:select', function (e) {
            $('#satuan').val(null);
            var id = $('.select2_barang').val();
            $.ajax({
                url : "<?php echo site_url('inventory/get_satuan')?>/" + id,
                type: "GET",
                dataType: "JSON",
                data:{get_param: 'value'},
                success: function(data){
                    $("#satuan").val(data[0].nama_satuan);
                    
                }   
            });
        });
        </script>
        <!-- /Select2 -->
        <!-- tambah barang pada tabel -->
        <script>
        $(".add-row").click(function(){
            
            var kode = $(".select2_barang").val();
            var barang = $('.select2_barang').select2('data')[0].text;
            var deskripsi = $("#deskripsi").val();
            var jumlah = $("#jumlah").val();
            var satuan =  $("#satuan").val();
            if (kode !== "" && jumlah !== "")
            {
                var markup = "<tr><td class='text-center'><input type='checkbox' name='record'></td><td class='text-center'>" + kode + "</td><td>" + barang + "</td><td>"+ deskripsi +"</td><td class='text-center'>" + jumlah + "</td><td class='text-center'>"+ satuan + "</td></tr>";
                $("#tableBarang tbody").append(markup);
                $('.select2_barang').append("<option></option>");
                $('.select2_barang').val(null).trigger('change');
                $('#jumlah').val(null);
                $("#satuan").val("");
                $("#deskripsi").val("");
            }
            
        });

        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]:checked').each(function(){
                    $(this).parents("tr").remove();
            });

            
        });

        function clearTable(){
            var table = document.getElementById("tableBarang");
            //or use :  var table = document.all.tableid;
            for(var i = table.rows.length - 1; i > 0; i--)
            {
                table.deleteRow(i);
            }
        }

        function resetForm()
        {
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            
        }
        function edit_ppb(id)
        {
            resetForm();
            clearTable();
            
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('purchase/ajax_edit_ppb')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {                                              
                    $('[name="noPPB"]').val(data.ppb.no_ppb);
                    $('[name="gudang"]').val(data.ppb.id_gudang).trigger('change');
                    $('[name="departemen"]').val(data.ppb.id_departemen).trigger('change');
                    $('[name="peminta"]').val(data.ppb.id_pegawai).trigger('change');
                    $('[name="keterangan"]').val(data.ppb.keterangan).trigger('change');
                    $('[name="kategori"]').val(data.ppb.id_kategori).trigger('change');
                    getBarang();
                    
                    for (var i = 1, l = data.ppbDetail.length; i <= l; i++) {
                        var kode = data.ppbDetail[i-1].kode_barang;
                        var barang = data.ppbDetail[i-1].nama_barang;
                        var deskripsi = data.ppbDetail[i-1].keterangan;
                        var jumlah = data.ppbDetail[i-1].jumlah;
                        var satuan =  data.ppbDetail[i-1].nama_satuan;
                        var markup = "<tr><td class='text-center'><input type='checkbox' name='record'></td><td class='text-center'>" + kode + "</td><td>" + barang + "</td><td>"+ deskripsi +"</td><td class='text-center'>" + jumlah + "</td><td class='text-center'>"+ satuan + "</td></tr>";
                        $("#tableBarang tbody").append(markup);
                    }
                    $('html,body').scrollTop(0);
                    var x = document.getElementById("edit_ppb");
                    x.style.display = "block";
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function save()
        {
            $.ajax({
            url : "<?php echo site_url('purchase/ajax_update_ppb')?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if (data.inputerror)
                {
                    alert('Error adding / update data');
                    $('html, body').animate({ scrollTop: $('#edit_ppb').offset().top }, 'slow');
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                } else {
                    var no_ppb = $("#noPPB").val();;
                    var rowCount = $('#tableBarang >tbody >tr').length;
                    var table = $('table tbody');
                    table.find('tr').each(function (i, el){
                        var $tds = $(this).find('td'),
                        kodeBarang = $tds.eq(1).text(),
                        deskripsi = $tds.eq(3).text(),
                        jumlah = $tds.eq(4).text();
                        if (i>rowCount-1) return false;
                        $.ajax({
                            url : "<?php echo site_url('purchase/ajax_add_ppb_detail')?>",
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                no_ppb: no_ppb,
                                kodeBarang: kodeBarang,
                                jumlah : jumlah,
                                deskripsi : deskripsi,
                            }
                        });
                    });
                    var x = document.getElementById("edit_ppb");
                    x.style.display = "none";
                    clear(); // reset form on modals
                    clearTable();
                    reload_table();
                    swal(
                        'Good job!',
                        'Data has been save!',
                        'success'
                    );
                    
                    // location.reload();
                    
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