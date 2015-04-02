<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<?php echo js_asset('html5uploader.js');?>
	<?php echo css_asset('bootstrap.min.css');?> 
	<?php echo css_asset('mycss.css');?>
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
			    <ul class="nav navbar-nav navbar-right">
				    <li><a class="navbar-brand">หน้า : </a></li>
				   
				    <li><?php echo anchor('form_controller/loadUploadSign','1');?></li>
				    <li><?php echo anchor('form_controller/loadUploadRightHand','2');?></li>
				    <li class="active"><a>3</a></li>
				    <li><?php echo anchor('form_controller/loadUploadBothHand','4');?></li>
				</ul>
		  	</div>
		</nav>
	</div>
	<div id="body" class="body">
			<div class="panel panel-default" id="title" class="title">
		        <div class="panel-heading">
		            <h3 class="panel-title">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
		        </div>
				<?php echo form_open("main/uploadLeftHandArea");?>
				<div class="panel-body" id="content" name="content">
		        	<div id="formupload" name="formupload">
		        		<div name="left" id="left">
		        			<div class="upload" id="wholelefthand">
		        				<table>
								  	<tr>
								    	<td>
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
											<div ondragenter="new uploader('left_thumb','ajaxupload','<?php echo $email;?>')">
										     	<div class="uploadarea">
													<div  class="drop" id="left_thumb" ></div>
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('left_fore','ajaxupload','<?php echo $email;?>')">
										     	<div class="uploadarea">
													<div  class="drop" id="left_fore" ></div>
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('left_middle','ajaxupload','<?php echo $email;?>')">
										     	<div class="uploadarea">
													<div  class="drop" id="left_middle" ></div>
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('left_ring','ajaxupload','<?php echo $email;?>')">
										      	<div class="uploadarea">
													<div  class="drop" id="left_ring" ></div>
												</div>
											</div>
									    </td>
									    <td>
									    	<div ondragenter="new uploader('left_little','ajaxupload','<?php echo $email;?>')">
										      	<div class="uploadarea">
													<div  class="drop" id="left_little" ></div>
												</div>
											</div>
									    </td>
									</tr>
								</table>
							</div>
							<br>
							<input class="btn btn-default btn-lg " type="submit" name="submit" id="submit" value="บันทึก">
						</div>
		        	</div>
		        </div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</body>
</html>
