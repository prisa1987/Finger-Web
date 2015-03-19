	<?php
	/**
	* Get data and files from user and store on db(table form) and local folder
	* @author Thitikarn Sutthichutipong
	*/
	class Main extends CI_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('upload');
			$this->load->library('session');
		}
		private $jsonPerson = "";

		function addPersonToFingerAPP(){
			$this->load->library('nusoap_base');
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$id = $this->findID($userdata['email']);
			$client = new nusoap_client("http://127.0.0.1:8080/webservice.asmx?wsdl",TRUE);
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			$data = $client->call("AddNewFingerPrints",array('person_id' => $id));
			echo "<script> alert('Successful for enrollment') </script>";

			redirect('form_controller/loadForm1','refresh');

		}

		function requestIdentify(){
			
			$this->load->library('nusoap_base');
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];



			$client = new nusoap_client("http://127.0.0.1:8080/webservice.asmx?wsdl",TRUE);
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			$data = $client->call("Load_PersonScore",array('mail' => $userdata['email']));
			$id = $this->findID($userdata['email']); 
			//	print_r(  $data['Load_PersonScoreResult'] );
			if($data != null)  { 
					// print_r($data['FingerAppResult']);
				$this->decodeJSON($data['Load_PersonScoreResult']);
					// $this->setJSONPerson($data['FingerAppResult']);
			}
			else {
				//Store Data
				echo "NOOO";
			}

		}

		function decodeJSON($json){
			// var_dump(json_decode($json));
			$json_a = json_decode($json,true);
			$userdata = $this->session->userdata('userdata');
			$data['username'] = $userdata['username'];
			
			if(count($json_a) > 0){
				$data['json'] = $json_a;
				$this->load->view('forms/displaysearch',$data);
			}else{
				$this->load->view('IsEnrollment_view',$data);
			}

		}



		function loadImage($id){
			
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$data['originalImages'] = $this->getOrginalImage($data['email']);
			$data['FingerMatchesImages'] = $this->getMatchesImage($data['originalImages'],$id);
			//print_r($data['FingerMatchesImages']);
			$data['score'] = $this->getFingerScore($data['FingerMatchesImages'],$data['originalImages']);
			// print_r($data['FingerMatchesImages'][0] );
			$this->load->view("FingerPrints_view.php",$data);

		}



		function getOrginalImage($email){

			$path = 'assets/images/temporary/'.$email.'/'; 

			$images;
			if(file_exists($path)){
				$images = glob($path."*.*");
			}
			

			return $images;

		}

		function getMatchesImage($originalImages,$id){
			
			// if($fingerPos == "criminal_sign") return getMatchesImage_criminal_sign($id);


			$FingerMatchesImages =  array();
			
			foreach ($originalImages as $key) {
				
				$subFile =  explode("/",$key);
				$subFilename = explode("_", $subFile[4]);
				$fingerPos = $subFilename[0]." ".$subFilename[1];
				$fingerPosFolder = $subFilename[0]."_".$subFilename[1];
			
				if($fingerPosFolder == "right_thumb") array_push($FingerMatchesImages,$this->getMatchesImage_right_thumb($id));
				else if($fingerPosFolder == "right_little") array_push($FingerMatchesImages,$this->getMatchesImage_right_little($id));
				else if($fingerPosFolder == "right_middle") array_push($FingerMatchesImages,$this->getMatchesImage_right_middle($id));
				else if($fingerPosFolder == "right_ring") array_push($FingerMatchesImages,$this->getMatchesImage_right_ring($id));
				else if($fingerPosFolder == "right_fore") array_push($FingerMatchesImages,$this->getMatchesImage_right_fore($id));

				else if($fingerPosFolder == "left_thumb") array_push($FingerMatchesImages,$this->getMatchesImage_left_thumb($id));
				else if($fingerPosFolder == "left_little") array_push($FingerMatchesImages,$this->getMatchesImage_left_little($id));
				else if($fingerPosFolder == "left_middle") array_push($FingerMatchesImages,$this->getMatchesImage_left_middle($id));
				else if($fingerPosFolder == "left_ring") array_push($FingerMatchesImages,$this->getMatchesImage_left_ring($id));
				else if($fingerPosFolder == "left_fore") array_push($FingerMatchesImages,$this->getMatchesImage_left_fore($id));


				// if($fingerPosFolder == "right_thumb") array_push($FingerMatchesImages,$a);
				
				// $this->session->set_userdata('FingerMatchesImages',$FingerMatchesImages);
			}

			return $FingerMatchesImages;
			
			

		}

		function getMatchesImage_criminal_sign($id){
			$path = 'assets/images/form/'; 
			$Folder = 'criminal_sign';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_fingerprint_number($id){
			$path = 'assets/images/form/'; 
			$Folder = 'fingerprint_number';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_fore($id){
			$path = 'assets/images/form/'; 
			$Folder = 'left_fore';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_little($id){
			$path = 'assets/images/form/'; 
			$Folder = 'left_little';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_middle($id){
			$path = 'assets/images/form/'; 
			$Folder = 'left_middle';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_ring($id){
			$path = 'assets/images/form/'; 
			$Folder = 'left_ring';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_thumb($id){
			$path = 'assets/images/form/'; 
			$Folder = 'left_thumb';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}
		
		function getMatchesImage_left_thumb_hand($id){
			$path = 'assets/images/form/'; 
			$Folder = 'left_thumb_hand';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_lefthand($id){
			$path = 'assets/images/form/'; 
			$Folder = 'lefthand';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_officer_sign($id){
			$path = 'assets/images/form/'; 
			$Folder = 'officer_sign';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_fore($id){
			$path = 'assets/images/form/'; 
			$Folder = 'right_fore';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
		//	print_r($result);
						//$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_little($id){
			$path = 'assets/images/form/'; 
			$Folder = 'right_little';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_middle($id){
			$path = 'assets/images/form/'; 
			$Folder = 'right_middle';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
		$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_ring($id){
			$path = 'assets/images/form/'; 
			$Folder = 'right_ring';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
		
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_thumb($id){
			$path = 'assets/images/form/'; 
			$Folder = 'right_thumb';
			$File = $path.$Folder."/".$Folder."_".$id.".*";
			$result = glob ($File );
			
			
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}
		
		function getMatchesImage_right_thumb_hand($id){
			$path = 'assets/images/form/'; 
			$Folder = 'right_thumb_hand';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_righthand($id){
			$path = 'assets/images/form/'; 
			$Folder = 'righthand';
			$File = $path.$Folder."/".$Folder."_".$id.".*";

			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getFingerScore($FingerDBArray,$ProbeArray){
			

			$this->load->library('nusoap_base');
			$client = new nusoap_client("http://127.0.0.1:8080/webservice.asmx?wsdl",TRUE);
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			$score = array();
			// print_r($FingerDBArray);
			// print_r($ProbeArray);
			$i = 0;
			foreach ($ProbeArray as $key ) {
				$params = array('FingerDBArray' => $FingerDBArray[$i],
					'ProbeArray' => $key
					);
				echo "FingerDBArray : ".$FingerDBArray[$i]."</br>";
				echo "ProbeArray : ".$key."</br>";
				$data = $client->call("Load_AFingerScore",$params);
				//print_r($data);
				$myArray = json_decode($data["Load_AFingerScoreResult"], true);

				array_push($score, $myArray);
				 //print_r($data["Load_AFingerScoreResult"]);
				$i++;

				
			}
			//print_r($myArray);
			return  $score;

		}

		function search(){
			$userdata = $this->session->userdata('userdata');
			for($i = 1; $i<=10; $i++){
				$file = 'finger_'.$i;

				$exe = $this->saveSearch($file);
				$filename = $file."_".$userdata['email'].".".$exe;
				if(file_exists("assets/images/search/".$filename)) {
					// echo "<script>alert('$filename')</script>";
					$this->session->set_userdata($file,$exe);
					// $data[$i] = $filename;

				}

			}
			$this->callWebService($userdata['email']);

		}

		function saveSearch($filename){
			$config['allowed_types']="jpg|jpeg|png|gif|bmp|jpe|tiff|tif";
			$config['max_size']=4096;
			$config['upload_path'] = 'assets/images/search/';
			$this->upload->initialize($config);
			$userdata = $this->session->userdata('userdata');
			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'],0777);

			// chdir('C:/xampp/htdocs/fingerprint/'.$config['upload_path']);

			// delete old file
			$mask = 'assets/images/search/'.$filename.'_'.$userdata['email'].'.*';
			// $file = 'assets/images/temporary/'.$filename.'_'.$userdata['email'].'.tif';
			// unset($file);
			array_map('unlink', glob($mask));

			if($this->upload->do_upload($filename)){
				$data=$this->upload->data();
				$ans = $data['file_path'].$filename.'_'.$userdata['email'].$data['file_ext'];
				// echo "<script>alert('$ans')</script>";
				rename($data['full_path'],$data['file_path'].$filename.'_'.$userdata['email'].$data['file_ext']);
				return substr($data['file_ext'],1);
			}
		}

		/**
		* Get data from input tag and store on db table 'form'
		*/
		function form(){
			$this->form_validation->set_rules('fingerprint_date','Fingerprint Date','required');
			$this->form_validation->set_rules('department','Department','required|xss_clean');
			$this->form_validation->set_rules('criminal_name','Criminal name','required|xss_clean');
			$this->form_validation->set_rules('criminal_surname','Criminal surname','required|xss_clean');
			$this->form_validation->set_rules('officer_name','Officer name','required|xss_clean');
			$this->form_validation->set_rules('officer_surname','Officer surname','required|xss_clean');
			$this->form_validation->set_rules('history_number','History number','xss_clean|alpha_numeric');
			$this->form_validation->set_rules('fingerprint_code','Fingerprint code','xss_clean|alpha_numeric');
			$this->form_validation->set_rules('other_code','Other code','xss_clean|alpha_numeric');
			$userdata = $this->session->userdata('userdata');
			$arr = array(
				'useremail' => $userdata['email'],
				'fingerprint_date' => $this->input->post('fingerprint_date'),
				'department' => $this->input->post('department'), 
				'criminal_sex' => $this->input->post('criminal_sex'), 
				'yearofbirth' => $this->input->post("yearofbirth"), 
				'criminal_name' => $this->input->post('criminal_name'),  
				'criminal_surname' => $this->input->post("criminal_surname"),
				'officer_name' => $this->input->post('officer_name'),
				'officer_surname' => $this->input->post('officer_surname'), 
				'history_number' => $this->input->post('history_number'),  
				'fingerprint_code' => $this->input->post("fingerprint_code"),
				'other_code' => $this->input->post('other_code')			
				);
			$this->session->set_userdata('formdata',$arr);
			if($this->form_validation->run() == true){
				//redirect('form_controller/loadUploadSign','refresh');		
				$this->storeData();
				$this->addPersonToFingerAPP();
			}
			else{
				// $arr = $this->session->userdata('formdata');
				// echo $arr['fingerprint_date'];

				redirect('form_controller/loadForm2','refresh');
			}
		}

		// save image to temporary folder
		function save_images($filename){
			//['bmp']   =>  array('image/bmp', 'รmage/x-ms-bmp');
		$userdata = $this->session->userdata('userdata');
		$config['allowed_types']="bmp|jpg|jpeg|png|gif|jpe|tiff|tif";
		$config['max_size']=4096;
		// $config['upload_path'] = 'assets/images/temporary/'; //Tonmai Code


		$config['upload_path']  = 'assets/images/temporary/'.$userdata['email'].'/';
		// echo "d: ".$config['upload_path'];
		//$this->upload->initialize($config);
		//$this->load->library('upload', $config);
		$this->upload->initialize($config);
		// $flgDelete = rmdir("thaicreate");
		if(!file_exists($config['upload_path'])) mkdir($config['upload_path'],0777);

		// delete old file
		
		// $files = glob($mask.'/*'); // get all file names
		//echo "File name : ".$filename ;
		if($this->upload->do_upload($filename)){
			$data=$this->upload->data();
			rename($data['full_path'],$data['file_path'].$filename.'_'.$userdata['email'].$data['file_ext']);
			return substr($data['file_ext'],1);
		}
		//  else{
		 //		echo $this->upload->display_errors();
		  //}
		}

		
		// save signature files for area
		function uploadSignatureArea(){
			$userdata = $this->session->userdata('userdata');
			// $src = 'assets/images/temporary/';
			// if(file_exists($src.'criminal_sign_'.$userdata['email'].'.'.$this->session->userdata('criminal_sign'))&&
			// 	file_exists($src.'officer_sign_'.$userdata['email'].'.'.$this->session->userdata('officer_sign'))&&
			// 	file_exists($src.'fingerprint_number_'.$userdata['email'].'.'.$this->session->userdata('fingerprint_number'))){
			redirect('form_controller/loadUploadRightHand','refresh');
			// }
			// else redirect('form_controller/loadUploadSign','refresh');
		}

		// save right hand files for area
		function uploadRightHandArea(){
			$userdata = $this->session->userdata('userdata');
			// $src = 'assets/images/temporary/';
			// if(file_exists($src.'right_thumb_'.$userdata['email'].'.'.$this->session->userdata('right_thumb'))&&
			// 	file_exists($src.'right_fore_'.$userdata['email'].'.'.$this->session->userdata('right_fore'))&&
			// 	file_exists($src.'right_middle_'.$userdata['email'].'.'.$this->session->userdata('right_middle'))&&
			// 	file_exists($src.'right_ring_'.$userdata['email'].'.'.$this->session->userdata('right_ring'))&&
			// 	file_exists($src.'right_little_'.$userdata['email'].'.'.$this->session->userdata('right_little'))){
			redirect('form_controller/loadUploadLeftHand','refresh');
			// }
			// else redirect('form_controller/loadUploadRightHand','refresh');
		}

		// save left hand files for area
		function uploadLeftHandArea(){
			$userdata = $this->session->userdata('userdata');

			redirect('form_controller/loadUploadBothHand','refresh');

		}

		// save both hand files for area
		function uploadBothHandArea(){
			$userdata = $this->session->userdata('userdata');


		}

		// clear all file extension and form data in session
		function clearSession(){
			$this->session->unset_userdata('criminal_sign');
			$this->session->unset_userdata('officer_sign');
			$this->session->unset_userdata('fingerprint_number');

			$this->session->unset_userdata('right_thumb');
			$this->session->unset_userdata('right_fore');
			$this->session->unset_userdata('right_middle');
			$this->session->unset_userdata('right_ring');
			$this->session->unset_userdata('right_little');

			$this->session->unset_userdata('left_thumb');
			$this->session->unset_userdata('left_fore');
			$this->session->unset_userdata('left_middle');
			$this->session->unset_userdata('left_ring');
			$this->session->unset_userdata('left_little');

			$this->session->unset_userdata('lefthand');
			$this->session->unset_userdata('left_thumb_hand');
			$this->session->unset_userdata('right_thumb_hand');
			$this->session->unset_userdata('righthand');

			$this->session->unset_userdata('formdata');
		}

		// save signature files
		function uploadSignature(){
			$userdata = $this->session->userdata('userdata');
			$mask = 'assets/images/temporary/'.$userdata['email'].'/*';
			//echo $mask;
		    array_map('unlink', glob($mask));
			$this->session->set_userdata('criminal_sign',$this->save_images('criminal_sign'));
			$this->session->set_userdata('officer_sign', $this->save_images('officer_sign'));
			$this->session->set_userdata('fingerprint_number',$this->save_images('fingerprint_number'));
			redirect('form_controller/loadUploadRightHand','refresh');
			
		}

		// save right hand files
		function uploadRightHand(){

			$this->session->set_userdata('right_thumb',$this->save_images('right_thumb'));
			$this->session->set_userdata('right_fore',$this->save_images('right_fore'));
			$this->session->set_userdata('right_middle',$this->save_images("right_middle"));
			$this->session->set_userdata('right_ring',$this->save_images('right_ring'));
			$this->session->set_userdata('right_little',$this->save_images("right_little"));
			redirect('form_controller/loadUploadLeftHand','refresh');

		}

		// save left hand files
		function uploadLeftHand(){


			$this->session->set_userdata('left_thumb',$this->save_images('left_thumb'));
			$this->session->set_userdata('left_fore',$this->save_images('left_fore'));
			$this->session->set_userdata('left_middle',$this->save_images("left_middle"));
			$this->session->set_userdata('left_ring',$this->save_images('left_ring'));
			$this->session->set_userdata('left_little',$this->save_images("left_little"));
			//redirect('form_controller/loadUploadBothHand','refresh');

			$userdata = $this->session->userdata('userdata');

			$this->requestIdentify();
			
		}

		// save both hand files
		function uploadBothHand(){
			
			$this->session->set_userdata('lefthand',$this->save_images('lefthand'));
			$this->session->set_userdata('left_thumb_hand',$this->save_images('left_thumb_hand'));
			$this->session->set_userdata('right_thumb_hand',$this->save_images("right_thumb_hand"));
			$this->session->set_userdata('righthand',$this->save_images('righthand'));

	//		$userdata = $this->session->userdata('userdata');

		//	$this->requestIdentify();


		}

		// check data null value
		function checkFormData(){
			$arr = $this->session->userdata('formdata');
			if(($arr['fingerprint_date']!='')&&($arr['department']!='')&&($arr['criminal_sex']!='')&&
				($arr['yearofbirth']!='')&&($arr['criminal_name']!='')&&($arr['criminal_surname']!='')&&
				($arr['officer_name']!='')&&($arr['officer_surname']!='')){
				return true;
		}
		return false;
	}

		// save data and file to database and folder
	function storeData(){
			// save data to db
		$array = $this->session->userdata('formdata');
		if(($array==null)||(!$this->checkFormData())) redirect('form_controller/loadForm2','refresh');
		$this->db->insert("form",$array);
			// get file extension
		$userdata = $this->session->userdata('userdata');
			// get form's id from db
		$id = $this->findID($userdata['email']);

		$this->remove_image($userdata['email'],'criminal_sign',$this->session->userdata('criminal_sign'),$id);
		$this->remove_image($userdata['email'],'officer_sign',$this->session->userdata('officer_sign'),$id);
		$this->remove_image($userdata['email'],'fingerprint_number',$this->session->userdata('fingerprint_number'),$id);

		$this->remove_image($userdata['email'],'right_thumb',$this->session->userdata('right_thumb'),$id);
		$this->remove_image($userdata['email'],'right_fore',$this->session->userdata('right_fore'),$id);
		$this->remove_image($userdata['email'],'right_middle',$this->session->userdata('right_middle'),$id);
		$this->remove_image($userdata['email'],'right_ring',$this->session->userdata('right_ring'),$id);
		$this->remove_image($userdata['email'],'right_little',$this->session->userdata('right_little'),$id);

		$this->remove_image($userdata['email'],'left_thumb',$this->session->userdata('left_thumb'),$id);
		$this->remove_image($userdata['email'],'left_fore',$this->session->userdata('left_fore'),$id);
		$this->remove_image($userdata['email'],'left_middle',$this->session->userdata('left_middle'),$id);
		$this->remove_image($userdata['email'],'left_ring',$this->session->userdata('left_ring'),$id);
		$this->remove_image($userdata['email'],'left_little',$this->session->userdata('left_little'),$id);

		$this->remove_image($userdata['email'],'lefthand',$this->session->userdata('lefthand'),$id);
		$this->remove_image($userdata['email'],'left_thumb_hand',$this->session->userdata('left_thumb_hand'),$id);
		$this->remove_image($userdata['email'],'right_thumb_hand',$this->session->userdata('right_thumb_hand'),$id);
		$this->remove_image($userdata['email'],'righthand',$this->session->userdata('righthand'),$id);
	}

		// move image from temporary folder to permanent folder
	function remove_image($email,$filename,$fileext,$id){

		$fileext = "*";
		$source = 'assets/images/temporary/'.$email.'/'.$filename.'_'.$email.'.'.$fileext;
		$dest = 'assets/images/form/'.$filename.'/'.$filename.'_'.$id.'.'.$fileext;
		$form = 'assets/images/form/';
		$filenamefolder = 'assets/images/form/'.$filename.'/';

		if(!file_exists($form)) mkdir($form,0777);
		if(!file_exists($filenamefolder)) mkdir($filenamefolder,0777);
		
		$result = 	glob($source);
		if(count($result) > 0 ){
			$extension = end(explode('.', $result[0]));
			$fileext = "*";
			$source = 'assets/images/temporary/'.$email.'/'.$filename.'_'.$email.'.'.$extension;
			$dest = 'assets/images/form/'.$filename.'/'.$filename.'_'.$id.'.'.$extension;
			echo $source."</br>" ;
		echo $dest."</br>" ;
			copy($source, $dest);
			
		}
		

	}

		// find form's id by useremail from table 'users'
	function findID($useremail){
		$this->db->select_max('id');
		$this->db->from('form');
		$this->db->where('useremail',$useremail);
		$query = $this->db->get();
		foreach ($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}

	function get(){
		$id = $this->getID();
		$this->db->from('form');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row_array();	
		$data['fingerprint_date'] = $result['fingerprint_date'];
		$data['department'] = $result['department'];
		$data['criminal_sex'] = $result['criminal_sex'];
		$data['yearofbirth'] = $result['yearofbirth'];
		$data['criminal_name'] = $result['criminal_name'];
		$data['criminal_surname'] = $result['criminal_surname'];
		$data['officer_name'] = $result['officer_name'];
		$data['officer_surname'] = $result['officer_surname'];
		$data['history_number'] = $result['history_number'];
		$data['fingerprint_code'] = $result['fingerprint_code'];
		$data['other_code'] = $result['other_code'];
		$this->session->set_userdata('formdata',$data);
		redirect('form_controller/loadFormSearch','refresh');
	}
	}
	?>