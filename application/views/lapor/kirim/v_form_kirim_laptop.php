<div class="form-group">
	<label for="laptop_id" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
		<select id='barang' name="barang[]" multiple='multiple' required>
			<?php
				foreach ($listLaptop->result() as $row) {
					if($row->laptop_id == $selectedBarang){
						echo "<option value='$row->laptop_id' selected>".$row->laptop_sn_lp."</option>";
					}else{
						echo "<option value='$row->laptop_id'>".$row->laptop_sn_lp."</option>";
					}
				}
			?>
		</select>
	</div>
</div>