
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
	</div>
</div><!--/.row-->
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
					    </div>
					  </div>
					  <div class="form-group">
							<label for="ucc_nama_kegiatan" class="col-sm-2 control-label">Rincian Barang</label>
							<div class="col-sm-4">
								<div id="input-wrapper">
									
									<?php
										if($isEditing==true){
											for($i=0;$i<$jmlBarang;$i++){
												if($i==0){
													echo '<table width="100%">
															<tr>
																<td width="25%">Nama Barang</td>
																<td><input type="text" name="nama_barang[0]" class="form-control" placeholder="Nama Barang" value='.$nama_barang[0].' required></td>
															</tr>
															<tr>
																<td width="25%">Harga</td>
																<td><input type="text" name="harga[0]" class="form-control" placeholder="Harga Barang" value='.$harga[0].' required></td>
															</tr>
															<tr>
																<td width="25%">Jumlah</td>
																<td><input type="number" name="jml[0]" class="form-control" placeholder="Jumlah Barang" value='.$jml[0].' required></td>
															</tr>
														</table>';
												}
												else{
													?>
													<a href="<?php echo site_url('rekap/deleteDtlBarang/'.$id_rekap.'/'.$id_dtl[$i]); ?>" onclick="return confirm('Hapus <?php echo $nama_barang[$i]; ?>?')"><button type="button" class="btn btn-sm btn-danger">Hapus</button></a>
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
														</table>
														
													<?php
												}
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
											</table>
										<?php }
										?>
								</div>
								<br />
								<button type="button" id="add-field" class="btn btn-sm btn-primary">
									<span class="glyphicon glyphicon-plus"></span> Tambah Barang</button>
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
					    <label for="diterima_supplier" class="col-sm-2 control-label">Diterima Supplier</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="diterima_supplier" name="diterima_supplier" placeholder="Diterima Supplier" value="<?php if(isset($diterima_supplier)){echo $diterima_supplier;}?>" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="invoice" class="col-sm-2 control-label">Invoice</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control" id="invoice" name="invoice" placeholder="Invoice" value="<?php if(isset($invoice)){echo $invoice;}?>" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="tgl_terima" class="col-sm-2 control-label">Tanggal Terima</label>
					    <div class="col-sm-2">
					      <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" placeholder="Tanggal Terima" value="<?php if(isset($tgl_terima)){echo $tgl_terima;}?>" required>
					    </div>
					  </div>
					 
					   <div class="form-group">
					    <label for="lokasi" class="col-sm-2 control-label">Lokasi</label>
					    <div class="col-sm-2">
					      <select  name="lokasi" id="lokasi" class="form-control" required>
					      	<option value="">Pilih</option>
						    <?php
								foreach ($listLocation->result() as $row) {
									if($location == $row->id){
										echo "<option value='$row->id' selected>".$row->nama."</option>";
									}
									else{
										echo "<option value='$row->id'>".$row->nama."</option>";
									}
								}
							?>
						  </select>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-4">
					      <input type="submit" name="submit" id="submit" class="btn btn-sm btn-info" value="Tambah"> <br />

					    </div>
					  </div>
				  </div>		
				</form>
			</div>
		</div>
	</div>
