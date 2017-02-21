<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<br />
				<div class="form-group">
			    	<label for="jenis_barang" class="col-sm-2 control-label">Jenis Barang : </label>
			    	<div class="col-sm-4">
			      		<select class="select2" style="width:375px" name="jenis_barang" id="jenis_barang">
				    		<option value="">Jenis Barang</option>
				    		<?php
				    			foreach ($listBarang->result() as $row) {
				    				if($jenis_barang == $row->id){
				    					echo "<option value='$row->id' selected>".$row->nama."</option>";
				    				}else{
				    					echo "<option value='$row->id'>".$row->nama."</option>";
				    				}
									
								}
				    		?>
				    	</select>
			    	</div>
			    	<br /><br />
			  	</div>

			  	<?php if($jenis_barang != 0){?>
			  	<div class="form-group">
			    	<label for="status" class="col-sm-2 control-label">Status Barang: </label>
			    	<div class="col-sm-4">
			      		<select class="form-control" name="status" id="status">
				    		<?php
				    			foreach ($listStatus->result() as $row) {
				    				if($status == $row->status_id){
				    					echo "<option value='$row->status_id' selected>".$row->status_ket."</option>";
				    				}else{
				    					echo "<option value='$row->status_id'>".$row->status_ket."</option>";
				    				}
									
								}
				    		?>
				    	</select>
			    	</div>
			    	<br />
			  	</div>
			  	<?php } ?>
			<?php if(isset($msg)){echo $msg;}?>
			<?php 
				if(isset($listSelectedBarang)){
					include $listSelectedBarang;
				}
			?>
		</div>
	</div>