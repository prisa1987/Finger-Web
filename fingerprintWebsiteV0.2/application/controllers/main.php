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
			$data = $client->call("AddNewFingerPrints",array('person_id' => $id,'organisation' => $this->findOrganisation($userdata['email']) ));
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
			 // print_r(  $data );
			if($data != null)  { 
					// print_r($data['FingerAppResult']);
				$this->decodeJSON($data['Load_PersonScoreResult']);
					// $this->setJSONPerson($data['FingerAppResult']);
			}
			else {
				echo "Please check the connection of Fingerprint Application";
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




		function loadImage($id,$organisation){
			
			$userdata = $this->session->userdata('userdata');
			$data['id'] = $id;
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$data['originalImages'] = $this->getOrginalImage($userdata['email']);
			// $data['FingerMatchesImages'] = $this->getMatchesImage($data['originalImages'],$id,$organisation);
			//print_r($data['FingerMatchesImages']);
			$data['scoreAndImg']= $this->getFingerScore($id,$data['originalImages']);
			$this->load->view('FingerPrints_view',$data);
		
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

		function getMatchesImage($originalImages,$id,$organisation){
			
			// if($fingerPos == "criminal_sign") return getMatchesImage_criminal_sign($id);


			$FingerMatchesImages =  array();
			
			foreach ($originalImages as $key) {
				
				$subFile =  explode("/",$key);
				$subFilename = explode("_", $subFile[4]);
				$fingerPos = $subFilename[1];
				$fingerPosWithoutExtSplit = explode(".", 	$fingerPos );
				$fingerPosWithoutExt = $fingerPosWithoutExtSplit[0];
			//	$organisation = $organisation;
				
				// $fingerPosFolder = $subFilename[0]."_".$subFilename[1];
				// echo $fingerPosWithoutExt."</br>";
				if($fingerPosWithoutExt == "R0") array_push($FingerMatchesImages,$this->getMatchesImage_right_thumb($id,$organisation));
				else if($fingerPosWithoutExt == "R4") array_push($FingerMatchesImages,$this->getMatchesImage_right_little($id,$organisation));
				else if($fingerPosWithoutExt == "R2") array_push($FingerMatchesImages,$this->getMatchesImage_right_middle($id,$organisation));
				else if($fingerPosWithoutExt == "R3") array_push($FingerMatchesImages,$this->getMatchesImage_right_ring($id,$organisation));
				else if($fingerPosWithoutExt == "R1") array_push($FingerMatchesImages,$this->getMatchesImage_right_fore($id,$organisation));

				else if($fingerPosWithoutExt == "L0") array_push($FingerMatchesImages,$this->getMatchesImage_left_thumb($id,$organisation));
				else if($fingerPosWithoutExt == "L4") array_push($FingerMatchesImages,$this->getMatchesImage_left_little($id,$organisation));
				else if($fingerPosWithoutExt == "L2") array_push($FingerMatchesImages,$this->getMatchesImage_left_middle($id,$organisation));
				else if($fingerPosWithoutExt == "L3") array_push($FingerMatchesImages,$this->getMatchesImage_left_ring($id,$organisation));
				else if($fingerPosWithoutExt == "L1") array_push($FingerMatchesImages,$this->getMatchesImage_left_fore($id,$organisation));


				// if($fingerPosFolder == "right_thumb") array_push($FingerMatchesImages,$a);
				// echo "array : ";
				// print_r($FingerMatchesImages);
				// echo "</br>";				
				// $this->session->set_userdata('FingerMatchesImages',$FingerMatchesImages);
			}

			return $FingerMatchesImages;
			
			

		}


		function getMatchesImage_left_fore($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'left_fore/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'L1';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_little($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'left_little/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'L4';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_middle($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'left_middle/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'L2';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_ring($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'left_ring/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'L3';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_left_thumb($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'left_thumb/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'L0';
			// echo "or: ". $organisation;
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";

			// echo $File;
			$result = glob ($File );
			
			  // print_r($result);
			if(count($result)> 0){
				$images = $result;
			 }
			return $images;
		
		}
		
		function getMatchesImage_right_fore($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'right_fore/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'R1';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
			$result = glob ($File );
		//	print_r($result);
						//$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_little($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'right_little/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'R4';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
			$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_middle($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'right_middle/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'R2';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
		$result = glob ($File );
			
			$images = $File;
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_ring($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'right_ring/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'R3';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";
			$result = glob ($File );
		
			if(count($result)> 0){
				$images = $result[0];
			}
			return $images;
		}

		function getMatchesImage_right_thumb($id,$organisation){
			$path = 'assets/images/form/'; 
			$Folder = 'right_thumb/';
			$id_Folder = $id.'_'.$Folder;
			$fingerPosition = 'R0';
			$File = $path.$Folder.$id_Folder.$id."_".$organisation."_".$fingerPosition."_"."*".".*";

			// echo $File;
			$result = glob ($File );
			
			 // print_r($result);
			if(count($result)> 0){
				$images = $result;
			 }
			return $images;
		}
		
	

		function getFingerScore($id,$ProbeArray){
			

			$this->load->library('nusoap_base');
			$client = new nusoap_client("http://127.0.0.1:8080/webservice.asmx?wsdl",TRUE);
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			
			 $scoreFingerPosition = array();
			  // $imgFingerPosition = array();
			  $userdata = $this->session->userdata('userdata');
			  // $id = $this->findUserID($userdata['email']);
				foreach ($ProbeArray as $key ){
					// print_r($key);
					$ProbeArraysplit =	explode("/",$key);
					$FingerPostionProbeArraySplit = explode("_",$ProbeArraysplit[4]);
					// print_r($FingerPostionProbeArraySplit);
					$FingerPostionProbeArraySplitWithoutExt = explode(".", $FingerPostionProbeArraySplit [1]);
					$FingerPostionProbeArray = $FingerPostionProbeArraySplitWithoutExt[0];
					

					$params = array('id' => $id,
						'ProbeArray' => $key
					);
					
					$data = $client->call("Load_AFingerScore",$params);
					$myArray = json_decode($data["Load_AFingerScoreResult"], true);
					
				$arr = array($myArray['path']=>$myArray['score']);
				 // print_r($arr);
				 array_push($scoreFingerPosition , $arr );
			}


				
			
			return  $scoreFingerPosition ;

		}


		/**
		* Get data from input tag and store on db table 'form'
		*/
		function form(){
			$this->form_validation->set_rules('collected_date','Fingerprint Date','required');
			// $this->form_validation->set_rules('department','Department','required|xss_clean');
			// $this->form_validation->set_rules('criminal_name','Criminal name','required|xss_clean');
			// $this->form_validation->set_rules('criminal_surname','Criminal surname','required|xss_clean');
			// $this->form_validation->set_rules('officer_name','Officer name','required|xss_clean');
			// $this->form_validation->set_rules('officer_surname','Officer surname','required|xss_clean');
			// $this->form_validation->set_rules('history_number','History number','xss_clean|alpha_numeric');
			// $this->form_validation->set_rules('fingerprint_code','Fingerprint code','xss_clean|alpha_numeric');
			// $this->form_validation->set_rules('other_code','Other code','xss_clean|alpha_numeric');
		
			$userdata = $this->session->userdata('userdata');
			$organisation = $this->findOrganisation($userdata['email']);
			$arr = array(
				'email' => $userdata['email'],
				'collected_date' => $this->input->post('collected_date'),
				'organisation' => $organisation
				// 'department' => $this->input->post('department'), 
				// 'criminal_sex' => $this->input->post('criminal_sex'), 
				// 'yearofbirth' => $this->input->post("yearofbirth"), 
				// 'criminal_name' => $this->input->post('criminal_name'),  
				// 'criminal_surname' => $this->input->post("criminal_surname"),
				// 'officer_name' => $this->input->post('officer_name'),
				// 'officer_surname' => $this->input->post('officer_surname'), 
				// 'history_number' => $this->input->post('history_number'),  
				// 'fingerprint_code' => $this->input->post("fingerprint_code"),
				// 'other_code' => $this->input->post('other_code')			
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
			return substr($data['file_ext'],1);
		}
		   // else{
				 // 	echo $this->upload->display_errors();
		   // }
		}

		function uploadKnownFingerPosition(){
			$userdata = $this->session->userdata('userdata');

			
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
		
			$this->load->view('identify_view');
 			// $this->requestIdentify();

		}


		function uploadUnKnownFingerPosition(){
			$userdata = $this->session->userdata('userdata');
			// $mask = 'assets/images/temporary/'.$userdata['email'].'/*';
			// echo $mask;
			// array_map('unlink', glob($mask));
			$this->session->set_userdata('U1',$this->save_images('U1'));
			$this->session->set_userdata('U2',$this->save_images('U2'));
			$this->session->set_userdata('U3',$this->save_images('U3'));
			$this->session->set_userdata('U4',$this->save_images('U4'));
			$this->session->set_userdata('U5',$this->save_images('U5'));

			$this->load->view('identify_view');

			// $this->requestIdentify();
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
		$this->db->insert("form",$array);
			// get file extension
		$userdata = $this->session->userdata('userdata');
			// get form's id from db
		$id = $this->findID($userdata['email']);
		$organisation =  $this->findOrganisation($userdata['email']);
		
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
		$fileext = "*";
		$source = 'assets/images/temporary/'.$email.'/'.$email.'_'.$fingerPositionTemp.'*'.'.'.$fileext;
		if( $fingerPositionTemp == "R0" ) $fingerPositionFormFolder = "right_thumb";
		else if( $fingerPositionTemp == "R1" ) $fingerPositionFormFolder = "right_fore";
		else if( $fingerPositionTemp == "R2" ) $fingerPositionFormFolder = "right_middle";
		else if( $fingerPositionTemp == "R3" ) $fingerPositionFormFolder = "right_ring";
		else if( $fingerPositionTemp == "R4" ) $fingerPositionFormFolder = "right_little";
		elseif( $fingerPositionTemp == "L0" )  $fingerPositionFormFolder = "left_thumb";
		else if( $fingerPositionTemp == "L1" ) $fingerPositionFormFolder = "left_fore";
		else if( $fingerPositionTemp == "L2" ) $fingerPositionFormFolder = "left_middle";
		else if( $fingerPositionTemp == "L3" ) $fingerPositionFormFolder = "left_ring";
		else if( $fingerPositionTemp == "L4" ) $fingerPositionFormFolder = "left_little";
		else if( $fingerPositionTemp == "U1" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u1"; }
		else if( $fingerPositionTemp == "U2" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u2"; }
		else if( $fingerPositionTemp == "U3" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u3"; }
		else if( $fingerPositionTemp == "U4" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u4"; }
		else if( $fingerPositionTemp == "U5" ) { $fingerPositionFormFolder = "unknown"; $fingerUnknownNumber = "u5"; }
	
		// $fingerNumber = "1";

		
		if ($fingerPositionFormFolder != "unknown") {
		    $dest = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$id.'_'.$fingerPositionFormFolder.'/'.$id.'_'.'0'.$organisation.'_'.$fingerPositionTemp.'*'.'.'.$fileext;
			$filenamefolder = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$id.'_'.$fingerPositionFormFolder;
		}
		else {
			$dest = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$fingerUnknownNumber.'/'.$id.'_'.'0'.$organisation.'_'.$fingerPositionTemp.'*'.'.'.$fileext;
			$filenamefolder = 'assets/images/form/'.$fingerPositionFormFolder.'/'.$fingerPositionFormFolder.'/'.$fingerUnknownNumber;
		}
		

		if(!file_exists($form)) mkdir($form,0777);
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
			// echo $source."</br>" ;
		    // echo $dest."</br>" ;
			copy($source, $dest);
			
		}
		

	}

		// find form's id by useremail from table 'users'
	function findID($useremail){
		$this->db->select_min('id');
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




	function get(){
		$id = $this->getID();
		$this->db->from('form');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row_array();	
		$data['collected_date'] = $result['collected_date'];
		// $data['department'] = $result['department'];
		// $data['criminal_sex'] = $result['criminal_sex'];
		// $data['yearofbirth'] = $result['yearofbirth'];
		// $data['criminal_name'] = $result['criminal_name'];
		// $data['criminal_surname'] = $result['criminal_surname'];
		// $data['officer_name'] = $result['officer_name'];
		// $data['officer_surname'] = $result['officer_surname'];
		// $data['history_number'] = $result['history_number'];
		// $data['fingerprint_code'] = $result['fingerprint_code'];
		// $data['other_code'] = $result['other_code'];
		$this->session->set_userdata('formdata',$data);
		redirect('form_controller/loadFormSearch','refresh');
	}
}
?>
