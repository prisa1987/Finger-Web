<?php

      
	tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "PDF Report";
	$obj_pdf->SetTitle($title);
	// $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
	// $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

	// remove default header/footer
	$obj_pdf->setPrintHeader(false);


	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('freeserif');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('freeserif', '', 14);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	// ob_start();
	//     // we can have any view part here like HTML, PHP etc
	//     $content = ob_get_contents();
	// ob_end_clean();

	// set text shadow effect
$obj_pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = '<style>

    td {
        border: 0.5px solid #3E3A37;
        margin-top : 10px;
       
    }
   
 
</style>';

$head = "
        <div class='panel-heading row'>
           <h3 class='panel-title'>แบบพิมพ์ลายนิ้วมือ ผู้ต้องหา ฯลฯ</h3>
        </div>";


$headTable = '<div class="row col-md-6" style="margin-left:30%;"> 
			<table id="tableResult"  class="table table-striped col-md-4" cellpadding="5"> 
            	<tr nobr="true">
            		<td  align="center" > Id. ผู้ต้องสงสัย </td>
            		<td align="center"> จัดเก็บโดยองค์กร </td>
            		<td  align="center" > คะแนนรวม </td>
            		<td  align="center" > ดูรูป </td>
            	</tr>';
$content = "";
for ($i=0; $i <count($id) ; $i++) { 
	   $j = $i+2;
	$content .= '<tr style="margin-left:120px;">
		          <td>'.$id.'</td>'
		          .'<td>'.$organisation.'</td>'
		          .'<td>'.$overall_score.'</td>'
	          	  .'<td><a href="#'.$j.'"> ดู </a></td>
 	          	 </tr>';
}
	            	
	       // count($id);
  $endTable  = '</table></div><br pagebreak="true"/>'; 





$headFinger = '<div class="row">
           <h3 class="panel-title">ลายนิ้วมือ ผู้ต้องหา Id: '. $id. '</h3>
        </div>';


$headTableFinger = '<div class="row col-md-6" style="margin-left:30%;"> 
			<table id="tableResult"  class="table table-striped col-md-4" cellpadding="5"> 
            	<tr nobr="true">
            		<td  align="center" > ตำแหน่งนิ้ว </td>
            		<td align="center"> รูปที่ค้นหา </td>
            		<td  align="center" > รูปที่ Matches </td>
            		<td  align="center" > คะแนน </td>
            	</tr>';
