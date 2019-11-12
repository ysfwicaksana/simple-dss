<div id="body">
  <i class="im im-graduation-hat"></i> <b>Tambah Siswa</b>

  <hr>
  <?php echo $this->session->flashdata('notify') ?>
  <?php echo form_open('admin/siswa-store') ?>
  <input type="hidden" name="method" value="update">
  <input type="hidden" name="id" value="<?php echo $id ?>">
  <table id="table">
    <tr>
      <td>NIS <sup><font color="red">*</font></sup></td>
      <td>:</td>
      <td><input type="text" name="nis" value="<?php echo $set->nis ?>" disabled></td>
      <td>Wali Murid</td>
      <td>:</td>
      <td><input type="text" name="wali" value="<?php echo $set->wali ?>" ></td>
    </tr>
    <tr>
      <td>Nama Lengkap</td>
      <td>:</td>
      <td><input type="text" name="nama" value="<?php echo $set->nama ?>" ></td>
      <td>Pekerjaan Wali Murid</td>
      <td>:</td>
      <td><input type="text" name="pekerjaan" value="<?php echo $set->pekerjaan ?>" ></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td>:</td>
      <td><input type="text" name="tempat_lahir" value="<?php echo $set->tempat_lahir ?>" ></td>
      <td>Nomor Telepon Wali Murid</td>
      <td>:</td>
      <td><input type="text" name="telepon" value="<?php echo $set->telepon ?>" ></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td>:</td>
      <td><input type="date" name="tanggal_lahir" value="<?php echo $set->tanggal_lahir ?>" ></td>
      <td></td>
      <td></td>
      <td><sup><font color="red">*</sup> NIS harus berbeda dari siswa yang lain</font></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>
        <input type="radio" name="jk" value="L" <?php echo ($set->jk == 'L') ? 'checked' : "" ?>> L
        <input type="radio" name="jk" value="P" <?php echo ($set->jk == 'P') ? 'checked' : "" ?>> P
      </td>

    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><textarea name="alamat" id="" cols="30" rows="5"><?php echo $set->alamat ?></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" value="Submit"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <?php echo form_close() ?>
