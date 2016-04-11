<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<!-- <div class="panel-heading"></div> -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="<?php echo site_url('laptop/add');?>" method="POST"> 
				  <div class="form-group">
				    <label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="no_po" class="col-sm-2 control-label">No PO</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="no_po" name="no_po" placeholder="No PO" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="no_asset" class="col-sm-2 control-label">No Asset</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="no_asset" name="no_asset" placeholder="No Asset" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="no_it" class="col-sm-2 control-label">No IT</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="no_it" name="no_it" placeholder="No IT" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="sn" class="col-sm-2 control-label">Serial Number</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="sn" name="sn" placeholder="Serial Number" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="type" class="col-sm-2 control-label">Type</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="type" name="type" placeholder="Type" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="merk" class="col-sm-2 control-label">Merk</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="vendor" class="col-sm-2 control-label">Vendor</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="vendor" name="vendor" placeholder="Vendor" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="tgl_terima" class="col-sm-2 control-label">Merk</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" placeholder="Tanggal Terima" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="pic" class="col-sm-2 control-label">PIC</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="pic" name="pic" placeholder="PIC" required>
				    </div>
				  </div>

				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-default">Tambah</button>
				    </div>
				  </div>
				</form>

			</div>
		</div>
	</div>