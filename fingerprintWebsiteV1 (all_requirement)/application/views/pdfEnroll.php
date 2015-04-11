<?php


	tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "PDF Enroll";
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

	$obj_pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
	$html = '<style>

    td {
        border: 0.5px solid #3E3A37;
        margin-top : 10px;
       
    }
   
 
</style>';

	$head = '<div class="panel-heading row">
       		    <h3 class="panel-title"> บันทึกลายนิ้วมือผู้ต้องหา Id: '.$form_id.'</h3>
	        </div>';



	
	$headTable = '<div class="row col-md-6" style="margin-left:30%;"> 
			<table id="tableResult"  class="table table-striped col-md-4" cellpadding="5"> 
            	<tr nobr="true">
            		
            		<td align="center"> ตำแหน่งนิ้ว </td>
            		<td align="center">  รูป  </td>
            	</tr>';
     $content = "";
    for ($i=0; $i <count($originalImages) ; $i++) { 

    	if(strpos($originalImages[$i], "R0") !== false) 	{ $fingerPosition = "นิ้วโป้งขวา"; 	}
    	else if(strpos($originalImages[$i], "R1") !== false) 	{ $fingerPosition = "นิ้วชี้ขวา"; 	}
    	else if(strpos($originalImages[$i], "R2") !== false) 	{ $fingerPosition = "นิ้วกลางขวา"; 	}
    	else if(strpos($originalImages[$i], "R3") !== false) 	{ $fingerPosition = "นิ้วนางขวา"; 	}
    	else if(strpos($originalImages[$i], "R4") !== false) 	{ $fingerPosition = "นิ้วก้อยขวา"; 	}

    	else if(strpos($originalImages[$i], "L0") !== false) 	{ $fingerPosition = "นิ้วโป้งซ้าย"; 	}
    	else if(strpos($originalImages[$i], "L1") !== false) 	{ $fingerPosition = "นิ้วชี้ซ้าย"; 	}
    	else if(strpos($originalImages[$i], "L2") !== false) 	{ $fingerPosition = "นิ้วกลางซ้าย"; 	}
    	else if(strpos($originalImages[$i], "L3") !== false) 	{ $fingerPosition = "นิ้วนางซ้าย"; 	}
    	else if(strpos($originalImages[$i], "L4") !== false) 	{ $fingerPosition = "นิ้วก้อยซ้าย"; 	}

		else if(strpos($originalImages[$i], "U1") !== false)	{ $fingerPosition = "ไม่สามารถระบุตำแหน่งนิ้วได้"; }
		else if(strpos($originalImages[$i], "U2") !== false)	{ $fingerPosition = "ไม่สามารถระบุตำแหน่งนิ้วได้"; }
		else if(strpos($originalImages[$i], "U3") !== false)	{ $fingerPosition = "ไม่สามารถระบุตำแหน่งนิ้วได้"; }
		else if(strpos($originalImages[$i], "U4") !== false)	{ $fingerPosition = "ไม่สามารถระบุตำแหน่งนิ้วได้"; }
		else if(strpos($originalImages[$i], "U5") !== false)	{ $fingerPosition = "ไม่สามารถระบุตำแหน่งนิ้วได้";  }

  //   	// else $fingerPosition="dd";
		$image = $originalImages[$i];
   		$this->load->library('ImageLib');
 	    $magicianObj_enrolled = new imageLib($image);
        $e =  $magicianObj_enrolled->openImage($image);


  		imagejpeg($e , "assets/images/convertTojpg/imgConverTojpgEnrolled".$i.'.jpg');
  		  chmod("assets/images/convertTojpg/imgConverTojpgEnrolled".$i.'.jpg', 0755); 

    	
	    $content .= '<tr style="margin-left:120px;">'
	    				.'<td>'.$fingerPosition.'</td>'
	    				.'<td><img src = "assets/images/convertTojpg/imgConverTojpgEnrolled'.$i.'.jpg" /></td>'
	    				// .'<td></td>'
	    			.'</tr>';

	    		



    }
    $end = '</table></div>';

    $obj_pdf->writeHTMLCell(0, 0, '', '', $html.$head.$headTable.$content.$end, 0, 1, 0, true, '', true);
    if(!file_exists('assets/images/history_pdf/'.$email)) mkdir( 'assets/images/history_pdf/'.$email,0777);
    // $obj_pdf->Output('_enrolled'.'.pdf', 'I');
    $obj_pdf->Output($_SERVER['DOCUMENT_ROOT'].'fingerprintWebsite/assets/images/history_pdf/'.$email.'/'.$history_id.'_enrolled'.'.pdf', 'F');
    $mask = '/var/www/html/fingerprintWebsite/assets/images/convertTojpg/*';
	array_map('unlink', glob($mask));
	
?>