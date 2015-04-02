<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
* 
*/
class MY_Structure
{
	function __construct()
	{
	}
	public function getHeader(){
		$data = '<div id="head" class="head"></div>';
		return $data;
	}
	public function getSearch(){
		$data = '<div id="search">
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
				</div>';
		return $data;
	}

	public function getMenuList(){
			$data = '<div id="menulist">
						<ul>
						<li><?php echo anchor("member/edit/","แก้ไข");?></li>
							<li><a href="loadForm1" id="loadForm1">แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</a></li>
							<li><a href="logout" id="logout">Logout</a></li>
							<li><?php echo anchor("auth/loadForm1/","แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ");?></li>
						</ul>
					</div>';
		return $data;
	}	
}
?>