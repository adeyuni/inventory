<script type="text/javascript">
	$(document).ready(function(){
		
	//add input field
		var max_field = 20;
		var i = <?= $jmlSubLokasi; ?>;

		//untuk nomor DO
		$("#add-sub-lokasi").click(function(){
			i++;
			$("#input-sub-lokasi").append('<div><button type="button" class="del btn btn-sm btn-danger">Hapus</button><table width="100%"><tr><td width="40%">Nama Sub Lokasi</td><td><input type="text" name="sub_lokasi['+i+']" class="form-control" placeholder="Sub Lokasi"></td></tr></table></div>');
		});

		$("#input-sub-lokasi").on('click', '.del', function(){
			$(this).parent('div').remove();
		});
	});
</script>

