<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<?php if($isEditing == true){ ?>
				<a href="<?php echo site_url('admin/management/lokasi');?>">
					<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-pencil"></span> Tambah Lokasi
					</button>
				</a>
			<?php } ?>
			<div class="panel-body">
				<div class="col-lg-6">
					<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
							<tr>
								<th>No</th>
								<th>Lokasi</th>
								<th>Sub Lokasi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php $i = 1; foreach($listLocation->result() as $row){?>
							<tr>
								<td><?php echo $i++;?></td>
								<td><?php echo $row->location_nama;?></td>
								<td><?php 
										$rsl = $subLocation[$row->location_id];
										echo "<ol>";
										foreach($rsl->result() as $rows){
											echo "<li>";
											echo $rows->location_dtl_nama;
										?>
										<a href="<?php echo site_url('admin/delete/sublokasi/'.$rows->location_dtl_id);?>">
				    						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger btn-xs">
												<span class="glyphicon glyphicon-trash"></span> Delete
											</button>
										</a>
										<?php
											echo "</li>";
										}
										echo "</ol>";
										$link_edit = site_url('admin/management/lokasi/edit/'.$row->location_id);
										$link_delete = site_url('admin/delete/lokasi/'.$row->location_id);
									?>
								</td>
								<td><a href="<?php echo $link_edit;?>">
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
						<?php }?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6">
					<h4>Tambah Lokasi</h4><br />
					<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
						<div class="form-group">
							<label for="lokasi_utama" class="col-sm-3 control-label">Lokasi Utama</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="lokasi_utama" name="lokasi_utama" placeholder="Lokasi Utama" value="<?php if(isset($lokasi_utama)){echo $lokasi_utama;}?>" required>
							</div>
						</div>
						<div class="form-group">
							<label for="sub_lokasi" class="col-sm-3 control-label">Sub Lokasi</label>
							<div class="col-sm-7">
								<div id="input-sub-lokasi">
									<?php
										if($isEditing==true){
											for($i=0;$i<$jmlSubLokasi;$i++){?>
													<?php if($i != 0){?>
													<!-- <a href="<?php echo site_url('admin/deleteSubLocation/'.$location_id.'/'.$location_dtl_id[$i]); ?>" onclick="return confirm('Hapus <?php echo $location_dtl_nama[$i]; ?>?')"><button type="button" class="btn btn-sm btn-danger">Hapus</button></a> -->
													<?php }?>

													<input type="hidden" name="id_sublocation[<?php $i; ?>]" value="<?php echo $location_dtl_id[$i]; ?>">
													<input type="hidden" name="jmlSubLokasi" value="<?php echo $jmlSubLokasi; ?>">
														<table width="100%">
															<tr>
																<td width="40%">Nama Sub Lokasi</td>
																<td><input type="text" name="sub_lokasi[<?php $i; ?>]" class="form-control" placeholder="Sub Lokasi" value="<?php echo $location_dtl_nama[$i]; ?>"></td>
															</tr>
														</table>
													<?php
											}
										}else{ ?>
											<table width="100%">
												<tr>
													<td width="40%">Nama Sub Lokasi</td>
													<td><input type="text" name="sub_lokasi[]" class="form-control" placeholder="Sub Lokasi"></td>
												</tr>
											</table>
										<?php }
										?>

								</div>
								<br />
								<button type="button" id="add-sub-lokasi" class="btn btn-sm btn-success">
									<span class="glyphicon glyphicon-plus"></span> Tambah Sub Lokasi
								</button>
								<br />
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
