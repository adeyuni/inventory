<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
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
					    <label for="no_do" class="col-sm-4 control-label">No Do</label>
					    <div class="col-sm-6">
					    	<input type="text" class="form-control" id="no_do" name="no_do" placeholder="No DO" value="<?php if(isset($no_do)){echo $no_do;}?>" >
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
						<label for="sn_lp" class="col-sm-4 control-label">Serial Number Laptop</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="sn_lp" name="sn_lp" placeholder="Serial Number Laptop" value="<?php if(isset($sn_lp)){echo $sn_lp;}?>" >
						</div>
					  </div>
					  <div class="form-group">
						<label for="sn_hdd" class="col-sm-4 control-label">Serial Number Hardisk</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="sn_hdd" name="sn_hdd" placeholder="Serial Number Hardisk" value="<?php if(isset($sn_hdd)){echo $sn_hdd;}?>" >
						</div>
					  </div>
					  <div class="form-group">
						<label for="sn_baterai" class="col-sm-4 control-label">Serial Number Baterai</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="sn_baterai" name="sn_baterai" placeholder="Serial Number Hardisk" value="<?php if(isset($sn_baterai)){echo $sn_baterai;}?>" >
						</div>
					  </div>
					  <div class="form-group">
						<label for="sn_charger" class="col-sm-4 control-label">Serial Number Charger</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="sn_charger" name="sn_charger" placeholder="Serial Number Charger" value="<?php if(isset($sn_charger)){echo $sn_charger;}?>" >
						</div>
					  </div>
					  <div class="form-group">
						<label for="nama_laptop" class="col-sm-4 control-label">Nama Laptop</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="nama_laptop" name="nama_laptop" placeholder="Nama Laptop" value="<?php if(isset($nama_laptop)){echo $nama_laptop;}?>" >
						</div>
					  </div>
					  <div class="form-group">
						<label for="kode_laptop" class="col-sm-4 control-label">Kode Laptop</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="kode_laptop" name="kode_laptop" placeholder="Kode Laptop" value="<?php if(isset($kode_laptop)){echo $kode_laptop;}?>" >
						</div>
					  </div>
					<div class="form-group">
						<label for="mon_laptop" class="col-sm-4 control-label">Monitor</label>
						<div class="col-sm-6">
							<select id="mon_laptop" class="select2" name="mon_laptop" style="width:300px">
								<?php
									if($id_mon1 != 0){ 
										echo "<option value=0 >Pilih</option>";
										echo "<option value='$id_mon1' selected>".$sn_mon1."</option>"; 
									}
									else{ 
										echo "<option value=0 selected>Pilih</option>";
									}
									foreach ($listMonitor->result() as $row) {
										echo "<option value='$row->id'>".$row->sn."</option>";
									}
								?>
							</select>
							<input type="hidden" name="mon_old" id="mon_old" value="<?php echo $id_mon1;?>">
						</div>
					</div>
					
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="mouse_laptop" class="col-sm-4 control-label">Mouse</label>
						<div class="col-sm-6">
							<select id="mouse_laptop" name="mouse_laptop" class="select2" style="width:300px">
								<?php
									if($id_mouse != 0){ 
										echo "<option value=0 >Pilih</option>";
										echo "<option value='$id_mouse' selected>".$sn_mouse."</option>";
									}
									else{ 
										echo "<option value=0 selected>Pilih</option>";
									}
									foreach ($listMouse->result() as $row) {
										echo "<option value='$row->id'>".$row->sn."</option>";
									}
								?>
							</select>
							<input type="hidden" name="mouse_old" id="mouse_old" value="<?php echo $id_mouse;?>">
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
					      <select class="selectpicker" name="pic[]" id="pic" multiple data-actions-box="true" required>
						    <?php
								foreach ($listPIC->result() as $row) {
									echo $row->nama;
									if($pic[0]== $row->id || $pic[1]== $row->id || $pic[2]== $row->id || $pic[3]== $row->id || $pic[4]== $row->id || $pic[5]== $row->id || $pic[6]== $row->id || $pic[7]== $row->id || $pic[8]== $row->id || $pic[9]== $row->id){
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
					    <label for="location" class="col-sm-4 control-label">Location</label>
					    <div class="col-sm-4">
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
					    <label for="user" class="col-sm-4 control-label">Keterangan</label>
					    <div class="col-sm-6">
					      <textarea class="form-control" name="ket" id="ket" style="height:100px"><?php if(isset($ket)){echo $ket;}?></textarea>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-4 col-sm-6">
					      <input type="submit" name="submit" id="submit" class="btn btn-info" value="Update">
					    </div>
					  </div>
				</div>
			</div>			
		</div>
	</div>
