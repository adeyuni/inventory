<div class="form-group">
	<label for="service_tag" class="col-sm-2 control-label">Service Tag</label>
	<div class="col-sm-10">
	  <input type="text" class="form-control" id="service_tag" name="service_tag" placeholder="Service Tag" value="<?php if(isset($service_tag)){echo $service_tag;}?>" >
	</div>
</div>
<div class="form-group">
	<label for="sn" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-10">
	  <input type="text" class="form-control" id="sn_cpu" name="sn_cpu" placeholder="Serial Number" value="<?php if(isset($sn_cpu)){echo $sn_cpu;}?>" >
	</div>
</div>
<div class="form-group">
	<label for="nama_pc" class="col-sm-2 control-label">Nama PC</label>
	<div class="col-sm-10">
	  <input type="text" class="form-control" id="nama_pc" name="nama_pc" placeholder="Nama PC" value="<?php if(isset($nama_pc)){echo $nama_pc;}?>" >
	</div>
</div>
<div class="form-group">
	<label for="mon_cpu1" class="col-sm-2 control-label">Monitor</label>
	<div class="col-sm-10">
		<select id="mon_cpu1" class="select2" name="mon_cpu1" style="width:300px">
			<option>Pilih</option>
			<?php
				foreach ($listMonitor->result() as $row) {
					echo "<option value='$row->id'>".$row->sn."</option>";
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="mon_cpu2" class="col-sm-2 control-label">Monitor Ext</label>
	<div class="col-sm-10">
		<select id="mon_cpu2" class="select2" name="mon_cpu2" style="width:300px">
			<option>Pilih</option>
			<?php
				foreach ($listMonitor->result() as $row) {
					echo "<option value='$row->id'>".$row->sn."</option>";
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="keyboard_cpu" class="col-sm-2 control-label">Keyboard</label>
	<div class="col-sm-10">
		<select id="keyboard_cpu" class="select2" name="keyboard_cpu" style="width:300px">
			<option>Pilih</option>
			<?php
				foreach ($listKeyboard->result() as $row) {
					echo "<option value='$row->id'>".$row->sn."</option>";
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="mouse_cpu" class="col-sm-2 control-label">Mouse</label>
	<div class="col-sm-10">
		<select id="mouse_cpu" name="mouse_cpu" class="select2" style="width:300px">
			<option>Pilih</option>
			<?php
				foreach ($listMouse->result() as $row) {
					echo "<option value='$row->id'>".$row->sn."</option>";
				}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label for="ups_cpu" class="col-sm-2 control-label">UPS</label>
	<div class="col-sm-10">
		<select id="ups_cpu" name="ups_cpu" class="select2" style="width:300px">
			<option>Pilih</option>
			<?php
				foreach ($listUPS->result() as $row) {
					echo "<option value='$row->id'>".$row->sn."</option>";
				}
			?>
		</select>
	</div>
</div>

