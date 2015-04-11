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

// open history page
	function loadHistory(){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$data['organisation'] = $userdata['organisation'];
			// $noid = 'select * from history where useremail="'.$data['email'].'" and form_id=""';
			$noid = 'select history_id,system_date,status from history where useremail="'.$data['email'].'" order by system_date desc';
			// $hasid = $noid.' union select history.system_date, history.overall_score, history.status from history join form on history.form_id = form.id order by system_date desc';
			// $questring = 'select history.system_date, history.form_id, form.organisation, history.score, history.status from history join form on history.form_id=form.id where useremail="1@admin.com"';
			// $questring = 'select history.system_date, history.form_id, form.organisation, history.score, history.status from history where useremail="'.$data['email'].'"';
			// $questring = 'select history.system_date, history.form_id, form.organisation, history.overall_score, history.status from history join form on history.form_id = form.id order by system_date desc';
			 // where email ="'.$data['username'].'"
			$query = $this->db->query($noid);
			$i = 0;
			$queryarr = array(array());
			foreach ($query->result_array() as $row) {
				$queryarr[$i]['history_id'] = $row['history_id'];
				$queryarr[$i]['system_date'] = $row['system_date'];
				// $queryarr[$i]['form_id'] = $row['form_id'];
				$queryarr[$i]['status'] = $row['status'];
				$i++;
			}
			
			$data['queryarr'] = $queryarr;
			
			// $a = $this->session->all_userdata();
			// var_dump($a);
			$this->load->view('forms/history',$data);
		}
		else redirect('auth/loadLogin','refresh');
	}

	function loadData(){
		$id = $this->input->post('hideid');
		$status = $this->input->post('hidestatus');
		// echo "<script type='text/javascript'>alert('$status');</script>";
		if($status=='enrolled') $this->loadEnrolled($id,$status);
		else if($status=='matched') $this->loadMatched($id,$status);
	}

	function loadMatched($id,$sta){
		$id = $this->input->post('hideid');
		$status = $this->input->post('hidestatus');
		// echo "<script type='text/javascript'>alert('$status');</script>";
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$data['form_id'] = $id;
			$data['organisation'] = $userdata['organisation'];
			$querystr = 'select finger_position, inserted_picture_filename, matched_picture_filename, score from history where form_id="'.$id.'" order by finger_position desc';
			$query = $this->db->query($querystr);
			$i = 0;
			$queryarr = array(array());
			foreach ($query->result_array() as $row) {
				$queryarr[$i]['finger_position'] = $row['finger_position'];
				$queryarr[$i]['inserted_picture_filename'] = $row['inserted_picture_filename'];
				$queryarr[$i]['matched_picture_filename'] = $row['matched_picture_filename'];
				$queryarr[$i]['score'] = $row['score'];
				$i++;
			}
			$data['queryarr'] = $queryarr;

			$this->load->view('forms/matched',$data);
		}
		else redirect('auth/loadLogin','refresh');
	}

	function loadEnrolled($id,$sta){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$data['form_id'] = $id;
			$data['organisation'] = $userdata['organisation'];

			$querystr = 'select finger_position, inserted_picture_filename from history where form_id="'.$id.'" order by finger_position desc';
			$query = $this->db->query($querystr);
			$i = 0;
			$queryarr = array(array());
			foreach ($query->result_array() as $row) {
				$queryarr[$i]['finger_position'] = $row['finger_position'];
				$queryarr[$i]['inserted_picture_filename'] = $row['inserted_picture_filename'];
				$i++;
			}
			$data['queryarr'] = $queryarr;
			$this->load->view('forms/enrolled',$data);
		}
		else redirect('auth/loadLogin','refresh');
	}

		// render form page without data
	function loadFormFingerImage(){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$mask = 'assets/images/temporary/'.$userdata['email'].'/*';
			array_map('unlink', glob($mask));
			$this->load->view('forms/uploadFingerKnownPosition',$data);
			
			//$this->load->view('forms/uploadSignature',$data);

		}
		else redirect('auth/loadLogin','refresh');
	}

		function loadFormUnknowFingerImage(){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$mask = 'assets/images/temporary/'.$userdata['email'].'/*';
			// echo $mask;
			array_map('unlink', glob($mask));
			$this->load->view('forms/uploadFingerUnKnownPosition',$data);
			
			//$this->load->view('forms/uploadSignature',$data);

		}
		else redirect('auth/loadLogin','refresh');
	}

	// render form page without data
	function loadForm1(){
		if($this->ion_auth->logged_in()){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			// $this->load->view('forms/uploadFingerKnownPosition',$data);
			 $this->load->view('SelectIdentifyVerify_view',$data);
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


	// upload file from upload area
	function ajaxupload(){
		$userdata = $this->session->userdata('userdata');
		$email = $userdata['email'];

		// Destination folder for downloaded files
		$upload_folder = 'assets/images/temporary/'.$email;
		if(!file_exists($upload_folder)) mkdir($upload_folder,0777);
		
		if(count($_FILES)>0) { 
			$filename = $_FILES['upload']['name'];
			$ext = strrchr( $filename, '.' );
			$ind = strpos($filename, $ext);
			$realname = substr($filename, 0,$ind);
			$mask = $upload_folder.'/'.$realname.'.*';
			$ext = substr($ext, 1);
			$in = strpos( $userdata['email'],'_'.$filename);
			echo $in;
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

			if(file_put_contents($upload_folder.'/'.$headers['UP-FILENAME']  , $content)) {
				$fileext = pathinfo($headers['UP-FILENAME'],PATHINFO_EXTENSION);
				$this->session->set_userdata($sessionname,$ext);
				echo 'done';
			}
			exit();
		}
	}


}
?>