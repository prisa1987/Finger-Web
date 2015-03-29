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
					    
					<!--     <li><?php echo anchor('form_controller/loadUploadSign','1');?></li> -->
					    <li class="active"><a>1</a></li>
					    <li><?php echo anchor('form_controller/loadUploadLeftHand','2');?></li>
					    <!-- <li><?php echo anchor('form_controller/loadUploadBothHand','4');?></li> -->
					</ul>
			  	</div>
			</nav>
		</div>
		<div id="body" class="body">
			<div class="panel panel-default" id="title" class="title">
		        <div class="panel-heading">
		            <h3 class="panel-title">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
		        </div>
		        <?php echo form_open_multipart("main/uploadRightHand");?>
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
									     	<div class="fileUpload btn btn-default">
									     		<span>Upload</span>
												<input type="file" class="upload" name="right_thumb" id="right_thumb">
											</div>
									    </td>
									    <td>
									     	<div class="fileUpload btn btn-default">
									     		<span>Upload</span>
												<input type="file" class="upload" name="right_fore" id="right_fore">
											</div>
									    </td>
									    <td>
									     	<div class="fileUpload btn btn-default">
									     		<span>Upload</span>
												<input type="file" class="upload" name="right_middle" id="right_middle">
											</div>
									    </td>
									    <td>
									      	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="right_ring" id="right_ring">
											</div>
									    </td>
									    <td>
									      	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="right_little" id="right_little">
											</div>
									    </td>
									</tr>
									<tr>
									    <td>
									     	<div class="outputarea">
												<output id="right_thumb_out" name="right_thumb_out"></output>
											</div>
									    </td>
									    <td>
									     	<div class="outputarea">
												<output id="right_fore_out" name="right_fore_out"></output>
											</div>
									    </td>
									    <td>
									     	<div class="outputarea">
												<output id="right_middle_out" name="right_middle_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="right_ring_out" name="right_ring_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="right_little_out" name="right_little_out"></output>
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
		var list = 'right_thumb_out';
		document.getElementById('right_thumb').addEventListener('change', function(){outputid('right_thumb_out')}, false);
		document.getElementById('right_thumb').addEventListener('change', handleFileSelect, false);
		document.getElementById('right_fore').addEventListener('change', function(){outputid('right_fore_out')}, false);
		document.getElementById('right_fore').addEventListener('change', handleFileSelect, false);
		document.getElementById('right_middle').addEventListener('change', function(){outputid('right_middle_out')}, false);
		document.getElementById('right_middle').addEventListener('change', handleFileSelect, false);
		document.getElementById('right_ring').addEventListener('change', function(){outputid('right_ring_out')}, false);
		document.getElementById('right_ring').addEventListener('change', handleFileSelect, false);
		document.getElementById('right_little').addEventListener('change', function(){outputid('right_little_out')}, false);
		document.getElementById('right_little').addEventListener('change', handleFileSelect, false);
		function handleFileSelect(evt) {
			var files = evt.target.files;
			var f = files[0];
			var reader = new FileReader();
			reader.onload = (function(theFile) {
			    return function(e) {
			    	document.getElementById(list).innerHTML = ['<img src="', e.target.result,'" title="', theFile.name, '" width="200" height="200px"/>'].join('');
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
