<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-lg-6">

					<?php if($isThereRelathionship == true){?>
						<div class='alert bg-danger' role='alert'>
							<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>
							Lokasi tidak bisa di delete, karena masih terdapat record dengan lokasi <b><u><?php echo $lokasi;?></u></b>.<br />
						</div>
						<a href="<?php echo site_url('admin/management/lokasi');?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-arrow-left"></span> Kembali &nbsp &nbsp &nbsp 
						</button>
					</a>
					<?php }else{?>
					<h4>Anda Yakin Menghapus Lokasi <u><?php echo $lokasi;?></u> ?</h4>
					<a href="<?php echo site_url('admin/process_delete/sublokasi/'.$location_id);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('admin/management/lokasi');?>">
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
