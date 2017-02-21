<div class="form-group">
    <label for="lokasi" class="col-sm-2 control-label">Sub Lokasi</label>
    <div class="col-sm-2">
      	<select  name="sub_lokasi" id="sub_lokasi" class="form-control" required>
      		<option value="">Pilih</option>
		    <?php
				foreach ($listSubLocation->result() as $row) {
					if($sub_location == $row->location_dtl_id){
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