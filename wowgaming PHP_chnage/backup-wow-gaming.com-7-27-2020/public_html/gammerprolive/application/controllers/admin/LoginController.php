<?php 
/**
 * 
 */
class LoginController extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
				$this->load->model('admin/LoginModel');
	}


	public function loginView(){
		$this->load->view('admin/login');
	}

	public function doLogin(){
		$email 		=	$this->security->xss_clean($this->input->post('email'));
      $password 	=	$this->security->xss_clean($this->input->post('password'));

		$data['login_result'] = $this->LoginModel->doLogin($email);
			if($data['login_result'] == true){
				
				$userInfo =	$data['login_result'];
				// Encrypt User Password to verify the password
            $salt                = $userInfo->salt;
            $encrypted_password  = $userInfo->password;
            $hash                = base64_encode(sha1($password . $salt, true) . $salt); 
	         if ($encrypted_password == $hash) {
               	$userData = array(
						'admin_login_id_pk'	=>		$userInfo->admin_login_id_pk,
						'email'				=>		$userInfo->email,
						'is_admin'			=>		'1'
					);
            	$this->session->set_userdata('logged_in', $userData);
       			redirect(base_url(). 'admin/dashboard');
				}else{
					$response = array(
                  'message'      => 'Your password is incorrect'
              	);
				}
    		}else{
    			$response = array(
              'message'      => 'Your email is incorrect'
            );
    		}
    		$this->session->set_flashdata('message',$response);
    		$this->session->set_flashdata('alert-class','alert-danger');		
			redirect(base_url().'admin/login');
	}
	public function logout(){
		$sess_array = array(
					'login_id_pk'	=>		'',
					'first_name'	=>		'',
					'last_name'		=>		'',
					'email'			=>		'',
				);
		$response	=	array(
			'message'	=>	'Logout Successfully'
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->unset_userdata('newsiteid');
		$this->session->set_flashdata('message',$response);
   		$this->session->set_flashdata('alert-class', 'alert-success');
		redirect(base_url().'admin/login');
	}

}
	
?>