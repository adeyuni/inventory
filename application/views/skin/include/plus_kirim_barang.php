<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/multi-select.css')?>">
<script src="<?php echo site_url('assets/js/jquery.multi-select.js')?>"></script>

<script type="text/javascript">
	$('#barang').multiSelect();

	$('#tgl_kirim').datepicker({
	        format: "yyyy-mm-dd",
	        startDate: '-3y',
	        autoclose:true
	    });
	
	$(document).ready(function(){

		$('.select2').select2();
		
		//for change jenis barang
		$("#lokasi").change(function(){
	    	var lokasi = $("#lokasi").val();
	    	var sublokasi = $("#sublokasi").val();
	    	var jenis_barang = $("#jenis_barang").val();

	    	location.href="<?php echo site_url('lapor/pengiriman');?>/"+lokasi+"/"+sublokasi+"/"+jenis_barang;
	    });

		$("#sublokasi").change(function(){
	    	var lokasi = $("#lokasi").val();
	    	var sublokasi = $("#sublokasi").val();
	    	var jenis_barang = $("#jenis_barang").val();
	    	
	    	location.href="<?php echo site_url('lapor/pengiriman');?>/"+lokasi+"/"+sublokasi+"/"+jenis_barang;
	    });

	    $("#jenis_barang").change(function(){
	    	var lokasi = $("#lokasi").val();
	    	var sublokasi = $("#sublokasi").val();
	    	var jenis_barang = $("#jenis_barang").val();
	    	
	    	location.href="<?php echo site_url('lapor/pengiriman');?>/"+lokasi+"/"+sublokasi+"/"+jenis_barang;
	    });

	});
    
</script>