
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

  public function __construct()
  {
  	parent::__construct();
  }

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		 $record = [
			 'username' => $this->input->post('username'),
			 'password' => sha1($this->input->post('password'))
		 ];

		 $check = $this->crud->get('users',$record)->row();

		 if($check){

			 $createSession = [
				 'id' => $check->id,
				 'username' => $check->username,
				 'level' => $check->level
			 ];

			 $this->session->set_userdata($createSession);

			
				redirect('admin');


		 } else {
			 $this->session->set_flashdata('notify',notify('danger','Username atau Password salah'));
			 redirect('app');
		 }
	}

  public function logout()
  {
    $data = ['id','username','level'];
    $this->session->unset_userdata($data);
    redirect('app');
  }
}
