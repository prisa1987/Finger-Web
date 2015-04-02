<!DOCTYPE html>
<head>
<meta charset="utf-8">
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
				    <li><?php echo anchor('form_controller/loadUploadLeftHand','3');?></li>
				    <li class="active"><a>4</a></li>
				</ul>
		  	</div>
		</nav>
	</div>
	<div id="body" class="body">
		<div class="panel panel-default" id="title" class="title">
		    <div class="panel-heading">
		        <h3 class="panel-title">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
		    </div>
			<?php echo form_open_multipart("main/uploadBothHand");?>
			<div class="panel-body" id="content" name="content">
		        <div id="formupload" name="formupload">
		        	<div name="both_hand" id="both_hand" >
		        		<div class="upload" id="bothhand">
		        			<table>
								  	<tr>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="lefthand">มือซ้ายพิมพ์กดพร้อมกัน 4 นิ้ว </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="left_thumb_hand">นิ้วหัวแม่มือซ้าย </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="right_thumb_hand">นิ้วหัวแม่มือขวา </label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="righthand">มือขวาพิ้มพ์กดพร้อมกัน 4 นิ้ว </label>
											</div>
									    </td>
									</tr>
									<tr>
										<td>
											<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="lefthand" id="lefthand">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="left_thumb_hand" id="left_thumb_hand">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="right_thumb_hand" id="right_thumb_hand">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="righthand" id="righthand">
											</div>
									    </td>
									    
									</tr>
									<tr>
									    <td>
									     	<div class="outputarea">
												<output id="lefthand_out" name="lefthand_out"></output>
											</div>
									    </td>
									    <td>
									     	<div class="outputarea">
												<output id="left_thumb_hand_out" name="left_thumb_hand_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="right_thumb_hand_out" name="right_thumb_hand_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="righthand_out" name="righthand_out"></output>
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
			<?php echo js_asset('jquery-latest.min.js');?>
			<?php echo js_asset('jquery.inputfile.js');?>
			</div>
		</div>
	</div>
			<script>
				$('input[type="file"]').inputfile({
					uploadButtonClass: 'btn btn-primary'
				});
				var list = 'lefthand_out';
				document.getElementById('lefthand').addEventListener('change', function(){outputid('lefthand_out')}, false);
				document.getElementById('lefthand').addEventListener('change', handleFileSelect, false);
				document.getElementById('left_thumb_hand').addEventListener('change', function(){outputid('left_thumb_hand_out')}, false);
				document.getElementById('left_thumb_hand').addEventListener('change', handleFileSelect, false);
				document.getElementById('right_thumb_hand').addEventListener('change', function(){outputid('right_thumb_hand_out')}, false);
				document.getElementById('right_thumb_hand').addEventListener('change', handleFileSelect, false);
				document.getElementById('righthand').addEventListener('change', function(){outputid('righthand_out')}, false);
				document.getElementById('righthand').addEventListener('change', handleFileSelect, false);
				function handleFileSelect(evt) {
			        var files = evt.target.files;
			        var f = files[0];
			        var reader = new FileReader();
			        reader.onload = (function(theFile) {
			            return function(e) {
			             	document.getElementById(list).innerHTML = ['<img src="', e.target.result,'" title="', theFile.name, '" width="200px" height="200px"/>'].join('');
			                };
			          })(f);
			          reader.readAsDataURL(f);
				}
				function outputid(id){
					list = id;
				}
			 </script>
</body>
</html>