$contentfingers = "";
for ($i=0; $i <count($fingers) ; $i++) { 


	if(strpos(key($fingers[$i]), "R0") !== false) 	{ $fingerPosMacthed = "นิ้วโป้งขวา"; 	$pathImage = "form/right_thumb/".$id."_"."right_thumb"."/".key($fingers[$i]); 	}
	else if(strpos(key($fingers[$i]), "R1") !== false){ $fingerPosMacthed = "นิ้วชี้ขวา";  	$pathImage = "form/right_fore/".$id."_"."right_fore"."/".key($fingers[$i]);		}
	else if(strpos(key($fingers[$i]), "R2") !== false) { $fingerPosMacthed = "นิ้วกลางขวา";  $pathImage = "form/right_middle/".$id."_"."right_middle"."/".key($fingers[$i]); }
	else if(strpos(key($fingers[$i]), "R3") !== false){ $fingerPosMacthed = "นิ้วนางขวา";   	$pathImage = "form/right_ring/".$id."_"."right_ring"."/".key($fingers[$i]); 	}
	else if(strpos(key($fingers[$i]), "R4") !== false){ $fingerPosMacthed = "นิ้วก้อยขวา";  $pathImage = "form/right_little/".$id."_"."right_little"."/".key($fingers[$i]); }

	else if(strpos(key($fingers[$i]), "L0") !== false){ $fingerPosMacthed = "นิ้วโป้งซ้าย"; 	$pathImage = "form/left_thumb/".$id."_"."left_thumb"."/".key($fingers[$i]); 	}
	else if(strpos(key($fingers[$i]), "L1") !== false){ $fingerPosMacthed = "นิ้วชี้ซ้าย"; 	$pathImage = "form/left_fore/".$id."_"."left_fore"."/".key($fingers[$i]); 	}
	else if(strpos(key($fingers[$i]), "L2") !== false){ $fingerPosMacthed = "นิ้วกลางซ้าย"; 	$pathImage = "form/left_middle/".$id."_"."left_middle"."/".key($fingers[$i]); }
	else if(strpos(key($fingers[$i]), "L3") !== false){ $fingerPosMacthed = "นิ้วนางซ้าย";  	$pathImage = "form/left_ring/".$id."_"."left_ring"."/".key($fingers[$i]); }
	else if(strpos(key($fingers[$i]), "L4") !== false){ $fingerPosMacthed = "นิ้วก้อยซ้าย"; 	$pathImage = "form/left_little/".$id."_"."left_little"."/".key($fingers[$i]); }
							

	else if(strpos(key($fingers[$i]), "U1") !== false){ $fingerPosMacthed = "ไม่สามารถระบุตำแหน่งนิ้วได้"; 	$pathImage = "form/Unknown/"."u1"."/".key($fingers[$i]); 	}
	else if(strpos(key($fingers[$i]), "U2") !== false){ $fingerPosMacthed = "ไม่สามารถระบุตำแหน่งนิ้วได้"; 	$pathImage = "form/left_fore/"."u2"."/".key($fingers[$i]); 	}
	else if(strpos(key($fingers[$i]), "U3") !== false){ $fingerPosMacthed = "ไม่สามารถระบุตำแหน่งนิ้วได้"; 	$pathImage = "form/left_middle/"."u3"."/".key($fingers[$i]); }
	else if(strpos(key($fingers[$i]), "U4") !== false){ $fingerPosMacthed = "ไม่สามารถระบุตำแหน่งนิ้วได้";  $pathImage = "form/left_ring/"."u4"."/".key($fingers[$i]); }
	else if(strpos(key($fingers[$i]), "U5") !== false){ $fingerPosMacthed = "ไม่สามารถระบุตำแหน่งนิ้วได้"; 	$pathImage = "form/left_little/"."u5"."/".key($fingers[$i]); }
	$src_img_probe = $originalImages[$i];
	$src_img_matched  = "assets/images/".$pathImage;
	// $full_dst_path = base_url().'assets/images/convertTojpg';

	// $image = new Imagick($src_img_probe);
   $this->load->library('ImageLib');

    $magicianObj_probe = new imageLib($src_img_probe);
    $p =  $magicianObj_probe->openImage($src_img_probe);
    

   $magicianObj_macthed = new imageLib($src_img_matched);  
   $m =  $magicianObj_macthed->openImage($src_img_matched);
  
  imagejpeg($p , "assets/images/convertTojpg/imgConverTojpgProbe".$i.'.jpg');
  imagejpeg($m , "assets/images/convertTojpg/imgConverTojpgMatched".$i.'.jpg');
  
 
	$contentfingers .= '<tr style="margin-left:120px;">
				<td>'. $fingerPosMacthed .'</td>'
				 .'<td class="Match_result"><img src="assets/images/convertTojpg/imgConverTojpgProbe'.$i.'.jpg" /></td>'
		         .'<td class="Match_result"><img src="assets/images/convertTojpg/imgConverTojpgMatched'.$i.'.jpg" /></td>'
		         .'<td>'.reset($fingers[$i]).'</td>'
		         .' </tr>';

		   
}

$endTableFinger  = '</table></div><br pagebreak="true"/>'; 




// Print text using writeHTMLCell()
$obj_pdf->writeHTMLCell(0, 0, '', '', $html.$head.$headTable.$content.$endTable.$headFinger.$headTableFinger.$contentfingers.$endTableFinger, 0, 1, 0, true, '', true);


// $obj_pdf->writeHTML($head.$table, true, false, true, false, '');
if(!file_exists('assets/images/history_pdf/'.$email)) mkdir( 'assets/images/history_pdf/'.$email,0777);
// $obj_pdf->Output('/var/www/html/fingerprintWebsite/assets/images/history_pdf/'.$email.'/'.$history_id.'.pdf', 'F');
$obj_pdf->Output($_SERVER['DOCUMENT_ROOT'].'fingerprintWebsite/assets/images/history_pdf/'.$email.'/'.$history_id.'_matched'.'.pdf', 'F');
// $obj_pdf->('s.pdf', 'I');

  $mask = '/var/www/html/fingerprintWebsite/assets/images/convertTojpg/*';
array_map('unlink', glob($mask));


?>