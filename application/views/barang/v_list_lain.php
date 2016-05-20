<div class="row">
	<div class="col-lg-12">
		<!-- <h1 class="page-header">Dashboard</h1> -->
		<br />
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="form-group">
					    	<label for="sn" class="col-sm-2 control-label">Silahkan Pilih : </label>
					    	<div class="col-sm-4">
					      		<select class="form-control" name="jenis_barang" id="jenis_barang">
						    		<option value="">Silahkan Pilih</option>
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
					  	</div>
					</div>
					<div class="panel-body">
						<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        
						        <th data-field="no" data-sortable="true"><b>No</b></th>
						        <th data-field="no_po" data-sortable="true"><b>No PO</b></th>
						        <th data-field="no_it"  data-sortable="true"><b>NO IT</b></th>
						        <th data-field="no_asset" data-sortable="true"><b>No Asset</b></th>
						        <th data-field="nama_barang" data-sortable="true"><b>Nama Barang</b></th>
						        <th data-field="sn" data-sortable="true"><b>Serial Number</b></th>
						        <th data-field="user" data-sortable="true"><b>User</b></th>
						        <th data-field="action" data-sortable="true"><b>Action</b></th>
						    </tr>
						    </thead>
						    <tbody>
						    	<?php 
						    		$i=1;
						    		foreach ($listLain->result() as $row) {
						    			
						    			echo "<tr>";
						    			echo "<td>".$i++."</td>";
						    			echo "<td>".$row->no_po."</td>";
						    			echo "<td>".$row->no_it."</td>";
						    			echo "<td>".$row->no_asset."</td>";
						    			echo "<td>".$row->nama."</td>";
						    			echo "<td>".$row->sn."</td>";
						    			echo "<td>".$row->user."</td>";
						    			$link_edit = site_url('/edit/lain/'.$row->id);
						    			$link_detail = site_url('/detail/lain/'.$row->id);
						    			$link_delete = site_url('/delete/lain/'.$row->id);
						    			echo "<td><a href='$link_detail' target='_blank'>Detail</a> | <a href='$link_edit'>Edit</a> | <a href='$link_delete' onclick='return konfirmasi()'>Delete</a></td>";
						    			echo "</tr>";
						    		}
						    	?>
						    	
						    </tbody>
						</table>
					</div>
				</div>
			</div>