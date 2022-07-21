<?php 
/**
 * 
 */
class UserController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/UserModel');
	}

	public function userListingView(){
		$data["data"] 		=		$this->UserModel->getUserDetails();
		$data['title']		=		'User Listing | Gammer Pro';
		$this->load->view('admin/users/listing',$data);
	}
}

?>