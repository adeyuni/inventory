<div class="form-group">
	<label for="barang_id" class="col-sm-2 control-label">SN Barang di Kirim</label>
	<div class="col-sm-4">
		<select id='barang' name="barang[]" multiple='multiple' required>
		    <?php
				foreach ($listBarang2->result() as $row) {
					if($row->barang_id == $selectedBarang){
						echo "<option value='$row->barang_id' selected>".$row->barang_sn."</option>";
					}else{
						echo "<option value='$row->barang_id'>".$row->barang_sn."</option>";
					}
				}
			?>
		</select>
	</div>
</div>