<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
				<div class="col-lg-6">
					  <div class="form-group">
					    <label for="jenis_barang" class="col-sm-4 control-label">Jenis Barang</label>
					    <div class="col-sm-6">
					    	<select class="form-control" name="jenis_barang" id="jenis_barang" disabled>
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
					  <div class="form-group">
					    <label for="no_po" class="col-sm-4 control-label">No Po</label>
					    <div class="col-sm-6">
					    	<input type="text" class="form-control" id="no_po" name="no_po" placeholder="No PO" value="<?php if(isset($no_po)){echo $no_po;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="no_asset" class="col-sm-4 control-label">No Asset</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" id="no_asset" name="no_asset" placeholder="No Asset" value="<?php if(isset($no_asset)){echo $no_asset;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="no_it" class="col-sm-4 control-label">No IT</label>
					    <div class="col-sm-6">
					      <input type="number" class="form-control" id="no_it" name="no_it" placeholder="No IT" value="<?php if(isset($no_it)){echo $no_it;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
						<label for="service_tag" class="col-sm-4 control-label">Service Tag</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="service_tag" name="service_tag" placeholder="Service Tag" value="<?php if(isset($service_tag)){echo $service_tag;}?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="sn" class="col-sm-4 control-label">Serial Number</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="sn_cpu" name="sn_cpu" placeholder="Serial Number" value="<?php if(isset($sn_cpu)){echo $sn_cpu;}?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="nama_pc" class="col-sm-4 control-label">Nama PC</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="nama_pc" name="nama_pc" placeholder="Nama PC" value="<?php if(isset($nama_pc)){echo $nama_pc;}?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="mon_cpu1" class="col-sm-4 control-label">Monitor</label>
						<div class="col-sm-6">
							<select id="mon_cpu1" class="select2" name="mon_cpu1" style="width:300px">
								<option>Pilih</option>
								<?php
									echo "<option value='$id_mon1' selected>".$sn_mon1."</option>";
									foreach ($listMonitor->result() as $row) {
										echo "<option value='$row->id'>".$row->sn."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="mon_cpu2" class="col-sm-4 control-label">Monitor Ext</label>
						<div class="col-sm-6">
							<select id="mon_cpu2" class="select2" name="mon_cpu2" style="width:300px">
								<option>Pilih</option>
								<?php
									echo "<option value='$id_mon2' selected>".$sn_mon2."</option>";
									foreach ($listMonitor->result() as $row) {
										echo "<option value='$row->id'>".$row->sn."</option>";
									}
								?>
							</select>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="keyboard_cpu" class="col-sm-4 control-label">Keyboard</label>
						<div class="col-sm-6">
							<select id="keyboard_cpu" class="select2" name="keyboard_cpu" style="width:300px">
								<option>Pilih</option>
								<?php
									echo "<option value='$id_keyboard' selected>".$sn_keyboard."</option>";
									foreach ($listKeyboard->result() as $row) {
										echo "<option value='$row->id'>".$row->sn."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="mouse_cpu" class="col-sm-4 control-label">Mouse</label>
						<div class="col-sm-6">
							<select id="mouse_cpu" name="mouse_cpu" class="select2" style="width:300px">
								<option>Pilih</option>
								<?php
									echo "<option value='$id_mouse' selected>".$sn_mouse."</option>";
									foreach ($listMouse->result() as $row) {
										echo "<option value='$row->id'>".$row->sn."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="ups_cpu" class="col-sm-4 control-label">UPS</label>
						<div class="col-sm-6">
							<select id="ups_cpu" name="ups_cpu" class="select2" style="width:300px">
								<option>Pilih</option>
								<?php
									echo "<option value='$id_ups' selected>".$sn_ups."</option>";
									foreach ($listUPS->result() as $row) {
										echo "<option value='$row->id'>".$row->sn."</option>";
									}
								?>
							</select>
						</div>
					</div>
					 <div class="form-group">
					    <label for="type" class="col-sm-4 control-label">Type</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="<?php if(isset($type)){echo $type;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="merk" class="col-sm-4 control-label">Merk</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk" value="<?php if(isset($merk)){echo $merk;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="vendor" class="col-sm-4 control-label">Vendor</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" id="vendor" name="vendor" placeholder="Vendor" value="<?php if(isset($vendor)){echo $vendor;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="tgl_terima" class="col-sm-4 control-label">Tanggal Terima</label>
					    <div class="col-sm-4">
					      <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" placeholder="Tanggal Terima" value="<?php if(isset($tgl_terima)){echo $tgl_terima;}?>" >
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="pic" class="col-sm-4 control-label">PIC</label>
					    <div class="col-sm-6">
					    	<?php 
					    		if(isset($listOfPic)){
					    			$pic = explode(",", $listOfPic);
					    		}
					    	?>
					      <select class="selectpicker" name="pic[]" id="pic" multiple data-done-button="true" required>
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
					    <label for="user" class="col-sm-4 control-label">User</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" id="user" name="user" placeholder="User" value="<?php if(isset($user)){echo $user;}?>" >
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-4 col-sm-6">
					      <input type="submit" name="submit" id="submit" class="btn btn-info" value="Update">
					    </div>
					  </div>
				</div>
			</div>
			<!-- <div class="panel-heading"></div> -->
			<?php if(isset($msg)){echo $msg;}?>
			
		</div>
	</div>
