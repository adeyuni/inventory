<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST">
					<?php 
						foreach ($jml as $key=>$value) {
							if($jml[$key] != 0){
								//echo $jenis_barang_nama[$key]."<br />";
								if($jenis_barang[$key] == 1){
									for($i=1; $i<=$jml[$key]; $i++){
										include "peminjaman/v_pinjam_cpu.php";
									}
								}elseif($jenis_barang[$key] == 100){
									for($i=1; $i<=$jml[$key]; $i++){
										include "peminjaman/v_pinjam_laptop.php";
									}
								}elseif($jenis_barang[$key] == 200){
									for($i=1; $i<=$jml[$key]; $i++){
										include "peminjaman/v_pinjam_smartphone.php";
									}
								}elseif($jenis_barang[$key] == 300){
									for($i=1; $i<=$jml[$key]; $i++){
										include "peminjaman/v_pinjam_imac.php";
									}
								}else{
									for($i=1; $i<=$jml[$key]; $i++){
										include "peminjaman/v_pinjam_barang.php";
									}
								}
							}
						}
					?>
					<div class="form-group">
					    <label for="tgl_pinjam" class="col-sm-2 control-label">Tanggal Peminjaman</label>
					    <div class="col-sm-2">
					      	<input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" placeholder="Tanggal Pinjam">
					    </div>
					</div>
					<div class="form-group">
					    <label for="tgl_estimasi" class="col-sm-2 control-label">Tanggal Estimasi Pengembalian</label>
					    <div class="col-sm-2">
					      	<input type="date" class="form-control" id="tgl_estimasi" name="tgl_estimasi" placeholder="Tanggal Estimasi">
					    </div>
					</div>
					<div class="form-group">
					    <label for="user" class="col-sm-2 control-label">User</label>
					    <div class="col-sm-3">
					      	<input type="text" class="form-control" id="user" name="user" placeholder="User">
					    </div>
					</div>
					<div class="form-group">
						<label for="penyerah" class="col-sm-2 control-label">Penyerah</label>
						<div class="col-sm-4">
							<select class="select2" name="penyerah" id="penyerah" style="width:300px" required>
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
					    <label for="ket" class="col-sm-2 control-label">Keterangan Tambahan</label>
					    <div class="col-sm-4">
					      	<textarea class="form-control" rows="3" cols="5" name="ket" id="ket" placeholder="Keterangan"></textarea>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
					  		<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


