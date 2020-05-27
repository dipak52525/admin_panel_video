<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('id'))
		// {
		// 	return redirect('admin/Admin/index');
		// }

	}
	public function index()
	{
		// Set Rules for category_list form view fields
		$this->form_validation->set_rules('uname', 'User Name', 'required|alpha');
		$this->form_validation->set_rules('pass', 'Password', 'required|max_length[12]');

		// this is useful to display all required field errors if user click on submit without fill the details.
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if ($this->form_validation->run())
		{
			// getting user input
			$uname = $this->input->post('uname');
			$pass = $this->input->post('pass');

			// load the model
			$this->load->model('Login_Model');
			$login_id = $this->Login_Model->is_validate($uname, $pass);
			if ($login_id)
			{
				// Login Data is Correct
				$this->session->set_userdata('id', $login_id);
				return redirect('Admin/welcome');
			}
			else
			{
				// Login Data is Incorrect
				return redirect('Admin/index');
			}
		} 
		else 
		{
			$this->load->view('admin/login');
		}

	}

	public function welcome()
	{
		if(!$this->session->userdata('id'))
		{
			return redirect('Admin/index');
		}
		$this->load->model('Login_Model');
		$categories = $this->Login_Model->category_list();
		$this->load->view('admin/admin_dashboard', ['categories'=>$categories]);
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		return redirect('Admin/index'); 
	}
}
