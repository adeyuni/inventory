<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<div class="col-lg-6">
				<?php if($_SESSION["user_role"] == 1 OR $_SESSION["user_role"] == 2){?>
					<?php if($isDelete == true){?>
					<h4>Anda Yakin Menghapus Barang Di Bawah Ini : </h4>
					<a href="<?php echo site_url('barang/delete/'.$jenis_barang2.'/'.$laptop_id);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('barang/daftar/'.$jenis_barang2);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Tidak
						</button>
					</a>
					<?php }else{ ?>
					<a href="<?php echo site_url($url_edit);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-pencil"></span> Edit
						</button>
					</a> 
					<a href="<?php echo site_url($url_cetak);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-default">
							<span class="glyphicon glyphicon-print"></span> Export Data
						</button>
					</a>
					<?php }
					}?>
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
								<td><?php if(isset($sn)){echo $sn;}?></td>
							</tr>
							<tr>
								<td><b>Nama Laptop</b></td>
								<td><?php if(isset($nama_laptop)){echo $nama_laptop;}?></td>
							</tr>
							<tr>
								<td><b>Kode Laptop</b></td>
								<td><?php if(isset($kode_laptop)){echo $kode_laptop;}?></td>
							</tr>
							<tr>
								<td><b>Monitor Ext</b></td>
								<td><?php if(isset($sn_mon1)){$url_mon1 = site_url('barang/detail/2/'.$id_mon1); echo "<a href=$url_mon1>".$sn_mon1."</a>";}?></td>
							</tr>
							<tr>
								<td><b>Mouse</b></td>
								<td><?php if(isset($sn_mouse)){$url_mouse = site_url('barang/detail/4/'.$id_mouse); echo "<a href=$url_mouse>".$sn_mouse."</a>";}?></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-lg-6">
					<br /><br />
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
								<td><b>Keterangan</b></td>
								<td><?php if(isset($ket)){echo $ket;}?></td>
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
							<tr>
								<td><b>History User</b></td>
								<td><?php 
										if(isset($history)){
											echo "<ol>";
											foreach ($history as $key => $value) {
												echo "<li>".$value."</li>";		
											}
											echo "</ol>";
										}else{
											echo "-";
										}
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
