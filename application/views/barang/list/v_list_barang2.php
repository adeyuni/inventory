<div class="panel-body">
	<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	    <thead>
	    <tr>
	        
	        <th data-field="no" data-sortable="true"><b>No</b></th>
	        <th data-field="no_asset" data-sortable="true"><b>No Asset</b></th>
	        <th data-field="no_it"  data-sortable="true"><b>No IT</b></th>
	        <th data-field="serial_number"  data-sortable="true"><b>Serial Number</b></th>
	        <th data-field="user" data-sortable="true"><b>User</b></th>
	        <th data-field="kondisi" data-sortable="true"><b>Kondisi</b></th>
	        <th data-field="action" data-sortable="true"><b>Action</b></th>
	    </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    		$i=1;
	    		foreach ($listBarang2->result() as $row) {
	    			
	    			echo "<tr>";
	    			echo "<td>".$i++."</td>";
	    			echo "<td>".$row->barang_no_asset."</td>";
	    			echo "<td>".$row->barang_no_it."</td>";
	    			echo "<td>".$row->barang_sn."</td>";
	    			echo "<td>".$row->barang_user."</td>";
	    			echo "<td>";
	    			if($row->barang_kondisi == 1){
	    				echo '<span class="label label-success">';
	    			}elseif ($row->barang_kondisi == 2){
	    				echo '<span class="label label-danger">';
	    			}else{
	    				echo '<span class="label label-info">';
	    			}
	    			echo $kondisi[$row->barang_kondisi]."</span></td>";
	    			
	    			$link_edit = site_url('/barang/edit/'.$row->rekap_id."/".$row->rekap_dtl_id."/".$jenis_barang."/".$row->barang_id);
	    			$link_detail = site_url('/barang/detail/'.$jenis_barang."/".$row->barang_id);
	    			$link_delete = site_url('/barang/delete/'.$jenis_barang."/".$row->barang_id);

	    			$cek = $this->MBarang->is_exist('as_barang', array('as_barang_barang_id' =>  $row->barang_id));

					if($cek == true){
						$link_tarik = site_url('/assigment/tarik/'.$jenis_barang.'/'.$row->barang_id);
					}	
	    	?>
	    				<td><a href="<?php echo $link_detail;?>">
	    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
									<span class="glyphicon glyphicon-zoom-in"></span> Detail
								</button>
							</a>
							<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
							<?php if($status != 0){?>
							<a href="<?php echo $link_edit;?>">
	    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
									<span class="glyphicon glyphicon-pencil"></span> Edit
								</button>
							</a>
							<?php } ?>
							<?php if($cek == true){?>
							<a href="<?php echo $link_tarik;?>">
	    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-warning">
									<span class="glyphicon glyphicon-open"></span> Tarik
								</button>
							</a>
							<?php } ?>

							<a href="<?php echo $link_delete;?>">
	    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
									<span class="glyphicon glyphicon-trash"></span> Delete
								</button>
							</a>
							<?php } ?>
						</td>
					</tr>
	    	<?php } ?>
	    </tbody>
	</table>
</div>