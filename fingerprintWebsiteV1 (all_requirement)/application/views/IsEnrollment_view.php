<!DOCTYPE html>
<head>
	<meta charset="utf-8">

	<?php echo css_asset('bootstrap.min.css');?>
	<?php echo css_asset('mycss.css');?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<?php echo js_asset('bootstrap.js');?>

</head>
<body>
	<div class="container">
		<h1> เนื่องจากไม่พบลายนิ้วมือ ที่ใกล้เคียงกันในฐานข้อมูล</h1>
		<h1> คุณต้องการ ลงทะเบียน ลายนิ้วใหม่หรือไม่</h1>
		<?php echo form_open_multipart("main/form");?>
		<p style="margin-left:20%" >
			<button type="button" class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#myModal">ลงทะเบียน </button>
			<button type="button" class="btn btn-default btn-lg"> ไม่ต้องการ </button> 
		</p>

		<!-- Small modal -->
		<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button> -->

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="gridSystemModalLabel"> โปรดระบุข้อมูล ของลายนิ้วมือ : </h4>
					</div>

					<div class="panel-body" id="content" name="content">
						<div id="form" name="form">

							<br>
							<!-- <div class="form-inline" name="header" id="header"> -->
							<label style="display:inline;" for="fingerprint_date">วัน เดือน ปี ที่พิมพ์ลายนิ้วมือ *</label>
							<input class="form-control" type="date" name="collected_date" id="collected_date" style="display:inline; width: 50%;" >
							<!-- </div> -->

						</div>
						<br>
						<div class="form-horizontal" id="detail" name="detail">	
							<input class="btn btn-default btn-lg  btn-primary" type="submit" name="submit" id="submit" value="บันทึก" onclick="errorCheck()">
						</div>
					</div>
				</div>
			</div>   
		</div>
	</div>
</form>		
</div>





</body>



</html>
