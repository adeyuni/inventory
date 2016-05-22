<div class="form-group">
	<label for="barang_sn" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
		<select id="barang_sn" class="select2" name="barang_sn" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listBarang->result() as $row) {
					if($row->barang_id == $selectedBarang){
						echo "<option value='$row->barang_id' selected>".$row->barang_sn."</option>";
					}else{
						echo "<option value='$row->barang_id'>".$row->barang_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>