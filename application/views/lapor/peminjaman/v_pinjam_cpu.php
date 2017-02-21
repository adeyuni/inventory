<div class="form-group">
	<label for="barang" class="col-sm-2 control-label">Service Tag CPU-<?php echo $i;?></label>
	<div class="col-sm-4">
		<input type="hidden" name="jenis_barang[]" value="<?php echo $jenis_barang[$key];?>">
		<select class="select2" name="barang[]" id="barang" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				foreach ($listCPU->result() as $row) {
					echo "<option value='$row->cpu_id'>".$row->cpu_service_tag."</option>";
				}
			?>
		</select>
	</div>
</div>