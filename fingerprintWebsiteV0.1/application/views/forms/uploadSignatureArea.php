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
					 
					    <li class="active"><a>1</a></li>
					    <li><?php echo anchor('form_controller/loadUploadRightHand','2');?></li>
					    <li><?php echo anchor('form_controller/loadUploadLeftHand','3');?></li>
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
		        <?php echo form_open("main/uploadSignatureArea");?>
		        <div class="panel-body" id="content" name="content">
		        	<div id="formupload" name="formupload">
		        		<div id="signature">
							<div class="upload" id="sign">
								<table>
								  	<tr>
								    	<td>
								      		<div class="uploadlabelarea">
												<label class="uploadlabel" for="criminal_sign">ลายมือชื่อผู้ต้องหา </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="officer_sign">ลายมือชื่อเจ้าหน้าที่ผู้พิมพ์ลายนิ้วมือ </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="fingerprint_number">หมายเลขสารบบลายพิมพ์นิ้วมือ </label>
											</div>
									    </td>
									</tr>
									<tr>
									    <td>
										    <div ondragenter="new uploader('criminal_sign','ajaxupload','<?php echo $email;?>')">
										     	<div class="uploadarea">
													<div class="drop" id="criminal_sign" ></div>
												</div>
											</div>
									    </td>
									    <td>
										    <div ondragenter="new uploader('officer_sign','ajaxupload','<?php echo $email;?>')">
										      	<div class="uploadarea">
													<div class="drop" id="officer_sign" ></div>
												</div>
											</div>
									    </td>
									    <td>
										    <div ondragenter="new uploader('fingerprint_number','ajaxupload','<?php echo $email;?>')">
										      	<div class="uploadarea">
													<div class="drop" id="fingerprint_number" ></div>
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