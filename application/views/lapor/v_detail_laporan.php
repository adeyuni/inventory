<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<div class="col-lg-6">
					<table class="table">
						<tbody>
							<tr>
								<td><b>Jenis Laporan</b></td>
								<td><b><?php if(isset($jenis_laporan)){echo $jenis_laporan;}?></b></td>
							</tr>
							<tr>
								<td><b>Jenis Barang</b></td>
								<td><?php if(isset($jenis_barang)){echo $jenis_barang;}?></td>
							</tr>
							<tr>
								<td><b>Serial Number</b></td>
								<td><?php if(isset($barang)){echo $barang;}?></td>
							</tr>
							<tr>
								<td><b>Tanggal Laporan</b></td>
								<td><?php if(isset($tgl)){echo $tgl;}?></td>
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
								<td><b>Keterangan</b></td>
								<td><?php if(isset($ket)){echo $ket;}?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
