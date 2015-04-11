<?php
	class Createpdf extends CI_Controller{
		function __construct(){
			parent::__construct();

		}

		function pdf()
		{
		    $this->load->helper('pdf_helper');
		    /*
		        ---- ---- ---- ----
		        your code here
		        ---- ---- ---- ----
		    */
		    $this->load->view('pdfreport');
		}

		 // Page footer
   		 public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    	}
	}
?>