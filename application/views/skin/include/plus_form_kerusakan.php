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
	    	
	    	location.href="<?php echo site_url('lapor/kerusakan');?>/"+jenis_barang;
	    });

	    //for change status barang
		$("#status").change(function(){
	    	var status = $("#status").val();
	    	var jenis_barang = $("#jenis_barang").val();
	    	
	    	location.href="<?php echo site_url('barang/daftar');?>/"+jenis_barang+"/"+status;
	    });

	});
    
</script>