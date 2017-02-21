<script type="text/javascript">
	$(document).ready(function(){
	
	$('#tgl_terima').datepicker({
	        format: "yyyy-mm-dd",
	        startDate: '-3y',
	        autoclose:true
	    });

	//add input field
		var max_field = 20;
		var i = <?= $jmlBarang; ?>;
		var j = <?= $jmlDO; ?>;

		//untuk detail barang
		$("#add-field").click(function(){
			i++;
			$("#input-wrapper").append('<div><button type="button" class="del btn btn-sm btn-danger">Hapus</button><table width="100%"><tr><td width="25%">Nama Barang</td><td><input type="text" name="nama_barang[]" class="form-control" placeholder="Nama Barang" required></td></tr><tr><td width="25%">Harga</td><td><input type="text" name="harga[]" class="form-control" placeholder="Harga Barang" required></td></tr><tr><td width="25%">Jumlah</td><td><input type="number" name="jml[]" class="form-control" placeholder="Jumlah Barang" required></td></tr><tr><td width="25%">Type</td><td><input type="text" name="type[]" class="form-control" placeholder="Type Barang"></td></tr><tr><td width="25%">Merk</td><td><input type="text" name="merk[]" class="form-control" placeholder="Merk Barang"></td></tr></table></div>');
		});

		$("#input-wrapper").on('click', '.del', function(){
			$(this).parent('div').remove();
		});


		//untuk nomor DO
		$("#add-daftar-no-do").click(function(){
			i++;
			$("#input-do").append('<div><button type="button" class="del btn btn-sm btn-danger">Hapus</button><table width="100%"><tr><td width="25%">NO DO</td><td><input type="text" name="no_do[]" class="form-control" placeholder="No DO" required></td></tr><tr><td width="25%">Keterangan</td><td><input type="text" name="ket[]" class="form-control" placeholder="Keterangan" required><input type="hidden" name="is_do" id="is_do" value="1"></td></tr></table></div>');
		});

		$("#input-do").on('click', '.del', function(){
			$(this).parent('div').remove();
		});

		$("#lokasi").change(function(){
	    	var lokasi_utama = $("#lokasi").val();
	    	if(lokasi_utama != ""){
	    		$("#sub-lokasi").show();
	    		$("#sub-lokasi").load('<?php echo site_url("rekap/get_sub_location/");?>'+'/'+lokasi_utama,{"lokasi_utama":lokasi_utama});
	    	}else{
	    		$("#sub-lokasi").hide();
	    	}

	    });
	});
</script>

