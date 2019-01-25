<?php
require('../lib/fpdf17/fpdf.php');

require '../dbconnect/connect.php';
$id = $_GET['id'];	
		
class PDF extends FPDF {

	private $name;
	private $image;
	private $address;

	
	
	public function setAddress($address){
        $this->address = $address;
    }    
    public function getAddress(){
        return $this->address;
    }
	public function setImage($image){
        $this->image = $image;
    }
    public function getImage(){
        return $this->image;
    }

	public function setName($name){
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
  

	function Header(){
	

		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo ./images/noimage.png
		$this->Image($this->getImage(),80,10,50);
		$this->Cell(160,10,'',0,1,'C');
		$this->Cell(180,20,$this->getName(),0,1,'C');
		$this->SetFont('Arial','',10);
		$this->Cell(180,0,$this->getAddress(),0,1,'C');
		$this->Cell(160,10,'',0,1,'C');
		$this->SetFont('Arial','',15);
		$this->Cell(180,10,'Maintenance Request',0,1,'C');
		$this->SetFont('Arial','',10);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		
		
	}
	function Footer(){
		//add table's bottom line
		
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$id = $_GET['id'];
$pdf = new PDF('P','mm','A4'); //use new class


$pdf->setName('First Davao Millennium Property Venture');
$pdf->setAddress('FDM Building, 59 Bolton Extension, Barangay 1-A, Davao City, 8000 Davao del Sur');
$pdf->setImage('../system-images/realty-logo.png');
$pdf->setTitle('Maintenance Request');
//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

 $sql = "SELECT 
        maintenance_request.id mid,
        firstname,
        middlename,
        lastname,
        property_name,
        property.address paddress,
        maintenance_request.contact_number mcontact,
        city,
        request_date,
        property_access_by,
        repair_request,
        block,
        lot
        FROM maintenance_request 
        INNER JOIN customer ON 
        maintenance_request.customer_id = customer.id 
        INNER JOIN property ON
        maintenance_request.property_id = property.id 
        WHERE maintenance_request.id = '$id'";

$result = mysqli_query($mysqli,$sql);
while($data=mysqli_fetch_array($result)){

	$name = $data['firstname']." ".$data['middlename']." ".$data['lastname'];
	$property_name = $data['property_name'];
	$block = $data['block'];
	$lot = $data['lot'];

  if($block == 0 && $lot != 0){
    $address = ' Lot '.$lot.' '.$data['paddress'].' '.$data['city'];
  }else if($lot == 0 && $block != 0){
     $address = ' Block '.$block.' '.$data['paddress'].' '.$data['city'];
  }else if($block == 0 && $lot == 0){
     $address = $data['paddress'].' '.$data['city'];	
  }
  else{
      $address = ' Block '.$block.' Lot '.$lot.' '.$data['paddress'].' '.$data['city'];
  }
	$address = $data['paddress'].' '.$data['city'];
	$contact_number = $data['mcontact'];
	$request_date = $data['request_date'];
	$property_access_by = $data['property_access_by'];
	$repair_request = $data['repair_request'];

	if($property_access_by == 0){
		$property_access_by = 'Tenant';
	}else if($property_access_by == 1){
		$property_access_by = 'Agent';
	}else{
		$property_access_by = 'Landlord';
	}

	$pdf->Ln(15);
		
	$pdf->SetFont('Arial','',11);
	
	$pdf->SetFillColor(255,255,255);
	$pdf->SetDrawColor(255,255,255);
	
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);
	$pdf->Cell(190,1,'','T',1,'',true);

	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Date : '.$request_date,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);

	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Requestor : '.$name,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);	

	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Property Name : '.$property_name,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);

	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Address : '.$address,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);

	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Contact Number : '.$contact_number,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);
	/*
	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Property Access By : '.$property_access_by,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);
	*/
	$pdf->SetDrawColor(255,255,255);	

	$pdf->MultiCell(190,10,'Repair Request : '.$repair_request,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);

}

$pdf->Output();
?>
