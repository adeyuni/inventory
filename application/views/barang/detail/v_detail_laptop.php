<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $title;?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<div class="col-lg-6">
					<a href="<?php echo site_url($url_edit);?>">Edit Data</a>
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
								<td><?php if(isset($no_po)){echo $no_po;}?></td>
							</tr>
							<tr>
								<td><b>No DO</b></td>
								<td><?php if(isset($no_do)){echo $no_do;}?></td>
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
								<td><b>Serial Number Laptop</b></td>
								<td><?php if(isset($sn_lp)){echo $sn_lp;}?></td>
							</tr>
							<tr>
								<td><b>Serial Number Hardisk</b></td>
								<td><?php if(isset($sn_hd)){echo $sn_hd;}?></td>
							</tr>
							<tr>
								<td><b>Serial Number Baterai</b></td>
								<td><?php if(isset($sn_baterai)){echo $sn_baterai;}?></td>
							</tr>
							<tr>
								<td><b>Serial Number Charger</b></td>
								<td><?php if(isset($sn_charger)){echo $sn_charger;}?></td>
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
								<td><?php if(isset($sn_mon1)){echo $sn_mon1;}?></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-lg-6">
					<br />
					<br />
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
								<td><b>PIC</b></td>
								<td><?php if(isset($pic)){echo $pic;}?></td>
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
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
