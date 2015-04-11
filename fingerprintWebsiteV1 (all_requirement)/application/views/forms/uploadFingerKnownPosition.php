<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<?php echo css_asset('bootstrap.min.css');?>
 	<?php echo css_asset('mycss.css');?>
 	<?php echo js_asset('html5uploader.js');?>
 	<?php echo js_asset('requestIdentify.js');?>
 	<?php echo js_asset('jquery-latest.min.js');?>
	<?php echo js_asset('jquery.inputfile.js');?>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script >
			

	function readURL(input) {
		// alert(input.files.name);
        if (input.files && input.files[0]) {
        			alert("f");
        	$input_id = $(input).attr('id');
        	$sp = $input_id.split("_");
        	$block_id = $sp[0];
        	// alert($block_id);
            var reader = new FileReader();

            reader.onload = (function(theFile) {
			    return function(e) {
			    	document.getElementById($block_id).innerHTML = ['<img src="', e.target.result,'" title="', theFile.name, '" width="200" height="200px"/>'].join('');
			    };
			})(input.files[0]);
            reader.readAsDataURL(input.files[0]);
 
    
        }
    }

    function uploadZip(){
    	$("#zipFile").trigger('click');
    }

    function readURLZip(input) {
		// alert(input.files);
		
        if (input.files && input.files[0]) {
        	// alert("Sdaf");
           // reader.readAsDataURL(input.mozFullPath);
           // unzipFile(input);
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);

           // document.getElementById('form1').submit();
           $("#submitZip").trigger('click');
        }
    }


    function unzipFile(input){
    	// alert(input.files[0].name);
    		$.ajax({
		    		url : "../main/unzipFile/"+input.files[0].name,
		    		type : "post",
		    		// data : "input="+input,
		    		
		    		
		    	})
				.success(function(result){
					alert(result);
			
				});
    }

    function changeInputURL(id,filename){
	

		var t = <?php echo json_encode(base_url());    ?>;
	

    }

    $( document ).ready(function() {

    	  var RL = "";
    	  var fingerPostion = "";
    	  var fingerPostion_url = "";
    	  for(var i=0;i<2;i++){
    	  	if(i==0) RL = "R";
    	  	else RL = "L";

    	  	for(var j=0;j<5;j++ ){
    	  		fingerPostion = RL+j;
    	  		fingerPostion_url = fingerPostion+"_url";
    	  		var input = document.getElementById(fingerPostion_url);
    	  		readURL(input);
    	  	}
    	  }
	});




    	
  
	</script>
