<div class="form-group">
	<label for="imac_sn" class="col-sm-2 control-label">S/N IMAC</label>
	<div class="col-sm-4">
		<select id="sn" class="select2" name="imac_sn" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($imac_id != 0){?>
			<option value="<?php echo $imac_id; ?>" selected><?php echo $imac_sn;?></option>
			<?php } ?>
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
		<?php if($imac_id != 0){?>
		<input type="hidden" name="imac_old" id="imac_old" value="<?php echo $imac_id; ?>">
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<label for="nama_imac" class="col-sm-2 control-label">Nama IMAC</label>
    <div class="col-sm-3">
      	<input type="text" class="form-control" id="nama_imac" name="nama_imac" placeholder="Nama Imac" value="<?php if(isset($nama_imac)){echo $nama_imac;}?>" required>
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