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
			  <!-- 	<div class="container-fluid">
			    	<a class="navbar-brand disabled">ผู้ใช้งาน : <?php echo $username;?></a>
				    <form class="navbar-form navbar-left">
				        <button class="btn btn-default" type="button" id="logout" name="logout"><?php echo anchor('auth/logout','ออกจากระบบ');?></button>
				        <button class="btn btn-default" type="button" id="logout" name="logout"><?php echo anchor('auth/logout','ออกจากระบบ');?></button>
				    </form>
				    <ul class="nav navbar-nav navbar-right">
				    	
				    	
					    <li><a class="navbar-brand">หน้า : </a></li>
					    
					    <li><?php echo anchor('form_controller/loadUploadSign','1');?></li>
					    <li><?php echo anchor('form_controller/loadUploadRightHand','2');?></li>
					    <li><?php echo anchor('form_controller/loadUploadLeftHand','3');?></li>
					    <li><?php echo anchor('form_controller/loadUploadBothHand','4');?></li>
					</ul>
			  	</div> -->
			</nav>
		</div>
	    <div class="panel panel-default" id="body" class="body">
	        <div class="panel-heading" id="title" class="title">
	            <h3 class="panel-title">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
	        </div>
	        <?php echo form_open_multipart("main/form");?>
	            <div class="panel-body" id="content" name="content">
	            	<div id="form" name="form">
	            		<br>
		                <div class="form-inline" name="header" id="header">
							<label class="col-md-6" for="fingerprint_date">วัน เดือน ปี ที่พิมพ์ลายนิ้วมือ *</label>
							<?php echo '<input class="form-control col-md-6" type="date" name="fingerprint_date" id="fingerprint_date" value="'.$fingerprint_date.'">';?>
							<br>
							<label class="col-md-6" for="department">ส่วนราชการ *</label>
							<?php echo '<input class="form-control col-md-6" type="text" name="department" id="department" value="'.$department.'">';?>
						</div>
						<br>
						<div class="form-horizontal" id="detail" name="detail">
							<div class="form-horizontal" name="criminal" id="criminal">
								<label for="criminal" class="bold"><b>ผู้ถูกพิมพ์ลายนิ้วมือ </b></label>
								<div class="form-inline">
									<label class="col-md-6" for="criminal_sex">เพศ *</label>
									<?php echo '<select class="form-control col-md-6" id="criminal_sex" name="criminal_sex" select="'.$criminal_sex.'">';?>
										<option value="" disabled="disabled" selected="selected">เลือก</option>
										<option value="male">ชาย</option>
										<option value="female">หญิง</option>
									</select>
									<label class="col-md-6" for="yearofbirth">เกิด&nbsp;&nbsp;พ.ศ. *</label>
									<select class="form-control col-md-6"  id="yearofbirth" name="yearofbirth">
											    <option value="" disabled="disabled" selected="selected">เลือก</option>
											    <option value="2480">2480</option>
											    <option value="2481">2481</option>
											    <option value="2482">2482</option>
											    <option value="2483">2483</option>
											    <option value="2484">2484</option>
											    <option value="2485">2485</option>
											    <option value="2486">2486</option>
											    <option value="2487">2487</option>
											    <option value="2488">2488</option>
											    <option value="2489">2489</option>
											    <option value="2490">2490</option>
											    <option value="2491">2491</option>
											    <option value="2492">2492</option>
											    <option value="2493">2493</option>
											    <option value="2494">2494</option>
											    <option value="2495">2495</option>
											    <option value="2496">2496</option>
											    <option value="2497">2497</option>
											    <option value="2498">2498</option>
											    <option value="2499">2499</option>
											    <option value="2500">2500</option>
											    <option value="2501">2501</option>
											    <option value="2502">2502</option>
											    <option value="2503">2503</option>
											    <option value="2504">2504</option>
											    <option value="2505">2505</option>
											    <option value="2506">2506</option>
											    <option value="2507">2507</option>
											    <option value="2508">2508</option>
											    <option value="2509">2509</option>
											    <option value="2510">2510</option>
											    <option value="2511">2511</option>
											    <option value="2512">2512</option>
											    <option value="2513">2513</option>
											    <option value="2514">2514</option>
											    <option value="2515">2515</option>
											    <option value="2516">2516</option>
											    <option value="2517">2517</option>
											    <option value="2518">2518</option>
											    <option value="2519">2519</option>
											    <option value="2520">2520</option>
											    <option value="2521">2521</option>
											    <option value="2522">2522</option>
											    <option value="2523">2523</option>
											    <option value="2524">2524</option>
											    <option value="2525">2525</option>
											    <option value="2526">2526</option>
											    <option value="2527">2527</option>
											    <option value="2528">2528</option>
											    <option value="2529">2529</option>
											    <option value="2530">2530</option>
											    <option value="2531">2531</option>
											    <option value="2532">2532</option>
											    <option value="2533">2533</option>
											    <option value="2534">2534</option>
											    <option value="2535">2535</option>
											    <option value="2536">2536</option>
											    <option value="2537">2537</option>
									</select>
								</div>
								<div class="form-inline">
									<label class="col-md-6" for="criminal_name">ชื่อ *</label>
									<?php echo '<input class="form-control col-md-6" type="text" name="criminal_name" id="criminal_name" value="'.$criminal_name.'">';?>
									<label class="col-md-6" for="criminal_surname">นามสกุล *</label>
									<?php echo '<input class="form-control col-md-6" type="text" name="criminal_surname" id="criminal_surname" value="'.$criminal_surname.'">';?>
								</div>
							</div>
							<br>
							<div class="form-horizontal" name="officer" id="officer">
								<label for="officer" class="bold"><b>เจ้าหน้าที่ผู้พิมพ์ลายนิ้วมือ</b></label>
								<div class="form-inline">
									<label class="col-md-6" for="officer_name">ชื่อ *</label>
									<?php echo '<input class="form-control col-md-6" type="text" name="officer_name" id="officer_name" value="'.$officer_name.'">';?>
									<label class="col-md-6" for="officer_surname">นามสกุล *</label>
									<?php echo '<input class="form-control col-md-6" type="text" name="officer_surname" id="officer_surname" value="'.$officer_surname.'">';?>
								</div>
							</div>
							<br>
							<div class="form-horizontal" id="other" name="other">
								<div class="form-inline">
									<label class="col-md-6" for="history_number">หมายเลขบัญชีประวัติการกระทำความผิด </label>
									<?php echo '<input class="form-control col-md-6" type="text" name="history_number" id="history_number" value="'.$history_number.'">';?>
								</div>
								<div class="form-inline">
									<label class="col-md-6" for="fingerprint_code">รหัสลายพิมพ์นิ้วมือ </label>
									<?php echo '<input class="form-control col-md-6" type="text" name="fingerprint_code" id="fingerprint_code" value="'.$fingerprint_code.'">';?>
								</div>
								<div class="form-inline">
									<label class="col-md-6" for="other_code">แยกรหัสอื่น </label>
									<?php echo '<input class="form-control col-md-6" type="text" name="other_code" id="other_code" value="'.$other_code.'">';?>
								</div>
							</div>
							<br>
							<label class="col-md-6" id="star" name="star">ช่องที่มีเครื่องหมาย * ต้องกรอกให้ครบ</label>
							<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
							<br>
							<input class="btn btn-default btn-lg " type="submit" name="submit" id="submit" value="บันทึก" onclick="errorCheck()">
						</div>
	                </div>
	            </div>
	            <?php echo form_close();?>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
		var fingerprint_date = '<?php echo $fingerprint_date;?>';
		var department = '<?php echo $department;?>';
		var criminal_sex = '<?php echo $criminal_sex;?>';
		var yearofbirth = '<?php echo $yearofbirth;?>';
		var criminal_name = '<?php echo $criminal_name;?>';
		var criminal_surname = '<?php echo $criminal_surname;?>';
		var officer_name = '<?php echo $officer_name;?>';
		var officer_surname = '<?php echo $officer_surname;?>';
		var history_number = '<?php echo $history_number;?>';
		var fingerprint_code = '<?php echo $fingerprint_code;?>';
		var other_code = '<?php echo $other_code;?>';
		// set dropdown value
		if(criminal_sex!=''){
			document.getElementById('criminal_sex').value = criminal_sex;
		}
		// set dropdown value
		if(yearofbirth!=''){
			document.getElementById('yearofbirth').value = yearofbirth;
		}
		// warn user with red border on blank input field
		if(fingerprint_date=='') {
			document.getElementById('fingerprint_date').style.border = '1px solid red';
			document.getElementById('fingerprint_date').style.boxShadow =  '0px 0px 8px red';
		}
		if(department=='') {
			document.getElementById('department').style.border = '1px solid red';
			document.getElementById('department').style.boxShadow =  '0px 0px 8px red';
		}

		if(criminal_sex=='') {
			document.getElementById('criminal_sex').style.border = '1px solid red';
			document.getElementById('criminal_sex').style.boxShadow =  '0px 0px 8px red';
		}
		if(yearofbirth=='') {
			document.getElementById('yearofbirth').style.border = '1px solid red';
			document.getElementById('yearofbirth').style.boxShadow =  '0px 0px 8px red';
		}
		if(criminal_name=='') {
			document.getElementById('criminal_name').style.border = '1px solid red';
			document.getElementById('criminal_name').style.boxShadow =  '0px 0px 8px red';
		}
		if(criminal_surname=='') {
			document.getElementById('criminal_surname').style.border = '1px solid red';
			document.getElementById('criminal_surname').style.boxShadow =  '0px 0px 8px red';
		}
		if(officer_name=='') {
			document.getElementById('officer_name').style.border = '1px solid red';
			document.getElementById('officer_name').style.boxShadow =  '0px 0px 8px red';
		}
		if(officer_surname=='') {
			document.getElementById('officer_surname').style.border = '1px solid red';
			document.getElementById('officer_surname').style.boxShadow =  '0px 0px 8px red';
		}
	</script>
</body>
</html>
