<script type="text/javascript">
	$(document).ready(function(){
		$('.select2').select2();
	
		$("#jenis_barang").change(function(){
			var jenis_barang = $("#jenis_barang").val();

			if(jenis_barang != ""){
				location.href="<?php echo site_url('assigment/barang');?>/"+jenis_barang;
			}else{
				location.href="<?php echo site_url('assigment/barang');?>";
			}
		});

		$("#sn").change(function(){
			var jenis_barang = $("#jenis_barang").val();
			var id = $("#sn").val();

			if(id != ""){
				location.href="<?php echo site_url('assigment/barang');?>/"+jenis_barang+"/"+id;
			}else{
				location.href="<?php echo site_url('assigment/barang');?>/"+jenis_barang;
			}
		});

		$("#location").change(function(){
	    	var lokasi_utama = $("#location").val();
	    	if(lokasi_utama != ""){
	    		$("#sub-lokasi").show();
	    		$("#sub-lokasi").load('<?php echo site_url("rekap/get_sub_location/");?>'+'/'+lokasi_utama,{"lokasi_utama":lokasi_utama});
	    	}else{
	    		$("#sub-lokasi").hide();
	    	}

	    });

	});
</script>