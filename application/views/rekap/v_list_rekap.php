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
						Daftar Rekap PO
					</div>
					<div class="panel-body">
						<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        
						        <th data-field="no" data-sortable="true"><b>No</b></th>
						        <th data-field="no_po" data-sortable="true"><b>No PO</b></th>
						        <th data-field="no_it"  data-sortable="true"><b>Vendor</b></th>
						        <th data-field="no_it"  data-sortable="true"><b>Contact Person</b></th>
						        <th data-field="no_asset" data-sortable="true"><b>Invoice</b></th>
						        <th data-field="service_tag" data-sortable="true"><b>Tanggal Diterima</b></th>
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
						    			echo "<td>".$row->rekap_invoice."</td>";
						    			echo "<td>".$row->rekap_tgl_terima."</td>";
						    			$link_edit = site_url('/edit/cpu/'.$row->rekap_id);
						    			$link_detail = site_url('/detail/cpu/'.$row->rekap_id);
						    			$link_delete = site_url('/delete/cpu/'.$row->rekap_id);
						    			echo "<td><a href='$link_detail' target='_blank'>Detail</a> | <a href='$link_edit'>Edit</a> | <a href='$link_delete' onclick='return konfirmasi()'>Delete</a></td>";
						    			echo "</tr>";
						    		}
						    	?>
						    </tbody>
						</table>
					</div>
				</div>
			</div>