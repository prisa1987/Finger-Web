<!DOCTYPE html>
<head>
<meta charset="utf-8">
	<link type="text/css" rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/>
	<?php echo css_asset('jquery.inputfile.css');?>
	<?php echo css_asset('structure-css.css');?> 
<!-- 	<?php echo css_asset('bootstrap.min.css');?> 
	<?php echo css_asset('jquery.inputfile.css');?>
	<?php echo css_asset('structure-css.css');?> 
	<?php echo css_asset('reset.css');?> -->
</head>
<body>
<div id="container">
	<?php echo $header;?>
	<div id="body" class="body">
		<div id="sidebar" class="sidebar">
			<!-- <div id="search">
				<?php echo form_open("search/get");?>
				<h2>Search</h2>
				<br>
				<label>ชื่อ : </label>
				&nbsp;&nbsp;
				<input type="text" id="name" name="name">
				<br>
				<label>นามสกุล : </label>
				&nbsp;&nbsp;
				<input type="text" id="surname" name="surname">
				<br><br>
				<input type="submit" name="submit" id="submit" value="Search">
				<?php echo form_close();?>
			</div> -->
			<!-- <?php echo $search;?> -->
			<!-- <br> -->
			<div id="menulist">
						<ul>
							<li><a href="loadForm" id="loadForm">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</a></li>
							<li><a href="logout" id="logout">Logout</a></li>
							<!-- <li><?php echo anchor("auth/loadForm/","แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ");?></li> -->
						</ul>
					</div>
		</div>
		<div id="content" class="content">
		
		
		</div>
	</div>
</div>
</body>
</html>
