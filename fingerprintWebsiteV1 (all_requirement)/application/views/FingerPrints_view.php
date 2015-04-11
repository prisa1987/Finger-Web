<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<?php echo css_asset('bootstrap.min.css');?>
    <?php echo css_asset('mycss.css');?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>
<body>
<div id="container">
	
	<div id="body" class="body">
		<div id="sidebar" class="sidebar">
		</div>

		<div id="content" class="content">
		
			<div class="panel panel-default" id="body" class="body">

		        <div class="panel-heading row" id="title" class="title">
		            <h3 class="panel-title"> ตรวจจับลายนิ้วมือ </h3>
		        </div>

		        <div class="row">
			      

					<div id="divTable" class="row col-md-6" style="display:block; margin-left:250px;">
						<table  id="tableResult"class="table table-striped col-md-6">
						<thead>
							<th class="col-md-3">  Finger Position </th>
							<th class="col-md-3"> Original Image</th>
	  						<th class="col-md-3"> Finger Matches </th>
	  						<th class="col-md-3"> Scores </th>
						</thead><?php $i=0;  ?>
						<?php foreach ($originalImages as $key) {

							echo "<tr class='result'>";
							// echo base_url().$key;
							$fingerPosProbe= "";
							$fingerPosMacthed = "";
							$subFile =  explode("/",$key);
							$subFilename = explode("_", $subFile[4]);
							$subFilenamefingerPos = $subFilename[1];
							$subFilenamefingerPosSplit = explode(".", $subFilenamefingerPos);
							$subFilenamefingerPosWithoutExt = $subFilenamefingerPosSplit[0];
							$fingerPosFolder = $subFilename[0]."_".$subFilename[1];
							$pathImage = "";

							//Posion from Probe
							if($subFilenamefingerPosWithoutExt == "R0")  $fingerPosProbe = "Right Thumb";  
							else if($subFilenamefingerPosWithoutExt == "R1") $fingerPosProbe = "Right Fore"; 
							else if($subFilenamefingerPosWithoutExt == "R2") $fingerPosProbe = "Right Middle"; 
							else if($subFilenamefingerPosWithoutExt == "R3") $fingerPosProbe = "Right Ring"; 
							else if($subFilenamefingerPosWithoutExt == "R4") $fingerPosProbe = "Right Little"; 

							else if($subFilenamefingerPosWithoutExt == "L0") $fingerPosProbe = "Left Thumb"; 
							else if($subFilenamefingerPosWithoutExt == "L1") $fingerPosProbe = "Left Fore"; 
							else if($subFilenamefingerPosWithoutExt == "L2") $fingerPosProbe = "Left Middle"; 
							else if($subFilenamefingerPosWithoutExt == "L3") $fingerPosProbe = "Left Ring"; 
							else if($subFilenamefingerPosWithoutExt == "L4") $fingerPosProbe = "Left Little"; 
							else $fingerPos = "Unknown Positon"; 

							//Positon from Matched
							if(strpos(key($scoreAndImg[$i]), "R0") !== false) 	{ $fingerPosMacthed = "Right Thumb"; 	$pathImage = "form/right_thumb/".$id."_"."right_thumb"."/".key($scoreAndImg[$i]); 	}
							else if(strpos(key($scoreAndImg[$i]), "R1") !== false){ $fingerPosMacthed = "Right Fore";  	$pathImage = "form/right_fore/".$id."_"."right_fore"."/".key($scoreAndImg[$i]);		}
							else if(strpos(key($scoreAndImg[$i]), "R2") !== false) { $fingerPosMacthed = "Right Middle";  $pathImage = "form/right_middle/".$id."_"."right_middle"."/".key($scoreAndImg[$i]); }
							else if(strpos(key($scoreAndImg[$i]), "R3") !== false){ $fingerPosMacthed = "Right Ring";   	$pathImage = "form/right_ring/".$id."_"."right_ring"."/".key($scoreAndImg[$i]); 	}
							else if(strpos(key($scoreAndImg[$i]), "R4") !== false){ $fingerPosMacthed = "Right Little";  $pathImage = "form/right_little/".$id."_"."right_little"."/".key($scoreAndImg[$i]); }

							else if(strpos(key($scoreAndImg[$i]), "L0") !== false){ $fingerPosMacthed = "Left Thumb"; 	$pathImage = "form/left_thumb/".$id."_"."left_thumb"."/".key($scoreAndImg[$i]); 	}
							else if(strpos(key($scoreAndImg[$i]), "L1") !== false){ $fingerPosMacthed = "Left Fore"; 	$pathImage = "form/left_fore/".$id."_"."left_fore"."/".key($scoreAndImg[$i]); 	}
							else if(strpos(key($scoreAndImg[$i]), "L2") !== false){ $fingerPosMacthed = "Left Middle"; 	$pathImage = "form/left_middle/".$id."_"."left_middle"."/".key($scoreAndImg[$i]); }
							else if(strpos(key($scoreAndImg[$i]), "L3") !== false){ $fingerPosMacthed = "Left Ring";  	$pathImage = "form/left_ring/".$id."_"."left_ring"."/".key($scoreAndImg[$i]); }
							else if(strpos(key($scoreAndImg[$i]), "L4") !== false){ $fingerPosMacthed = "Left Little"; 	$pathImage = "form/left_little/".$id."_"."left_little"."/".key($scoreAndImg[$i]); }
							

							else if(strpos(key($scoreAndImg[$i]), "U1") !== false){ $fingerPosMacthed = "Unknown Position"; 	$pathImage = "form/Unknown/"."u1"."/".key($scoreAndImg[$i]); 	}
							else if(strpos(key($scoreAndImg[$i]), "U2") !== false){ $fingerPosMacthed = "Unknown Position"; 	$pathImage = "form/left_fore/"."u2"."/".key($scoreAndImg[$i]); 	}
							else if(strpos(key($scoreAndImg[$i]), "U3") !== false){ $fingerPosMacthed = "Unknown Position"; 	$pathImage = "form/left_middle/"."u3"."/".key($scoreAndImg[$i]); }
							else if(strpos(key($scoreAndImg[$i]), "U4") !== false){ $fingerPosMacthed = "Unknown Position";  $pathImage = "form/left_ring/"."u4"."/".key($scoreAndImg[$i]); }
							else if(strpos(key($scoreAndImg[$i]), "U5") !== false){ $fingerPosMacthed = "Unknown Position"; 	$pathImage = "form/left_little/"."u5"."/".key($scoreAndImg[$i]); }

							echo "<td>".$fingerPosMacthed."</td>";
	  						echo "<td class='Original_result '><img "."src='".base_url().$key . "'></img></td>";
	  						// print_r( $FingerMatchesImages[$i] );
	  						echo "<td class='Match_result '><img "."src='".base_url()."assets/images/".$pathImage. "'></img></td>";
	  						echo "<td>".reset($scoreAndImg[$i])."</td></tr>";
	  						$i++; 
	  						
	  						}
	  					?>
						</table>
					</div>

