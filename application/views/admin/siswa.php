<div id="body">
  <i class="fa fa-graduation-cap"></i> <b>Tambah Siswa</b>

  <hr>
  <?php echo $this->session->flashdata('notify') ?>
  <?php echo form_open('admin/siswa-store') ?>
  <input type="hidden" name="method" value="create">
  <table id="table">
    <tr>
      <td>NIS <sup><font color="red">*</font></sup></td>
      <td>:</td>
      <td><input type="text" name="nis"></td>
      <td>Wali Murid</td>
      <td>:</td>
      <td><input type="text" name="wali"></td>
    </tr>
    <tr>
      <td>Nama Lengkap</td>
      <td>:</td>
      <td><input type="text" name="nama" ></td>
      <td>Pekerjaan Wali Murid</td>
      <td>:</td>
      <td><input type="text" name="pekerjaan"></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td>:</td>
      <td><input type="text" name="tempat_lahir"></td>
      <td>Nomor Telepon Wali Murid</td>
      <td>:</td>
      <td><input type="text" name="telepon"></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td>:</td>
      <td><input type="date" name="tanggal_lahir" ></td>
      <td></td>
      <td></td>
      <td><sup><font color="red">*</sup> NIS harus berbeda dari siswa yang lain</font></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>
        <input type="radio" name="jk" value="L"> L
        <input type="radio" name="jk" value="P"> P
      </td>

    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><textarea name="alamat" id="" cols="30" rows="5"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" value="Submit"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <?php echo form_close() ?>

  <i class="fa fa-graduation-cap"></i> <b>Daftar Siswa</b>
  <hr>

  <table class="display" id="master">
    <thead>
      <tr>
        <th>No.</th>
        <th>NIS</th>
        <th>Nama Lengkap</th>
        <th>Tempat, Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Wali Murid</th>
        <th>Opsi</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>

</div>

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.buttons.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/buttons.flash.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jszip.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/pdfmake.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/vfs_font.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/buttons.html5.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/buttons.print.min.js');?>" type="text/javascript"></script>
<!-- <script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>" type="text/javascript"></script> -->
<script>

$(document).ready(function(){

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
          return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
      };

  var t = $("#master").dataTable({
                  destroy: true,
                  initComplete: function() {
                      var api = this.api();
                      $('#mytable_filter input')
                              .off('.DT')
                              .on('keyup.DT', function(e) {
                                  if (e.keyCode == 13) {
                                      api.search(this.value).draw();
                          }
                      });
                  },
                  oLanguage: {
                      sProcessing: "Loading..."
                  },
                  dom: 'Bfrtip',
                  lengthMenu: [
          [ 10, 25, 50, -1 ],
          [ '10 rows', '25 rows', '50 rows', 'Show all' ]
      ],
      buttons: [
          'pageLength','copy',  'excel', 'pdf', 'print'
      ],
                  processing: true,
                  serverSide: true,
                  ajax: {"url": "<?php echo base_url('jsondatatables/siswa');?>", "type": "POST",},
                  columns: [
                          {"data": "id" },
                          {"data": "nis","bSearchable": true },
                          {"data": "nama","bSearchable": true },
                          {"data": "ttl","bSearchable": true },
                          {"data": "alamat","bSearchable": true },
                          {"data": "wali","bSearchable": true },

                          {"data": "action","bSearchable": false,"orderable" : false }
                      ],

                  order: [[0, 'desc']],
                  rowCallback: function(row, data, iDisplayIndex) {

                      var info = this.fnPagingInfo();
                      var page = info.iPage;
                      var length = info.iLength;
                      var index = page * length + (iDisplayIndex + 1);
                      $('td:eq(0)', row).html(index);
                  }
              });



  });
</script>
