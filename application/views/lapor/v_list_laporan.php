<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<br /><br />
			<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
			<ul class="children collapse1" id="menu3">
				<li>
					<a class="" href="<?php echo site_url('lapor/kerusakan');?>">
						<span class="glyphicon glyphicon-list-alt"></span> Pelaporan Asset Rusak
					</a>
				</li>
				<li>
					<a class="" href="<?php echo site_url('lapor/service');?>">
						<span class="glyphicon glyphicon-list-alt"></span> Pelaporan Asset di Servis
					</a>
				</li>
				<li>
					<a class="" href="<?php echo site_url('lapor/after_service');?>">
						<span class="glyphicon glyphicon-list-alt"></span> Pelaporan Asset Setelah di Servis
					</a>
				</li>
				<li>
					<a class="" href="<?php echo site_url('lapor/kehilangan');?>">
						<span class="glyphicon glyphicon-list-alt"></span> Pelaporan Asset Hilang
					</a>
				</li>
			</ul>
			<?php } ?>
			<div class="panel-body">
				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="no" data-sortable="true"><b>No</b></th>
				        <th data-field="jenis_laporan" data-sortable="true"><b>Jenis Laporan</b></th>
				        <th data-field="jenis_barang" data-sortable="true"><b>Jenis Barang</b></th>
				        <th data-field="sn"  data-sortable="true"><b>S/N Barang</b></th>
				        <th data-field="tgl"  data-sortable="true"><b>Tanggal</b></th>
				        <th data-field="action" data-sortable="true"><b>Action</b></th>
				    </tr>
				    </thead>
				    <tbody>
				    	<?php if($jenis_barang != null) {?>
				    	<?php 
				    		$i=1;
				    		$no = 0;
				    		foreach ($jenis_barang as $key => $jenisBarang){
				    			echo "<tr>";
				    			echo "<td>".$i++."</td>"; // no
				    			echo "<td>".$jenis_laporan[$no]."</td>"; //laporan
				    			echo "<td>".$jenisBarang."</td>"; //barang
				    			echo "<td>".$barang[$no]."</td>"; //sn
				    			echo "<td>".$tgl[$no]."</td>";
				    			$link_detail = site_url('/lapor/detail/'.$laporan_id[$no]);
				    	?>
				    				<td><a href="<?php echo $link_detail;?>">
				    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
												<span class="glyphicon glyphicon-zoom-in"></span> Detail
											</button>
										</a>
									</td>
								</tr>
				    	<?php
				    			// echo "<td><a href='$link_detail' target='_blank'>Detail</a> | <a href='$link_edit'>Edit</a> | <a href='$link_delete' onclick='return konfirmasi()'>Delete</a></td>";
				    			// echo "</tr>";
				    		$no++;
				    		}
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