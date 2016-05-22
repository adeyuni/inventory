<div class="form-group">
	<label for="smartphone_id" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
		<select id="smartphone_id" class="select2" name="smartphone_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listSmartphone->result() as $row) {
					if($row->smartphone_id == $selectedSmartphone){
						echo "<option value='$row->smartphone_id' selected>".$row->smartphone_sn."</option>";
					}else{
						echo "<option value='$row->smartphone_id'>".$row->smartphone_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>