<?php

class JsonModel extends CI_Model {

  public function jsonSiswaSelect2($siswa)
  {
    $this->db->select('id, concat("(",nis,") ",nama) as name');
    $this->db->like('nis',$siswa,'both');
    $this->db->or_like('nama',$siswa,'both');
    $sql = $this->db->get('siswa');

    $data = [];

    foreach ($sql->result() as $value) {
       $data[] = array(
         'id' => $value->id,
         'text' => $value->name
       );
    }

    return $data;
  }

   public function siswa()
   {
      $this->dt->select('id, nis, concat(nama," (",jk,")") as nama, concat(tempat_lahir,", ",date_format(tanggal_lahir,"%d/%m/%Y")) as ttl, alamat, concat(wali," (",telepon,") <br>",pekerjaan) as wali ');
      $this->dt->from('siswa');
      $this->dt->add_column('action',
        anchor('admin/siswa-edit/$1','<i class="fa fa-edit" title="Sunting $2" style="color:#0e46c1"></i>')." ".
        anchor('admin/siswa-delete/$1','<i class="fa fa-user-times" title="Hapus $2" style="color:#e84040"></i>','onclick="jaravscript: return confirm(\'Apakah anda ingin menghapus siswa?\')"'),'id,nis'
      );

      return $this->dt->generate();
   }

   public function beasiswa()
   {
     $this->dt->select('beasiswa.id as id, concat("(",siswa.nis,") ",siswa.nama) as siswa, tahun_akademik, nem, prestasi, penghasilan, tanggungan, jarak_rumah ');
     $this->dt->from('beasiswa');
     $this->dt->join('siswa','beasiswa.siswa = siswa.id');
     $this->dt->add_column('action',

       anchor('admin/beasiswa-delete/$1','<i class="fa fa-times" title="Hapus $2" style="color:#e84040"></i>','onclick="jaravscript: return confirm(\'Apakah anda ingin menghapus beasiswa?\')"'),'id,siswa'
     );

     return $this->dt->generate();
   }
}
