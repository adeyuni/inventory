<script type="text/javascript">
	
	function get_detail(val){
		var stok_awal = $("#jml-"+val).val();
		var beredar = $("#beredar-"+val).val();

		document.getElementById("stok-awal").innerHTML = stok_awal;
		document.getElementById("jml-beredar").innerHTML = beredar;
	}

	$(document).ready(function(){
		$('.select2').select2();
		
		$("#no_po").change(function(){
	    	var no_po = $("#no_po").val();

	    	if(no_po != "" && no_po != 999999){
	    		location.href="<?php echo site_url('barang/add');?>/"+no_po;
	    	}else if(no_po == 999999){
	    		location.href="<?php echo site_url('barang/add');?>/"+no_po;
	    	}else{
	    		location.href="<?php echo site_url('barang/add');?>";
	    	}
	    });


		//for change jenis barang
		$("#jenis_barang").change(function(){
	    	var jenis_barang = $("#jenis_barang").val();
	    	var no_po = $("#no_po").val();
	    	
	    	if(no_po != "" && no_po != 999999){
	    		var dtl_barang = $("#dtl_barang").val();

	    		location.href="<?php echo site_url('barang/add');?>/"+no_po+"/"+dtl_barang+"/"+jenis_barang;
	    	}else if(no_po == 999999){

	    		location.href="<?php echo site_url('barang/add');?>/"+no_po+"/"+null+"/"+jenis_barang;
	    	}
	    });

	});
    
</script>