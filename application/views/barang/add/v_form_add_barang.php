<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
					<div class="form-group">
						<label for="no_po" class="col-sm-2 control-label">Nomor PO</label>
						<div class="col-sm-4">
							<select id="no_po" class="select2" name="no_po" style="width:375px" <?php if($isEditing == true){echo "disabled";}?> required>
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
					    	<select class="select2" name="jenis_barang" id="jenis_barang" <?php if($isEditing == true or $isDtl == false){ echo "disabled";}?> style="width:375px" required>
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
				  	<?php }?>

				  	<?php if($isEnabled == true or $isEditing == true){?>
				  	<div class="form-group">
						<label for="no_asset" class="col-sm-2 control-label">No Asset</label>
					    <div class="col-sm-4">
					    	<input type="text" class="form-control" id="no_asset" name="no_asset" placeholder="No Asset" value="<?php if(isset($no_asset)){echo $no_asset;}?>" >
					    </div>
					</div>
					<div class="form-group">
					    <label for="no_it" class="col-sm-2 control-label">No IT</label>
					    <div class="col-sm-4">
					      	<input type="text" class="form-control" id="no_it" name="no_it" placeholder="No IT" value="<?php if(isset($no_it)){echo $no_it;}?>" >
					      	<?php if($isEditing == true){ ?>
					      	<input type="hidden" name="no_it_old" id="no_it_old" value="<?php if(isset($no_it)){echo $no_it;}?>">
					      	<?php } ?>
					    </div>
					</div>
					
				  	<?php if(isset($formInputBarang)){
						include $formInputBarang;
					}?>
					<div class="form-group">
					    <label for="ket" class="col-sm-2 control-label">Keterangan Tambahan</label>
					    <div class="col-sm-4">
					      	<textarea class="form-control" name="ket" id="ket" placeholder="Keterangan"><?php if(isset($ket)){echo $ket;}?></textarea>
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
