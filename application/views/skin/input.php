<script type="text/javascript">

		//select2
		$(function(){
	      // turn the element to select2 select style
	      $('.select2').select2();
	    });

		$(document).ready(function(){
			$(".form_laptop").hide();
			$(".form_imac").hide();
     		$(".form_smartphone").hide();
     		$(".form_barang").hide();
     		$(".form_lain").hide();
     		$(".form_input").hide();
     		$(".form_cpu").hide();

     		var elm = document.getElementById("jenis_barang").value;
     		if(elm == 1){
 				$(".form_laptop").hide();
 				$(".form_imac").hide();
	     		$(".form_smartphone").hide();
	     		$(".form_barang").hide();
	     		$(".form_lain").hide();
	     		$(".form_input").show();
	     		$(".form_cpu").show();
 			}
 			else if(elm == 100){
 				$(".form_laptop").show();
 				$(".form_imac").hide();
	     		$(".form_smartphone").hide();
	     		$(".form_barang").hide();
	     		$(".form_lain").hide();
	     		$(".form_input").show();
	     		$(".form_cpu").hide();
 			}
 			else if(elm == 200){
 				$(".form_laptop").hide();
 				$(".form_imac").hide();
	     		$(".form_smartphone").show();
	     		$(".form_barang").hide();
	     		$(".form_lain").hide();
	     		$(".form_input").show();
	     		$(".form_cpu").hide();
 			}else if(elm == 300){
 				$(".form_laptop").hide();
 				$(".form_imac").show();
	     		$(".form_smartphone").hide();
	     		$(".form_barang").hide();
	     		$(".form_lain").hide();
	     		$(".form_input").show();
	     		$(".form_cpu").hide();
 			}else if(elm == 999){
 				$(".form_laptop").hide();
 				$(".form_imac").hide();
	     		$(".form_smartphone").hide();
	     		$(".form_barang").hide();
	     		$(".form_lain").show();
	     		$(".form_input").show();
	     		$(".form_cpu").hide();
 			}else if(elm == ""){
 				$(".form_laptop").hide();
 				$(".form_imac").hide();
	     		$(".form_smartphone").hide();
	     		$(".form_barang").hide();
	     		$(".form_lain").hide();
	     		$(".form_input").hide();
	     		$(".form_cpu").hide();
 			}else{
 				$(".form_laptop").hide();
 				$(".form_imac").hide();
	     		$(".form_smartphone").hide();
	     		$(".form_barang").show();
	     		$(".form_lain").hide();
	     		$(".form_input").show();
	     		$(".form_cpu").hide();
 			}
     		
     		$("#jenis_barang").change(function(){
     			var elm = document.getElementById("jenis_barang").value;

     			if(elm == 1){
     				$(".form_laptop").hide();
     				$(".form_imac").hide();
		     		$(".form_smartphone").hide();
		     		$(".form_barang").hide();
		     		$(".form_lain").hide();
		     		$(".form_input").show();
		     		$(".form_cpu").show();
     			}
     			else if(elm == 100){
     				$(".form_laptop").show();
     				$(".form_imac").hide();
		     		$(".form_smartphone").hide();
		     		$(".form_barang").hide();
		     		$(".form_lain").hide();
		     		$(".form_input").show();
		     		$(".form_cpu").hide();
     			}
     			else if(elm == 200){
     				$(".form_laptop").hide();
     				$(".form_imac").hide();
		     		$(".form_smartphone").show();
		     		$(".form_barang").hide();
		     		$(".form_lain").hide();
		     		$(".form_input").show();
		     		$(".form_cpu").hide();
     			}else if(elm == 300){
	 				$(".form_laptop").hide();
	 				$(".form_imac").show();
		     		$(".form_smartphone").hide();
		     		$(".form_barang").hide();
		     		$(".form_lain").hide();
		     		$(".form_input").show();
		     		$(".form_cpu").hide();
 				}else if(elm == 999){
     				$(".form_laptop").hide();
     				$(".form_imac").hide();
		     		$(".form_smartphone").hide();
		     		$(".form_barang").hide();
		     		$(".form_lain").show();
		     		$(".form_input").show();
		     		$(".form_cpu").hide();
     			}else if(elm == ""){
     				$(".form_laptop").hide();
     				$(".form_imac").hide();
		     		$(".form_smartphone").hide();
		     		$(".form_barang").hide();
		     		$(".form_lain").hide();
		     		$(".form_input").hide();
		     		$(".form_cpu").hide();
     			}else{
     				$(".form_laptop").hide();
     				$(".form_imac").hide();
		     		$(".form_smartphone").hide();
		     		$(".form_barang").show();
		     		$(".form_lain").hide();
		     		$(".form_input").show();
		     		$(".form_cpu").hide();
     			}
     	});
     	});
	</script>