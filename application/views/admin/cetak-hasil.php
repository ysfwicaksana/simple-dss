<h2>
  <center>
    <?php echo $title ?><br>
    SMK KARYA BHAKTI
  </center>
</h2>

<hr>
<p>Hasil penentuan penerima beasiswa tahun akademik <?php echo $ta ?>/<?php echo $ta + 1 ?></p>
<b style="color:red">Nilai tertinggi merupakan penerima beasiswa</b>
<table  style="border-collapse:collapse;border:1px solid black;padding:5px" border="1">
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
