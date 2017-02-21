<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
				    <thead>
				    <tr>
				        
				        <th data-field="no" data-sortable="true"><b>No</b></th>
				        <th data-field="no_po" data-sortable="true"><b>No PO</b></th>
				        <th data-field="vendor"  data-sortable="true"><b>Vendor</b></th>
				        <th data-field="cp"  data-sortable="true"><b>Contact Person</b></th>
				        <th data-field="invoice" data-sortable="true"><b>Invoice</b></th>
				        <th data-field="tgl_terima" data-sortable="true"><b>Tanggal Diterima</b></th>
				        <th data-field="action" data-sortable="true"><b>Action</b></th>
				    </tr>
				    </thead>
				    <tbody>
				    	
				    	<?php 
				    		$i=1;
				    		foreach ($listPO->result() as $row) {
				    			
				    			echo "<tr>";
				    			echo "<td>".$i++."</td>";
				    			echo "<td>".$row->rekap_no_po."</td>";
				    			echo "<td>".$row->rekap_vendor."</td>";
				    			echo "<td>".$row->rekap_cp."</td>";
				    			echo "<td>".convert_invoice($row->rekap_invoice)."</td>";
				    			echo "<td>".$row->rekap_tgl_terima."</td>";
				    			$link_edit = site_url('/rekap/edit/'.$row->rekap_id);
				    			$link_detail = site_url('/rekap/detail/'.$row->rekap_id);
				    			$link_delete = site_url('/rekap/delete/'.$row->rekap_id);
				    	?>
				    				<td><a href="<?php echo $link_detail;?>">
				    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
												<span class="glyphicon glyphicon-zoom-in"></span> Detail
											</button>
										</a>
										<a href="<?php echo $link_edit;?>">
				    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
												<span class="glyphicon glyphicon-pencil"></span> Edit
											</button>
										</a>
										<a href="<?php echo $link_delete;?>">
				    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
												<span class="glyphicon glyphicon-trash"></span> Delete
											</button>
										</a>
									</td>
								</tr>
				    	<?php
				    			// echo "<td><a href='$link_detail' target='_blank'>Detail</a> | <a href='$link_edit'>Edit</a> | <a href='$link_delete' onclick='return konfirmasi()'>Delete</a></td>";
				    			// echo "</tr>";
				    		}
				    	?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>


<?php

	function convert_invoice($input){

		if($input == 1){
			return "Sudah";
		}else{
			return "Belum";
		}
	}
?>