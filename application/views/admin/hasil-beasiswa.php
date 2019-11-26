<div id="body">
  <i class="fa fa-graduation-cap"></i> <b>Hasil Penentuan Beasiswa</b>
  <hr>

  <p style="color:red;font-weight:bold">Nilai yang tertinggi merupakan penerima beasiswa tahun akademik <?php echo $ta ?>/<?php echo $ta + 1 ?></p>

  
<table id="table" style="border-collapse:collapse;border:1px solid black" border="1">
  <thead>
    <tr>
      <th>No</th>
      <th>NIS</th>
      <th>Nama</th>
      <th>Nilai</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; foreach ($hasil as $value): ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $value['nis'] ?></td>
        <td><?php echo $value['nama'] ?></td>
        <td><?php echo $value['nilai'] ?></td>
      </tr>

    <?php endforeach; ?>
  </tbody>
</table>
<br>
<a href="<?php echo site_url('admin/cetak-hasil/'.$ta) ?>"><i class="fa fa-print"></i> Cetak Hasil Beasiswa</a>
