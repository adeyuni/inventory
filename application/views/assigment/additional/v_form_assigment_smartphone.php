<div class="form-group">
	<label for="smartphone_id" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
		<select id="sn" class="select2" name="smartphone_id" style="width:300px" required>
			<option value="">Pilih</option>
			<?php if($smartphone_id != 0){?>
			<option value="<?php echo $smartphone_id; ?>" selected><?php echo $smartphone_sn;?></option>
			<?php } ?>
			<?php
				foreach ($listSmartphone->result() as $row) {
					if($row->smartphone_id == $selectedSmartphone){
						echo "<option value='$row->smartphone_id' selected>".$row->smartphone_sn."</option>";
					}else{
						echo "<option value='$row->smartphone_id'>".$row->smartphone_sn."</option>";
					}
				}
			?>
		</select>
		<?php if($smartphone_id != 0){?>
		<input type="hidden" name="smartphone_old" id="smartphone_old" value="<?php echo $smartphone_id; ?>">
		<?php } ?>
	</div>
</div>