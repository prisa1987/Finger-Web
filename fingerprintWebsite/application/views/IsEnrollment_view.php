<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<?php echo css_asset('bootstrap.min.css');?>
    <?php echo css_asset('mycss.css');?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>
<body>
<div class="container">
	<h1> เนื่องจากไม่พบลายนิ้วมือ ที่ใกล้เคียงกันในฐานข้อมูล</h1>
	<h1> คุณต้องการ ลงทะเบียน ลายนิ้วใหม่หรือไม่</h1>
	 <?php echo form_open_multipart("form_controller/loadForm");?>
	<p style="margin-left:20%" >
	  <button type="submit" name="submit"  class="btn btn-primary btn-lg">ลงทะเบียน </button>
	  <button type="button" class="btn btn-default btn-lg"> ไม่ต้องการ </button>
	</p>
	</form>
			
</div>



</body>



</html>
