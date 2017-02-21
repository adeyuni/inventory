<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST" enctype="multipart/form-data"> 
					<div class="form-group">
						<label for="no_po" class="col-sm-2 control-label">Nomor PO</label>
						<div class="col-sm-4">
							<select id="no_po" class="select2" name="no_po" style="width:340px" <?php if($isEditing == true){echo "disabled";}?> required>
								<option value="">Silahkan Pilih</option>
								<!-- <option value=999999 <?php if($selectedPO == 999999){echo "selected";}?>>Tidak Ada NO PO</option> -->
								<?php
									foreach ($listPO->result() as $row) {
										if($row->rekap_id == $selectedPO){
											echo "<option value='$row->rekap_id' selected>".$row->rekap_no_po."</option>";
										}else{
											echo "<option value='$row->rekap_id'>".$row->rekap_no_po."</option>";
										}
										
									}
								?>
							</select>
						</div>
					</div>
					<?php if($showDtl == true){
						include $viewDtl;
					}?>
					<!-- <div id="form-dtl-barang"></div> -->
					<?php if($showJenisBarang == true){?>
					<div class="form-group">
					    <label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang</label>
					    <div class="col-sm-4">
					    	<select class="select2" style="width:340px"  name="jenis_barang" id="jenis_barang" <?php if($isEditing == true or $isDtl == false){ echo "disabled";}?> required>
					    		<option value="">Silahkan Pilih</option>
					    		<?php
					    			foreach ($listBarang->result() as $row) {
					    				if($selectedJenisBarang == $row->id){
					    					echo "<option value='$row->id' selected>".$row->nama."</option>";
					    				}else{
					    					echo "<option value='$row->id'>".$row->nama."</option>";
					    				}
									}

					    		?>
					    	</select>
					    </div>
				  	</div>
				  	<div class="form-group">
					    <label for="jenis_barang" class="col-sm-2 control-label"></label>
					    <div class="col-sm-4">
					    	<?php
					    		if($selectedJenisBarang == 1){
					    			$file = "PC.xlsx";
					    		}elseif($selectedJenisBarang == 100){
					    			$file = "laptop.xlsx";
					    		}elseif($selectedJenisBarang == 200){
					    			$file = "smartphone.xlsx";
					    		}elseif($selectedJenisBarang == 300){
					    			$file = "imac.xlsx";
					    		}else{
					    			$file = "barang.xlsx";
					    		}
					    	?>
					    	<a href="<?php echo site_url('assets/template/'.$file);?>"><span class="glyphicon glyphicon-download"></span> Download Template</a>
					    </div>
				  	</div>
				  	<?php }?>

				  	<?php if($isEnabled == true or $isEditing == true){?>
				  	<div class="form-group">
						<label for="no_asset" class="col-sm-2 control-label">Import File</label>
					    <div class="col-sm-4">
					    	<input type="file" name="file_import" id="file_import" required>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
					  		<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit" <?php if($isDtl == false and $isEditing == false){echo "disabled";}?> >
						</div>
					</div>	
					<?php }?>
				</form>
			</div>
		</div>
	</div>
