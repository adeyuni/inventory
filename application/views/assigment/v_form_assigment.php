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
					<div class="form-group">
					    <label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang</label>
					    <div class="col-sm-4">
					    	<select class="form-control" name="jenis_barang" id="jenis_barang" required>
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
					    <div class="col-sm-4">
					      	<input type="text" class="form-control" id="user" name="user" placeholder="User" value="<?php if(isset($user)){echo $user;}?>" required>
					    </div>
					</div>
					<div class="form-group">
						<label for="deparment" class="col-sm-2 control-label">Department</label>
					    <div class="col-sm-4">
					      	<input type="text" class="form-control" id="deparment" name="deparment" placeholder="Department" value="<?php if(isset($deparment)){echo $deparment;}?>" required>
					    </div>
					</div>
					<div class="form-group">
						<label for="location" class="col-sm-2 control-label">Location</label>
					    <div class="col-sm-2">
					      	<select  name="location" id="location" class="form-control" required>
					      		<option value="">Pilih</option>
							    <?php
									foreach($listLocation->result() as $row) {
										if($selectedLocation == $row->id){
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
						<div class="col-sm-offset-2 col-sm-4">
					    	<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
					  	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
