<div class="form-group">
	<label for="cpu_id" class="col-sm-2 control-label">Service Tag CPU</label>
	<div class="col-sm-4">
		<select id="sn" class="select2" name="cpu_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($cpu_id != 0){?>
			<option value="<?php echo $cpu_id; ?>" selected><?php echo $cpu_service_tag;?></option>
			<?php } ?>
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
		<?php if($cpu_id != 0){?>
		<input type="hidden" name="cpu_old" id="cpu_old" value="<?php echo $cpu_id; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="mon1_id" class="col-sm-2 control-label">S/N Monitor</label>
	<div class="col-sm-4">
		<select id="mon1_id" class="select2" name="mon1_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($id_mon1 != 0){?>
			<option value="<?php echo $id_mon1; ?>" selected><?php echo $sn_mon1;?></option>
			<?php } ?>
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
		<?php if($id_mon1 != 0){?>
			<input type="hidden" name="mon1_old" id="mon1_old" value="<?php echo $id_mon1; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="mon2_id" class="col-sm-2 control-label">S/N Monitor Ext</label>
	<div class="col-sm-4">
		<select id="mon2_id" class="select2" name="mon2_id" style="width:300px">
			<option value="">Pilih</option>
			<?php if($id_mon2 != 0){?>
			<option value="<?php echo $id_mon2; ?>" selected><?php echo $sn_mon2;?></option>
			<?php } ?>
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
		<?php if($id_mon2 != 0){?>
		<input type="hidden" name="mon2_old" id="mon2_old" value="<?php echo $id_mon2; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="dongle_id" class="col-sm-2 control-label">S/N Kabel Dongle</label>
	<div class="col-sm-4">
		<select id="dongle_id" class="select2" name="dongle_id" style="width:300px">
			<option value="">Pilih</option>
			<?php if($id_dongle != 0){?>
			<option value="<?php echo $id_dongle; ?>" selected><?php echo $sn_dongle;?></option>
			<?php } ?>
			<?php
				foreach ($listDongle->result() as $row) {
					if($row->barang_id == $selectedDongle){
						echo "<option value='$row->barang_id' selected>".$row->barang_sn."</option>";
					}else{
						echo "<option value='$row->barang_id'>".$row->barang_sn."</option>";
					}
				}
			?>
		</select>
		<?php if($id_dongle != 0){?>
		<input type="hidden" name="dongle_old" id="dongle_old" value="<?php echo $id_dongle; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="keyboard_id" class="col-sm-2 control-label">S/N Keyboard</label>
	<div class="col-sm-4">
		<select id="keyboard_id" class="select2" name="keyboard_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($id_keyboard != 0){?>
			<option value="<?php echo $id_keyboard; ?>" selected><?php echo $sn_keyboard;?></option>
			<?php } ?>
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
		<?php if($id_keyboard != 0){?>
			<input type="hidden" name="keyboard_old" id="keyboard_old" value="<?php echo $id_keyboard; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="mouse_id" class="col-sm-2 control-label">S/N Mouse</label>
	<div class="col-sm-4">
		<select id="mouse_id" class="select2" name="mouse_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($id_mouse != 0){?>
			<option value="<?php echo $id_mouse; ?>" selected><?php echo $sn_mouse;?></option>
			<?php } ?>
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
		<?php if($id_mouse != 0){?>
		<input type="hidden" name="mouse_old" id="mouse_old" value="<?php echo $id_mouse; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="ups_id" class="col-sm-2 control-label">S/N UPS</label>
	<div class="col-sm-4">
		<select id="ups_id" class="select2" name="ups_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($id_ups != 0){?>
			<option value="<?php echo $id_ups; ?>" selected><?php echo $sn_ups;?></option>
			<?php } ?>
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
		<?php if($id_ups != 0){?>
			<input type="hidden" name="ups_old" id="ups_old" value="<?php echo $id_ups; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="hostname" class="col-sm-2 control-label">Hostname PC</label>
    <div class="col-sm-3">
      	<input type="text" class="form-control" id="hostname" name="hostname" placeholder="Hostname" value="<?php if(isset($cpu_hostname)){echo $cpu_hostname;}?>">
    </div>
</div>