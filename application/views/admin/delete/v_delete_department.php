<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-lg-6">

					<?php if($isThereRelathionship == true){?>
						<div class='alert bg-danger' role='alert'>
							<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>
							Department tidak bisa di delete, karena masih terdapat record dengan Department <b><u><?php echo $department;?></u></b>.<br />
						</div>
						<a href="<?php echo site_url('admin/management/department');?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-arrow-left"></span> Kembali &nbsp &nbsp &nbsp 
						</button>
					</a>
					<?php }else{?>
					<h4>Anda Yakin Menghapus Lokasi <u><?php echo $department;?></u> ?</h4>
					<a href="<?php echo site_url('admin/process_delete/department/'.$department_id);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('admin/management/department');?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Tidak
						</button>
					</a>
					<?php } ?>
				</div>
				<div class="col-lg-6">
				</div>
			</div>			
		</div>
	</div>
