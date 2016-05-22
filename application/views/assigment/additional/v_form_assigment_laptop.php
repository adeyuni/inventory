<div class="form-group">
	<label for="laptop_id" class="col-sm-2 control-label">S/N Laptop</label>
	<div class="col-sm-4">
		<select id="laptop_id" class="select2" name="laptop_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listLaptop->result() as $row) {
					if($row->laptop_id == $selectedLaptop){
						echo "<option value='$row->laptop_id' selected>".$row->laptop_sn_lp."</option>";
					}else{
						echo "<option value='$row->laptop_id'>".$row->laptop_sn_lp."</option>";
					}
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="mon1_id" class="col-sm-2 control-label">S/N Monitor Ext</label>
	<div class="col-sm-4">
		<select id="mon1_id" class="select2" name="mon1_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listMonitor->result() as $row) {
					if($row->barang_id == $selectedMon1){
						echo "<option value='$row->barang_id' selected>".$row->barang_sn."</option>";
					}else{
						echo "<option value='$row->barang_id'>".$row->barang_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="mouse_id" class="col-sm-2 control-label">S/N Mouse</label>
	<div class="col-sm-4">
		<select id="mouse_id" class="select2" name="mouse_id" style="width:300px">
			<option value="">Pilih</option>
			<?php
				foreach ($listMouse->result() as $row) {
					if($row->barang_id == $selectedMouse){
						echo "<option value='$row->barang_id' selected>".$row->barang_sn."</option>";
					}else{
						echo "<option value='$row->barang_id'>".$row->barang_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>