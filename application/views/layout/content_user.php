<div class="right_col" role="main">
<div class="clearfix"></div>
<!-- awal row data profile-->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>Data Profil</h2>
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
	    <form method="POST" class="form-horizontal form-label-left" novalidate>

	      <div class="item form-group">
	        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
	        </label>
	        <div class="col-md-3 col-sm-3 col-xs-6">
	          <input type="text" id="username" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $this->session->userdata('username');?>" disabled>
	        </div>
	      </div>
	      <div class="item form-group">
	        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
	        </label>
	        <div class="col-md-3 col-sm-3 col-xs-6">
	          <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $this->session->userdata('nama');?>">
	        </div>
	      </div>

				<div class="form-group">
	      	<div class ="col-md-3 col-sm-3 col-xs-12"></div>
	      	<div class="col-md-3 col-sm-3 col-xs-6">
	      		<?php
			        if (validation_errors() || $this->session->flashdata('pesan')) {
			    	?>

			  		<div class="alert alert-success alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
								<?php echo validation_errors(); ?>
									<?php echo $this->session->flashdata('pesan'); ?>
		      	</div>

	         	<?php } else if (validation_errors() || $this->session->flashdata('error')) {?>

						<div class="alert alert-warning alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
			        <?php echo validation_errors(); ?>
		            <?php echo $this->session->flashdata('error'); ?>
		      	</div>
						
						<?php } ?>
	      	</div>
	      </div>
				
	      <div class="ln_solid"></div>
	      <div class="form-group">
	        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	          <button type="submit" class="btn btn-success">Perbarui</button>
	        </div>
	      </div>

	    </form>
	  </div>

	</div>
	</div>
</div>
<!-- akhir row data profile -->

<!-- awal row ganti password -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>Ganti Password</h2>
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
	    <form method="POST" class="form-horizontal form-label-left" novalidate>
	      <div class="item form-group">
	        <label for="password_lama" class="control-label col-md-3 col-sm-3 col-xs-12">Password Lama</label>
	        <div class="col-md-3 col-sm-3 col-xs-6">
	          <input id="password_lama" class="form-control col-md-7 col-xs-12" type="password" name="password_lama" required="required">
	        </div>
	      </div>
	      <div class="item form-group">
	        <label for="password_baru" class="control-label col-md-3 col-sm-3 col-xs-12">Password Baru</label>
	        <div class="col-md-3 col-sm-3 col-xs-6">
	          <input id="password_baru" class="form-control col-md-7 col-xs-12" type="password" name="password_baru" required="required">
	        </div>
	      </div>
	      <div class="item form-group">
	        <label for="password_baru2" class="control-label col-md-3 col-sm-3 col-xs-12">Password Baru</label>
	        <div class="col-md-3 col-sm-3 col-xs-6">
	          <input id="password_baru2" class="form-control col-md-7 col-xs-12" type="password" name="password_baru2" data-validate-linked="password_baru" required="required">
	        </div>
	      </div>

	      <div class="form-group">
	      	<div class ="col-md-3 col-sm-3 col-xs-12"></div>
	      	<div class="col-md-3 col-sm-3 col-xs-6">
	      		<?php
		        	if (validation_errors() || $this->session->flashdata('pesan_pass_error')) {
			    ?>
			  	<div class="alert alert-danger alert-dismissible fade in" role="alert">
			    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    		<span aria-hidden="true">×</span>
			        </button>
			        <?php echo validation_errors(); ?>
		            <?php echo $this->session->flashdata('pesan_pass_error'); ?>
		      	</div>
	        	<?php } ?>

	        	<?php
			        if (validation_errors() || $this->session->flashdata('pesan_pass')) {
			    ?>
			  	<div class="alert alert-success alert-dismissible fade in" role="alert">
			    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    		<span aria-hidden="true">×</span>
			        </button>
			        <?php echo validation_errors(); ?>
		            <?php echo $this->session->flashdata('pesan_pass'); ?>
		      	</div>
		        <?php } ?>
	      	</div>
	      </div>
	      <div class="ln_solid"></div>
	      <div class="form-group">
	        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	          <button type="submit" class="btn btn-success">Perbarui</button>
	        </div>
	      </div>
	  </form>
	  </div>
	</div>
	</div>
</div>
<!-- akhir row ganti password -->
</div>