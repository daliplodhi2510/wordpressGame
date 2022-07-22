<?php 
	/**
	 * 
	 */
	class MasterController extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('admin/MasterModel');
			$this->load->model('admin/Admin_model');
			$this->load->model('admin/Filter_model');
			
         date_default_timezone_set('Asia/Calcutta'); 

		}

		public function gameView(){
      	$data["result"] = $this->MasterModel->getGameData();
			$this->load->view('admin/master/create-game',$data);
		}
		public function storeGame(){
			$data = $this->input->post();
			$getImgExtn = explode('.', $_FILES["gameFile"]['name']);
      		$fileName   = random_string('alnum',20) . "." . $getImgExtn[1];
      		// File upload configuration
   if(!empty($_FILES["gameFile"]["name"])){
            $file_extension          = pathinfo($_FILES["gameFile"]["name"], PATHINFO_EXTENSION);
               $allowed_image_extension = array(
                  "png",
                  "jpg",
                  "jpeg"
               );
               // Validate file input to check if is not empty
                 if (!file_exists($_FILES["gameFile"]["tmp_name"])) {
                     $response = array(
                         "type" => "error",
                         "message" => "Choose file to upload."
                     );
                 } // Validate file input to check if is with valid extension
                 else if (!in_array($file_extension, $allowed_image_extension)) {
                     $response = array(
                         "type" => "error",
                         "message" => "Upload valid format. Only PNG,JPG and JPEG are allowed."
                     );
                 } // Validate image file size
                 else if (($_FILES["gameFile"]["size"] > 2000000)) {
                     $response = array(
                         "type" => "error",
                         "message" => "Size exceeds 2MB"
                     );
                 } else {
                    $target     = './assets/images/gameimage/' . $fileName;
                     if (move_uploaded_file($_FILES["gameFile"]["tmp_name"], $target)) {
                        // Data insert array
                       	$dataArray = array(
                       			'title'	=> $data['gameTitle'],
                       			'banner'	=>	$fileName,
                       			'url'		=> $data['urlPackage']
		                 	);
                       	$last_id 	=  $this->MasterModel->insert('game_details',$dataArray);
                        $response = array(
                           "type" 	 => "success",
                           "message" => "Game Store Succssfully!"
                        );
                     }else{
                        $response = array(
                             "type" => "error",
                             "message" => "Problem in uploading image files."
                        );
                     }
                 }
            $this->session->set_flashdata('message', $response);
            $this->session->set_flashdata('alert-class', 'alert-success');
            redirect(base_url() . "admin/master/create-game");
         }
		}

      /*Rule Page View*/
      public function rulePageView(){
         $data["result"] = $this->MasterModel->getRules();
         $this->load->view('admin/master/rules-master',$data);
      }
      public function storeRules(){
         $data = $this->input->post();
         $dataArray = array(
            'rule_type'       =>    $data['ruleType'],
            'rule_title'      =>    $data['ruleTitle'],
            'rules'           =>    $data['rules'],
            'date_created'            =>    date('Y-m-d H:i:s')
         );
         if($this->MasterModel->insert('tbl_rules',$dataArray)){
            $response = array(
               "type"    => "success",
               "message" => "Game Store Succssfully!"
            );
         }else{
               $response = array(
                  "type" => "error",
                  "message" => "Problem in uploading image files."
               );
         }
             $this->session->set_flashdata('message', $response);
            $this->session->set_flashdata('alert-class', 'alert-success');
            redirect(base_url() . "admin/master/rules-master");
      }

      /*Delete Rules*/
      public function deleteRules($id){
         $where = "rule_id = ".$id."";
         $tableName = "tbl_rules";
         if($this->MasterModel->delete($where,$tableName)){
             $response = array(
               "type"    => "success",
               "message" => "Record Delete Succssfully!"
            );
         }else{
            $response = array(
               "type" => "error",
               "message" => "Something Went Wrong."
            );
         }
          $this->session->set_flashdata('message', $response);
            $this->session->set_flashdata('alert-class', 'alert-success');
            redirect(base_url() . "admin/master/rules-master");
      }

      public function updateRules(){
         $data = $this->input->post();
         $whereCon = "rule_id = ".$data["id"]."";
         $tableName = "tbl_rules";
           $dataArray = array(
            'rule_type'       =>    $data['ruleType'],
            'rule_title'      =>    $data['ruleTitle'],
            'rules'           =>    $data['rules'],
            'date_created'            =>    date('Y-m-d H:i:s')
         );
         if($this->MasterModel->updateData($whereCon,$tableName,$dataArray)){
            $response = array(
               "type"    => "success",
               "message" => "Record Update Succssfully!"
            );
         }else{
            $response = array(
               "type" => "error",
               "message" => "Something Went Wrong."
            );
         }
         $this->session->set_flashdata('message', $response);
         $this->session->set_flashdata('alert-class', 'alert-success');
         redirect(base_url() . "admin/master/rules-master");
      }
      /*Game Image Upload*/
      public function uploadGameImage(){
         $data["result"] = $this->MasterModel->getImages();
         $this->load->view('admin/master/upload-image',$data);
      }
      public function storeImages(){
         $data = $this->input->post();
         $getImgExtn = explode('.', $_FILES["imageFile"]['name']);
            $fileName   = random_string('alnum',20) . "." . $getImgExtn[1];
            // File upload configuration
         if(!empty($_FILES["imageFile"]["name"])){
            $file_extension          = pathinfo($_FILES["imageFile"]["name"], PATHINFO_EXTENSION);
               $allowed_image_extension = array(
                  "png",
                  "jpg",
                  "jpeg"
               );
               // Validate file input to check if is not empty
                 if (!file_exists($_FILES["imageFile"]["tmp_name"])) {
                     $response = array(
                         "type" => "error",
                         "message" => "Choose file to upload."
                     );
                 } // Validate file input to check if is with valid extension
                 else if (!in_array($file_extension, $allowed_image_extension)) {
                     $response = array(
                         "type" => "error",
                         "message" => "Upload valid format. Only PNG,JPG and JPEG are allowed."
                     );
                 } // Validate image file size
                 else if (($_FILES["imageFile"]["size"] > 2000000)) {
                     $response = array(
                         "type" => "error",
                         "message" => "Size exceeds 2MB"
                     );
                 } else {
                    $target     = './assets/images/gameimage/' . $fileName;
                     if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target)) {
                        // Data insert array
                        $dataArray = array(
                              'img_type'  => $data['imageType'],
                              'image_name' => $data["imageTitle"],
                              'image'    => $fileName,
                              'date_created'    => date('Y-m-d H:i:s')
                        );

                        $last_id    =  $this->MasterModel->insert('tbl_image',$dataArray);
                        $response = array(
                           "type"    => "success",
                           "message" => "Game Store Succssfully!"
                        );
                     }else{
                        $response = array(
                             "type" => "error",
                             "message" => "Problem in uploading image files."
                        );
                     }
                 }
            $this->session->set_flashdata('message', $response);
            $this->session->set_flashdata('alert-class', 'alert-success');
            redirect(base_url() . "admin/master/upload-image");
         }
      }

      /*Delete Images*/
      public function deleteImages($id){
         $where = "img_id = ".$id."";
         $tableName = "tbl_image";
         if($this->MasterModel->delete($where,$tableName)){
             $response = array(
               "type"    => "success",
               "message" => "Record Delete Succssfully!"
            );
         }else{
            $response = array(
               "type" => "error",
               "message" => "Something Went Wrong."
            );
         }
          $this->session->set_flashdata('message', $response);
            $this->session->set_flashdata('alert-class', 'alert-success');
            redirect(base_url() . "admin/master/upload-image");
      }

      public function updateImage(){
         $data = $this->input->post();
         $getImgExtn = explode('.', $_FILES["imageFile"]['name']);
            $fileName   = random_string('alnum',20) . "." . $getImgExtn[1];
            // File upload configuration
         if(!empty($_FILES["imageFile"]["name"])){
            $file_extension          = pathinfo($_FILES["imageFile"]["name"], PATHINFO_EXTENSION);
               $allowed_image_extension = array(
                  "png",
                  "jpg",
                  "jpeg"
               );
               // Validate file input to check if is not empty
                 if (!file_exists($_FILES["imageFile"]["tmp_name"])) {
                     $response = array(
                         "type" => "error",
                         "message" => "Choose file to upload."
                     );
                 } // Validate file input to check if is with valid extension
                 else if (!in_array($file_extension, $allowed_image_extension)) {
                     $response = array(
                         "type" => "error",
                         "message" => "Upload valid format. Only PNG,JPG and JPEG are allowed."
                     );
                 } // Validate image file size
                 else if (($_FILES["imageFile"]["size"] > 2000000)) {
                     $response = array(
                         "type" => "error",
                         "message" => "Size exceeds 2MB"
                     );
                 } else {
                    $target     = './assets/images/gameimage/' . $fileName;
                     if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target)) {
                        // Data insert array
                        $dataArray = array(
                              'img_type'  => $data['imageType'],
                              'image_name' => $data["imageTitle"],
                              'image'    => $fileName,
                              'date_created'    => date('Y-m-d H:i:s')
                        );
                       $whereCon = "img_id = ".$data["id"]."";
                        $tableName = "tbl_image";
                        $last_id    =  $this->MasterModel->updateData($whereCon,$tableName,$dataArray);
                        $response = array(
                           "type"    => "success",
                           "message" => "Game Store Succssfully!"
                        );
                     }else{
                        $response = array(
                             "type" => "error",
                             "message" => "Problem in uploading image files."
                        );
                     }
                 }
            $this->session->set_flashdata('message', $response);
            $this->session->set_flashdata('alert-class', 'alert-success');
            redirect(base_url() . "admin/master/upload-image");
         }

      }
      public function getFilterList()
      {
          $gameId = $this->input->get('game_id');
          
          if($_SERVER['REQUEST_METHOD'] === 'POST')
		  {
		    $data['filter_title']  = trim($this->input->post('filter_title'));	
		    $data['game_id']  = $gameId;
			$checkDetails = $this->Admin_model->getDataArray(FILTER_MASTER, $where=$data, $orderKey='filter_id');
            if($checkDetails)
            {
                $response = array(
                           "type" 	 => "warning",
                           "message" => "Filter title already exist for this game!"
                        );
                $this->session->set_flashdata('message', $response);
                $this->session->set_flashdata('alert-class', 'alert-warning');
            }else
            {
                $data['status'] = '1';
                $data['created_date'] = date('Y-m-d H:i:s');
				$result = $this->Admin_model->insertData(FILTER_MASTER, $data);
				if($result)
				{
				    $response = array(
                           "type" 	 => "success",
                           "message" => "Filter title added successfully"
                        );
                    $this->session->set_flashdata('message', $response);
                    $this->session->set_flashdata('alert-class', 'alert-success');
				}
            }  
          }
          $data["title"] = "Get Filter List | Gammer Pro";
          $data['game_id'] = $gameId;
          $data["result"] = $this->Filter_model->getFilterList($gameId);
          //echo "<pre>";print_r($data);die;
    	  $this->load->view('admin/master/manage-filter-list',$data);
	  }
	  public function editFilterDetails()
	  {
	      $gameId = $this->input->get('game-id');
	      $filterId = $this->input->get('filter-id');
	      $getFilterDetails = $this->Admin_model->getDataArray(FILTER_MASTER, $where=array('filter_id'=>$filterId,'game_id'=>$gameId), $orderKey='filter_id,filter_title,game_id');
	      $data["title"] = "Update Filter Details | Gammer Pro";
	      $data['filter_id'] =$getFilterDetails[0]['filter_id'];
	      $data['filter_title'] =$getFilterDetails[0]['filter_title'];
	      $data['game_id'] = $gameId;
	      $this->load->view('admin/master/edit-filter-details', $data);
	  }
	  public function updateFilterDetails(){
	      if($_SERVER['REQUEST_METHOD'] === 'POST')
		  {
		    $gameId = $this->input->post('game_id');
		    $filterId = $this->input->post('filter_id');
		    $data['filter_title']  = trim($this->input->post('filter_title'));	
		    $checkDetails = $this->Admin_model->getDataArray(FILTER_MASTER, $where=array('filter_title'=>$data['filter_title'], 'filter_id'=>$filterId), $orderKey='filter_id');
            if($checkDetails)
            {
                $response = array(
                           "type" 	 => "warning",
                           "message" => "Filter title already exist for this game!"
                        );
                $this->session->set_flashdata('message', $response);
                $this->session->set_flashdata('alert-class', 'alert-warning');
            }else
            {
                $result = $this->Admin_model->updateData(FILTER_MASTER, $data, $where=array('filter_id'=>$filterId));
				if($result)
				{
				    $response = array(
                           "type" 	 => "success",
                           "message" => "Filter title updated successfully"
                        );
                    $this->session->set_flashdata('message', $response);
                    $this->session->set_flashdata('alert-class', 'alert-success');
                    redirect('admin/master/edit-filter-details?filter-id='.$filterId.'&game-id='.$gameId);
				}
            } 
		    
		  }  
	  }
	}
?>