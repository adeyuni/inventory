 <select id="sn">
    <option value="">Pilih</option>
    <?php
      foreach($listCPU->result() as $row){
        echo "<option value='$row->cpu_id'>".$row->cpu_service_tag."</option>";
      }
    ?>
  </select>