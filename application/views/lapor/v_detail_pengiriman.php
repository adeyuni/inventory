<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<div class="col-lg-6">
					<?php if($status2 == 0){ ?>
					<h4>Barang sudah diterima ? </h4>
					<a href="<?php echo site_url('lapor/terima_barang/'.$mutasi_id);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('lapor/daftar_pengiriman');?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Belum
						</button>
					</a>
					<?php } ?>
					<br />
					<br />
					<table class="table">
						<tbody>
							<tr>
								<td><b>Status Pengiriman</b></td>
								<td><b><?php if(isset($status)){echo $status;}?></b></td>
							</tr>
							<tr>
								<td><b>Jenis Barang</b></td>
								<td><?php if(isset($jenis_barang)){echo $jenis_barang;}?></td>
							</tr>
							<tr>
								<td><b>Serial Number</b></td>
								<td>
									<?php 
										if(isset($sn)){
											echo "<ol>";
											foreach ($sn as $key => $value) {
												echo "<li>".$value."</li>";		
											}
											echo "</ol>";
										}else{ echo "-";}
									?>
								</td>
							</tr>
							<tr>
								<td><b>Lokasi Pengiriman</b></td>
								<td><?php if(isset($lokasi)){echo $lokasi." / ".$sublokasi;}?></td>
							</tr>
							<tr>
								<td><b>Lokasi Tujuan</b></td>
								<td><?php if(isset($lokasi_tujuan)){echo $lokasi_tujuan;}?></td>
							</tr>
							<tr>
								<td><b>PIC</b></td>
								<td><?php if(isset($pic)){echo $pic;}?></td>
							</tr>
							<tr>
								<td><b>Tanggal Kirim</b></td>
								<td><?php if(isset($tgl_kirim)){echo $tgl_kirim;}?></td>
							</tr>
							<tr>
								<td><b>Tanggal Terima</b></td>
								<td><?php if(isset($tgl_terima)){echo $tgl_terima;}?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
