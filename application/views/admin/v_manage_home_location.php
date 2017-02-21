<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<div class="col-lg-6">
					<h4>Silahkan Pilih </h4><br />
					<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
						<div class="form-group">
							<label for="location" class="col-sm-4 control-label">Home Location</label>
							<div class="col-sm-4">
								<select id="location" class="select2" name="location" style="width:300px" required>
									<option value="">Pilih</option>
									<?php
										foreach ($listLocation->result() as $row) {
											if($row->location_id == $selectedLocation){
												echo "<option value='$row->location_id' selected>".$row->location_nama."</option>";
											}else{
												echo "<option value='$row->location_id'>".$row->location_nama."</option>";
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-4">
						  		<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
