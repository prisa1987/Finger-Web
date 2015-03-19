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
			        <div id="formProbe" class="col-md-4" >
			        	<!-- <iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0"></iframe> -->
				        <!-- <?php echo form_open_multipart('verifyPerson/uploadProbeImage'); ?> -->
					  	<!-- <form id="fileupload" action="verifyPerson/uploadProbeImage" method="post" enctype="multipart/form-data" onsubmit="return clickupload();" target="uploadtarget"> -->
					        	<!--  <a class="thumbnail">
								      <img id="upfileProbe" <?php echo image_asset('addBlock.png');   ?> 
								      
								 </a> -->
								
												
							<!-- <div style="margin-top:20px; margin-bottom:10px; margin-left:150px;">
							  <button type="reset" value="Reset" class="btn btn-danger reset-Btn" style="">Reset</button>
							  <button id="searchBtn" type="submit" class="btn btn-warning confirm-Btn" value="upload"> Search</button>
							</div> -->


						<!-- </form> -->
					</div>



					<div id="divTable" class="col-md-6" style="display:block;">
						<table  id="tableResult"class="table table-striped col-md-6">
						<!-- thead>
							<th> First Name </th>
	  						<th> Score </th>
						</thead> -->
	  					<!-- <tr class="result">
	  						<td class="firstName_result"></td>
	  						<td class="score_result"></td>
	  					</tr> -->
						</table>
					</div>

									

				</div>
		    </div>

		</div>
	</div>
</div>


<script>
  	
  

   //  $( document ).ready(function() {
   //  //	alert("sadfa");
   //  	$.ajax({
		 //    		url : "getJSONPerson",
		 //    		type : "post",
		 //    		dataType: "json",
		    		


		 //    	})
			// 	.success(function(result){
			// 	//alert(result);
			// 	if (result == null) { alert("null")};	
			// 		var trHtml = '';
			// 	alert("wait");
			// 	  var obj = JSON.stringify(result);
				  
			// 	alert(obj);
			
			// 	 trHtml += '<thead><th> First Name </th><th>File Name</th><th> Score </th><th> ลายนิ้วมือ </th></thead>'
			// 	 		//var objJSON = eval("(function(){return " + strJSON + ";})()");
		 //    		$.each(obj, function(key,val){
		    	 		
		 //    			trHtml += '<tr><td class="firstName_result">' + val['name'] +'</td>'+
		 //    			'<td >' +val['fileName'] + '</td>' +
		 //    			'<td class="score_result">' + val['score'] +  '</td>' + 
		 //    			'<td><a href="loadImage/'+ val['Id']+'"> ดู </a>'+ '</td>' + 
		 //    			'</tr>'
		 //    		});
		 //    		$('#divTable').css("display","inline");
		 //    		$('#tableResult').append(trHtml);

			// 	});//

		 // });//

		 

    	
    
	
</script>
</body>



</html>
