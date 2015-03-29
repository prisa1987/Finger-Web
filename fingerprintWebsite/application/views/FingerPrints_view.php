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
							$fingerPos= "Un";
							$subFile =  explode("/",$key);
							$subFilename = explode("_", $subFile[4]);
							$subFilenamefingerPos = $subFilename[1];
							$subFilenamefingerPosSplit = explode(".", $subFilenamefingerPos);
							$subFilenamefingerPosWithoutExt = $subFilenamefingerPosSplit[0];
							$fingerPosFolder = $subFilename[0]."_".$subFilename[1];
							if($subFilenamefingerPosWithoutExt == "R0") $fingerPos = "Right Thumb"; 
							else if($subFilenamefingerPosWithoutExt == "R1") $fingerPos = "Right Fore"; 
							else if($subFilenamefingerPosWithoutExt == "R2") $fingerPos = "Right Middle"; 
							else if($subFilenamefingerPosWithoutExt == "R3") $fingerPos = "Right Ring"; 
							else if($subFilenamefingerPosWithoutExt == "R4") $fingerPos = "Right Little"; 

							else if($subFilenamefingerPosWithoutExt == "L0") $fingerPos = "Left Thumb"; 
							else if($subFilenamefingerPosWithoutExt == "L1") $fingerPos = "Left Fore"; 
							else if($subFilenamefingerPosWithoutExt == "L2") $fingerPos = "Left Middle"; 
							else if($subFilenamefingerPosWithoutExt == "L3") $fingerPos = "Left Ring"; 
							else if($subFilenamefingerPosWithoutExt == "L4") $fingerPos = "Left Little"; 

							echo "<td>".$fingerPos."</td>";
	  						echo "<td class='Original_result '><img "."src='".base_url().$key . "'></img></td>";
	  						// print_r( $FingerMatchesImages[$i] );
	  						echo "<td class='Match_result '><img "."src='".base_url().key($scoreAndImg[$i]) . "'></img></td>";
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