</head>
<body>
	<div id="container">
		<div class=" panel-default" id="head" name="head">
		  	<div class="panel-body" id="banner" name="banner">
		   		<img src="">
		  	</div>
		  	<nav class="navbar navbar-default" id="menubar" name="menubar">
			  	<div class="container-fluid">
			    	<a class="navbar-brand disabled">ผู้ใช้งาน : <?php echo $username;?></a>
				    <form class="navbar-form navbar-left" role="search">
				        <button class="btn btn-default" type="button" id="logout" name="logout"><?php echo anchor('auth/logout','ออกจากระบบ');?></button>
				    </form>
				    
			  	</div>
			</nav>
		</div>
		<div id="body" class="body">
			<div class="panel panel-default" id="title" class="title">
		        <div class="panel-heading">
		            <h3 class="panel-title" style="display:inline; ">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
		         	   <?php echo form_open_multipart("main/unzipFile");?>    
		         	  
		         	  <a  onclick="uploadZip();" ><button type="button" class="btn btn-primary" 
		            style="margin-left: 35px; margin-top : 0px;" > อัพโหลดเป็น Zip </button></a>
		            <input type="file" id="zipFile"   name="zipFile"  style="display:none;" onchange="readURLZip(this);"  />
		            <input class="btn btn-default btn-lg " type="submit" name="submit" id="submitZip" value="บันทึก"  style="margin-left: 220px; display:none;">
		          
		            <?php echo form_close();?>

		            <a href="loadFormUnknowFingerImage"><button type="button" class="btn btn-primary" 
		            style=" float:right; margin-right: 35px; margin-top : 0px;" > คลิก </button></a>
		             <p class="panel-title" style=" float:right; margin-right: 30px; margin-top : 10px;">หาก ไม่สามารถระบุตำแหน่งนิ้วได้ </p> 
		        </div>
		     <?php echo form_open_multipart("main/uploadKnownFingerPosition");?> 
		        <!-- <form action="main/uploadKnownFingerPosition" > -->
		        <div class="panel-body" id="content" name="content">
		        	<div id="formupload" name="formupload">
		        		<div name="right" id="right" >
		        			<div class="upload" id="wholerighthand">
		        				<table>
								  	<tr>
								    	<td>
								      		<div class="uploadlabelarea">
												<label class="uploadlabel" for="right_thumb">นิ้วหัวแม่มือขวา </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="right_fore">นิ้วชี้ขวา </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="right_middle">นิ้วกลางขวา </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="right_ring">นิ้วนางขวา </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="right_little">นิ้วก้อยขวา </label>
											</div>
									    </td>
									</tr>
	
									<tr>
									    <td>
											<div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','R0')">
										     	<div class="uploadarea">
										 
									
										     
													<div class="drop" id="R0" ></div>
														   <input type="file" id="R0_url" name="R0"  style="display:none;"  onchange="readURL(this);"/>
													
												</div>
											</div>
									    </td>
									    <td>
										    <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','R1')">
										     	<div class="uploadarea">
													<div class="drop" id="R1" ></div>
													<input type="file" id="R1_url"   name="R1"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									    <td>
										   <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','R2')">
										     	<div class="uploadarea">
													<div class="drop" id="R2" ></div>
													<input type="file" id="R2_url"   name="R2"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									    <td>
										   <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','R3')">
										      	<div class="uploadarea">
													<div class="drop" id="R3" ></div>
													<input type="file" id="R3_url"   name="R3"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									    <td>
										    <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','R4')">
										      	<div class="uploadarea">
													<div class="drop" id="R4" ></div>
													<input type="file" id="R4_url"   name="R4"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									</tr>

								</table>
							</div>
							</div>
								
		        	
		        		<div name="left" id="left"  style="margin-top:50px;">
		        			<div class="upload" id="wholelefthand">
		        				<table>
								  	<tr>
								    	<td >
								      		<div class="uploadlabelarea">
												<label class="uploadlabel" for="left_thumb">นิ้วหัวแม่มือซ้าย </label>
												
											</div>
									    </td>

									 
									    
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="left_fore">นิ้วชี้ซ้าย </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="left_middle">นิ้วกลางซ้าย </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="left_ring">นิ้วนางซ้าย </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="left_little">นิ้วก้อยซ้าย </label>
											</div>
									    </td>
									</tr>
									<tr>
										<td>
											<div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','L0')">
										     	<div class="uploadarea">

													<div  class="drop" id="L0"></div>

													<input type="file" id="L0_url"   name="L0"  style="display:none" onchange="readURL(this);"  />
													 
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','L1')">
										     	<div class="uploadarea">
													<div  class="drop" id="L1" ></div>
													<input type="file" id="L1_url"   name="L1"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','L2')">

										     	<div class="uploadarea">
													<div  class="drop" id="L2" ></div>
													<input type="file" id="L2_url"   name="L2"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','L3')">
										      	<div class="uploadarea">
													<div  class="drop" id="L3" ></div>
													<input type="file" id="L3_url"   name="L3"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','L4')">

										      	<div class="uploadarea">
													<div  class="drop" id="L4" ></div>
													<input type="file" id="L4_url"   name="L4"  style="display:none" onchange="readURL(this);"  />
												</div>
											</div>
									    </td>
									</tr>
								</table>
								
								
							</div>
							<br>
							<input class="btn btn-default btn-lg " type="submit" name="submit" id="submit" value="บันทึก"  style="margin-left: 220px;">
							 <a href= <?php echo base_url()."form_controller/loadForm1"?> >
					  	<button type="button"  class="btn btn-primary btn-lg" style="display:block; float:right; margin-right: 230px;" >
							กลับสู่หน้าหลัก </button>
					</a> 

						</div>
		        	
		      
							
						
		        	</div>
		        </div>
		        <?php echo form_close();?>
				
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$("#R0").click(function () {
		    	$("#R0_url").trigger('click');
			});

			$("#R1").click(function () {
		    	$("#R1_url").trigger('click');
			});

			$("#R2").click(function () {
		    	$("#R2_url").trigger('click');
			});

			$("#R3").click(function () {
		    	$("#R3_url").trigger('click');
			});

			$("#R4").click(function () {
		    	$("#R4_url").trigger('click');
			});

			$("#L0").click(function () {
		    	$("#L0_url").trigger('click');
			});

			$("#L1").click(function () {
		    	$("#L1_url").trigger('click');
			});

			$("#L2").click(function () {
		    	$("#L2_url").trigger('click');
			});


			$("#L3").click(function () {
		    	$("#L3_url").trigger('click');
			});

			$("#L4").click(function () {
		    	$("#L4_url").trigger('click');
			});

		
	</script>

</body>
</html>
