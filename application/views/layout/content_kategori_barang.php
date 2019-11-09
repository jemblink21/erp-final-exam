<div class="right_col" role="main">
<div class="clearfix"></div>
<!-- awal row data profile-->
<div id="content_kategori_barang" class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>Master Kategori Barang</h2>
	    <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
	    <div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	  	
	    <br />
	    <form action="#" id="form" class="form-horizontal form-label-left" novalidate>
		
		<div class="item form-group">
	        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="idKategori">ID Kategori <span class="required">*</span>
	        </label>
	        <div class="col-md-3 col-sm-3 col-xs-6">
	          <input type="text" id="idKategori" name="idKategori" placeholder="Otomatis" class="form-control col-md-7 col-xs-12" value="" readonly>
	        </div>
	      </div>

	      <div class="item form-group">
	        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namaKategori">Nama Kategori <span class="required">*</span>
	        </label>
	        <div class="col-md-3 col-sm-3 col-xs-6">
	          <input type="text" maxlength="25" id="namaKategori" name="namaKategori" required="required" class="form-control col-md-7 col-xs-12">
						<span class="help-block"></span>
	        </div>
	      </div>

	      <div class="ln_solid"></div>
	      <div class="form-group">
	        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="button" id="btnSave" onclick="save()" class="btn btn-success">Simpan</button>
	          <button type="button" class="btn btn-warning" onclick="cancel()">Batal</button>
	        </div>
	      </div>

	    </form>
	  </div>

	</div>
	</div>
</div>
<!-- akhir row data profile -->


<!-- awal row data barang-->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>Data Kategori Barang</h2>
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
					<th style="width:100px">ID Kategori</th>
					<th>Nama Kategori</th>
					<th style="width:150px;">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
    </div>

	</div>
	</div>
</div>
<!-- akhir row data barang -->

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
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/vendors/fastclick/lib/fastclick.js')?>"></script>
 

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
					"url": "<?php echo site_url('master/ajax_list_kategori')?>",
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
			$(this).next().empty();
	});

});

function reload_table()
	{
			table.ajax.reload(null,false); //reload datatable ajax
			$('.form-group').removeClass('has-error'); // clear error class
    	$('.help-block').empty(); // clear error string
	}

function cancel()
{
	$('#form')[0].reset(); // reset form on modals
	$('[name="idKategori"]').attr("placeholder", "Otomatis");
	$('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string
}

function delete_kategori(id_kategori)
	{
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
			url : "<?php echo site_url('master/ajax_delete_kategori')?>/"+id_kategori,
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
	function edit_kategori(id)
			{
			save_method = 'update';
			$('#form')[0].reset(); // reset form on modals
			$('.form-group').removeClass('has-error'); // clear error class
    	$('.help-block').empty(); // clear error string
			//Ajax Load data from ajax
			$.ajax({
					url : "<?php echo site_url('master/ajax_edit_kategori/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
					
					$('[name="idKategori"]').val(data.id_kategori);
					$('[name="idKategori"]').removeAttr('placeholder');
					$('[name="namaKategori"]').val(data.nama_kategori);
					$('html,body').scrollTop(0);
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
							alert('Error get data from ajax');
					}
					});
			}

			function save()
					{
					var url;
					if(save_method == 'update') 
					{
							url = "<?php echo site_url('master/ajax_update_kategori')?>";
					}
					else
					{
							url = "<?php echo site_url('master/ajax_add_kategori')?>";
					}

					// ajax adding data to database
					$.ajax({
							url : url,
							type: "POST",
							data: $('#form').serialize(),
							dataType: "JSON",
							success: function(data)
							{
								if(data.status != '0')
									{
										$('#form')[0].reset(); // reset form on modals
										reload_table();
										save_method = '';
										swal(
												'Good job!',
												'Data has been save!',
												'success'
												)
									} else {
										alert('Error adding / update data');
										for (var i = 0; i < data.inputerror.length; i++) 
											{
													$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
													$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
											}
									}		
							},
									error: function (jqXHR, textStatus, errorThrown)
									{
									alert('Error adding / update data');
									}
							});
					}

	</script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
		
  </body>
</html>
