<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<?php echo css_asset('bootstrap.min.css');?>
    <?php echo css_asset('mycss.css');?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>
<body>
<div class="container">
	<!-- <h1> เนื่องจากไม่พบลายนิ้วมือ ที่ใกล้เคียงกันในฐานข้อมูล</h1> -->
	<h1 style="margin-left:10%"> เลือก  ฟังก์ชัน ที่คุณต้องการใช้</h1>
	
	<p style="margin-left:20%; margin-top:3%;" >
	  
	  <a href= <?php echo base_url("/form_controller/loadFormFingerImage") ?>
	  	<button type="submit" name="submit"  class="btn btn-primary btn-lg" style="display:block;  width:200px; height:60px;" >
	   ระบุตัวตน </button></a> 
	  <button type="button" class="btn btn-default btn-lg" style="margin-top:2%; width:200px; height:60px;"> ยืนยันตัวตน </button>
	</p>
	</form>
			
</div>



</body>



</html>
