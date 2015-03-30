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
			$data['email'] = $userdata['email'];
			$data['username'] = $userdata['username'];
			$data['originalImages'] = $this->getOrginalImage($data['email']);
			$data['FingerMatchesImages'] = $this->getMatchesImage($data['originalImages'],$id,$organisation);
			//print_r($data['FingerMatchesImages']);
			$data['scoreAndImg'] = $this->getFingerScore($data['FingerMatchesImages'],$data['originalImages']);
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
		
	

		function getFingerScore($FingerDBArray,$ProbeArray){
			

			$this->load->library('nusoap_base');
			$client = new nusoap_client("http://127.0.0.1:8080/webservice.asmx?wsdl",TRUE);
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			


			// echo "</br>-------------------</br>";
			  // print_r($FingerDBArray);
			  // echo "</br>";
			  // print_r($ProbeArray);
			// $ProbeArray[0];
			
			
			// echo "</br>-------------------</br>";
			$i = 0;
			$j = 0;
			$MaxScoreFingerAray = array();
			 foreach ($FingerDBArray as $key ) {
			 	// echo "</br>";
			 	// echo "key : ";
			 	// print_r($key);
			 	$scoreSameFingerPosition = array();
			$imgSameFingerPosition = array();
				foreach ($key as $value ){
					$ProbeArraysplit =	explode("/",$ProbeArray[$j]);
					$FingerDBArraysplit = explode("/",$value);
					$FingerPostionDBArraySpilt = explode("_",$FingerDBArraysplit[5]);
					$FingerPostionProbeArraySplit = explode("_",$ProbeArraysplit[4]);
					// print_r($FingerPostionProbeArraySplit);
					$FingerPostionProbeArraySplitWithoutExt = explode(".", $FingerPostionProbeArraySplit [1]);
					$FingerPostionProbeArray = $FingerPostionProbeArraySplitWithoutExt[0];
					$FingerPostionDBArray = $FingerPostionDBArraySpilt[2];
					// echo "value : ";
			 		// print_r($value);
					// echo "</br>==============</br>";
					// echo "Probe: ".$FingerPostionProbeArray;
					 // echo "</br>";
					 // echo "DB : ".$FingerPostionDBArray;
					 // echo "</br>";
					 // echo "==============</br></br>";
					if($FingerPostionDBArray != $FingerPostionProbeArray ){
						$j++;
						// echo "Change : ".$ProbeArray[$j];
						// $FingerPostionProbeArray = $FingerPostionDBArray;
					}
					// print_r($value);
					// echo "</br>";
					 // print_r($ProbeArray);

					$params = array('FingerDBArray' => $value,
						'ProbeArray' => $ProbeArray[$j]
					);
					 // echo "</br>======================================================================</br>";
					 // echo "FingerDBArray : ".$value."</br>";
					 // echo "ProbeArray : ".$ProbeArray[$j]."</br>";
				
					$data = $client->call("Load_AFingerScore",$params);
					//print_r($data);
					$myArray = json_decode($data["Load_AFingerScoreResult"], true);

					array_push($scoreSameFingerPosition, $myArray);
					array_push($imgSameFingerPosition,$value );
					// echo "score : ";
					// print_r($data["Load_AFingerScoreResult"]);
					//echo "</br>";
 					//echo "=======================================================================";
					 

				}
				$i++;
				// echo "================================== Conclusion ====================================="."</br>";
				$n = 0;
				$SameFingerPosition= array();
				foreach ($scoreSameFingerPosition as $score ) {
					// echo $score;
					$scoreFloat = floatval($score);
					$array =array( $imgSameFingerPosition[$n] => $scoreFloat );
					$SameFingerPosition= array_merge($SameFingerPosition, $array);
					// echo $score."</br>";
					$n++;
				}
				//print_r($SameFingerPosition);
				arsort($SameFingerPosition);
				
				//echo "</br>"."------------------------ Sort array ---------------------.</br>";
				//print_r($SameFingerPosition);

				//echo "</br>"."---------------------------------------------------------.</br>";
				//echo "===========================================================================================";
		
				$MaxScoreFingerKey = key($SameFingerPosition);
				$MaxScoreFingerValue = reset($SameFingerPosition);
				$arr = array($MaxScoreFingerKey=>$MaxScoreFingerValue);
				 array_push($MaxScoreFingerAray , $arr );
			}
				
			 // print_r($MaxScoreFingerAray[1]);
			return  $MaxScoreFingerAray;

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

	function save_images($filename){
		$userdata = $this->session->userdata('userdata');
		$mask = 'assets/images/temporary/'.$userdata['email'].'/'.$userdata['email'].'_'.$filename.'.*';
		
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
	
 			$this->requestIdentify();
		}


		function uploadUnKnownFingerPosition(){
			$userdata = $this->session->userdata('userdata');
			// $mask = 'assets/images/temporary/'.$userdata['email'].'/*';
			// echo $mask;
			// array_map('unlink', glob($mask));
			$this->session->set_userdata('U0',$this->save_images('U0'));
			$this->session->set_userdata('U1',$this->save_images('U1'));
			$this->session->set_userdata('U2',$this->save_images('U2'));
			$this->session->set_userdata('U3',$this->save_images('U3'));
			$this->session->set_userdata('U4',$this->save_images('U4'));



			$this->requestIdentify();
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

			$this->session->unset_userdata('U0');
			$this->session->unset_userdata('U1');
			$this->session->unset_userdata('U2');
			$this->session->unset_userdata('U3');
			$this->session->unset_userdata('U4');

			$this->session->unset_userdata('formdata');
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
