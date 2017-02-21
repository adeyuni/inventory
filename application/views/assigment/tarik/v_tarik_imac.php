<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<div class="col-lg-6">
					<h4>Anda Yakin Melakukan Penarikan Barang Dibawah ini : </h4>
					<a href="<?php echo site_url('assigment/process_tarik/'.$jenis_barang.'/'.$as_imac_id);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('barang/daftar/'.$jenis_barang.'/1');?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Tidak
						</button>
					</a>
					<br />
					<br />
					<table class="table">
						<tbody>
							<tr>
								<td><b>Jenis Barang</b></td>
								<td><?php if(isset($jenis_barang)){echo $jenis_barang;}?></td>
							</tr>
							<tr>
								<td><b>No PO</b></td>
								<td><?php if(isset($no_po)){ $url_po = site_url('rekap/detail/'.$id_po); echo "<a href=$url_po>".$no_po."</a>";}?></td>
							</tr>
							<tr>
								<td><b>No Asset</b></td>
								<td><?php if(isset($no_asset)){echo $no_asset;}?></td>
							</tr>
							<tr>
								<td><b>No IT</b></td>
								<td><?php if(isset($no_it)){echo $no_it;}?></td>
							</tr>
							<tr>
								<td><b>Serial Number</b></td>
								<td><?php if(isset($sn_imac)){echo $sn_imac;}?></td>
							</tr>
							<tr>
								<td><b>Nama IMAC</b></td>
								<td><?php if(isset($imac_nama)){echo $imac_nama;}?></td>
							</tr>
							<tr>
								<td><b>Keyboard</b></td>
								<td><?php if(isset($sn_keyboard)){echo $sn_keyboard;}?></td>
							</tr>
							<tr>
								<td><b>Mouse</b></td>
								<td><?php if(isset($sn_mouse)){echo $sn_mouse;}?></td>
							</tr>
							<tr>
								<td><b>UPS</b></td>
								<td><?php if(isset($sn_ups)){ $url_ups = site_url('barang/detail/5/'.$id_ups); echo "<a href=$url_ups>".$sn_ups."</a>";}?></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-lg-6">
					<br /><br /><br /><br /><br />
					<table class="table">
						<tbody>
							<tr>
								<td><b>Type</b></td>
								<td><?php if(isset($type)){echo $type;}?></td>
							</tr>
							<tr>
								<td><b>Merk</b></td>
								<td><?php if(isset($merk)){echo $merk;}?></td>
							</tr>
							<tr>
								<td><b>Vendor</b></td>
								<td><?php if(isset($vendor)){echo $vendor;}?></td>
							</tr>
							<tr>
								<td><b>Tanggal Terima</b></td>
								<td><?php if(isset($tgl_terima)){echo $tgl_terima;}?></td>
							</tr>
							<tr>
								<td><b>User</b></td>
								<td><?php if(isset($user)){echo $user;}?></td>
							</tr>
							<tr>
								<td><b>Location</b></td>
								<td><?php if(isset($location)){echo $location;}?></td>
							</tr>
							<tr>
								<td><b>Tanggal Buat / Creator</b></td>
								<td><?php
									if(isset($time_create)){echo $time_create;}else{echo "-";}
									echo " / "; 
									if(isset($creator)){echo $creator;}else{echo "-";}?>
								</td>
							</tr>
							<tr>
								<td><b>Tanggal Edit / Editor</b></td>
								<td><?php
									if(isset($time_edit)){echo $time_edit;}else{echo "-";}
									echo " / "; 
									if(isset($editor)){echo $editor;}else{echo "-";}?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
