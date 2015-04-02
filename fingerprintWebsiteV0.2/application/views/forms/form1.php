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
	  	
	</div>
	<div id="body" class="body">
        <div class="panel panel-default" id="title" class="title">
            <div class="panel-heading">
                <h3 class="panel-title">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
            </div>
            <?php echo form_open_multipart("main/form");?>
                <div class="panel-body" id="content" name="content">
                	<div id="form" name="form">
                		<br>
	                	<div class="form-inline" name="header" id="header">
							<label  class="col-xs-6" for="fingerprint_date">วัน เดือน ปี ที่พิมพ์ลายนิ้วมือ *</label>
							<input class="form-control col-xs-6" type="date" name="collected_date" id="collected_date	" >
							<br>
						
						</div>
						<br>
						<div class="form-horizontal" id="detail" name="detail">
					
							
							<input class="btn btn-default btn-lg " type="submit" name="submit" id="submit" value="บันทึก" onclick="errorCheck()">
						</div>
	                </div>
                </div>
            <?php echo form_close();?>
            </div>
        </div>
		<div id="content" class="content">	
		</div>
	</div>
</div>
</body>
</html>
