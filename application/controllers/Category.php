<?php

class Category extends CI_Controller{

	public function __construct(){
		parent::__construct();
		//Load the model
		$this->load->model("Category_Model");
	}

	function loadCreateCategoryFormFields(){
        // This function is return the create category form data in html in ajax for rendering the form in modalLaunchCategory
		$html = $this->load->view('admin/create_category_form', '', true);
		$response['html'] = $html;
		echo json_encode($response);
	}

    function insertCategory()
    {
		// This methid is used for processing of inserting records in database.

		// set rules for category form fields
        $this->form_validation->set_rules('category_name', "Category Name", "required");

        if($this->form_validation->run())
        {
			// Save Category Data into Database
			$categoryArray = array(
                "categ_name" => $this->input->post("category_name"),
                'sort_by' => $this->input->post('sort_by')
            );
            
            if(!empty($_FILES['imageUpload']['name']))
            {
                $upload = $this->_do_upload();
                $categoryArray['image'] = $upload;
            }
            
			$id = $this->Category_Model->create_category($categoryArray);

			$row = $this->Category_Model->getRow($id);
			$category["category"] = $row;
			$rowHtml = $this->load->view('admin/category_list_rowdata', $category, true);

			$response = array();
			$response["status"] = 1;
			$response["rowHtml"] = $rowHtml;
			$response["message"] = "<div class=\"alert alert-success\"> Category Added Successfully.</div>";
        } 
        else
        {
			// return Error Messages
			$response = array(
                "status" => 0,
                "categ_name" => 0,
				"name" => strip_tags(form_error('category_name'))
			);
        }

		echo json_encode($response);
    }
	
	function updateCategory(){
		// This methid is used for processing of updating records in database.
	
        // get whole row from db using id getting by form
		$id = $this->input->post('id');
        $row = $this->Category_Model->getRow($id);
        
		$response = array();
		if (empty($row)){
			$response["status"] = 100;
			$response["msg"] = "Record is not found in DB or may be deleted.";
			json_encode($response);
			exit;
        }
        
		// set rules for category form fields
		$this->form_validation->set_rules('category_name', "Category Name", "required");
		
		if($this->form_validation->run()){
			// $now = new DateTime();
			$current_date_time = new DateTime();
			$is_active = 1;
			
			if(!isset($_POST["is_active"])){
				$is_active = 0;
				// $response["is_active"] = 0; This is used for remove the row if the user unchecked the active checkbox
			}

			// Save Category Data into Database
			$categoryArray = array(
				"categ_name" => $this->input->post("category_name"),
				"is_active" => $is_active,
				"updated_at" => $current_date_time->format('Y-m-d H:i:s'),
				'sort_by' => $this->input->post("sort_by")
			);

			if(!empty($_FILES['imageUpload']['name']))
            {
				$upload = $this->_do_upload();
				if($upload && file_exists('assets/category_images/'.$row->image)){
					unlink('assets/category_images/'.$row->image);
				}
                $categoryArray['image'] = $upload;
			}

			$id = $this->Category_Model->update_category($id, $categoryArray);

			$row = $this->Category_Model->getRow($id);
			// $categ_data["row"] = $row;
			// $rowHtml = $this->load->view('category_row', $categ_data, true);

			$response["status"] = 1;
			$response["rowHtml"] = $row;
			$response["message"] = "<div class=\"alert alert-success\"> Category Updated Successfully.</div>";
		} else {
			// return Error Messages
			$response = array(
				"status" => 0,
				"categ_name" => 0,
				"name" => strip_tags(form_error('category_name'))
			);
		}
		echo json_encode($response);
	}
	
	function deleteCategory($id){
		// This function is used for delete the record from DB and also remove the image from assets folder
		$row = $this->Category_Model->getRow($id);

		if (empty($row)){
			$response["status"] = 0;
			$response["msg"] = "<div class=\"alert alert-warning\"> Record already deleted from daatabase.</div>";
			echo json_encode($response);
			exit;
		} else {
			$this->Category_Model->delete_category($id);
			if ($row->image && file_exists('assets/category_images/'.$row->image)){
				unlink('assets/category_images/'.$row->image);
			}
			$response["status"] = 1;
			$response["msg"] = "<div class=\"alert alert-success\"> Record has been deleted successfully.</div>";
			echo json_encode($response);
		}

	}

    private function _do_upload()
    { 
        // This function is used for upload the file in upload_path folder and return the name of the image if image successfull upload else return error message 

        $config['upload_path']          = './assets/category_images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1024; // set max width image allowed
        $config['max_height']           = 1024; // set max height allowed
        $config['file_name']            = 'category_'.round(microtime(true) * 1000); //just milisecond timestamp fot unique name [for save the image with this name]
        $config['width'] = 75;
        $config['height'] = 50;

        // Set Preferences by calling the initialize() method. Useful if you auto-load the class. [For Exa: you have specified the 'upload' into library ]
        $this->upload->initialize($config);
       
        if(!$this->upload->do_upload('imageUpload'))
        {   
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = 0;
            $data['categ_name'] = 1;
            echo json_encode($data);
            exit();
        }    
        return $this->upload->data('file_name'); // return the new image name for storing in database
    }
    
    function editCategory($id){
        // This function is return the data for using display all data for update
        
		$row = $this->Category_Model->getRow($id);
		$data["row"] = $row;
		$html = $this->load->view('admin/edit_category_form', $data, true);
		$response['html'] = $html;
		echo json_encode($response);
	}
}

?>