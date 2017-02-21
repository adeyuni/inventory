<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-lg-4">
					<h4>Anda Yakin Menghapus PO ini Beserta Data-Data yang Sudah Ada ? </h4>
					<a href="<?php echo site_url('rekap/process_delete_rekap/'.$rekap_id);?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-ok"></span> Ya &nbsp &nbsp &nbsp 
						</button>
					</a>
					<a href="<?php echo site_url('rekap/');?>">
						<button type="button" id="add-daftar-no-do" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Tidak
						</button>
					</a>
					<br />
					<br />
					<table class="table">
						<tr>
							<td>No</td>
							<td>Jenis Barang</td>
							<td>S/N Barang</td>
						</tr>
					
					<?php 
					$i = 0;
					$j = 1;
					if(isset($jenis)){
						
						foreach($jenis as $Jenis){
							echo "<tr>";
							echo "<td>".$j++."</td>";
							echo "<td>".$Jenis."</td>";
							echo "<td>".$sn[$i++]."</td>";
							echo "</tr>";
						}
					}
					$i =0;
					if(isset($jenisBarang)){
						foreach($jenisBarang as $Jenis){
							echo "<tr>";
							echo "<td>".$j++."</td>";
							echo "<td>".$Jenis."</td>";
							echo "<td>".$snBarang[$i++]."</td>";
							echo "</tr>";
						}
					}


					?>
					</table>
					<?php
						if(!isset($jenis) AND !isset($jenisBarang)){
							echo "tidak ada data";
						}
					?>
				</div>
			</div>			
		</div>
	</div>
