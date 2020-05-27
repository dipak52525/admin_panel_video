<?php

class Login_Model extends CI_Model
{
	public function is_validate($username, $password)
	{
		$q = $this->db->where(['username'=>$username, 'password'=>$password])
					->get('users');

		// select * from users where useername=$username and password=$password;

		if ($q->num_rows())
		{
			return $q->row()->id; // This will return the id of the varify record successfully.
		}
		else
		{
			return False;
		}
	}

	public function category_list()
	{
		// $id = $this->session->userdata('id');
		$q = $this->db->get('category');
		return $q->result();
	}
}
?>