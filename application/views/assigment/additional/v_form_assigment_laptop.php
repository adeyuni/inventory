<div class="form-group">
	<label for="laptop_id" class="col-sm-2 control-label">S/N Laptop</label>
	<div class="col-sm-4">
		<select id="sn" class="select2" name="laptop_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($laptop_id != 0){?>
			<option value="<?php echo $laptop_id; ?>" selected><?php echo $laptop_sn_lp;?></option>
			<?php } ?>
			<?php
				foreach ($listLaptop->result() as $row) {
					if($row->laptop_id == $selectedLaptop){
						echo "<option value='$row->laptop_id' selected>".$row->laptop_sn_lp." - ".$row->laptop_kode."</option>";
					}else{
						echo "<option value='$row->laptop_id'>".$row->laptop_sn_lp." - ".$row->laptop_kode."</option>";
					}
				}
			?>
		</select>
		<?php if($laptop_id != 0){?>
		<input type="hidden" name="laptop_old" id="laptop_old" value="<?php echo $laptop_id; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="nama_laptop" class="col-sm-2 control-label">Nama Laptop</label>
    <div class="col-sm-3">
      	<input type="text" class="form-control" id="nama_laptop" name="nama_laptop" placeholder="Nama Laptop" value="<?php if(isset($nama_laptop)){echo $nama_laptop;}?>" required>
    </div>
</div>
<div class="form-group">
	<label for="kode_laptop" class="col-sm-2 control-label">Kode Laptop</label>
    <div class="col-sm-3">
      	<input type="text" class="form-control" id="kode_laptop" name="kode_laptop" placeholder="Kode Laptop" value="<?php if(isset($kode_laptop)){echo $kode_laptop;}?>" required>
    </div>
</div>
<div class="form-group">
	<label for="mon1_id" class="col-sm-2 control-label">S/N Monitor</label>
	<div class="col-sm-4">
		<select id="mon1_id" class="select2" name="mon1_id" style="width:300px">
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
	<label for="mouse_id" class="col-sm-2 control-label">S/N Mouse</label>
	<div class="col-sm-4">
		<select id="mouse_id" class="select2" name="mouse_id" style="width:300px">
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