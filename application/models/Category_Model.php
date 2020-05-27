<?php
 class Category_Model extends CI_Model{

 	public function create_category($category_data){
 		/* 
 			This method is used for insert data in "category" table
			$category_data : It contain the category data and its type is Array
 		*/
		 $this->db->insert('category', $category_data); // INSERT INTO category(name, create_date, update_date, is_active) values (?, ?, ?, ?);
		 return $id = $this->db->insert_id();
	 }
	 
	 public function update_category($id, $category_data){
		/* 
 			This method is used for update data in "category" table
			$id : It contain the id of the category which is available in category table
		 */
		 
		$this->db->where('id', $id);
		$this->db->update('category', $category_data);
		return $id;
	 }
	 
	 public function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('category');
	 }

	 public function fetch_all_category(){
		 /*
			This  function is  used for fet all the data from category table of codeignitier_admin database
			Return : It will return the all records in array format
		*/
		$this->db->where('is_active', 1);
		$result = $this->db->order_by('id', 'DESC')->get('category')->result_array();
		// select * from category where is_active=1 order by id desc;
		return $result;
	 }

	 function getRow($id){
		 // This method is used for return the record of category based on given id
		$this->db->where('id', $id);
        // $row = $this->db->get('category')->row_array();
        $row = $this->db->get('category')->row();
		// SELECT * FROM category where id = $id;
		return $row;
	 }
 }

?>