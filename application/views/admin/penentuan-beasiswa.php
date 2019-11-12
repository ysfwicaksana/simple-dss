<div id="body">
  <i class="fa fa-graduation-cap"></i> <b>Penentuan Beasiswa</b>

  <hr>
  <p>Penentuan beasiswa dilakukan per tahun akademik</p>
  <?php echo $this->session->flashdata('notify') ?>
  <?php echo form_open('admin/spk-saw') ?>
  <table id="table">
    <tr>
      <td>Tahun Akademik <sup><font color="red">*</font></sup></td>
      <td>:</td>
      <td>
        <select name="ta">
          <optgroup label="Pilih Tahun Akademik">
            <?php foreach ($ta as $ta): ?>
              <option value="<?php echo $ta->tahun_akademik ?>"><?php echo $ta->tahun_akademik ?></option>
            <?php endforeach; ?>
          </optgroup>

        </select>
      </td>

    </tr>

    <tr>
      <td></td>
      <td></td>
      <td><input type="submit" value="Submit"></td>
    </tr>
  </table>
  <?php echo form_close() ?>
