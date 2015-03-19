<?php
/**
* Render pages
* @author Thitikarn Sutthichutipong
*/
class Form_controller extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$this->lang->load('auth');
		$this->load->helper('language');
		$this->load->library('session');
	}

	// render user home
	function loadUserHome(){
		$userdata = $this->session->all_userdata();
		$data['email'] = $userdata['email'];
		$data['username'] = $userdata['username'];
		if($this->ion_auth->logged_in()){
			$this->load->view('forms/user_home',$data);
		}
		else{
			$this->load->view('auth/login',$data);
		}
	}

	// render admin home
	function loadAdminHome(){
		$userdata = $this->session->all_userdata();
		$data['email'] = $userdata['email'];
		$data['username'] = $userdata['username'];
		if($this->ion_auth->logged_in()){
			$this->load->view('forms/admin_home',$data);
		}
		else{
			$this->load->view('auth/login',$data);
		}
	}

	function loadSearch(){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$this->load->view('forms/search',$data);
		}
		else redirect('auth/loadLogin','refresh');
	}

	// render form page without data
	function loadForm1(){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$this->load->view('forms/uploadRightHand',$data);
			//$this->load->view('forms/uploadSignature',$data);

		}
		else redirect('auth/loadLogin','refresh');
	}

	function loadForm(){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$this->load->view('forms/form1',$data);
		}
		else redirect('auth/loadLogin','refresh');
	}

	// render form page with data
	function loadForm2(){
		if($this->ion_auth->logged_in()){
			$array = $this->session->userdata('formdata');
			$data = $array;
			if(empty($array)){
				$data = array(
							'fingerprint_date' => '',
							'department' => '', 
							'criminal_sex' => '', 
							'yearofbirth' => '', 
							'criminal_name' => '',  
							'criminal_surname' => '',
							'officer_name' => '',
							'officer_surname' => '', 
							'history_number' => '',  
							'fingerprint_code' => '',
							'other_code' => ''		
							);
			}
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$this->load->view('forms/form2',$data);
		}
		else{
			redirect('auth/loadLogin','refresh');
		}
	}


	// render image upload page
	function loadUploadSign(){
		$userdata = $this->session->userdata('userdata');
		$data['email'] = $userdata['email'];
		$data['username'] = $userdata['username'];
		if ($this->ion_auth->logged_in()) {
			$this->load->view('forms/uploadSignature',$data);
			// $this->load->view('forms/uploadSignatureArea',$data);
		}
		else{
			redirect('auth/loadLogin','refresh');
		}
	}

	// render image upload page
	function loadUploadBothHand(){
		$userdata = $this->session->userdata('userdata');
		$data['email'] = $userdata['email'];
		$data['username'] = $userdata['username'];
		if ($this->ion_auth->logged_in()) {
			$this->load->view('forms/uploadBothHand',$data);
			// $this->load->view('forms/uploadBothHandArea',$data);
		}
		else{
			redirect('auth/loadLogin','refresh');
		}
	}

	// render image upload page
	function loadUploadRightHand(){
		$userdata = $this->session->userdata('userdata');
		$data['email'] = $userdata['email'];
		$data['username'] = $userdata['username'];
		if ($this->ion_auth->logged_in()) {
			$this->load->view('forms/uploadRightHand',$data);
			// $this->load->view('forms/uploadRightHandArea',$data);
		}
		else{
			redirect('auth/loadLogin','refresh');
		}
	}

	// render image upload page
	function loadUploadLeftHand(){
		$userdata = $this->session->userdata('userdata');
		$data['email'] = $userdata['email'];
		$data['username'] = $userdata['username'];
		if ($this->ion_auth->logged_in()) {
			$this->load->view('forms/uploadLeftHand',$data);
			// $this->load->view('forms/uploadLeftHandArea',$data);
		}
		else{
			redirect('auth/loadLogin','refresh');
		}
	}

	// render image upload page
	function loadFormSearch(){
		$userdata = $this->session->userdata('userdata');
		$data['email'] = $userdata['email'];
		$data['username'] = $userdata['username'];
		$data = $this->session->flashdata('data');
		if ($this->ion_auth->logged_in()) {
			$this->load->view('forms/formsearch',$data);
		}
		else{
			redirect('auth/loadLogin','refresh');
		}
	}

	// upload file from upload area
	function ajaxupload(){
		$userdata = $this->session->userdata('userdata');

		// Destination folder for downloaded files
		$upload_folder = 'assets/images/temporary';
		if(!file_exists($upload_folder)) mkdir($upload_folder,0777);
		
		if(count($_FILES)>0) { 
			$filename = $_FILES['upload']['name'];
			$ext = strrchr( $filename, '.' );
			$ind = strpos($filename, $ext);
			$realname = substr($filename, 0,$ind);
			$mask = $upload_folder.'/'.$realname.'.*';
			$ext = substr($ext, 1);
			$in = strpos($filename, '_'.$userdata['email']);
			$sessionname = substr($filename,0, $in);
			array_map('unlink', glob($mask));
			if( move_uploaded_file( $_FILES['upload']['tmp_name'] , $upload_folder.'/'.$_FILES['upload']['name'] ) ) {
				$fileext = pathinfo($_FILES['upload']['name'],PATHINFO_EXTENSION);
				$this->session->set_userdata($sessionname,$ext);
				echo 'done';
			}
			exit();
		} 
		else if(isset($_GET['up'])) {
			// If the browser does not support sendAsBinary ()
			if(isset($_GET['base64'])) {
				$content = base64_decode(file_get_contents('php://input'));
			} else {
				$content = file_get_contents('php://input');
			}

			$headers = getallheaders();
			$headers = array_change_key_case($headers, CASE_UPPER);
			
			$filename = $headers['UP-FILENAME'];
			$ext = strrchr( $filename, '.' );
			$ind = strpos($filename, $ext);
			$realname = substr($filename, 0,$ind);
			$mask = $upload_folder.'/'.$realname.'.*';
			$ext = substr($ext, 1);
			$in = strpos($filename, '_'.$userdata['email']);
			$sessionname = substr($filename,0, $in);
			array_map('unlink', glob($mask));

			if(file_put_contents($upload_folder.'/'.$headers['UP-FILENAME'], $content)) {
				$fileext = pathinfo($headers['UP-FILENAME'],PATHINFO_EXTENSION);
				$this->session->set_userdata($sessionname,$ext);
				echo 'done';
			}
			exit();
		}
	}
}
?>