<div class="form-group">
	<label for="cpu_id" class="col-sm-2 control-label">Service Tag CPU</label>
	<div class="col-sm-4">
		<select id="cpu_id" class="select2" name="cpu_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listCPU->result() as $row) {
					if($row->cpu_id == $selectedCPU){
						echo "<option value='$row->cpu_id' selected>".$row->cpu_service_tag."</option>";
					}else{
						echo "<option value='$row->cpu_id'>".$row->cpu_service_tag."</option>";
					}
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="mon1_id" class="col-sm-2 control-label">S/N Monitor</label>
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
	<label for="mon2_id" class="col-sm-2 control-label">S/N Monitor Ext</label>
	<div class="col-sm-4">
		<select id="mon2_id" class="select2" name="mon2_id" style="width:300px">
			<option value="">Pilih</option>
			<?php
				foreach ($listMonitor->result() as $row) {
					if($row->barang_id == $selectedMon2){
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
	<label for="keyboard_id" class="col-sm-2 control-label">S/N Keyboard</label>
	<div class="col-sm-4">
		<select id="keyboard_id" class="select2" name="keyboard_id" style="width:300px">
			<option value="">Pilih</option>
			<?php
				foreach ($listKeyboard->result() as $row) {
					if($row->barang_id == $selectedKeyboard){
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