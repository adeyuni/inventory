<script type="text/javascript">
	
	$(document).ready(function(){

		$('#tgl').datepicker({
	        format: "yyyy-mm-dd",
	        startDate: '-3y',
	        autoclose:true
	    });

		$('.select2').select2();
		
		//for change jenis barang
		$("#jenis_barang").change(function(){
	    	var jenis_barang = $("#jenis_barang").val();
	    	
	    	location.href="<?php echo site_url('lapor/service');?>/"+jenis_barang;
	    });

	    //for change status barang
		$("#barang_id").change(function(){
	    	var barang_id = $("#barang_id").val();
	    	var jenis_barang = $("#jenis_barang").val();
	    	
	    	location.href="<?php echo site_url('lapor/service');?>/"+jenis_barang+"/"+barang_id;
	    });

	});
    
</script>