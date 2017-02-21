<div class="form-group">
	<label for="imac_id" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
		<select id='barang' name="barang[]" multiple='multiple' required>
			<?php
				foreach ($listImac->result() as $row) {
					if($row->imac_id == $selectedBarang){
						echo "<option value='$row->imac_id' selected>".$row->imac_sn."</option>";
					}else{
						echo "<option value='$row->imac_id'>".$row->imac_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>