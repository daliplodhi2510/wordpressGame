<?php 
	/**
	 * 
	 */
	class Dashboard extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
		}
		
		public function dashboard(){
			if (($this->session->userdata && $this->session->userdata['logged_in']['is_admin']== '1')):
			$data["title"] 	=	"Dashboard";
			$this->load->view('admin/dashboard/index',$data);
		else:
			redirect(base_url().'admin');
		endif;
		}
	}
?>