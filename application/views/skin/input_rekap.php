<script type="text/javascript">
	$(document).ready(function(){
		
	//add input field
		var max_field = 20;
		var i = <?= $jmlBarang; ?>;
		$("#add-field").click(function(){
			i++;
			$("#input-wrapper").append('<div><button type="button" class="del btn btn-sm btn-danger">Hapus</button><table width="100%"><tr><td width="25%">Nama Barang</td><td><input type="text" name="nama_barang[]" class="form-control" placeholder="Nama Barang" required></td></tr><tr><td width="25%">Harga</td><td><input type="text" name="harga[]" class="form-control" placeholder="Harga Barang" required></td></tr><tr><td width="25%">Jumlah</td><td><input type="number" name="jml[]" class="form-control" placeholder="Jumlah Barang" required></td></tr></table></div>');
		});
		$("#input-wrapper").on('click', '.del', function(){
			$(this).parent('div').remove();
		});
	});
</script>

