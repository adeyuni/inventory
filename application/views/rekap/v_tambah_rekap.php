<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<!-- <div class="panel-heading"></div> -->
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST"> 
				  	<div class="form_input">
				  	  	<div class="form-group">
					    	<label for="no_po" class="col-sm-2 control-label">No PO</label>
					    	<div class="col-sm-4">
					      		<input type="text" class="form-control" id="no_po" name="no_po" placeholder="No PO" value="<?php if(isset($no_po)){echo $no_po;}?>" required>
					      		<input type="hidden" name="is_do" id="is_do" value="0">
					    	</div>
					  	</div>
					  	<div class="form-group">
							<label for="rincian_do" class="col-sm-2 control-label">Rincian DO</label>
							<div class="col-sm-4">
								<div id="input-do">
									<?php
										if($isEditing==true){
											for($i=0;$i<$jmlDO;$i++){?>
													<?php if($i != 0){?>
													<a href="<?php echo site_url('rekap/deleteDO/'.$id_rekap.'/'.$no_do_id[$i]); ?>" onclick="return confirm('Hapus <?php echo $no_do[$i]; ?>?')"><button type="button" class="btn btn-sm btn-danger">Hapus</button></a>
													<?php }?>
													<table width="100%">
														<tr>
															<td width="25%">No DO</td>
															<td><input type="text" name="no_do[<?php $i; ?>]" class="form-control" placeholder="NO DO" value="<?php echo $no_do[$i]; ?>" ></td>
														</tr>
														<tr>
															<td width="25%">Keterangan</td>
															<td><input type="text" name="ket[<?php $i; ?>]" class="form-control" placeholder="Keterangan" value="<?php echo $ket[$i]; ?>" ></td>
														</tr>
													</table>
														
													<?php
											}
										}else{ ?>
											<!-- <table width="100%">
												<tr>
													<td width="25%">No DO</td>
													<td><input type="text" name="no_do[]" class="form-control" placeholder="NO DO"></td>
												</tr>
												<tr>
													<td width="25%">Keterangan</td>
													<td><input type="text" name="ket[]" class="form-control" placeholder="Keterangan"></td>
												</tr>
											</table> -->

									<?php }
										?>
								</div>
								<br />
								<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
									<span class="glyphicon glyphicon-plus"></span> Tambah NO DO
								</button>
							</div>
						</div>
					  	<div class="form-group">
							<label for="rincian_barang" class="col-sm-2 control-label">Rincian Barang</label>
							<div class="col-sm-4">
								<div id="input-wrapper">
									<?php
										if($isEditing==true){
											for($i=0;$i<$jmlBarang;$i++){?>
													<?php if($i != 0){?>
													<!-- <a href="<?php echo site_url('rekap/deleteDtlBarang/'.$id_rekap.'/'.$id_dtl[$i]); ?>" onclick="return confirm('Hapus <?php echo $nama_barang[$i]; ?>?')"><button type="button" class="btn btn-sm btn-danger">Hapus</button></a> -->
													<?php }?>
														<input type="hidden" name="id_dtl[<?php $i; ?>]" value="<?php echo $id_dtl[$i]; ?>">
														<table width="100%">
															<tr>
																<td width="25%">Nama Barang</td>
																<td><input type="text" name="nama_barang[<?php $i; ?>]" class="form-control" placeholder="Nama Barang" value="<?php echo $nama_barang[$i]; ?>" required></td>
															</tr>
															<tr>
																<td width="25%">Harga</td>
																<td><input type="text" name="harga[<?php $i; ?>]" class="form-control" placeholder="Harga Barang" value="<?php echo $harga[$i]; ?>" required></td>
															</tr>
															<tr>
																<td width="25%">Jumlah</td>
																<td><input type="number" name="jml[<?php $i; ?>]" class="form-control" placeholder="Jumlah Barang" value="<?php echo $jml[$i]; ?>" required></td>
															</tr>
															<tr>
																<td width="25%">Type</td>
																<td><input type="text" name="type[<?php $i; ?>]" class="form-control" placeholder="Type Barang" value="<?php echo $type[$i]; ?>"></td>
															</tr>
															<tr>
																<td width="25%">Merk</td>
																<td><input type="text" name="merk[<?php $i; ?>]" class="form-control" placeholder="Merk Barang" value="<?php echo $merk[$i]; ?>"></td>
															</tr>
														</table>
														<hr />
													<?php
											}
										}else{ ?>
											<table width="100%">
												<tr>
													<td width="25%">Nama Barang</td>
													<td><input type="text" name="nama_barang[]" class="form-control" placeholder="Nama Barang" required></td>
												</tr>
												<tr>
													<td width="25%">Harga</td>
													<td><input type="text" name="harga[]" class="form-control" placeholder="Harga Barang" required></td>
												</tr>
												<tr>
													<td width="25%">Jumlah</td>
													<td><input type="number" name="jml[]" class="form-control" placeholder="Jumlah Barang" required></td>
												</tr>
												<tr>
													<td width="25%">Type</td>
													<td><input type="text" name="type[]" class="form-control" placeholder="Type Barang"></td>
												</tr>
												<tr>
													<td width="25%">Merk</td>
													<td><input type="text" name="merk[]" class="form-control" placeholder="Merk Barang"></td>
												</tr>
											</table>
										<?php }
										?>
								</div>
								<?php if($isEditing==false){?>
								<br />
								<button type="button" id="add-field" class="btn btn-sm btn-primary">
									<span class="glyphicon glyphicon-plus"></span> Tambah Barang
								</button>
								<?php }?>

							</div>
						</div>
					  	<div class="form-group">
					    	<label for="no_cp" class="col-sm-2 control-label">No Contact Person</label>
					    	<div class="col-sm-4">
					      		<input type="text" class="form-control" id="no_cp" name="no_cp" placeholder="No Contact Person" value="<?php if(isset($no_cp)){echo $no_cp;}?>"  required>
					   	 	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="vendor" class="col-sm-2 control-label">Vendor</label>
					    	<div class="col-sm-4">
					      		<input type="text" class="form-control" id="vendor" name="vendor" placeholder="Vendor" value="<?php if(isset($vendor)){echo $vendor;}?>" required>
					    	</div>
					  	</div>
				  	</div>
			  	<div class="form_input">
				  	<div class="form-group">
					    <label for="diterima_supplier" class="col-sm-2 control-label">PO Sudah Diterima Supplier</label>
					    <div class="col-sm-4">
					  		<input type="radio" name="diterima_supplier" id="diterima_supplier" value="1" <?php if($diterima_supplier == 1){echo "checked";}?> required>Sudah 
  							<input type="radio" name="diterima_supplier" id="diterima_supplier" value="0" <?php if($diterima_supplier == 0){echo "checked";}?> > Belum
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="invoice" class="col-sm-2 control-label">Invoice</label>
					    <div class="col-sm-4">
					      <input type="radio" name="invoice" id="invoice" value="1" <?php if($invoice == 1){echo "checked";}?> required>Sudah 
  							<input type="radio" name="invoice" id="invoice" value="0" <?php if($invoice == 0){echo "checked";}?> > Belum
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="tgl_terima" class="col-sm-2 control-label">Tanggal Terima</label>
					    <div class="col-sm-2">
					      <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" placeholder="Tanggal Terima" value="<?php if(isset($tgl_terima)){echo $tgl_terima;}?>">
					    </div>
					  </div>
					 
					  <div class="form-group">
					    <label for="lokasi" class="col-sm-2 control-label">Lokasi</label>
					    <div class="col-sm-2">
					      <select  name="lokasi" id="lokasi" class="form-control">
					      	<option value="">Pilih</option>
							    <?php
									foreach ($listLocation->result() as $row) {
										if($location == $row->location_id){
											echo "<option value='$row->location_id' selected>".$row->location_nama."</option>";
										}
										else{
											echo "<option value='$row->location_id'>".$row->location_nama."</option>";
										}
									}
									?>
							  </select>
					    </div>
					  </div>
						<div id="sub-lokasi">
							<?php if($sub_lokasi != 0){?>
								<div class="form-group">
							    <label for="lokasi" class="col-sm-2 control-label">Sub Lokasi</label>
							    <div class="col-sm-2">
							      	<select  name="sub_lokasi" id="sub_lokasi" class="form-control">
							      		<option value="">Pilih</option>
									    <?php
											foreach ($listSubLocation->result() as $row) {
												if($sub_lokasi == $row->location_dtl_id){
													echo "<option value='$row->location_dtl_id' selected>".$row->location_dtl_nama."</option>";
												}
												else{
													echo "<option value='$row->location_dtl_id'>".$row->location_dtl_nama."</option>";
												}
											}
										?>
									</select>
							    </div>
							 </div>
							<?php } ?>
						</div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-4">
					      <input type="submit" name="submit" id="submit" class="btn btn-sm btn-info" value="Submit"> <br />

					    </div>
					  </div>
				  </div>		
				</form>
			</div>
		</div>
	</div>
