<div class="form-group">
	<label for="cpu_id" class="col-sm-2 control-label">Service Tag CPU</label>
	<div class="col-sm-4">
		<select id="barang_id" class="select2" name="barang_id" id="barang_id" style="width:300px" required>
			<option value="">Pilih</option>
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
<div class="form-group">
	<?php if($selectedBarang != 0){ 
			foreach($dtl->result() as $row){
				$keterangan = $row->laporan_ket;
				$tgl = $row->laporan_tgl;
				$time = $row->laporan_create_time;
			}
	?>
	<label for="smartphone_id" class="col-sm-2 control-label"></label>
		<div class="col-sm-4">
			<div class="alert bg-primary" role="alert">
				<b>Keterangan : </b>
				<?php echo $keterangan;?>
				<br />
				<b>Tanggal Rusak : </b>
				<?php echo $tgl;?> 
				<br /><br />
				Date Create : <?php echo $time;?>
			</div>
		</div>
	<?php }?>
</div>

<div class="form-group">
	<?php if(isset($dtlService) AND $selectedBarang != 0){ 
		foreach($dtlService->result() as $row){
				$keterangan = $row->laporan_ket;
				$tgl = $row->laporan_tgl;
				$time = $row->laporan_create_time;
			}
	?>
	<label for="cpu_id" class="col-sm-2 control-label"></label>
	<div class="col-sm-4">
		<div class="alert bg-primary" role="alert">
				<b>Keterangan : </b>
				<?php echo $keterangan;?>
				<br />
				<b>Tanggal Service : </b>
				<?php echo $tgl;?> 
				<br /><br />
				Date Create : <?php echo $time;?>
			</div>
	</div>
	<?php }?>
</div>
