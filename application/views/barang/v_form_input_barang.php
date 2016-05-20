<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<!-- <div class="panel-heading"></div> -->
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
				  <div class="form-group">
				    <label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang</label>
				    <div class="col-sm-4">
				    	<select class="form-control" name="jenis_barang" id="jenis_barang">
				    		<option value="">Silahkan Pilih</option>
				    		<?php
				    			foreach ($listBarang->result() as $row) {
				    				if($jenis_barang == $row->id){
				    					echo "<option value='$row->id' selected>".$row->nama."</option>";
				    				}else{
				    					echo "<option value='$row->id'>".$row->nama."</option>";
				    				}
									
								}
				    		?>
				    	</select>
				    </div>
				  </div>
				  <div class="form_input">
				  	  <div class="form-group">
					    <label for="no_po" class="col-sm-2 control-label">No PO</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="no_po" name="no_po" placeholder="No PO" value="<?php if(isset($no_po)){echo $no_po;}?>"  >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="no_do" class="col-sm-2 control-label">No DO</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="no_do" name="no_do" placeholder="No DO" value="<?php if(isset($no_do)){echo $no_do;}?>"  >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="no_asset" class="col-sm-2 control-label">No Asset</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="no_asset" name="no_asset" placeholder="No Asset" value="<?php if(isset($no_asset)){echo $no_asset;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="no_it" class="col-sm-2 control-label">No IT</label>
					    <div class="col-sm-4">
					      <input type="number" class="form-control" id="no_it" name="no_it" placeholder="No IT" value="<?php if(isset($no_it)){echo $no_it;}?>" required >
					    </div>
					  </div>
				  </div>

				  <div class="form_cpu">
				  	<?php include "v_form_cpu.php";?>
				  </div>

				  <div class="form_barang">
				  	<?php include "v_form_barang.php";?>
				  </div>

				  <div class="form_laptop">
				  	<?php
				  		include "v_form_laptop.php";
				  	?>
				  </div>
				  <div class="form_smartphone">
				  	<?php
				  		include "v_form_smartphone.php";
				  	?>
				  </div>
				  <div class="form_imac">
				  	<?php
				  		include "v_form_imac.php";
				  	?>
				  </div>
				  <div class="form_lain">
				  	<?php
				  		include "v_form_lain.php";
				  	?>
				  </div>


				  <div class="form_input">
				  	  <div class="form-group">
					    <label for="type" class="col-sm-2 control-label">Type</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="<?php if(isset($type)){echo $type;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="merk" class="col-sm-2 control-label">Merk</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk" value="<?php if(isset($merk)){echo $merk;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="vendor" class="col-sm-2 control-label">Vendor</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="vendor" name="vendor" placeholder="Vendor" value="<?php if(isset($vendor)){echo $vendor;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="tgl_terima" class="col-sm-2 control-label">Tanggal Terima</label>
					    <div class="col-sm-2">
					      <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" placeholder="Tanggal Terima" value="<?php if(isset($tgl_terima)){echo $tgl_terima;}?>" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="pic" class="col-sm-2 control-label">PIC</label>
					    <div class="col-sm-4">
					    	<?php 
					    		if(isset($listOfPic)){
					    			$pic = explode(",", $listOfPic);
					    		}
					    	?>
					      <select class="selectpicker" name="pic[]" id="pic" multiple data-actions-box="true" required>
						    <?php
								foreach ($listPIC->result() as $row) {
									if($pic[0]== $row->id || $pic[1]== $row->id || $pic[2]== $row->id || $pic[3]== $row->id || $pic[4]== $row->id || $pic[5]== $row->id || $pic[6]== $row->id){
										echo "<option value='$row->id' selected>".$row->nama."</option>";
									}
									else{
										echo "<option value='$row->id'>".$row->nama."</option>";
									}
								}
							?>
						  </select>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="user" class="col-sm-2 control-label">User</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="user" name="user" placeholder="User" value="<?php if(isset($user)){echo $user;}?>" >
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="location" class="col-sm-2 control-label">Location</label>
					    <div class="col-sm-2">
					      <select  name="location" id="location" class="form-control" required>
					      	<option value="">Pilih</option>
						    <?php
								foreach ($listLocation->result() as $row) {
									if($location == $row->id){
										echo "<option value='$row->id' selected>".$row->nama."</option>";
									}
									else{
										echo "<option value='$row->id'>".$row->nama."</option>";
									}
								}
							?>
						  </select>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="user" class="col-sm-2 control-label">Keterangan</label>
					    <div class="col-sm-4">
					      <textarea class="form-control" name="ket" id="ket" style="height:100px"><?php if(isset($ket)){echo $ket;}?></textarea>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-4">
					      <input type="submit" name="submit" id="submit" class="btn btn-default" value="Tambah">
					    </div>
					  </div>
				  </div>
  					
				</form>

			</div>
		</div>
	</div>
