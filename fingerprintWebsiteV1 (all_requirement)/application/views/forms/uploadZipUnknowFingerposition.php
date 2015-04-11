<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<?php echo css_asset('bootstrap.min.css');?>
 	<?php echo css_asset('mycss.css');?>
 	<?php echo js_asset('html5uploader.js');?>
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
		         <!-- 
		            <button type="submit" name="submit"  class="btn btn-primary" style=" float:right; margin-right: 35px; margin-top : 0px;" > คลิก </button>
		               <p class="panel-title" style=" float:right; margin-right: 30px; margin-top : 10px;">หาก ไม่สามารถระบุตำแหน่งนิ้วได้ </p> -->
		        </div>
		        <?php echo form_open_multipart("main/uploadUnKnownFingerPosition");?>
		        <div class="panel-body" id="content" name="content">
		        	<div id="formupload" name="formupload">
		        		<div name="unknownPosition" id="unknownPosition" >
		        			<div class="upload" id="wholeunknownPosition">
		        				<table>
								  	<tr>
								    	<td>
								      		<div class="uploadlabelarea">
												<label class="uploadlabel" for="unknownPosition1">นิ้วที่ 1 </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="unknownPosition2">นิ้วที่ 2</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="unknownPosition3">นิ้วที่ 3 </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="unknownPosition4">นิ้วที่ 4</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="unknownPosition5">นิ้วที่ 5 </label>
											</div>
									    </td>
									</tr>
												<tr>
									    <td>
											<div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','U1')">
										     	<div class="uploadarea">
													<div class="drop" id="U1" >
															<?php if(isset($U1_path)){ ?>
														<img id="e" src=<?php echo base_url($U1_path); ?> width="200px" height="200px"/> <?php } ?>
													</div>
													<!-- <input type="file" id="U1_url"   name="U1"  style="display:none" onchange="readURL(this);"  /> -->
												</div>
											</div>
									    </td>
									    <td>
										    <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','U2')">
										     	<div class="uploadarea">
													<div class="drop" id="U2" >
														<?php if(isset($U2_path)){ ?>
														<img id="e" src=<?php echo base_url($U2_path); ?> width="200px" height="200px"/> <?php } ?>
													</div>
													<!-- <input type="file" id="U2_url"   name="U2"  style="display:none" onchange="readURL(this);"  /> -->
												</div>
											</div>
									    </td>
									    <td>
										   <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','U3')">
										     	<div class="uploadarea">
													<div class="drop" id="U3" >
														<?php if(isset($U3_path)){ ?>
														<img id="e" src=<?php echo base_url($U3_path); ?> width="200px" height="200px"/> <?php } ?>
													</div>
													<!-- <input type="file" id="U3_url"   name="U3"  style="display:none" onchange="readURL(this);"  /> -->
												</div>
											</div>
									    </td>
									    <td>
										   <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','U4')">
										      	<div class="uploadarea">
													<div class="drop" id="U4" >
														<?php if(isset($U4_path)){ ?>
														<img id="e" src=<?php echo base_url($U4_path); ?> width="200px" height="200px"/> <?php } ?>
													</div>
													<!-- <input type="file" id="U4_url"   name="U4"  style="display:none" onchange="readURL(this);"  /> -->
												</div>
											</div>
									    </td>
									    <td>
										    <div ondragenter="new uploader('<?php echo $email;?>','ajaxupload','U5')">
										      	<div class="uploadarea">
													<div class="drop" id="U5" >
														<?php if(isset($U5_path)){ ?>
														<img id="e" src=<?php echo base_url($U5_path); ?> width="200px" height="200px"/> <?php } ?>
													</div>
													<!-- <input type="file" id="U5_url"   name="U5"  style="display:none" onchange="readURL(this);"  /> -->
												</div>
											</div>
									    </td>
									</tr>

								</table>
							</div>
							</div>
						
							<br>
							<input class="btn btn-default btn-lg " type="submit" name="submit" id="submit" value="บันทึก" style="margin-left: 220px;">
							
							 <a href= <?php echo base_url()."form_controller/loadForm1"?> >
					  	<button type="button"  class="btn btn-primary btn-lg" style="display:block; float:right; margin-right: 230px;" >
							กลับสู่หน้าหลัก </button>
					</a> 

		        	
		      
							
						
		        	</div>
		        </div>
		        <?php echo form_close();?>
				<?php echo js_asset('jquery-latest.min.js');?>
				<?php echo js_asset('jquery.inputfile.js');?>
			</div>
		</div>
	</div>
	<script>
			$("#U1").click(function () {
		    	$("#U1_url").trigger('click');
			});

			$("#U2").click(function () {
		    	$("#U2_url").trigger('click');
			});

			$("#U3").click(function () {
		    	$("#U3_url").trigger('click');
			});


			$("#U4").click(function () {
		    	$("#U4_url").trigger('click');
			});

			$("#U5").click(function () {
		    	$("#U5_url").trigger('click');
			});

		

		function readURL(input) {
        if (input.files && input.files[0]) {
        	
        	$input_id = $(input).attr('id');
        	$sp = $input_id.split("_");
        	$block_id = $sp[0];
        	// alert($block_id);
            var reader = new FileReader();

            reader.onload = (function(theFile) {
			    return function(e) {
			    	document.getElementById($block_id).innerHTML = ['<img class="addedIMG" src="', e.target.result,'" title="', theFile.name, '" width="200" height="200px"/>'].join('');
			    };
			})(input.files[0]);
            reader.readAsDataURL(input.files[0]);
 
    
        }
    }

     $( document ).ready(function() {
    	
    	  var RL = "U";
    	  var fingerPostion = "";
    	  var fingerPostion_url = "";
    
    	  for(var j=1;j<=5;j++ ){
    	  		fingerPostion = RL+j;
    	  		fingerPostion_url = fingerPostion+"_url";
    	  		var input = document.getElementById(fingerPostion_url);
    	  		readURL(input);
    	  	}
    	  

	});

	</script>
</body>
</html>