<!-- 
					<div  class="col-md-6" style="display:block; margin-left:250px;">
						<table  class="table table-striped col-md-6">
						<thead>
							<th class="col-md-2"> Positon </th>
							<th class="col-md-2"> Fore </th>
							<th class="col-md-2"> Little </th>
	  						<th class="col-md-2">  Middle </th>
	  						<th class="col-md-2"> Ring </th>
	  						<th class="col-md-2"> Thumb </th>
						</thead>
						<?php  $i=0;
						foreach ($originalImages as $key) {
							// $isLeft = strstr($key,"left");
							 // echo $key;
							
	  						if( strpos($key,'left') !== false ){
	  							 if($i==0) { echo "<tr>";
	  							 echo "<td> Left </td>"; }
	  							 echo "<td class='Original_result '><img "."src='".base_url().$key . "'></img></td>";
	  							// echo "<td class='Original_result'><img "."src='".base_url().$key . "'></img></td>";
	  							if($i==4) echo "</tr>"; 
	  							
	  						}
	  					 	else  {
	  							if($i==5) { echo "<tr>"; echo "<td> Right </td>"; }
	  							// echo "<td class='Original_result'><img "."src='".base_url().$key . "'></img></td><";// echo "<td class='Match_result '><img "."src='".base_url().$FingerMatchesImages[$i] . "'</img></td>";
	  							 echo "<td class='Original_result '><img "."src='".base_url().$key . "'></img></td>";
	  							if($i==9) echo "</tr>";
	  						// echo "<td>".$score[$i]."</td>";
	  							
	  						}
	  						$i++;
	  					}
	  					?>
						</table>
					</div> -->


									

				</div>

					 <div class="row">
					 <a href= <?php echo base_url().'index.php/'."form_controller/loadForm1"?> >
					  	<button type="submit" name="submit"  class="btn btn-primary btn-lg" style="display:block; float:right; margin-right:30%; margin-bottom:20px;" >
							กลับสู่หน้าหลัก </button>
					</a> </div>

		    </div>

		</div>
	</div>
</div>



</body>



</html>
