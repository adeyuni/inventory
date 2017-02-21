<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">

				<div class="col-lg-7">
					<table class="table">
						<tbody>
							<tr>
								<td><b>Barang yang Di Pinjam</b></td>
								<td><?php
											 
											if(isset($jenis_barang)){
												foreach ($jenis_barang as $key=>$value) {
													echo $jenis_barang[$key]." - ".$barang[$key]."<br />";
												}
											}

										?>
								</td>
							</tr>
							<tr>
								<td><b>Tanggal Pinjam</b></td>
								<td><b><?php if(isset($tgl_pinjam)){echo $tgl_pinjam;}?></b></td>
							</tr>
							<tr>
								<td><b>Tanggal Estimasi</b></td>
								<td><?php if(isset($tgl_estimasi)){echo $tgl_estimasi;}?></td>
							</tr>
							<tr>
								<td><b>User</b></td>
								<td><?php if(isset($user)){echo $user;}?></td>
							</tr>
							<tr>
								<td><b>Penyerah</b></td>
								<td><?php if(isset($penyerah)){echo _conv_user($listPIC, $penyerah);}?></td>
							</tr>
							<tr>
								<td><b>Status</b></td>
								<td><?php if(isset($status)){echo _conv_status($status);}?></td>
							</tr>
							<tr>
								<td><b>Tanggal Kembali</b></td>
								<td><?php if(isset($tgl_kembali)){echo $tgl_kembali;}?></td>
							</tr>
							<tr>
								<td><b>Penerima</b></td>
								<td><?php if(isset($penerima)){echo _conv_user($listPIC, $penerima);}?></td>
							</tr>
							<tr>
								<td><b>Timestamp Created / Creator</b></td>
								<td><?php
									if(isset($time_create)){echo $time_create;}else{echo "-";}
									echo " / "; 
									if(isset($creator)){echo $creator;}else{echo "-";}?>
								</td>
							</tr>
							<tr>
								<td><b>Timestamp Received / Penerima</b></td>
								<td><?php
									if(isset($terima_create)){echo $terima_create;}else{echo "-";}
									echo " / "; 
									if(isset($penerima_id)){echo $penerima_id;}else{echo "-";}?>
								</td>
							</tr>
							<tr>
								<td><b>Keterangan</b></td>
								<td><?php if(isset($ket)){echo $ket;}?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-5">
					<?php if($status == 0){ ?>
						<h3>Terima Barang yang dipinjam ? </h3> <br />
						<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST">
							<div class="form-group">
								<label for="penerima" class="col-sm-4 control-label">Penerima</label>
								<div class="col-sm-8">
									<select class="select2" name="penerima" id="penerima" style="width:200px" required>
										<option value="">Pilih</option>
										<?php
											foreach ($listPIC->result() as $row) {
												echo "<option value='$row->pic_id'>".$row->pic_nama."</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
							    <label for="tgl_kembali" class="col-sm-4 control-label">Tanggal Pengembalian</label>
							    <div class="col-sm-6">
							      	<input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" placeholder="Tanggal Kembali">
							    </div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-0 col-sm-12">
							      	<input type="submit" name="submit" id="submit" class="btn btn-sm btn-info" value="Submit"> 
							      	<a href="<?php echo $url_back;?>">
										<button type="button" class="btn btn-sm btn-danger">
											<span class="glyphicon glyphicon-arrow-left"></span> Kembali
										</button>
									</a>
							      	<br />
								</div>
							</div>
						</form>
						<br />
						<br />
					<?php } ?>
				</div>
			</div>			
		</div>
	</div>

<?php

	function _conv_user($pic = null, $selected = null){
		foreach($pic->result() as $row){
			if($selected == $row->pic_id){
				return $row->pic_nama;
			}
		}
	}

	function _conv_status($stat = null){
		if($stat == 0){
			return '<span class="label label-danger">Belum Dikembalikan</span>';
		}else{
			return '<span class="label label-success">Sudah Dikembalikan</span>';
		}
	}

?>