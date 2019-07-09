<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __contsruct()
	{
		parent::__contsruct();
		check_not_login();
		$this->load->model('user_m');
	}
	
	public function index()
	{		
		$data['row'] = $this->user_m->get();
		$this->template->load('template', 'user/user_data', $data);
	}

	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fullname', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('pasconf', 'Password Confirmation', 'required|matches[passwword]', array('matches' => '%s Konfirmasi Password Tidak Sesuai Dengan Password' )

		);
		$this->form_validation->set_rules('level', 'Level', 'required');

		$this->form_validation->set_message('required', '%s Masih Kosong, Silahkan isi terlebih dahulu.');
		$this->form_validation->set_message('min_length','%s Minimal 5 karakter');
		$this->form_validation->set_message('username','%s Minimal 5 karakter');



		if ($this->form_validation->run() == FALSE){
            $this->template->load('template', 'user/user_form_add');
        	}else{
            echo "proses simpan data baru";
            }

		
	}
}
 