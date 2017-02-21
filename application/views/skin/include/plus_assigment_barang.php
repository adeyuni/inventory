<script type="text/javascript">
	
	$(document).ready(function(){
		$('.select2').select2();
		//for change jenis barang
		$("#jenis_barang").change(function(){
	    	var jenis_barang = $("#jenis_barang").val();
	    	
	    	location.href="<?php echo site_url('assigment/daftar');?>/"+jenis_barang;
	    });
	});
    
</script>