<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST">
					<div class="form-group">
					    <label for="lokasi" class="col-sm-2 control-label">Lokasi</label>
					    <div class="col-sm-4">
					    	<select id="lokasi" class="select2" name="lokasi" style="width:300px" required>
								<option value="">Silahkan Pilih</option>
								<?php
					    			foreach ($listLocation->result() as $row) {
					    				if($selectedLocation == $row->location_id){
					    					echo "<option value='$row->location_id' selected>".$row->location_nama."</option>";
					    				}else{
					    					echo "<option value='$row->location_id'>".$row->location_nama."</option>";
					    				}
									}
					    		?>
							</select>
					    </div>
				  	</div>
				  	<?php if($selectedLocation != NULL){ ?>
				  	<div class="form-group">
					    <label for="sublokasi" class="col-sm-2 control-label">Sub Lokasi</label>
					    <div class="col-sm-4">
					    	<select id="sublokasi" class="select2" name="sublokasi" style="width:300px" required>
								<option value="">Silahkan Pilih</option>
								<?php
					    			foreach ($listSubLocation->result() as $row) {
					    				if($selectedSubLocation == $row->location_dtl_id){
					    					echo "<option value='$row->location_dtl_id' selected>".$row->location_dtl_nama."</option>";
					    				}else{
					    					echo "<option value='$row->location_dtl_id'>".$row->location_dtl_nama."</option>";
					    				}
									}
					    		?>
							</select>
					    </div>
				  	</div>
				  	<?php } ?>
					<div class="form-group">
					    <label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang</label>
					    <div class="col-sm-4">
					    	<select id="jenis_barang" class="select2" name="jenis_barang" style="width:300px" required>
								<option value="">Silahkan Pilih</option>
								<?php
					    			foreach ($listBarang->result() as $row) {
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
					
					<?php if($jenis_barang != 0){ ?>
					<div class="form-group">
					    <label for="lokasi" class="col-sm-2 control-label">Lokasi Tujuan</label>
					    <div class="col-sm-4">
					    	<select id="lokasi_tujuan" class="select2" name="lokasi_tujuan" style="width:300px" required>
								<option value="">Silahkan Pilih</option>
								<?php
					    			foreach ($listLocation->result() as $row) {
					    				if($selectedLocationTujuan == $row->location_id){
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
						<label for="pic" class="col-sm-2 control-label">PIC</label>
					    <div class="col-sm-4">
					    	<input type="text" class="form-control" id="pic" name="pic" placeholder="PIC" value="<?php if(isset($pic)){echo $pic;}?>" >
					    </div>
					</div>
					<div class="form-group">
					    <label for="tgl_kirim" class="col-sm-2 control-label">Tanggal Pengiriman</label>
					    <div class="col-sm-2">
					      <input type="date" class="form-control" id="tgl_kirim" name="tgl_kirim" placeholder="Tanggal Kirim" value="<?php if(isset($tgl_kirim)){echo $tgl_kirim;}?>">
					    </div>
					  </div>
					<div class="form-group">
					    <label for="ket" class="col-sm-2 control-label">Note </label>
					    <div class="col-sm-4">
					      	<textarea class="form-control" name="ket" id="ket" rows="6" placeholder="" required><?php if(isset($ket)){echo $ket;}?></textarea>
					    </div>
					</div>
					<?php } ?>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
					    	<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
					  	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
