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
		<!-- 	<div class=" panel-default" id="head" name="head">
			  	<div class="panel-body" id="banner" name="banner">
			   		<img src="">
			  	</div>
			  	<nav class="navbar navbar-default" id="menubar" name="menubar">
				  	<div class="container-fluid">
				    	<a class="navbar-brand disabled">ผู้ใช้งาน : <?php echo $username;?></a>
					    <form class="navbar-form navbar-left">
					        <button class="btn btn-default" type="button" id="logout" name="logout"><?php echo anchor('auth/logout','ออกจากระบบ');?></button>
					    </form>
					    <ul class="nav navbar-nav navbar-right">
					    	
						    <li><a class="navbar-brand">หน้า : </a></li>
						    <li class="active"><a>1</a></li>
						    <li><?php echo anchor('form_controller/loadUploadSign','2');?></li>
						    <li><?php echo anchor('form_controller/loadUploadRightHand','3');?></li>
						    <li><?php echo anchor('form_controller/loadUploadLeftHand','4');?></li>
						    <li><?php echo anchor('form_controller/loadUploadBothHand','5');?></li>
						</ul>
				  	</div>
				</nav>
			</div> -->
			<div class="panel panel-default" id="body" class="body">

		        <div class="panel-heading row" id="title" class="title">
		            <h3 class="panel-title"> ตรวจจับลายนิ้วมือ </h3>
		        </div>

		        <div class="row">
			      

					<div id="divTable" class="col-md-6" style="display:block; margin-left:250px;">
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
							$subFile =  explode("/",$key);
							$subFilename = explode("_", $subFile[4]);
							$fingerPos = $subFilename[0]." ".$subFilename[1];
							$fingerPosFolder = $subFilename[0]."_".$subFilename[1];

							// $id = 21;
							echo "<td>".$fingerPos."</td>";
	  						echo "<td class='Original_result '><img "."src='".base_url().$key . "'></img></td>";
	  							
	  						echo "<td class='Match_result '><img "."src='".base_url().$FingerMatchesImages[$i] . "'></img></td>";
	  						echo "<td>".$score[$i]."</td></tr>";
	  						$i++;
	  						}
	  					?>
						</table>
					</div>


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
					</div>


									

				</div>
		    </div>

		</div>
	</div>
</div>



</body>



</html>
