<div class="form-group">
	<label for="smartphone_id" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
		<select id='barang' name="barang[]" multiple='multiple' required>
			<?php
				foreach ($listSmartphone->result() as $row) {
					if($row->smartphone_id == $selectedBarang){
						echo "<option value='$row->smartphone_id' selected>".$row->smartphone_sn."</option>";
					}else{
						echo "<option value='$row->smartphone_id'>".$row->smartphone_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>