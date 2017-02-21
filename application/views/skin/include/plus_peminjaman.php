<script type="text/javascript">
	
	$(document).ready(function(){
		$('.select2').select2();

		$('#tgl_pinjam').datepicker({
	        format: "yyyy-mm-dd",
	        startDate: '-3y',
	        autoclose:true
	    });

	    $('#tgl_estimasi').datepicker({
	        format: "yyyy-mm-dd",
	        startDate: '-3y',
	        autoclose:true
	    });

	    $('#tgl_kembali').datepicker({
	        format: "yyyy-mm-dd",
	        startDate: '-3y',
	        autoclose:true
	    });
		
		//for change jenis barang
		$("#status").change(function(){
	    	var status = $("#status").val();
	    	
	    	location.href="<?php echo site_url('lapor/peminjaman/daftar');?>/"+status;
	    });

	});

	function goBack() {
	    window.history.back();
	}
    
  //   var jml = $("#jml").val();
		// for (var val = 0; val < jml; val++) {
		// 	//for change jenis barang
		// 	$( "#jenis_barang".concat(val)).change(function() {
				
		// 	  	var jenis_barang = $("#jenis_barang0").val();
			  
		// 	  //alert(jenis_barang);
		// 	  $("#rsl".concat(val)).load('<?php echo site_url('/tes/hasil');?>', {"jenis_barang":jenis_barang} );
		// 	});
		// }

</script>