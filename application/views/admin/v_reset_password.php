<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-lg-6">
					<h4>Anda Yakin Mereset Password Akun <u><?php echo $akun;?></u> ?</h4>
					<a href="<?php echo site_url($action);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('admin/management/akun');?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Tidak
						</button>
					</a>
				</div>
				<div class="col-lg-6">
				</div>
			</div>			
		</div>
	</div>
