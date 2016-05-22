<script type="text/javascript">
	
	function get_detail(val){
		var stok_awal = $("#jml-"+val).val();
		var beredar = $("#beredar-"+val).val();

		document.getElementById("stok-awal").innerHTML = stok_awal;
		document.getElementById("jml-beredar").innerHTML = beredar;
	}

	$("#form-dtl-barang").hide();
	$("#form-input").show();

	$(document).ready(function(){
		$('.select2').select2();
		
		$("#no_po").change(function(){
	    	var no_po = $("#no_po").val();

	    	if(no_po != "" && no_po != 999999){
	    		$("#form-dtl-barang").show();
	    		$("#form-dtl-barang").load('<?php echo site_url("barang/get_barang/");?>'+'/'+no_po,{"no_po":no_po});
	    	}else{
	    		$("#form-dtl-barang").hide();
	    	}
	    });


		//for change jenis barang
		$("#jenis_barang").change(function(){
	    	var jenis_barang = $("#jenis_barang").val();
	    	
	    	if(jenis_barang != ''){
	    		$("#form-input").show();
	    		$("#form-input").load('<?php echo site_url("barang/get_form_input/")?>' + '/'+jenis_barang);
	    		$('.select2').select2();

	    	}
	    });

	});
    
</script>