<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="no" data-sortable="true"><b>No</b></th>
				        <th data-field="jenis_barang" data-sortable="true"><b>Jenis Barang</b></th>
				        <th data-field="lokasi_asal"  data-sortable="true"><b>Lokasi Asal</b></th>
				        <th data-field="lokasi_tujuan"  data-sortable="true"><b>Lokasi Tujuan</b></th>
				        <th data-field="tgl_kirim" data-sortable="true"><b>Tanggal Kirim</b></th>
				        <th data-field="pic" data-sortable="true"><b>PIC</b></th>
				        <th data-field="status" data-sortable="true"><b>Status</b></th>
				        <th data-field="action" data-sortable="true"><b>Action</b></th>
				    </tr>
				    </thead>
				    <tbody>
				    	
				    	<?php 
				    		$i=1;
				    		foreach ($listPengiriman->result() as $row) {
				    			
				    			echo "<tr>";
				    			echo "<td>".$i++."</td>";
				    			echo "<td>"._conv_jenis_barang($jenisBarang, $row->mutasi_jenis_barang)."</td>";
				    			echo "<td>"._conv_location($location, $row->mutasi_lokasi)."</td>";
				    			echo "<td>"._conv_location($location, $row->mutasi_lokasi_tujuan)."</td>";
				    			echo "<td>".$row->mutasi_tgl_kirim."</td>";
				    			echo "<td>".$row->mutasi_pic."</td>";
				    			echo "<td>"._conv_status($row->mutasi_status)."</td>";
				    			$link_detail = site_url('/lapor/detail_pengiriman/'.$row->mutasi_id);
				    	?>
				    				<td><a href="<?php echo $link_detail;?>">
				    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
												<span class="glyphicon glyphicon-zoom-in"></span> Detail
											</button>
										</a>
									</td>
								</tr>
				    	<?php
				    		}
				    	?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>

<?php

	function _conv_jenis_barang($jenis_barang, $selected = null){
		foreach($jenis_barang->result() as $row){
			if($selected == $row->id){
				return $row->nama;
			}
		}
	}

	function _conv_location($location, $selected = null){
		foreach($location->result() as $row){
			if($selected == $row->location_id){
				return $row->location_nama;
			}
		}
	}

	function _conv_status($stat = null){
		if($stat == 0){
			return '<span class="label label-danger">Belum Diterima</span>';
		}else{
			return '<span class="label label-success">Diterima</span>';
		}
	}
?>