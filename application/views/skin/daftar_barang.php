<script type="text/javascript">
	$('#jenis_barang').change(function(){
		var elm = $(this).val();
		// $(location).attr('href','http://www.mysite.com/books?chapter='+chapter);
		if(elm==1){
			$(location).attr('href','<?php echo site_url("daftar_barang/cpu");?>');
		}else if(elm == 2){
			$(location).attr('href','<?php echo site_url("daftar_barang/monitor");?>');
		}
	}); 
</script>