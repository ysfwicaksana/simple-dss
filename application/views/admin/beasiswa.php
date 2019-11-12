<div id="body">
  <i class="fa fa-money"></i> <b>Tambah Beasiswa</b>

  <hr>
  <?php echo $this->session->flashdata('notify') ?>
  <?php echo form_open('admin/beasiswa-store') ?>

  <table id="table">
    <tr>
      <td>Tahun Akademik <sup><font color="red">*</font></sup></td>
      <td>:</td>
      <td><input type="text" name="tahun_akademik" class="yearselect"></td>
      <td><sup> <font color="red">*TA yang dipilih -  TA yang dipilih + 1 (contoh:2019-2020)</font></sup></td>
      <td></td>
      <td></td>

    </tr>
    <tr>
      <td>Siswa</td>
      <td>:</td>
      <td><select name="siswa" id="json-siswa-select2" style="width:100%!important"></select></td>

    </tr>
    <tr>
      <td>NEM SMP</td>
      <td>:</td>
      <td>
        <select name="nem">
          <optgroup label="Pilih NEM">
            <option value="1">Diatas 36.00</option>
            <option value="0.75">35.99 - 32.00</option>
            <option value="0.5">31.99 - 25.00</option>
            <option value="0.25">Dibawah 24.99</option>
          </optgroup>

        </select>
      </td>

    </tr>
    <tr>
      <td>Prestasi Akademik/Non Akademik</td>
      <td>:</td>
      <td>
        <select name="prestasi">
          <optgroup label="Pilih Prestasi">
            <option value="0.2">Tidak Berprestasi</option>
            <option value="0.4">Tingkat Kecamatan</option>
            <option value="0.6">Tingkat Kabupaten</option>
            <option value="0.8">Tingkat Provinsi</option>
            <option value="1">Tingkat Nasional</option>
          </optgroup>
        </select>
      </td>

    </tr>
    <tr>
      <td>Penghasilan Orang Tua</td>
      <td>:</td>
      <td>
        <select name="penghasilan">
          <optgroup label="Pilih Penghasilan">
            <option value="1">Dibawah Rp.800.000,-</option>
            <option value="0.75">Rp.800.000 - 1.500.000,-</option>
            <option value="0.5">Rp.1.500.000 - 3.000.000,-</option>
            <option value="0.25">Diatas Rp.3.000.000,-</option>
          </optgroup>
        </select>
      </td>

    </tr>
    <tr>
      <td>Tanggungan Orang Tua</td>
      <td>:</td>
      <td>
        <select name="tanggungan">
          <optgroup label="Pilih Tanggungan">
            <option value="0.2">1 anak</option>
            <option value="0.4">2 anak</option>
            <option value="0.6">3 anak</option>
            <option value="0.8">4 anak</option>
            <option value="1">Lebih dari 5 anak</option>
          </optgroup>

        </select>
      </td>
    </tr>
    <tr>
      <td>Jarak Rumah</td>
      <td>:</td>
      <td>
        <select name="jarak_rumah">
          <optgroup label="Pilih Jarak Rumah">
            <option value="0.33">Dekat</option>
            <option value="0.66">Sedang</option>
            <option value="1">Jauh</option>
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

  <i class="fa fa-money"></i> <b>Daftar Beasiswa</b>
  <hr>

  <table class="display" id="master">
    <thead>
      <tr>
        <th>No.</th>
        <th>Tahun Akademik</th>
        <th>Siswa</th>
        <th>NEM SMP</th>
        <th>Prestasi Akademik/Non</th>
        <th>Penghasilan Ortu</th>
        <th>Tanggungan Ortu</th>
        <th>Jarak Rumah</th>
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
<script src="<?php echo base_url('assets/js/select2.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/year-select.js');?>" type="text/javascript"></script>

<script>

$(document).ready(function(){

  $("#json-siswa-select2").select2({

      // theme : "classic",
      allowClear : true,
      ajax : {
        type : 'post',
        dataType : 'json',
        url : '<?php echo base_url('admin/jsonSiswaSelect2');?>',
        delay : 100,
        data : function(params) {
            return {
              siswa : params.term
            };
        },
        processResults : function(data) {
          return {
            results : data
          }
        },
        cache :true
      }
    });

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
                  ajax: {"url": "<?php echo base_url('jsondatatables/beasiswa');?>", "type": "POST",},
                  columns: [
                          {"data": "id" },
                          {"data": "tahun_akademik","bSearchable": true },

                          {"data": "siswa","bSearchable": true },
                          {"data": "nem","bSearchable": true },
                          {"data": "prestasi","bSearchable": true },
                          {"data": "penghasilan","bSearchable": true },
                          {"data": "tanggungan","bSearchable": true },
                          {"data": "jarak_rumah","bSearchable": true },
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

              $('.yearselect').yearselect();



  });
</script>
