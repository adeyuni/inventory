<div class="form-group">
  <label for="sn_laptop" class="col-sm-2 control-label">Serial Number Laptop</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_laptop" name="sn_laptop" placeholder="Serial Number Laptop" value="<?php if(isset($sn_laptop)){echo $sn_laptop;}?>"  >
  </div>
</div>
<div class="form-group">
  <label for="sn_hd" class="col-sm-2 control-label">Serial Number Hardisk</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_hd" name="sn_hd" placeholder="Serial Number Hardisk" value="<?php if(isset($sn_hd)){echo $sn_hd;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="sn_baterai" class="col-sm-2 control-label">Serial Number Baterai</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_baterai" name="sn_baterai" placeholder="Serial Number Baterai" value="<?php if(isset($sn_baterai)){echo $sn_baterai;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="sn_charger" class="col-sm-2 control-label">Serial Number Charger</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_charger" name="sn_charger" placeholder="Serial Number Charger" value="<?php if(isset($sn_charger)){echo $sn_charger;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="nama_laptop" class="col-sm-2 control-label">Nama Laptop</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="nama_laptop" name="nama_laptop" placeholder="Nama Laptop" value="<?php if(isset($nama_laptop)){echo $nama_laptop;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="kode_laptop" class="col-sm-2 control-label">Kode Laptop</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="kode_laptop" name="kode_laptop" placeholder="Kode Laptop" value="<?php if(isset($kode_laptop)){echo $kode_laptop;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="mon_laptop" class="col-sm-2 control-label">Monitor Ext</label>
  <div class="col-sm-4">
    <select id="mon_laptop" class="select2" name="mon_laptop" style="width:300px">
      <option>Pilih</option>
      <?php
        foreach ($listMonitor->result() as $row) {
          echo "<option value='$row->id'>".$row->sn."</option>";
        }
      ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label for="mouse_laptop" class="col-sm-2 control-label">Mouse</label>
  <div class="col-sm-4">
    <select id="mouse_laptop" name="mouse_laptop" class="select2" style="width:300px">
      <option>Pilih</option>
      <?php
        foreach ($listMouse->result() as $row) {
          echo "<option value='$row->id'>".$row->sn."</option>";
        }
      ?>
    </select>
  </div>
</div>