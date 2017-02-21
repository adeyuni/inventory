<div class="form-group">
	<label for="cpu_id" class="col-sm-2 control-label">Service Tag CPU</label>
	<div class="col-sm-4">
		<select id='barang' name="barang[]" multiple='multiple' required>
			<?php
				foreach ($listCPU->result() as $row) {
					if($row->cpu_id == $selectedBarang){
						echo "<option value='$row->cpu_id' selected>".$row->cpu_service_tag."</option>";
					}else{
						echo "<option value='$row->cpu_id'>".$row->cpu_service_tag."</option>";
					}
				}
			?>
		</select>
	</div>
</div>