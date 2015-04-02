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
		        <?php echo form_open_multipart("main/uploadSignature");?>
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
									     	<div class="fileUpload btn btn-default">
									     		<span>Upload</span>
												<input type="file" class="upload" name="criminal_sign" id="criminal_sign">
											</div>
									    </td>
									    <td>
									      	<div class="fileUpload btn btn-default" class="uploadarea">
									      		<span>Upload</span>
												<input type="file" class="upload" name="officer_sign" id="officer_sign">
											</div>
									    </td>
									    <td>
									      	<div class="fileUpload btn btn-default" class="uploadarea">
									      		<span>Upload</span>
												<input type="file" class="upload" name="fingerprint_number" id="fingerprint_number">
											</div>
									    </td>
									</tr>
									<tr>
									    <td>
									     	<div class="outputarea">
												<output id="criminal_sign_out" name="criminal_sign_out" ></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="officer_sign_out" name="officer_sign_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="fingerprint_number_out" name="fingerprint_number_out"></output>
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
		var list = 'criminal_sign_out';
		document.getElementById('criminal_sign').addEventListener('change', function(){outputid('criminal_sign_out')}, false);
		document.getElementById('criminal_sign').addEventListener('change', handleFileSelect, false);
		document.getElementById('officer_sign').addEventListener('change', function(){outputid('officer_sign_out')}, false);
		document.getElementById('officer_sign').addEventListener('change', handleFileSelect, false);
		document.getElementById('fingerprint_number').addEventListener('change', function(){outputid('fingerprint_number_out')}, false);
		document.getElementById('fingerprint_number').addEventListener('change', handleFileSelect, false);
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