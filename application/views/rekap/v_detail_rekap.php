<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-lg-9">
					<a href="<?php echo site_url($url_edit);?>">Edit Data</a>
					<br />
					<br />
					<table class="table">
						<tbody>
							<tr>
								<td><b>NO PO</b></td>
								<td><?php if(isset($no_po)){echo $no_po;}?></td>
							</tr>
							<tr>
								<td><b>RINCIAN DO</b></td>
								<td><table class="table">
										<tr>
											<th>No</th>
											<th>No DO</th>
											<th>Keterangan</th>
										</tr>
									<?php 
										$i=1;
										foreach ($detailDO->result() as $row) {
											echo "<tr>";
											echo "<td>".$i++."</td>";
											echo "<td>".$row->do_dtl_no_do."</td>";
											echo "<td>".$row->do_dtl_ket."</td>";
											echo "</tr>";
										}
									?>
									</table>
								</td>
							</tr>
							<tr>
								<td><b>RINCIAN BARANG</b></td>
								<td><table class="table">
										<tr>
											<th>No</th>
											<th>Nama Barang</th>
											<th>Harga</th>
											<th>Jumlah Beli</th>
											<th>Jumlah Beredar</th>
											<th>Sisa</th>
											<th>Type</th>
											<th>Merk</th>
										</tr>
									<?php 
										$j=1;
										for($i=0; $i<$jmlDtl; $i++) {
											echo "<tr>";
											echo "<td>".$j++."</td>";
											echo "<td>".$dtl_nama[$i]."</td>";
											echo "<td>".$dtl_harga[$i]."</td>";
											echo "<td>".$dtl_jml[$i]."</td>";
											echo "<td>".$dtl_beredar[$i]."</td>";
											echo "<td>".$dtl_sisa[$i]."</td>";
											echo "<td>".$dtl_type[$i]."</td>";
											echo "<td>".$dtl_merk[$i]."</td>";
											echo "</tr>";
										}
									?>
									</table>
								</td>
							</tr>
							<tr>
								<td><b>NO CP</b></td>
								<td><?php if(isset($no_cp)){echo $no_cp;}?></td>
							</tr>
							<tr>
								<td><b>VENDOR</b></td>
								<td><?php if(isset($vendor)){echo $vendor;}?></td>
							</tr>
							<tr>
								<td><b>DITERIMA SUPPLIER</b></td>
								<td><?php if(isset($diterima_supplier)){echo $diterima_supplier;}?></td>
							</tr>
							<tr>
								<td><b>INVOICE</b></td>
								<td><?php if(isset($invoice)){echo $invoice;}?></td>
							</tr>
							<tr>
								<td><b>TANGGAL TERIMA</b></td>
								<td><?php if(isset($tgl_terima)){echo $tgl_terima;}?></td>
							</tr>
							<tr>
								<td><b>LOKASI</b></td>
								<td><?php if(isset($location)){echo $location." / ".$sub_location;} else{echo "-";}?></td>
							</tr>
							<tr>
								<td><b>Created by / Time</b></td>
								<td><?php if(isset($creator)){echo $creator." / ".$time_create;}?></td>
							</tr>
							<tr>
								<td><b>Edited by / Time</b></td>
								<td><?php if(isset($editor)){echo $editor." / ".$time_edit;}else{echo "-";}?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
