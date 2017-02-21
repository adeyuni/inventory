<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST">
					<div class="form-group">
					    <label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang</label>
					    <div class="col-sm-4">
					    	<select id="jenis_barang" class="select2" name="jenis_barang" style="width:300px" <?php if(isset($isEditing)) { if($isEditing == true){ echo "disabled"; } }?> required>
								<option value="">Silahkan Pilih</option>
								<?php
					    			foreach ($listJenisBarang->result() as $row) {
					    				if($selectedJenisBarang == $row->id){
					    					echo "<option value='$row->id' selected>".$row->nama."</option>";
					    				}else{
					    					echo "<option value='$row->id'>".$row->nama."</option>";
					    				}
									}
					    		?>
							</select>
					    </div>
				  	</div>
				  	<?php if(isset($formAssigmentBarang)){
						include $formAssigmentBarang;
					}?>
					<div class="form-group">
						<label for="user" class="col-sm-2 control-label">User</label>
					    <div class="col-sm-3">
					      	<input type="text" class="form-control" id="user" name="user" placeholder="User" value="<?php if(isset($user)){echo $user;}?>" required>
					    </div>
					</div>
					<div class="form-group">
						<label for="department" class="col-sm-2 control-label">Department</label>
					    <div class="col-sm-4">
					      	<select id="department" class="select2" name="department" style="width:300px" required>
								<option value="">Silahkan Pilih</option>
								 <?php
									foreach($listDepartment->result() as $row) {
										if($selectedDepartment == $row->department_id){
											echo "<option value='$row->department_id' selected>".$row->department_nama."</option>";
										}
										else{
											echo "<option value='$row->department_id'>".$row->department_nama."</option>";
										}
									}
								?>
							</select>
					    </div>
					</div>
					<div class="form-group">
						<label for="location" class="col-sm-2 control-label">Location</label>
					    <div class="col-sm-2">
						  	<select id="location" class="select2" name="location" style="width:300px" required>
								<option value="">Silahkan Pilih</option>
								 <?php
									foreach($listLocation->result() as $row) {
										if($selectedLocation == $row->location_id){
											echo "<option value='$row->location_id' selected>".$row->location_nama."</option>";
										}
										else{
											echo "<option value='$row->location_id'>".$row->location_nama."</option>";
										}
									}
								?>
							</select>
					    </div>
					</div>
					<div id="sub-lokasi">
							<?php if($sub_lokasi != 0){?>
								<div class="form-group">
							    <label for="lokasi" class="col-sm-2 control-label">Sub Location</label>
							    <div class="col-sm-2">
							      	<select  name="sub_lokasi" id="sub_lokasi" class="form-control" required>
							      		<option value="">Pilih</option>
									    <?php
											foreach ($listSubLocation->result() as $row) {
												if($sub_lokasi == $row->location_dtl_id){
													echo "<option value='$row->location_dtl_id' selected>".$row->location_dtl_nama."</option>";
												}
												else{
													echo "<option value='$row->location_dtl_id'>".$row->location_dtl_nama."</option>";
												}
											}
										?>
									</select>
							    </div>
							 </div>
							<?php } ?>
						</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
					    	<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
					  	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
