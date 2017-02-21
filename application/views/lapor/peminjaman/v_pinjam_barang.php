<div class="form-group">
	<label for="barang" class="col-sm-2 control-label">S/N <?php echo $jenis_barang_nama[$key]."-".$i;?></label>
	<div class="col-sm-4">
		<input type="hidden" name="jenis_barang[]" value="<?php echo $jenis_barang[$key];?>">
		<select class="select2" name="barang[]" id="barang" style="width:300px" required>
			<option value="">Pilih</option>
			<?php
				$listBarang = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => $jenis_barang[$key], 'barang_kondisi' => 1, 'barang_location' => $location_home));
				foreach ($listBarang->result() as $row) {
					echo "<option value='$row->barang_id'>".$row->barang_sn."</option>";
				}
			?>
		</select>
	</div>
</div>