<script type="text/javascript">

	$(document).ready(function(){

		$('.select2').select2();
		
		$("#no_po").change(function(){
	    	var no_po = $("#no_po").val();

	    	if(no_po != "" && no_po != 999999){
	    		location.href="<?php echo site_url('barang/import');?>/"+no_po;
	    	}else if(no_po == 999999){
	    		location.href="<?php echo site_url('barang/import');?>/"+no_po;
	    	}else{
	    		location.href="<?php echo site_url('barang/import');?>";
	    	}
	    });

	    $("#dtl_barang").change(function(){
	    	var no_po = $("#no_po").val();
	    	var dtl_barang = $("#dtl_barang").val();
	    	
	    	location.href="<?php echo site_url('barang/import');?>/"+no_po+"/"+dtl_barang;
	    });


		//for change jenis barang
		$("#jenis_barang").change(function(){
	    	var jenis_barang = $("#jenis_barang").val();
	    	var no_po = $("#no_po").val();
	    	
	    	if(no_po != "" && no_po != 999999){
	    		var dtl_barang = $("#dtl_barang").val();

	    		location.href="<?php echo site_url('barang/import');?>/"+no_po+"/"+dtl_barang+"/"+jenis_barang;
	    	}else if(no_po == 999999){

	    		location.href="<?php echo site_url('barang/import');?>/"+no_po+"/"+null+"/"+jenis_barang;
	    	}
	    });

	});
    
</script>