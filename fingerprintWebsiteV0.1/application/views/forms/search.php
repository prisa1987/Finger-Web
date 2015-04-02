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
		        <h3 class="panel-title">ค้นลายนิ้วมือ</h3>
		    </div>
			<?php echo form_open_multipart("main/search");?>
			<div class="panel-body" id="content" name="content">
		        <div id="formupload" name="formupload">
		        	<div name="both_hand" id="both_hand" >
		        		<div class="upload" id="bothhand">
		        			<table>
		        				<tr>
		        					<tr>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_1">1</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_2">2</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_3">3</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_4">4</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_5">5</label>
											</div>
									    </td>
									</tr>
									<tr>
										<td>
											<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_1" id="finger_1">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_2" id="finger_2">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_3" id="finger_3">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_4" id="finger_4">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_5" id="finger_5">
											</div>
									    </td>
									</tr>
									<tr>
									    <td>
									     	<div class="outputarea">
												<output id="finger_1_out" name="finger_1_out"></output>
											</div>
									    </td>
									    <td>
									     	<div class="outputarea">
												<output id="finger_2_out" name="finger_2_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="finger_3_out" name="finger_3_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="finger_4_out" name="finger_4_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="finger_5_out" name="finger_5_out"></output>
											</div>
									    </td>
									</tr>
		        				</tr>
								<tr>
		        					<tr>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_6">6</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_7">7</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_8">8</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_9">9</label>
											</div>
									    </td>
									    <td>
									      	<div class="uploadlabelarea">
												<label class="uploadlabel" for="finger_10">10</label>
											</div>
									    </td>
									</tr>
									<tr>
										<td>
											<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_6" id="finger_6">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_7" id="finger_7">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_8" id="finger_8">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_9" id="finger_9">
											</div>
									    </td>
									    <td>
									    	<div class="fileUpload btn btn-default">
									      		<span>Upload</span>
												<input type="file" class="upload" name="finger_10" id="finger_10">
											</div>
									    </td>
									</tr>
									<tr>
									    <td>
									     	<div class="outputarea">
												<output id="finger_6_out" name="finger_6_out"></output>
											</div>
									    </td>
									    <td>
									     	<div class="outputarea">
												<output id="finger_7_out" name="finger_7_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="finger_8_out" name="finger_8_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="finger_9_out" name="finger_9_out"></output>
											</div>
									    </td>
									    <td>
									      	<div class="outputarea">
												<output id="finger_10_out" name="finger_10_out"></output>
											</div>
									    </td>
									</tr>
		        				</tr>	  	
							</table>
						</div>
						<br>
						<input class="btn btn-default btn-lg " type="submit" name="submit" id="submit" value="ค้นหา">
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
				var list = 'finger_1_out';
				document.getElementById('finger_1').addEventListener('change', function(){outputid('finger_1_out')}, false);
				document.getElementById('finger_1').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_2').addEventListener('change', function(){outputid('finger_2_out')}, false);
				document.getElementById('finger_2').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_3').addEventListener('change', function(){outputid('finger_3_out')}, false);
				document.getElementById('finger_3').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_4').addEventListener('change', function(){outputid('finger_4_out')}, false);
				document.getElementById('finger_4').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_5').addEventListener('change', function(){outputid('finger_5_out')}, false);
				document.getElementById('finger_5').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_6').addEventListener('change', function(){outputid('finger_6_out')}, false);
				document.getElementById('finger_6').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_7').addEventListener('change', function(){outputid('finger_7_out')}, false);
				document.getElementById('finger_7').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_8').addEventListener('change', function(){outputid('finger_8_out')}, false);
				document.getElementById('finger_8').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_9').addEventListener('change', function(){outputid('finger_9_out')}, false);
				document.getElementById('finger_9').addEventListener('change', handleFileSelect, false);
				document.getElementById('finger_10').addEventListener('change', function(){outputid('finger_10_out')}, false);
				document.getElementById('finger_10').addEventListener('change', handleFileSelect, false);
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
