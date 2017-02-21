<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<?php if(isset($selectedStatus)){ ?>
				<div class="form-group">
			    	<label for="status" class="col-sm-2 control-label">Status Barang: </label>
			    	<div class="col-sm-4">
			      		<select class="form-control" name="status" id="status">
				    		<option value="0" <?php if($selectedStatus == 0){echo "selected";} ?>>Belum Dikembalikan</option>
				    		<option value="1" <?php if($selectedStatus == 1){echo "selected";} ?>>Sudah Dikembalikan</option>
				    	</select>
			    	</div>
			    	<br />
			  	</div>
			  	<?php } else {?>
			  	<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
				  	<div class="form-group">
					    <label for="sn" class="col-sm-2 control-label">S/N Barang : </label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="sn" name="sn" placeholder="Serial Number" value="<?php if(isset($sn)){echo $sn;}?>"  >
					    </div>
				  	</div>
				  	<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-4">
					      	<input type="submit" name="submit" id="submit" class="btn btn-info" value="Search">
					    </div>
					  </div>
				</form>
			  	<?php }?>
				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="no" data-sortable="true"><b>No</b></th>
				        <th data-field="sn"  data-sortable="true"><b>Serial Number</b></th>
				        <th data-field="user"  data-sortable="true"><b>User</b></th>
				        <th data-field="tgl_pinjam" data-sortable="true"><b>Tanggal Pinjam</b></th>
				        <th data-field="tgl_estimasi"  data-sortable="true"><b>Tanggal Estimasi</b></th>
				        <th data-field="penyerah" data-sortable="true"><b>Penyerah</b></th>
				        <th data-field="status" data-sortable="true"><b>Status</b></th>
				        <th data-field="penerima" data-sortable="true"><b>Penerima</b></th>
				        <th data-field="action" data-sortable="true"><b>Action</b></th>
				    </tr>
				    </thead>
				    <tbody>
				    	
				    	<?php 
				    		$i=1;
				    		foreach ($listPeminjaman->result() as $row) {
				    			
				    			echo "<tr>";
				    			echo "<td>".$i++."</td>";
				    			echo "<td>".$row->peminjaman_barang_sn."</td>";
				    			echo "<td>".$row->laporan_peminjaman_user."</td>";
				    			echo "<td>".$row->laporan_peminjaman_tgl_pinjam."</td>";
				    			echo "<td>".$row->laporan_peminjaman_estimasi."</td>";
				    			echo "<td>"._conv_user($listPIC,$row->laporan_peminjaman_penyerah)."</td>";
				    			echo "<td>"._conv_status($row->laporan_peminjaman_status)."</td>";
				    			echo "<td>"._conv_user($listPIC,$row->laporan_peminjaman_penerima)."</td>";
				    			$link_detail = site_url('/lapor/detail_peminjaman/'.$row->laporan_peminjaman_id);
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

	function _conv_user($pic = null, $selected = null){
		foreach($pic->result() as $row){
			if($selected == $row->pic_id){
				return $row->pic_nama;
			}
		}
	}

	function _conv_status($stat = null){
		if($stat == 0){
			return '<span class="label label-danger">Belum Dikembalikan</span>';
		}else{
			return '<span class="label label-success">Sudah Dikembalikan</span>';
		}
	}
?>