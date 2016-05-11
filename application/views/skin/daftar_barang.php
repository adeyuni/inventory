<script type="text/javascript">
	$('#jenis_barang').change(function(){
		var elm = $(this).val();
		// $(location).attr('href','http://www.mysite.com/books?chapter='+chapter);
		if(elm==1){
			$(location).attr('href','<?php echo site_url("daftar_barang/cpu");?>');
		}else if(elm == 2){
			$(location).attr('href','<?php echo site_url("daftar_barang/monitor");?>');
		}else if(elm == 3){
			$(location).attr('href','<?php echo site_url("daftar_barang/keyboard");?>');
		}else if(elm == 4){
			$(location).attr('href','<?php echo site_url("daftar_barang/mouse");?>');
		}else if(elm == 5){
			$(location).attr('href','<?php echo site_url("daftar_barang/ups");?>');
		}else if(elm == 6){
			$(location).attr('href','<?php echo site_url("daftar_barang/printer");?>');
		}else if(elm == 7){
			$(location).attr('href','<?php echo site_url("daftar_barang/scanner");?>');
		}else if(elm == 100){
			$(location).attr('href','<?php echo site_url("daftar_barang/laptop");?>');
		}else if(elm == 200){
			$(location).attr('href','<?php echo site_url("daftar_barang/smartphone");?>');
		}else if(elm == 300){
			$(location).attr('href','<?php echo site_url("daftar_barang/imac");?>');
		}else if(elm == 999){
			$(location).attr('href','<?php echo site_url("daftar_barang/lain");?>');
		}
	});

	

    function konfirmasi(){
		var conf = confirm("Anda yakin ingin menghapus data ini ?");
		if(conf == true){
			return true;
		}
		else{
			return false;
		}
	}

</script>