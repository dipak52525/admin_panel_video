<?php

class Login_Model extends CI_Model
{
	public function is_validate($username, $password)
	{
		$user = $this->db->where(['username'=>$username, 'password'=>$password])
					->get('users');

		// select * from users where useername=$username and password=$password;

		if ($user->num_rows())
		{
			return $user->row()->id; // This will return the id of the varify record successfully.
		}
		else
		{
			return False;
		}
	}

	public function category_list()
	{
		// $id = $this->session->userdata('id');
		$category_list = $this->db->get('category');
		return $category_list->result();
	}
}
?>