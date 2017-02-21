<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST">
					<div class="form-group">
					    <label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang</label>
					    <div class="col-sm-4">
					    	<select id="jenis_barang" class="select2" name="jenis_barang" style="width:300px" required>
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
				  	<?php if(isset($formAssigmentBarang)){
						include $formAssigmentBarang;
					}?>
					<?php if($jenis_barang != 0){ ?>
					<div class="form-group">
					    <label for="tgl" class="col-sm-2 control-label">Tanggal </label>
					    <div class="col-sm-2">
					      	<input type="date" class="form-control" id="tgl" name="tgl" placeholder="Tanggal" value="<?php if(isset($tgl_terima)){echo $tgl_terima;}?>">
					    </div>
					</div>
					<div class="form-group">
					    <label for="ket" class="col-sm-2 control-label">Note </label>
					    <div class="col-sm-4">
					      	<textarea class="form-control" name="ket" id="ket" rows="6" placeholder="" required><?php if(isset($ket)){echo $ket;}?></textarea>
					    </div>
					</div>
					<?php } ?>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
					    	<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
					  	</div>
					</div>
				</form>
			</div>
		</div>
	</div>
