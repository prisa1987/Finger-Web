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
				  
				    <!-- <li><?php echo anchor('form_controller/loadUploadSign','1');?></li> -->
				    <li><?php echo anchor('form_controller/loadUploadRightHand','1');?></li>
				    <li class="active"><a>2</a></li>
				 	<!--   <li><?php echo anchor('form_controller/loadUploadBothHand','4');?></li> -->
				</ul>
		  	</div>
		</nav>
	</div>
	<div id="body" class="body">
			<div class="panel panel-default" id="title" class="title">
		        <div class="panel-heading">
		            <h3 class="panel-title">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
		        </div>
				<?php echo form_open_multipart("main/uploadLeftHand");?>
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
									     	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="left_thumb" id="left_thumb">
											</div>
									    </td>
									    <td>
									     	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="left_fore" id="left_fore">
											</div>
									    </td>
									    <td>
									     	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="left_middle" id="left_middle">
											</div>
									    </td>
									    <td>
									      	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="left_ring" id="left_ring">
											</div>
									    </td>
									    <td>
									      	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="left_little" id="left_little">
											</div>
									    </td>
									</tr>
									<tr>
									    <td>
									     	<div class="outputarea">
												<output id="left_thumb_out" name="left_thumb_out"></output>
											</div>
									    </td>
									    <td>
									     	<div class="outputarea">
												<output id="left_fore_out" name="left_fore_out"></output>
											</div>
									    </td>
									    <td>
									     	<div class="outputarea">
												<output id="left_middle_out" name="left_middle_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="left_ring_out" name="left_ring_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="left_little_out" name="left_little_out"></output>
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
		var list = 'left_thumb_out';
				
				document.getElementById('left_thumb').addEventListener('change', function(){outputid('left_thumb_out')}, false);
				document.getElementById('left_thumb').addEventListener('change', handleFileSelect, false);
				document.getElementById('left_fore').addEventListener('change', function(){outputid('left_fore_out')}, false);
				document.getElementById('left_fore').addEventListener('change', handleFileSelect, false);
				document.getElementById('left_middle').addEventListener('change', function(){outputid('left_middle_out')}, false);
				document.getElementById('left_middle').addEventListener('change', handleFileSelect, false);
				document.getElementById('left_ring').addEventListener('change', function(){outputid('left_ring_out')}, false);
				document.getElementById('left_ring').addEventListener('change', handleFileSelect, false);
				document.getElementById('left_little').addEventListener('change', function(){outputid('left_little_out')}, false);
				document.getElementById('left_little').addEventListener('change', handleFileSelect, false);
				function handleFileSelect(evt) {
			        var files = evt.target.files;
			        var f = files[0];
			        var reader = new FileReader();
			        reader.onload = (function(theFile) {
			            return function(e) {
			             	document.getElementById(list).innerHTML = ['<img src="', e.target.result,'" title="', theFile.name, '" width="200" height="200"/>'].join('');
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
