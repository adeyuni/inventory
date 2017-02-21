<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(isset($msg)){echo $msg;}?>
			<div class="panel-body">
				<h4>Tentukan jumlah barang yang akan dipinjam : </h4> <br />
				<form class="form-horizontal" action="<?php echo site_url($action);?>" method="POST">
					<table padding="10px">
					<?php 
					$i = 1;
					foreach($listBarang->result() as $row){
						if($i%2 != 0){
							echo "<tr>";
							echo '<td><label for="no_cp" class="col-sm-2 control-label">'.$row->nama.'</label></td>';
							echo '<td><input type="number" class="form-control" id="jml" name="jml[]" value="0" required></td>';
							echo '<input type="hidden" class="form-control" id="jenis_barang" name="jenis_barang[]" value='.$row->id.'>';
							echo '<input type="hidden" class="form-control" id="jenis_barang_nama" name="jenis_barang_nama[]" value='.$row->nama.'>';
						}else{
							echo '<td><label for="no_cp" class="col-sm-2 control-label">'.$row->nama.'</label></td>';
							echo '<td><input type="number" class="form-control" id="jml" name="jml[]" value="0" required></td>';
							echo '<input type="hidden" class="form-control" id="jenis_barang" name="jenis_barang[]" value='.$row->id.'>';
							echo '<input type="hidden" class="form-control" id="jenis_barang_nama" name="jenis_barang_nama[]" value='.$row->nama.'>';
							echo "</tr>";
						}
						$i++;
					}
					?>
					</table>
				    <br />
				    <div class="col-sm-offset-0 col-sm-4">
				      	<input type="submit" name="submit" id="submit" class="btn btn-sm btn-info" value="Submit"> <br />
					</div>
				</form>
			</div>
		</div>
	</div>


