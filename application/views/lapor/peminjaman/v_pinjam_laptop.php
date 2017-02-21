<div class="form-group">
	<label for="barang" class="col-sm-2 control-label">S/N Laptop-<?php echo $i;?></label>
	<div class="col-sm-4">
		<input type="hidden" name="jenis_barang[]" value="<?php echo $jenis_barang[$key];?>">
		<select class="select2" name="barang[]" id="barang" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listLaptop->result() as $row) {
					echo "<option value='$row->laptop_id'>".$row->laptop_kode." - ".$row->laptop_sn_lp."</option>";
				}
			?>
		</select>
	</div>
</div>