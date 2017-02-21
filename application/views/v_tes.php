<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>change demo</title>
  <style>
  div {
    color: red;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
 
<form>
  <input class="target" type="text" value="Field 1">
  <select id="tes">
    <option value="">Pilih</option>
    <?php
      foreach($listBarang->result() as $row){
        echo "<option value='$row->id'>".$row->nama."</option>";
      }
    ?>
  </select>
</form>
<div id="other">
  Trigger the handler
</div>
<div id = "stage" style = "background-color:cc0;">
   STAGE
</div>
 
<script>
$( "#tes" ).change(function() {
  var jenis_barang = $("#tes").val();
  $("#stage").load('<?php echo site_url('/tes/hasil');?>', {"jenis_barang":jenis_barang} );
});


$( "#other" ).click(function() {
  $( ".target" ).change();
});

</script>
 
</body>
</html>