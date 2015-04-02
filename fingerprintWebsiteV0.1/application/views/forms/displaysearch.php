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
			    <form class="navbar-form navbar-left">
			        <button class="btn btn-default" type="button" id="logout" name="logout"><?php echo anchor('auth/logout','ออกจากระบบ');?></button>
			    </form>
		  	</div>
		</nav>
	</div>
	<div id="body" class="body row">
        <div class="panel panel-default row col-md-12" id="title" class="title">
            <div class="panel-heading row">
                <h3 class="panel-title">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
            </div>
            <div class="row col-md-6" style="margin-left: 20%;">
            <?php
            	if(count($json)>0){
            		$srcimage = '';
            		echo "<br><table id='tableResult' class='table table-striped col-md-4'>";
            		echo "<thead><th> No. </th>";
            		echo "<th> criminalName </th>";
            		echo "<th> organisation </th>";
            		echo "<th> scores </th>";
            		echo "<th> ดูรูป </th>";
            		// echo "<th> Image from DB </th></thead>";

	            	for ($i=0; $i <count($json) ; $i++) { 
	            		/*if($srcimage!=$json[$i]['srcImage']){
	            			echo "<br><tr><td><label>#</label></td><td><label>ID</label></td><td><label>ชื่อ - สกุล</label></td><td><label>คะแนน</label></td><td><label>ภาพต้นฉบับ</label></td><td><label>ภาพเปรียบเทียบ</label></td></tr>";
	            			$srcimage = $json[$i]['srcImage'];
	            		}*/
	            		echo "<tr style='margin-left:120px;'>";
	            		echo "<td>".$json[$i]['Id']."</td>";
	            		// echo "<td>".$json[$i]['imageID']."</td>";
	            		echo "<td>".$json[$i]['name']."</td>";
	            		echo "<td>".$json[$i]['organisation']."</td>";
	            		echo "<td>".$json[$i]['score']."</td>";
	            		echo "<td><a href='loadImage/".$json[$i]['Id']."/".$json[$i]['organisation']."'> ดู </a></td>";

	            		echo "</tr>";
	            	}
	            	echo "</table>";
            	}
            	else{
            		echo "string";
            	}
            ?>
            </div>

            </div>
        </div>
        <div >
		 <a href= <?php echo base_url().'index.php/'."form_controller/loadForm1"?> >
			<button type="button"  class="btn btn-primary btn-lg" style="display:block; float:right; margin-right: 230px;" >
							กลับสู่หน้าหลัก </button>
		</a> 

		</div>
		
	</div>


		        	
</div>
</body>
</html>
