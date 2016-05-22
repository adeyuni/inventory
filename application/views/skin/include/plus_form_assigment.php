<script type="text/javascript">
	$(document).ready(function(){
		$('.select2').select2();
	
		$("#jenis_barang").change(function(){
			var jenis_barang = $("#jenis_barang").val();

			if(jenis_barang != ""){
				location.href="<?php echo site_url('assigment/barang');?>/"+jenis_barang;
			}else{
				location.href="<?php echo site_url('assigment/barang');?>";
			}
		});

	});
</script>