<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<?php if($isEditing == true){ ?>
				<a href="<?php echo site_url('admin/management/barang');?>">
					<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-pencil"></span> Tambah Barang
					</button>
				</a>
			<?php } ?>
			<div class="panel-body">
				<div class="col-lg-6">
					<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
						<tr>
							<th>No</th>
							<th>Jenis Barang</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>

					<?php
						$i = 1;
						foreach($listBarang->result() as $row){
							echo "<tr>";
							echo "<td>".$i++."</td>";
							echo "<td>".$row->nama."</td>";
							$link_edit = site_url('admin/management/barang/edit/'.$row->id);
							$link_delete = site_url('admin/management/barang/delete/'.$row->id);
						?>
								<td>
									<a href="<?php echo $link_edit;?>">
			    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
											<span class="glyphicon glyphicon-pencil"></span> Edit
										</button>
									</a>
									<?php if( ($row->id >= 1 and $row->id <= 8) || ($row->id == 100) || ($row->id == 200) || ($row->id == 300)){ }else{ ?>
									<a href="<?php echo $link_delete;?>">
			    						<!-- <button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin menghapus data ini ?')">
											<span class="glyphicon glyphicon-trash"></span> Delete
										</button> -->
										<a href="<?php echo site_url('admin/delete/jenis_barang/'.$row->id);?>">
										<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
											<span class="glyphicon glyphicon-trash"></span> Delete
										</button>
										</a>
									</a>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6">
					<h4>Tambah Jenis Barang</h4><br />
					<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
						<div class="form-group">
							<label for="no_po" class="col-sm-3 control-label">Jenis Barang</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang" value="<?php if(isset($jenis_barang)){echo $jenis_barang;}?>" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-4">
						  		<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
