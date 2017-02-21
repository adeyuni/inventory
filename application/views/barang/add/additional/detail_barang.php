<div class="form-group">
	<label for="no_po" class="col-sm-2 control-label">Nama Barang</label>
	<div class="col-sm-4">
		<select name="dtl_barang" id="dtl_barang"  class="form-control" <?php if($isEditing == true){echo "disabled";}?> required>
			<option value="">Slihakan Pilih</option>
			<?php
				foreach($listDtlBarang->result() as $row){
					if($row->rekap_dtl_id == $selectedDtlBarang){
						echo "<option value='$row->rekap_dtl_id' selected>".$row->rekap_dtl_nama."</option>";
					}else{
						echo "<option value='$row->rekap_dtl_id'>".$row->rekap_dtl_nama."</option>";
					}
				}
			?>	
		</select>
	</div>
</div>
<?php if($isDtl == true){ ?>
<div class="form-group">
	<label for="no_po" class="col-sm-2 control-label"></label>
	<div class="col-sm-6">

		<label class="col-sm-3 control-label">Stok Awal : </label>
		<label id="stok-awal" class="col-sm-2 control-label"> <?php if(isset($stok_awal)){echo $stok_awal;}?></label>
		<label class="col-sm-3 control-label">Ditambahkan : </label>
		<label id="jml-beredar" class="col-sm-2 control-label"> <?php if(isset($jml_ditambahkan)){echo $jml_ditambahkan;}?></label>
		<label class="col-sm-3 control-label">Beredar : </label>
		<label id="jml-beredar" class="col-sm-2 control-label"> <?php if(isset($jml_beredar)){echo $jml_beredar;}?></label>
	</div>
</div>
<?php } ?>
