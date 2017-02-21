<div class="panel-body">
	<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	    <thead>
	    <tr>
	        <th data-field="no" data-sortable="true"><b>No</b></th>
	        <th data-field="no_asset" data-sortable="true"><b>No Asset</b></th>
	        <th data-field="no_it" data-sortable="true"><b>No IT</b></th>
	        <th data-field="sn"  data-sortable="true"><b>Serial Number</b></th>
	        <th data-field="hostname"  data-sortable="true"><b>Hostname</b></th>
	        <th data-field="user" data-sortable="true"><b>User</b></th>
	        <th data-field="action" data-sortable="true"><b>Action</b></th>
	    </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    		$j=1;
	    		for($i=0; $i<$jmlBeredar; $i++){
	    			
	    			echo "<tr>";
	    			echo "<td>".$j++."</td>";
	    			echo "<td>".$no_asset[$i]."</td>";
	    			echo "<td>".$no_it[$i]."</td>";
	    			echo "<td>".$sn[$i]."</td>";
	    			echo "<td>".$hostname[$i]."</td>";
	    			echo "<td>".$user[$i]."</td>";
	    			$link_tarik = site_url('/assigment/tarik/'.$jenis_barang.'/'.$imac_id[$i]);
	    	?>
	    				<td>
							<a href="<?php echo $link_tarik;?>">
	    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
									<span class="glyphicon glyphicon-open"></span> Tarik Barang
								</button>
							</a>
						</td>
					</tr>
	    	<?php } ?>
	    </tbody>
	</table>
</div>