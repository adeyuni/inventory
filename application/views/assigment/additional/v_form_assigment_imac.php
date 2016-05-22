<div class="form-group">
	<label for="imac_sn" class="col-sm-2 control-label">S/N IMAC</label>
	<div class="col-sm-4">
		<select id="imac_sn" class="select2" name="imac_sn" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listIMAC->result() as $row) {
					if($row->imac_id == $selectedIMAC){
						echo "<option value='$row->imac_id' selected>".$row->imac_sn."</option>";
					}else{
						echo "<option value='$row->imac_id'>".$row->imac_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="ups_id" class="col-sm-2 control-label">S/N UPS</label>
	<div class="col-sm-4">
		<select id="ups_id" class="select2" name="ups_id" style="width:300px">
			<option value="">Pilih</option>
			<?php
				foreach ($listUPS->result() as $row) {
					if($row->barang_id == $selectedUPS){
						echo "<option value='$row->barang_id' selected>".$row->barang_sn."</option>";
					}else{
						echo "<option value='$row->barang_id'>".$row->barang_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>