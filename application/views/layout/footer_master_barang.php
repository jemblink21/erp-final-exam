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
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/vendors/nprogress/nprogress.js')?>"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url('assets/vendors/Chart.js/dist/Chart.min.js')?>"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('assets/vendors/gauge.js/dist/gauge.min.js')?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/vendors/iCheck/icheck.min.js')?>"></script>
    
    <!-- DateJS -->
    <script src="<?php echo base_url('assets/vendors/DateJS/build/date.js')?>"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets/vendors/moment/min/moment.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/validator/validator.js')?>"></script>


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
    <script src="<?php echo base_url('assets/vendors/jszip/dist/jszip.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/pdfmake/build/pdfmake.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/pdfmake/build/vfs_fonts.js')?>"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js')?>"></script>
	<script>
        $(function() {
            if($('#content_kategori_barang').hasClass('row')){
                $('#formInduk').hide(); 
                $('#jenisKategori').change(function(){
                    if($('#jenisKategori').val() == '1') {
                        $('#formInduk').show(); 
                    } else {
                        $('#formInduk').hide(); 
                    } 
                });
            }
        });
    </script>
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
                    "url": "<?php echo site_url('master/ajax_list_barang')?>",
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
                $('[name="kodeBarang"]').removeAttr('readonly');
            }

        function cancel()
        {
            $('[name="kodeBarang"]').removeAttr('readonly');
            $('#form')[0].reset(); // reset form on modals
        }

        function delete_barang(kode_barang)
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
                url : "<?php echo site_url('master/ajax_delete')?>/"+kode_barang,
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
            function edit_barang(id)
                {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals

                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('master/ajax_edit_barang/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                    
                    $('[name="kodeBarang"]').val(data.kode_barang);
                    $('[name="kodeBarang"]').attr('readonly', true);
                    $('[name="namaBarang"]').val(data.nama_barang);
                    $('[name="kategoriBarang"]').val(data.id_kategori);
                    $('[name="satuan"]').val(data.id_satuan);
                    $('[name="deskripsi"]').val(data.deskripsi);
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
                        url = "<?php echo site_url('master/ajax_update_barang')?>";
                    }
                    else
                    {
                        url = "<?php echo site_url('master/ajax_add_barang')?>";
                    }

                    // ajax adding data to database
                    $.ajax({
                        url : url,
                        type: "POST",
                        data: $('#form').serialize(),
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            $('#form')[0].reset(); // reset form on modals
                            reload_table();
                            swal(
                                'Good job!',
                                'Data has been save!',
                                'success'
                                )
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