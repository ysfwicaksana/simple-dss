<?php

class JsonDatatables extends CI_Controller {

   public function __construct()
   {
     parent::__construct();
     $this->load->model('JsonModel','json');
   }

   public function siswa()
   {
      echo $this->json->siswa();
   }

   public function beasiswa()
   {
     echo $this->json->beasiswa();
   }
}
