<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-heading">
				<div class="form-group">
			    	<label for="sn" class="col-sm-2 control-label">Silahkan Pilih : </label>
			    	<div class="col-sm-4">
			      		<select class="select2" name="jenis_barang" id="jenis_barang" style="width:300px">
				    		<option value="">Silahkan Pilih</option>
				    		<?php
				    			foreach ($jenisBarang->result() as $row) {
				    				if($jenis_barang == $row->id){
				    					echo "<option value='$row->id' selected>".$row->nama."</option>";
				    				}else{
				    					echo "<option value='$row->id'>".$row->nama."</option>";
				    				}
									
								}
				    		?>
				    	</select>
			    	</div>
			  	</div>
			</div>
			<?php 
				if(isset($listSelectedBarang)){
					include $listSelectedBarang;
				}
			?>
		</div>
	</div>