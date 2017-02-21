 <select id="sn">
    <option value="">Pilih</option>
    <?php
      foreach($listLaptop->result() as $row){
        echo "<option value='$row->laptop_id'>".$row->laptop_sn_lp."</option>";
      }
    ?>
  </select>