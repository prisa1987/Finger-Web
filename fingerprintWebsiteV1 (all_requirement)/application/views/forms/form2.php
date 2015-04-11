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
							<?php echo '<input class="form-control col-md-6" type="date" name="collected_date" id="collected_date" value="'.$collected_date.'">';?>
							<br>
							<input class="btn btn-default btn-lg " type="submit" name="submit" id="submit" value="บันทึก" onclick="errorCheck()">
							<!-- <label class="col-md-6" for="department">ส่วนราชการ *</label>
							<?php echo '<input class="form-control col-md-6" type="text" name="department" id="department" value="'.$department.'">';?> -->
						</div>
						
							
						
	                </div>
	            </div>
	            <?php echo form_close();?>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
		var collected_date	 = '<?php echo $collected_date;?>';
		// var department = '<?php echo $department;?>';
		// var criminal_sex = '<?php echo $criminal_sex;?>';
		// var yearofbirth = '<?php echo $yearofbirth;?>';
		// var criminal_name = '<?php echo $criminal_name;?>';
		// var criminal_surname = '<?php echo $criminal_surname;?>';
		// var officer_name = '<?php echo $officer_name;?>';
		// var officer_surname = '<?php echo $officer_surname;?>';
		// var history_number = '<?php echo $history_number;?>';
		// var fingerprint_code = '<?php echo $fingerprint_code;?>';
		// var other_code = '<?php echo $other_code;?>';
		// set dropdown value
		// if(criminal_sex!=''){
		// 	document.getElementById('criminal_sex').value = criminal_sex;
		// }
		// // set dropdown value
		// if(yearofbirth!=''){
		// 	document.getElementById('yearofbirth').value = yearofbirth;
		// }
		// warn user with red border on blank input field
		if(fingerprint_date=='') {
			document.getElementById('collected_date	').style.border = '1px solid red';
			document.getElementById('collected_date	').style.boxShadow =  '0px 0px 8px red';
		}
		// if(department=='') {
		// 	document.getElementById('department').style.border = '1px solid red';
		// 	document.getElementById('department').style.boxShadow =  '0px 0px 8px red';
		// }

		// if(criminal_sex=='') {
		// 	document.getElementById('criminal_sex').style.border = '1px solid red';
		// 	document.getElementById('criminal_sex').style.boxShadow =  '0px 0px 8px red';
		// }
		// if(yearofbirth=='') {
		// 	document.getElementById('yearofbirth').style.border = '1px solid red';
		// 	document.getElementById('yearofbirth').style.boxShadow =  '0px 0px 8px red';
		// }
		// if(criminal_name=='') {
		// 	document.getElementById('criminal_name').style.border = '1px solid red';
		// 	document.getElementById('criminal_name').style.boxShadow =  '0px 0px 8px red';
		// }
		// if(criminal_surname=='') {
		// 	document.getElementById('criminal_surname').style.border = '1px solid red';
		// 	document.getElementById('criminal_surname').style.boxShadow =  '0px 0px 8px red';
		// }
		// if(officer_name=='') {
		// 	document.getElementById('officer_name').style.border = '1px solid red';
		// 	document.getElementById('officer_name').style.boxShadow =  '0px 0px 8px red';
		// }
		// if(officer_surname=='') {
		// 	document.getElementById('officer_surname').style.border = '1px solid red';
		// 	document.getElementById('officer_surname').style.boxShadow =  '0px 0px 8px red';
		// }
	</script>
</body>
</html>
