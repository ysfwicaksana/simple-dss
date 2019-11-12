<?php
class Template
{

  protected $ci;

  function __construct()
  {
    $this->ci =& get_instance();
  }

  function render($template,$data = null)
  {
    $data['header']  = $this->ci->load->view('layouts/header',$data,true);
    $data['nav']  = $this->ci->load->view('layouts/nav',$data,true);
    $data['content'] = $this->ci->load->view($template,$data,true);
    $data['footer']  = $this->ci->load->view('layouts/footer',$data,true);
    $this->ci->load->view('layouts/templates',$data);
  }
}
