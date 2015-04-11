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
			$this->load->library('zip');
		}
		private $jsonPerson = "";

		function addPersonToFingerAPP(){
			$this->load->library('nusoap_base');
			$userdata = $this->session->userdata('userdata');
			$info['email'] = $userdata['email'];
			$info['username'] = $userdata['username'];
			$info['history_id'] = $this->findHistoryID($userdata['email']);
			$organisation = $this->findOrganisation($userdata['email']);
			$id = $this->findFormID($userdata['email']);
			$client = new nusoap_client("http://158.108.34.80:8080/webservice.asmx?wsdl",TRUE);
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			$data = $client->call("AddNewFingerPrints",array('person_id' => $id,'organisation' => $this->findOrganisation($userdata['email']) ));
			
			$info['status'] = "enrolled";
			$this->updateHistoryTodb($info['history_id'],$info['status']);
			$info['originalImages'] =  $this->getOrginalImage($userdata['email']);
			$info['form_id'] = $this->findFormID($userdata['email']);
			$this->load->helper('pdf_helper');
			$this->load->view('pdfEnroll',$info); 
			redirect('form_controller/loadHistory','refresh');	

			// redirect('form_controller/loadForm1','refresh');

		}

		function requestIdentify(){
			
			$this->load->library('nusoap_base');
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			if($this->getOrginalImage( $userdata['email'])){

				$client = new nusoap_client("http://158.108.34.80:8080/webservice.asmx?wsdl",TRUE);
				$client->soap_defencoding = 'UTF-8';
				$client->decode_utf8 = false;
				$data = $client->call("Load_PersonScore",array('emailUser' => $userdata['email']));
				$id = $this->findFormID($userdata['email']); 
				 // print_r(  $data );
				if($data != null)  { 
						// print_r($data['FingerAppResult']);
					 // echo $data['Load_PersonScoreResult'];

					$this->decodeJSON($data['Load_PersonScoreResult']);
						// $this->setJSONPerson($data['FingerAppResult']);
				}
				else {
					echo "Please check the connection of Fingerprint Application";
					$history_id = $this->findHistoryID($userdata['email']);
					$status = "pending";
			  		$this->updateHistoryTodb($history_id,$status);
				}
			}else {
				echo "โปรด ใส่ ลายนิ้วที่คุณต้องการค้นหา";
				$history_id = $this->findHistoryID($userdata['email']);
				$status = "pending";
			  	$this->updateHistoryTodb($history_id,$status);
			}

		}

		function decodeJSON($json){
			// var_dump(json_decode($json));
			$json_a = json_decode($json,true);
			$userdata = $this->session->userdata('userdata');
			$data['username'] = $userdata['username'];
			
			if(count($json_a) > 0){
				$data['json'] = $json_a;
				// print_r($data['json']);
				// $this->load->helper('pdf_helper');
				$this->setFingerForeachPerson($data['json']);
		   		// $this->load->view('pdfreport',$data); 
				// $this->load->view('forms/displaysearch',$data);
			}else{
			
				$status = "rejected";
				$history_id = $this->findHistoryID($userdata['email']);
				$this->updateHistoryTodb($history_id,$status);
					echo "not_matched";
				// $this->callIsEnroll();

			}

		}

		function callIsEnroll(){
			$userdata = $this->session->userdata('userdata');
			$data['username'] = $userdata['username'];
			$this->load->view('IsEnrollment_view',$data);
		}

		function setFingerForeachPerson($json){

			$personInFoAndFingers = array();
			// print_r($json);
			$userdata = $this->session->userdata('userdata');
			// $criminal_id = $data['Id'] =
			$originalImages =  $this->getOrginalImage($userdata['email']);
			foreach ($json as $key) {
				$info['id'] = $key['Id'];
				$info['email'] = $userdata['email'];
				$info['organisation'] = $key['organisation'];
				$info['overall_score'] = $key['score'];
				$info['originalImages'] = $originalImages;
				$info['history_id'] = $this->findHistoryID($userdata['email']);
				foreach($originalImages as $img){
					array_push($personInFoAndFingers,$this->loadImage($key['Id'],$img));
				}
				
				$info['fingers']  =  $personInFoAndFingers;

			}
			
			$status = "matched";
			$this->load->helper('pdf_helper');
			$this->load->view('pdfreport',$info); 
		  	$this->updateHistoryTodb($info['history_id'],$status);

			echo $status;

		}


		




		function loadImage($criminal_id,$originalImages){
			
			$userdata = $this->session->userdata('userdata');

			 $this->getFingerScore($criminal_id,$originalImages);

			return $this->getFingerScore($criminal_id,$originalImages);;
		
			}

		function getOrginalImage($email){
			// echo $email."</br>";
			$path = 'assets/images/temporary/'.$email.'/'; 

			$images;
			if(file_exists($path)){
				$images = glob($path."*.*");
				// print_r($images);
			}
			

			return $images;

		}

		
	function getFingerScore($id,$ProbeArray){
			

			$this->load->library('nusoap_base');
			$client = new nusoap_client("http://158.108.34.80:8080/webservice.asmx?wsdl",TRUE);
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			// print_r($ProbeArray);
			 $scoreFingerPosition = array();
			  // $imgFingerPosition = array();
			  $userdata = $this->session->userdata('userdata');
					$params = array('id' => $id,
						'ProbeArray' => $ProbeArray
					);
					
					$data = $client->call("Load_AFingerScore",$params);
					$myArray = json_decode($data["Load_AFingerScoreResult"], true);
					
				$scoreFingerPosition = array($myArray['path']=>$myArray['score']);

				
			
			return  $scoreFingerPosition ;

		}




		/**
		* Get data from input tag and store on db table 'form'
		*/
		function form(){
			$this->form_validation->set_rules('collected_date','Fingerprint Date','required');
		
			$userdata = $this->session->userdata('userdata');
			$organisation = $this->findOrganisation($userdata['email']);
			$arr = array(
				'email' => $userdata['email'],
				'collected_date' => $this->input->post('collected_date'),
				'organisation' => $organisation
		
				);
			$this->session->set_userdata('formdata',$arr);
			if($this->form_validation->run() == true){
				//redirect('form_controller/loadUploadSign','refresh');		
				$this->storeData();
				$this->addPersonToFingerAPP();
			}
			else{

				redirect('form_controller/loadForm2','refresh');
			}
		}


	function save_images($filename){
		$userdata = $this->session->userdata('userdata');
		$mask = 'assets/images/temporary/'.$userdata['email'].'/'.$userdata['email'].'_'.$filename.'.*';
		
		// echo $mask;
		$sp = array();
		if(count(glob($mask)) > 0){
			$arr = glob($mask);
			$sp = explode('.', $arr[0] );
			 // print_r($sp);
		}
		$config['allowed_types']="bmp|jpg|jpeg|png|gif|jpe|tiff|tif";
		$config['max_size']=4096;
		$config['upload_path']  = 'assets/images/temporary/'.$userdata['email'].'/';
		$this->upload->initialize($config);
	
		if(!file_exists($config['upload_path'])) mkdir($config['upload_path'],0777);

		
		if($this->upload->do_upload($filename)){
			$data=$this->upload->data();
			if(count($sp) > 0 ){
				if($sp[3] != $data['file_ext']) {
					$mask = 'assets/images/temporary/'.$userdata['email'].'/'.$userdata['email'].'_'.$filename.'.'.$sp[3];

					array_map('unlink', glob($mask));
				}
			}
			rename($data['full_path'],$data['file_path'].$userdata['email'].'_'.$filename.$data['file_ext']);
			chmod($data['file_path'].$userdata['email'].'_'.$filename.$data['file_ext'], 0777);
			$inserted_picture_filename = 'temporary/'.$userdata['email'].'/'.$userdata['email'].'_'.$filename.$data['file_ext'];
			

			// $this->moveImageToSeached($userdata['email'],$filename);

			// return substr($data['file_ext'],1);
			return $inserted_picture_filename;
			}
		   // else{
				 	// echo $this->upload->display_errors();
		   // }
		}

		function uploadZip(){
			$this->recordHistoryTodb($userdata['email']);
			redirect('form_controller/loadHistory','refresh');
		}

		function uploadKnownFingerPosition(){
			$userdata = $this->session->userdata('userdata');

 			// if($IsZip != "zip"){
				$this->session->set_userdata('R0',$this->save_images('R0'));
				$this->session->set_userdata('R1',$this->save_images('R1'));
				$this->session->set_userdata('R2',$this->save_images('R2'));
				$this->session->set_userdata('R3',$this->save_images('R3'));
				$this->session->set_userdata('R4',$this->save_images('R4'));
				
				$this->session->set_userdata('L0',$this->save_images('L0'));
				$this->session->set_userdata('L1',$this->save_images('L1'));
				$this->session->set_userdata('L2',$this->save_images('L2'));
				$this->session->set_userdata('L3',$this->save_images('L3'));
				$this->session->set_userdata('L4',$this->save_images('L4'));
			// }

			
			
			// open History page
			$this->recordHistoryTodb($userdata['email']);
			redirect('form_controller/loadHistory','refresh');	

		}


		function uploadUnKnownFingerPosition(){
			$userdata = $this->session->userdata('userdata');
			$data['email'] = $userdata['email'];
			// $mask = 'assets/images/temporary/'.$userdata['email'].'/*';
			// echo $mask;
			// array_map('unlink', glob($mask));
			$this->session->set_userdata('U1',$this->save_images('U1'));
			$this->session->set_userdata('U2',$this->save_images('U2'));
			$this->session->set_userdata('U3',$this->save_images('U3'));
			$this->session->set_userdata('U4',$this->save_images('U4'));
			$this->session->set_userdata('U5',$this->save_images('U5'));

			// $this->recordHistoryTodb($userdata['email']);
			$this->recordHistoryTodb($userdata['email']);
			redirect('form_controller/loadHistory','refresh');

			// $this->load->view('identify_view');
			// $this->load->view('forms/history',$data);
			// $this->load->view('history',$data);
			// $this->requestIdentify();
		}
		
		/**Save History action **/
		function recordHistoryTodb($useremail){
			$userdata = $this->session->userdata('userdata');
			$status = "matching";
			$now = new DateTime();
			$system_date =  $now->format('Y-m-d');  

			$arr = array(
				'system_date' => $system_date,
				'status' => $status,
				'useremail' => $useremail
				);
			$this->db->where('useremail', $useremail);
			$this->db->insert("history",$arr);
		}

		/**Update History macthed action **/
		function updateHistoryTodb($history_id,$status){
			$userdata = $this->session->userdata('userdata');
			$now = new DateTime();
			$system_date =  $now->format('Y-m-d');  

			$arr = array(
				'system_date' => $system_date,
				'status' => $status,
				
		
				);
			$this->db->where('history_id', $history_id);
			$this->db->update("history",$arr);
		}		

		




		// clear all file extension and form data in session
		function clearSession(){
	
			$this->session->unset_userdata('R0');
			$this->session->unset_userdata('R1');
			$this->session->unset_userdata('R2');
			$this->session->unset_userdata('R3');
			$this->session->unset_userdata('R4');

			$this->session->unset_userdata('L0');
			$this->session->unset_userdata('L1');
			$this->session->unset_userdata('L2');
			$this->session->unset_userdata('L3');
			$this->session->unset_userdata('L4');

			$this->session->unset_userdata('U1');
			$this->session->unset_userdata('U2');
			$this->session->unset_userdata('U3');
			$this->session->unset_userdata('U4');
			$this->session->unset_userdata('U5');

			$this->session->unset_userdata('formdata');
		}

		// check data null value
		function checkFormData(){
			$arr = $this->session->userdata('formdata');
			if($arr['collected_date']!=''){
				return true;
		}
		return false;
	}



		// save data and file to database and folder
	function storeData(){
			// save data to db
		$array = $this->session->userdata('formdata');

		if(($array==null)||(!$this->checkFormData())) redirect('form_controller/loadForm2','refresh');
		
			// get file extension
		$userdata = $this->session->userdata('userdata');
			// get form's id from db
		
		$organisation =  $this->findOrganisation($userdata['email']);
		// print_r($array);
		// array_push($array,$organisation);
		$this->db->insert("form",$array);
		$id = $this->findFormID($userdata['email']);
		echo $id;
		// $form_id = $this->findFormID();
		$this->remove_image($userdata['email'],'R0',$this->session->userdata('R0'),$id,$organisation);
		$this->remove_image($userdata['email'],'R1',$this->session->userdata('R1'),$id,$organisation);
		$this->remove_image($userdata['email'],'R2',$this->session->userdata('R2'),$id,$organisation);
		$this->remove_image($userdata['email'],'R3',$this->session->userdata('R3'),$id,$organisation);
		$this->remove_image($userdata['email'],'R4',$this->session->userdata('R4'),$id,$organisation);

		$this->remove_image($userdata['email'],'L0',$this->session->userdata('L0'),$id,$organisation);
		$this->remove_image($userdata['email'],'L1',$this->session->userdata('L1'),$id,$organisation);
		$this->remove_image($userdata['email'],'L2',$this->session->userdata('L2'),$id,$organisation);
		$this->remove_image($userdata['email'],'L3',$this->session->userdata('L3'),$id,$organisation);
		$this->remove_image($userdata['email'],'L4',$this->session->userdata('L4'),$id,$organisation);


		$this->remove_image($userdata['email'],'U1',$this->session->userdata('U1'),$id,$organisation);
		$this->remove_image($userdata['email'],'U2',$this->session->userdata('U2'),$id,$organisation);
		$this->remove_image($userdata['email'],'U3',$this->session->userdata('U3'),$id,$organisation);
		$this->remove_image($userdata['email'],'U4',$this->session->userdata('U4'),$id,$organisation);
		$this->remove_image($userdata['email'],'U5',$this->session->userdata('U5'),$id,$organisation);
	}

		// move image from temporary folder to permanent folder
	function remove_image($email,$fingerPositionTemp,$fileext,$id,$organisation){
		 // echo $fingerPositionTemp;
		// $history_id = $this->findHistoryID($email);
		$fileext = "*";
		$source = 'assets/images/temporary/'.$email.'/'.$email.'_'.$fingerPositionTemp.'*'.'.'.$fileext;
		if( $fingerPositionTemp == "R0" ) $fingerPositionFormFolder = "right_thumb";
		else if( $fingerPositionTemp == "R1" ) $fingerPositionFormFolder = "right_fore";
		else if( $fingerPositionTemp == "R2" ) $fingerPositionFormFolder = "right_middle";
		else if( $fingerPositionTemp == "R3" ) $fingerPositionFormFolder = "right_ring";
		else if( $fingerPositionTemp == "R4" ) $fingerPositionFormFolder = "right_little";
		else if( $fingerPositionTemp == "L0" ) $fingerPositionFormFolder = "left_thumb";
		else if( $fingerPositionTemp == "L1" ) $fingerPositionFormFolder = "left_fore";
		else if( $fingerPositionTemp == "L2" ) $fingerPositionFormFolder = "left_middle";
		else if( $fingerPositionTemp == "L3" ) $fingerPositionFormFolder = "left_ring";
		else if( $fingerPositionTemp == "L4" ) $fingerPositionFormFolder = "left_little";
		else if( $fingerPositionTemp == "U1" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u1"; }
		else if( $fingerPositionTemp == "U2" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u2"; }
		else if( $fingerPositionTemp == "U3" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u3"; }
		else if( $fingerPositionTemp == "U4" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u4"; }
		else if( $fingerPositionTemp == "U5" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u5"; }
		// echo $fingerPositionTemp;
	
		// $fingerNumber = "1"\\;

		
		if ($fingerPositionFormFolder != "unknown") {
		    $dest = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$id.'_'.$fingerPositionFormFolder.'/'.$id.'_'.'0'.$organisation.'_'.$fingerPositionTemp.'*'.'.'.$fileext;
			$filenamefolder = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$id.'_'.$fingerPositionFormFolder;
		}
		else {
			$dest = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$fingerUnknownNumber.'/'.$id.'_'.'0'.$organisation.'_'.$fingerPositionTemp.'*'.'.'.$fileext;
			$filenamefolder = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$fingerUnknownNumber;
		}
		 // echo $filenamefolder;

		// if(!file_exists($form)) mkdir($form,0777);
		if(!file_exists($filenamefolder)) mkdir($filenamefolder,0777);
		
		$result = 	glob($source);
		$resultForm = glob($dest);
		$lastFingerNumber = count($resultForm);
		if($lastFingerNumber <= 0){
			$FingerNumber =0;
		}else $FingerNumber = $lastFingerNumber-1;

		
		// print_r( $result );
		echo "</br>";
		if(count($result) > 0 ){
			
			$extension = end(explode('.', $result[0]));
			$fileext = "*";
			// $source = 'assets/images/temporary/'.$email.'/'.$filename.'_'.$email.'.'.$extension;
			// $dest = 'assets/images/form/'.$filename.'/'.$filename.'_'.$id.'.'.$extension;
			$source = 'assets/images/temporary/'.$email.'/'.$email.'_'.$fingerPositionTemp.'.'.$extension;
			if ($fingerPositionFormFolder != "unknown") {
		   	 $dest = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$id.'_'.$fingerPositionFormFolder.'/'.$id.'_'.'0'.$organisation.'_'.$fingerPositionTemp.'_'.$FingerNumber.'.'.$extension;
			}
			else $dest = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$fingerUnknownNumber.'/'.$id.'_'.'0'.$organisation.'_'.$fingerPositionTemp.'_'.$FingerNumber.'.'.$extension;
			echo $source."</br>" ;
		    echo $dest."</br>" ;
		    	// umask(0777);	
			copy($source, $dest);
		// 
		 	// chmod($filenamefolder, 0777); 
			chmod($dest, 0777); 
			
			
		}
		

	}

	function moveZiptoTemporary($fingerPositionCode){
		$fileext = "*";

		$userdata = $this->session->userdata('userdata');
		$email = $userdata['email'];

		//source : zipfiles/email/*
		$source = 'assets/images/zipfiles/'.$email.'/unzip/'.'*'.'.'.$fileext;

		//dest : temporary/email/email_fingerposition.*
		$destFolder =  'assets/images/temporary/'.$email.'/';
		if(!file_exists($destFolder)) mkdir($destFolder,0777);
		$dest = $destFolder.'/'.$email.'_'.$fingerPositionCode.'.'.$fileext;

		$result = 	glob($source);
		if(count($result) > 0 ){
			
			// for($i=0;$i<count($result);$i++) echo $result[i];
			$extension = end(explode('.', $result[0]));
			// $fileext = "*";
			$source = 'assets/images/zipfiles/'.$email.'/unzip/'.$fingerPositionCode.'.'.$extension;
			$dest = $destFolder.'/'.$email.'_'.$fingerPositionCode.'.'.$extension;
			// $dest  = $searchedFolder.'/'.$history_id.'_'.$fingerPositionCode.'.'.$extension;
			// echo $source."</br>" ;
		    // echo $dest."</br>" ;
			copy($source, $dest);
			
		}

	}

	function unzipFile(){
		$userdata = $this->session->userdata('userdata');
		//delte old file 
		$mask = 'assets/images/zipfiles/'.$userdata['email'].'/*.*'; 
		array_map('unlink', glob($mask));

	
		$config['allowed_types']="zip";
		$config['max_size']=4096;
		$config['upload_path']  = 'assets/images/zipfiles/'.$userdata['email'].'/';
		$this->upload->initialize($config);
	

		if(!file_exists($config['upload_path'])) mkdir($config['upload_path'],0777);
 		// $this->upload->do_upload();
		if ( ! $this->upload->do_upload('zipFile'))
		{
			$error = array('error' => $this->upload->display_errors());
				print_r($error);
			// $this->load->view('upload_form_view', $error);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$zip = new ZipArchive;
			$file = $data['upload_data']['full_path'];
						
			
			chmod($file,0777);
			if ($zip->open($file) === TRUE) {
    				$zip->extractTo('assets/images/zipfiles/'.$userdata['email'].'/unzip/');
    				$zip->close();
    				


    				/** Get zip images **/
    				$path = 'assets/images/zipfiles/'.$userdata['email'].'/unzip/'; 
					$images;
					if(file_exists($path)){
						$images = glob($path."*.*");
						// print_r($images);
					}
					// print_r($images);
					$info['username'] = $userdata['username'];
					$info['email'] = $userdata['email'];
					$info['images'] = $images;
					$type = "";
					foreach ($images as $key ) {
						if (strpos($key, "R0"))   {  	$this->moveZiptoTemporary('R0'); $info['R0_path'] = $key; }
						else if (strpos($key, "R1")){   $this->moveZiptoTemporary('R1'); $info['R1_path'] = $key; }
						else if (strpos($key, "R2")){   $this->moveZiptoTemporary('R2'); $info['R2_path'] = $key; }
						else if (strpos($key, "R3")){   $this->moveZiptoTemporary('R3'); $info['R3_path'] = $key; }
						else if (strpos($key, "R4")){   $this->moveZiptoTemporary('R4'); $info['R4_path'] = $key; }
						else if (strpos($key, "L0")){   $this->moveZiptoTemporary('L0'); $info['L0_path'] = $key; }
						else if (strpos($key, "L1")){   $this->moveZiptoTemporary('L1'); $info['L1_path'] = $key; }
						else if (strpos($key, "L2")){   $this->moveZiptoTemporary('L2'); $info['L2_path'] = $key; }
						else if (strpos($key, "L3")){   $this->moveZiptoTemporary('L3'); $info['L3_path'] = $key; }
						else if (strpos($key, "L4")){   $this->moveZiptoTemporary('L4'); $info['L4_path'] = $key; }	
					
						//

						if(strpos($key,"U"))   { $type = "unknown"; break; }
						
					}
					if ($type == "unknown"){
						$i = 0;
						foreach ($images as $key ) {
							$filename = 'U'.$i;
							
							if (strpos($key, "U1")){   $this->moveZiptoTemporary('U1'); $info['U1_path'] = $key; }	
							else if (strpos($key, "U2")){   $this->moveZiptoTemporary('U2'); $info['U2_path'] = $key; }	
							else if (strpos($key, "U3")){   $this->moveZiptoTemporary('U3'); $info['U3_path'] = $key; }	
							else if (strpos($key, "U4")){   $this->moveZiptoTemporary('U4'); $info['U4_path'] = $key; }	
							else if (strpos($key, "U5")){   $this->moveZiptoTemporary('U5'); $info['U5_path'] = $key; }	
							$i++;
						}
						$this->load->view('forms/uploadZipUnknowFingerposition',$info);
					} else $this->load->view('forms/uploadZipKnowFingerposition',$info);


			} else {
    				echo 'failed';
			}
		}
			// if(count($sp) > 0 ){
				// if($sp[3] != $data['file_ext']) {
				// 	$mask = 'assets/images/zipfiles/'.$userdata['email'].'/'.$userdata['email'].'_'.'zip'.'.'.$sp[3];

				// 	array_map('unlink', glob($mask));
				// }
			// }
			// rename($data['full_path'],$data['file_path'].$userdata['email'].'_'.$filename.$data['file_ext']);
			// chmod($data['file_path'].$userdata['email'].'_'.$filename.$data['file_ext'], 0777);
			// $inserted_picture_filename = 'temporary/'.$userdata['email'].'/'.$userdata['email'].'_'.$filename.$data['file_ext'];
			

	    //  $res = $zip->open('my_zip_file.zip');
	    //  if ($res === TRUE) {
	    //      $zip->extractTo('my_extract_to_dir/');
	    //      $zip->close();
	       
	    //  } else {
	    //      echo 'failed';
     // }


	}

		// find form's id by useremail from table 'users'
	function findFormID($useremail){
		$this->db->select_max('id');
		$this->db->from('form');
		$this->db->where('email',$useremail);
		$query = $this->db->get();
		foreach ($query->result() as $row){
			$id = $row->id;
		}

		return $id;
	}

	function findUserID($useremail){
		$this->db->select_min('id');
		$this->db->from('users');
		$this->db->where('email',$useremail);
		$query = $this->db->get();
		foreach ($query->result() as $row){
			$id = $row->id;
		}

		return $id;
	}


	// find form's organisation by useremail from table 'users'
	function findOrganisation($useremail){
		$this->db->select_max('organisation');
		$this->db->from('users');
		$this->db->where('email',$useremail);
		$query = $this->db->get();
		foreach ($query->result() as $row){
			$organisation = $row->organisation;
		}

		return $organisation;
	}

	function findHistoryID($useremail){
		$this->db->select_max('history_id');
		$this->db->from('history');
		$this->db->where('useremail',$useremail);
		$query = $this->db->get();
		foreach ($query->result() as $row){
			$history_id = $row->history_id;
		}
		return $history_id;
	}

	function findFingerPositionFromHistoryId($history_id){
		$this->db->select_max('finger_position');
		$this->db->from('history');
		$this->db->where('history_id',$history_id);
		$query = $this->db->get();
		foreach ($query->result() as $row){
			$finger_position = $row->finger_position;
		}
		return $finger_position;
	}

}
?>
