<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<?php echo css_asset('bootstrap.min.css');?>
	<?php echo css_asset('mycss.css');?>
	<?php echo js_asset('jquery-2.1.1.js');?>
<script>
  	
  
function callRequestIdentify(id){
    //	alert("sadfa");
    	$.ajax({
		    		url : "../main/requestIdentify",
		    		type : "post",
		    		
		    		
		    	})
				.success(function(result){
								
					var not_matched = "not_matched";
					// alert( typeof(not_matched) );
					alert( result.trim());

					var status_id = "#status_"+id;
					var pdfLink_id = "#pdfLink_"+id;

					if(result.trim() == not_matched) callIsenroll();
					else if(result.trim() == "matched"){
						var base_url = <?php echo json_encode(base_url());?>;	
						var arr = <?php echo json_encode($queryarr);?>;	
						var filename = arr[id]['history_id']+"_matched.pdf";
						var email = <?php echo json_encode($email);?>;	
						// alert(filename);
						// alert(fullpath);

						$( status_id ).replaceWith( "<td id="+status_id+">"+ "matched" +"</td>");
						$( pdfLink_id ).replaceWith( "<td id="+pdfLink_id+"><a target='_blank' href='"+base_url+"assets/images/history_pdf/"+email+"/"+filename+"'>คลิก</a></td>");
					}
					else if(result.trim() == "reject"){
						$( status_id ).replaceWith( "<td id="+status_id+">"+ "reject" +"</td>");
					} 
					else if(result.trim() == "pending"){
						$( status_id ).replaceWith( "<td id="+status_id+">"+ "pending" +"</td>");
					} 

				
					// return result.trim();
				});

		 

}

function callIsenroll(){
	window.location.href = "../main/callIsEnroll";
}

    
	
</script>

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
			    <form class="navbar-form navbar-left">
			        <button class="btn btn-default" type="button" id="logout" name="logout"><?php echo anchor('auth/logout','ออกจากระบบ');?></button>
			    	<!-- <button class="btn btn-default" type="button" id="logout" name="logout"><?php echo anchor('verifyPerson','ตรวจจับ');?></button> -->
			    </form>
			    <!-- <ul class="nav navbar-nav navbar-right">

				   	
				    <li><a class="navbar-brand">หน้า : </a></li>
				    <li><?php echo anchor('form_controller/loadUploadSign','1');?></li>
				    <li><?php echo anchor('form_controller/loadUploadRightHand','2');?></li>
				    <li><?php echo anchor('form_controller/loadUploadLeftHand','3');?></li>
				    <li><?php echo anchor('form_controller/loadUploadBothHand','4');?></li>
				</ul> -->
		  	</div>
		</nav>
	</div>
	<div id="body" class="body">
        <div class="panel panel-default" id="title" class="title">
            <div class="panel-heading">
                <h3 class="panel-title">ประวัติการใช้งาน</h3>
            </div>
            <!-- <?php echo form_open_multipart("form_controller/loadData");?> -->
                <div class="panel-body" id="content" name="content">
                	<label class="col-md-6" for="yearofbirth">Filter : </label>
					<select class=""  id="filter" name="filter" onchange="setFilter()">
						<!-- <option value="" disabled="disabled" selected="selected">เลือก</option> -->
						<option value="total" selected="selected">ทั้งหมด</option>
						<option value="enrolled">ลงทะเบียน</option>
						<option value="reject">ไม่ลงทะเบียน</option>
						<option value="matched">ค้นพบ</option>
						<option value="matching">กำลังค้นหา</option>

					</select>
					<label class="col-md-6" for="yearofbirth">องค์กร : <?php echo $organisation;?></label>
					<div id="area" name="area">
						<table>
							<tr>
								<td>วันที่</td>
								<td>รหัสเอกสาร</td>
								<td>สถานะ</td>
								<td>รายละเอียด</td>
							</tr>
							<?php
								if(count($queryarr)>0){
									for ($i=0; $i<count($queryarr); $i++) { 
										echo "<tr><td >".$queryarr[$i]['system_date']."</td>";
										echo "<td></td>";
										echo "<td id='status_".$i."'>".$queryarr[$i]['status']."</td>";
										if($queryarr[$i]['status'] == "matching" ) echo "<script> callRequestIdentify(".$i."); </script>";  
										$fullpath = base_url('/assets/images/history_pdf/'.$email.'/'.$queryarr[$i]['history_id'].'_'.$queryarr[$i]['status'].'.pdf');
										if($queryarr[$i]['status']=="rejected"||$queryarr[$i]['status']=="matching" || $queryarr[$i]['status']=="pending")
											echo "<td id='pdfLink_".$i."'>-</td></tr>";
										else
											echo "<td id='pdfLink_".$i."'><a  target='_blank' href='".$fullpath."'>คลิก</a></td></tr>";
									}
								}
							?>
						</table>
					</div>
					<br>
					<button type="button" class='btn btn-default'><?php echo anchor('form_controller/loadFormFingerImage','กลับหน้าค้นหา'); ?></button>
                </div>
            <!-- <?php echo form_close();?> -->
            </div>
        </div>
	</div>

	<script type="text/javascript">
	function setFilter(){
		var filter = document.getElementById('filter').value;
		setArea(filter);			
	}
	function setArea(filter){
		var arr = <?php echo json_encode($queryarr);?>;
		var email = <?php echo json_encode($email);?>;
		var code = '<table><tr><td>วันที่</td><td>รหัสเอกสาร</td><td>สถานะ</td><td>รายละเอียด</td></tr>';
		for (var i = 0; i < arr.length; i++) {
			var system_date = arr[i].system_date;
			var form_id = arr[i].form_id;
			var status = arr[i].status;
			var history_id = arr[i].history_id;
			var filepath = '/fingerprintWebsite/assets/history_pdf/'+email+'/'+history_id+'.pdf';
			if(status==filter){
				code += '<tr><td>'+system_date+'</td><td>'+form_id+'</td><td>'+status+'</td>';
				if((status=='reject')||(status=='matching')||(status=='pending')) code += '<td>-</td></tr>';
				else code += '<td><a href="'+filepath+'">คลิก</a></td></tr>'
			}else if(filter == "total"){
					code += '<tr><td>'+system_date+'</td><td>'+form_id+'</td><td>'+status+'</td>';
				if((status=='reject')||(status=='matching')||(status=='pending')) code += '<td>-</td></tr>';
				else code += '<td><a href="'+filepath+'">คลิก</a></td></tr>'
			}
		};
		document.getElementById('area').innerHTML = code;
	}
</script>

</body>
</html>


