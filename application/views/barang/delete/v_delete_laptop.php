<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-lg-6">
					<?php if($isThereRelathionship == false){ ?>
					<h4>Anda Yakin Menghapus Barang Di Bawah Ini : </h4>
					<a href="<?php echo site_url('barang/process_delete/'.$jenis_barang2.'/'.$laptop_id);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('barang/daftar/'.$jenis_barang2);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Tidak
						</button>
					</a>
					<br /><br /><br />
					<?php }else{?>
					<div class='alert bg-danger' role='alert'>
						<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>
						Barang tidak bisa di delete, karena masih terikat dengan barang lain. Coba tarik terlebih dahulu, barang-barang yang terkait dengan barang ini. <br />
						<b>
						<?php 
							$i = 0;
							foreach ($listBrg as $key => $value) {
								echo $value."<br />";
						}?>
						</b>
					</div>
					<a href="<?php echo site_url('barang/daftar/'.$jenis_barang2);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-arrow-left"></span> Kembali &nbsp &nbsp &nbsp 
						</button>
					</a>
					<br /><br />
					<?php } ?>
					
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
								<td><?php if(isset($sn_laptop)){echo $sn_laptop;}?></td>
							</tr>
							<tr>
								<td><b>Hostname Laptop</b></td>
								<td><?php if(isset($hostname)){echo $hostname;}?></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-lg-6">
					
				</div>
			</div>			
		</div>
	</div>
