<?php 
class PageController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/PagesModel');
        date_default_timezone_set('Asia/Calcutta'); 

	}

	/*Privacy & Policy View*/

	public function privacyPolicyView(){
		$data["title"]	=	"Privacy & Policy | Gammer Pro";
		$data["result"]	=	$this->PagesModel->getData('tbl_privacy_policy');
		$this->load->view('admin/pages/privacy-policy',$data);
	}

	public function storePrivacyPolocy(){
		$data = $this->input->post();
		$dataArray 	=	array(
			'content' 		=>	$data["privacyText"],
			'date_created'	=>	date('Y-m-d H:i:s')
		);

		if($this->PagesModel->store('tbl_privacy_policy',$dataArray)){
			$response   =   array(
                "error"     =>  "success",
                "message"   =>  "Page information store successfully."
            );
		}else{
			$response   =   array(
                "error"     =>  "faild",
                "message"   =>  "Something went wrong."
            );
		}
		$this->session->set_flashdata('message', $response);
        $this->session->set_flashdata('alert-class', 'alert-success');
        redirect(base_url() . 'admin/pages/privacy-policy');
	}

	/*Terms And Condition View*/
	public function termsConditionView(){
		$data["title"]	=	"Privacy & Policy | Gammer Pro";
		$data["result"]	=	$this->PagesModel->getData('tbl_terms_conditions');
		$this->load->view('admin/pages/terms-and-condition',$data);
	}

	public function storeTermsCondition(){

		$data = $this->input->post();
		$dataArray 	=	array(
			'content' 		=>	$data["termCondtionText"],
			'date_created'	=>	date('Y-m-d H:i:s')
		);

		if($this->PagesModel->store('tbl_terms_conditions',$dataArray)){
			$response   =   array(
                "error"     =>  "success",
                "message"   =>  "Page information store successfully."
            );
		}else{
			$response   =   array(
                "error"     =>  "faild",
                "message"   =>  "Something went wrong."
            );
		}
		$this->session->set_flashdata('message', $response);
        $this->session->set_flashdata('alert-class', 'alert-success');
        redirect(base_url() . 'admin/pages/terms-and-condition');
	}
	/*Contact US Page*/
	public function contactUsView(){
		$data["title"]	=	"Privacy & Policy | Gammer Pro";
		$data["result"]	=	$this->PagesModel->getDataFromContactUs('tbl_contact');
		$this->load->view('admin/pages/contact-us',$data);
	}

	/*Update Contact Us*/
	public function updateContactUs(){
		$data = $this->input->post();
		$dataArray 	=	array(
			"title"			=>	$data["txtMsg"],
			"phone"			=> 	$data["txtCnumber"],
			"email"			=>	$data["txtEmail"],	
			"address"		=>	$data["txtAddress"],
			"whatsapp_no"	=>  $data["txtWhatsapp"],
			"messenger_id"	=>	$data["txtMsngr"],
			"fb_follow"		=>  $data["txtfb"],
			"ig_follow"		=>  $data["txtInstagram"],
			"twitter_follow"=>  $data["txtTwitter"],
			"youtube_follow"=>  $data["txtYoutube"]
		);
		$whereCon  = "contact_id = ".$data["contact_id"]."";
		if($this->PagesModel->updateData($whereCon,'tbl_contact',$dataArray)){
			$response   =   array(
                "error"     =>  "success",
                "message"   =>  "Contact Page Update Successfully."
            );
		}else{
			$response   =   array(
                "error"     =>  "faild",
                "message"   =>  "Something went wrong."
            );
		}
		$this->session->set_flashdata('message', $response);
        $this->session->set_flashdata('alert-class', 'alert-success');
        redirect(base_url() . 'admin/pages/contact-us');
	}
}
?>