<div class="form-group">
	<label for="no_po" class="col-sm-2 control-label">Nama Barang</label>
	<div class="col-sm-4">
		<select name="dtl_barang" id="dtl_barang" onchange="get_detail(this.value)" class="form-control">
			<?php
				$i=1;
				foreach($listDtlBarang->result() as $row){
					if($i == 1){
						$temp = $row->rekap_dtl_id;
					}
					$jml[$row->rekap_dtl_id] = $row->rekap_dtl_jml;
					$beredar[$row->rekap_dtl_id] = $row->rekap_dtl_beredar;

					if($row->rekap_dtl_id == $selectedDtlBarang){
						$temp = $row->rekap_dtl_id;
						echo "<option value='$row->rekap_dtl_id' selected>".$row->rekap_dtl_nama."</option>";
					}else{
						echo "<option value='$row->rekap_dtl_id'>".$row->rekap_dtl_nama."</option>";
					}
					
					$i++;
				}
			?>	
		</select>
		<?php
			foreach($listDtlBarang->result() as $row){
				echo "<input type='hidden' id='jml-$row->rekap_dtl_id' value='$row->rekap_dtl_jml'>";
				echo "<input type='hidden' id='beredar-$row->rekap_dtl_id' value='$row->rekap_dtl_beredar'>";
			}
		?>
	</div>
</div>
<div class="form-group">
	<label for="no_po" class="col-sm-2 control-label"></label>
	<div class="col-sm-6">
		<label class="col-sm-3 control-label">Stok Awal</label>
		<label id="stok-awal" class="col-sm-2 control-label">: <?php echo $jml[$temp];?></label>
		<label class="col-sm-3 control-label">Beredar</label>
		<label id="jml-beredar" class="col-sm-2 control-label">: <?php echo $beredar[$temp];?></label>
	</div>
</div>
