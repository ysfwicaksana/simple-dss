<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('JsonModel','json');
    $this->load->library('pdf');
    if($this->session->level != 1){
      redirect('app');
    }
  }

  public function index()
  {
      $data = [
        'title' => 'Dashboard Admin',
        'siswa' => $this->crud->all('siswa')->num_rows(),
        'beasiswa' => $this->crud->all('beasiswa')->num_rows()

      ];
      $this->template->render('admin/dashboard',$data);
  }

  public function siswa()
  {
    $data = [
      'title' => 'Kelola Siswa'
    ];
      $this->template->render('admin/siswa',$data);
  }

  public function siswa_store()
  {

    $rules = [];
    if($this->input->post('method') == 'create') {

      $rules = [

        [
          'field' => 'nis',
          'label' => 'NIS',
          'rules' => 'required|is_unique[siswa.nis]|max_length[10]'
        ],

        [
          'field' => 'nama',
          'label' => 'Nama lengkap',
          'rules' => 'required'
        ],
        [
          'field' => 'tempat_lahir',
          'label' => 'Tempat lahir',
          'rules' => 'required'
        ],
        [
          'field' => 'tanggal_lahir',
          'label' => 'Tanggal lahir',
          'rules' => 'required'
        ],
        [
          'field' => 'jk',
          'label' => 'Jenis Kelamin',
          'rules' => 'required'
        ],
        [
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        [
          'field' => 'wali',
          'label' => 'Wali murid',
          'rules' => 'required'
        ],
        [
          'field' => 'pekerjaan',
          'label' => 'Pekerjaan',
          'rules' => 'required'
        ],
        [
          'field' => 'telepon',
          'label' => 'Nomor telepon',
          'rules' => 'required'
        ],
      ];

    } else {
      $rules = [

        [
          'field' => 'nama',
          'label' => 'Nama lengkap',
          'rules' => 'required'
        ],
        [
          'field' => 'tempat_lahir',
          'label' => 'Tempat lahir',
          'rules' => 'required'
        ],
        [
          'field' => 'tanggal_lahir',
          'label' => 'Tanggal lahir',
          'rules' => 'required'
        ],
        [
          'field' => 'jk',
          'label' => 'Jenis Kelamin',
          'rules' => 'required'
        ],
        [
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        [
          'field' => 'wali',
          'label' => 'Wali murid',
          'rules' => 'required'
        ],
        [
          'field' => 'pekerjaan',
          'label' => 'Pekerjaan',
          'rules' => 'required'
        ],
        [
          'field' => 'telepon',
          'label' => 'Nomor telepon',
          'rules' => 'required'
        ],
      ];
    }


    $this->form_validation->set_rules($rules);
    if($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('notify',notify('danger',validation_errors()));
      redirect('admin/siswa');
    } else {

      if($this->input->post('method') == 'create') {

        $record = [
          'nis' => $this->input->post('nis'),
          'nama' => $this->input->post('nama'),
          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tanggal_lahir' => $this->input->post('tanggal_lahir'),
          'jk' => $this->input->post('jk'),
          'alamat' => $this->input->post('alamat'),
          'wali' => $this->input->post('wali'),
          'pekerjaan' => $this->input->post('pekerjaan'),
          'telepon' => $this->input->post('telepon')
        ];

        $this->crud->insert('siswa',$record);
        $this->session->set_flashdata('notify',notify('success','Siswa berhasil ditambah'));
        redirect('admin/siswa');

      } else {

        $record = [
          'nama' => $this->input->post('nama'),
          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tanggal_lahir' => $this->input->post('tanggal_lahir'),
          'jk' => $this->input->post('jk'),
          'alamat' => $this->input->post('alamat'),
          'wali' => $this->input->post('wali'),
          'pekerjaan' => $this->input->post('pekerjaan'),
          'telepon' => $this->input->post('telepon')
        ];

        $this->crud->update('siswa',$record,'id',$this->input->post('id'));
        $this->session->set_flashdata('notify',notify('success','Siswa berhasil disunting'));
        redirect('admin/siswa');
      }


    }
  }

  public function siswa_edit($id)
  {
    $data = [
      'title' => 'Sunting Siswa',
      'id' => $id,
      'set' => $this->crud->get('siswa',['id' => $id])->row()
    ];

    $this->template->render('admin/edit-siswa',$data);

  }

  public function siswa_delete($id)
  {
     $this->crud->delete('users','id',$id);
     $this->session->set_flashdata('notify',notify('success','Siswa berhasil dihapus'));
     redirect('admin/siswa');

  }

  public function jsonSiswaSelect2()
  {
    $result = $this->json->jsonSiswaSelect2($this->input->post('siswa'));

    echo json_encode($result);
  }



  public function beasiswa()
  {
    $data = [
      'title' => 'Kelola Beasiswa',
    ];

    $this->template->render('admin/beasiswa',$data);
  }

  public function beasiswa_store()
  {
     $rules = [
       [
         'field' => 'tahun_akademik',
         'label' => 'Tahun Akademik',
         'rules' => 'required'
       ],
       [
         'field' => 'siswa',
         'label' => 'Siswa',
         'rules' => 'required'
       ],
       [
         'field' => 'nem',
         'label' => 'NEM SMP',
         'rules' => 'required'
       ],
       [
         'field' => 'prestasi',
         'label' => 'Prestasi Akademik/Non Akademik',
         'rules' => 'required'
       ],
       [
         'field' => 'penghasilan',
         'label' => 'Penghasilan Orang Tua',
         'rules' => 'required'
       ],
       [
         'field' => 'tanggungan',
         'label' => 'Tanggungan Orang Tua',
         'rules' => 'required'
       ],
       [
         'field' => 'jarak_rumah',
         'label' => 'Jarak Rumah',
         'rules' => 'required'
       ]

     ];

     $this->form_validation->set_rules($rules);
     if ($this->form_validation->run() == FALSE) {
       $this->session->set_flashdata('notify',notify('danger',validation_errors()));
       redirect('admin/beasiswa');
     } else {


        $check = $this->crud->get('beasiswa',['tahun_akademik' => $this->input->post('tahun_akademik'), 'siswa' => $this->input->post('siswa')])->row();
        if($check){
          $this->session->set_flashdata('notify',notify('danger',"Siswa ini telah mendaftar beasiswa di tahun akademik yang diinput"));
          redirect('admin/beasiswa');
        } else {

           $beasiswa = [
             'tahun_akademik' => $this->input->post('tahun_akademik'),
             'siswa' => $this->input->post('siswa'),
             'nem' => $this->getNem($this->input->post('nem')),
             'prestasi' => $this->getPrestasi($this->input->post('prestasi')),
             'penghasilan' => $this->getPenghasilan($this->input->post('penghasilan')),
             'tanggungan' => $this->getTanggungan($this->input->post('tanggungan')),
             'jarak_rumah' => $this->getJarak($this->input->post('jarak_rumah'))
           ];

           $result = $this->crud->insert_latest('beasiswa',$beasiswa);

           $matriks = [
             'beasiswa' => $result,
             'nem' => $this->input->post('nem'),
             'prestasi' => $this->input->post('prestasi'),
             'penghasilan' => $this->input->post('penghasilan'),
             'tanggungan' => $this->input->post('tanggungan'),
             'jarak_rumah' => $this->input->post('jarak_rumah')
           ];

           $this->crud->insert('matrik_keputusan',$matriks);
           $this->session->set_flashdata('notify',notify('success',"Pendaftaran beasiswa berhasil disimpan"));
           redirect('admin/beasiswa');
        }

     }
  }

  private function getNem($nem)
  {
     if ($nem == 1) {

        $nemText = 'Diatas 36.00';

     } elseif ($nem == 0.75) {

        $nemText = '35.99 - 32.00';

     } elseif ($nem == 0.5) {

       $nemText = '31.99 - 25.00';

     } else {
       $nemText = 'Dibawah 24.99';
     }

     return $nemText;

  }

  private function getPenghasilan($nem)
  {
     if ($nem == 1) {

        $nemText = 'Dibawah Rp.800.000,-';

     } elseif ($nem == 0.75) {

        $nemText = 'Rp.800.000 - 1.500.000,-';

     } elseif ($nem == 0.5) {

       $nemText = 'Rp.1.500.000 - 3.000.000,-';

     } else {
       $nemText = 'Diatas Rp.3.000.000,-';
     }

     return $nemText;

  }

  public function getPrestasi($nem)
  {
    if ($nem == 1) {

       $nemText = 'Tingkat Nasional';

    } elseif ($nem == 0.8) {

       $nemText = 'Tingkat Provinsi';

    } elseif ($nem == 0.6) {

      $nemText = 'Tingkat Kabupaten';

    } elseif ($nem == 0.4) {
      $nemText = 'Tingkat Kecamatan';

    } else {

      $nemText = 'Tidak Berprestasi';
    }

    return $nemText;
  }

  public function getTanggungan($nem)
  {
    if ($nem == 1) {

       $nemText = 'Lebih dari 5 anak';

    } elseif ($nem == 0.8) {

       $nemText = '4 anak';

    } elseif ($nem == 0.6) {

      $nemText = '3 anak';

    } elseif ($nem == 0.4) {
      $nemText = '2 anak';

    } else {

      $nemText = '1 anak';
    }

    return $nemText;
  }

  private function getJarak($jarak)
  {
     if ($jarak == 0.33) {
        $jarak = 'Dekat';
     } elseif ($jarak == 0.66) {
       $jarak = 'Sedang';
     } else {
       $jarak = 'Jauh';
     }

     return $jarak;
  }

  public function beasiswa_delete($id)
  {
     $this->crud->delete('beasiswa','id',$id);
     $this->session->set_flashdata('notify',notify('success',"Beasiswa berhasil dihapus"));
     redirect('admin/beasiswa');
  }

  public function penentuan_beasiswa()
  {
     $data = [
       'title' => 'Penentuan Beasiswa',
       'ta' => $this->db->select('tahun_akademik')->group_by('tahun_akademik')->get('beasiswa')->result()
     ];

     $this->template->render('admin/penentuan-beasiswa',$data);
  }

  public function spk_saw()
  {

      $getIdBeasiswa = $this->db->select('siswa.nis as nis, siswa.nama as nama, matrik_keputusan.nem as nem, matrik_keputusan.prestasi as prestasi, matrik_keputusan.penghasilan as penghasilan, matrik_keputusan.tanggungan as tanggungan, matrik_keputusan.jarak_rumah as jarak_rumah')
                                ->from('matrik_keputusan')
                                ->join('beasiswa','beasiswa.id = matrik_keputusan.beasiswa')
                                ->join('siswa','siswa.id = beasiswa.siswa')
                                ->where('beasiswa.tahun_akademik',$this->input->post('ta'))->order_by('siswa.nis','ASC')->get()->result();

      $maxMin = $this->maxMin($this->input->post('ta'));

      $hasil = array();
      $hasil2 = array();
      $res = array();

      foreach ($getIdBeasiswa as $key => $value) {

        $biodata = [
          'nis' => $value->nis,
          'nama' => $value->nama
        ];

        // Normalisasi
        $nem = $value->nem / $maxMin->max_nem;
        $prestasi = $value->prestasi / $maxMin->max_prestasi;
        $penghasilan = $maxMin->min_penghasilan / $value->penghasilan;
        $tanggungan = $maxMin->min_tanggungan / $value->tanggungan;
        $jarak = $maxMin->min_jarak / $value->jarak_rumah;

        //Pemberian Bobot Kriteria berdasarkan tingkat kepentingan dari kriteria
        // 1 = C1 sangat tinggi
        // 0.6 = C2 Sedang
        // 0.8 = C3 tinggi
        // 0.8 = C4 tinggi
        // 0.4 = C5 rendah
        $res = (1 * $nem) + (0.6 * $prestasi) + (0.8 * $penghasilan) + (0.8 * $tanggungan) + (0.4 * $jarak);

        $nilai = [

          'nilai' => round($res,2)
        ];


        $hasil = $biodata + $nilai;

        array_push($hasil2,$hasil);


      }


      $data = [
        'title' => 'Hasil Penentuan Beasiswa',
        'hasil' => $hasil2,
        'ta' => $this->input->post('ta')
      ];

      $this->template->render('admin/hasil-beasiswa',$data);

  }

  public function cetak_hasil($tahun)
  {
    $getIdBeasiswa = $this->db->select('siswa.nis as nis, siswa.nama as nama, matrik_keputusan.nem as nem, matrik_keputusan.prestasi as prestasi, matrik_keputusan.penghasilan as penghasilan, matrik_keputusan.tanggungan as tanggungan, matrik_keputusan.jarak_rumah as jarak_rumah')
                              ->from('matrik_keputusan')
                              ->join('beasiswa','beasiswa.id = matrik_keputusan.beasiswa')
                              ->join('siswa','siswa.id = beasiswa.siswa')
                              ->where('beasiswa.tahun_akademik',$tahun)->order_by('siswa.nis','ASC')->get()->result();

    $maxMin = $this->maxMin($tahun);

    $hasil = array();
    $hasil2 = array();
    $res = array();

    foreach ($getIdBeasiswa as $key => $value) {

      $biodata = [
        'nis' => $value->nis,
        'nama' => $value->nama
      ];

      // Normalisasi
      $nem = $value->nem / $maxMin->max_nem;
      $prestasi = $value->prestasi / $maxMin->max_prestasi;
      $penghasilan = $maxMin->min_penghasilan / $value->penghasilan;
      $tanggungan = $maxMin->min_tanggungan / $value->tanggungan;
      $jarak = $maxMin->min_jarak / $value->jarak_rumah;

      //Pemberian Bobot Kriteria berdasarkan tingkat kepentingan dari kriteria
      // 1 = C1 sangat tinggi
      // 0.6 = C2 Sedang
      // 0.8 = C3 tinggi
      // 0.8 = C4 tinggi
      // 0.4 = C5 rendah
      $res = (1 * $nem) + (0.6 * $prestasi) + (0.8 * $penghasilan) + (0.8 * $tanggungan) + (0.4 * $jarak);

      $nilai = [

        'nilai' => round($res,2)
      ];


      $hasil = $biodata + $nilai;

      array_push($hasil2,$hasil);


    }


    $data = [
      'title' => 'Hasil Penentuan Beasiswa',
      'hasil' => $hasil2,
      'ta' => $tahun
    ];

    $this->pdf->setPaper('A4','potrait');
    $this->pdf->filename = "hasil-beasiswa.pdf";
    $this->pdf->load_view('admin/cetak-hasil',$data);
  }

  private function maxMin($ta)
  {
     $result = $this->db->select('max(matrik_keputusan.nem) as max_nem, max(matrik_keputusan.prestasi) as max_prestasi, min(matrik_keputusan.penghasilan) as min_penghasilan, min(matrik_keputusan.tanggungan) as min_tanggungan, min(matrik_keputusan.jarak_rumah) as min_jarak')
                        ->from('matrik_keputusan')
                        ->join('beasiswa','beasiswa.id = matrik_keputusan.beasiswa')
                        ->where('beasiswa.tahun_akademik',$ta)
                        ->get()
                        ->row();
     return $result;

  }






}
