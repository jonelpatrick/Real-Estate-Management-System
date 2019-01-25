<?php
require('../lib/fpdf17/fpdf.php');

require '../dbconnect/connect.php';
		
		
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
		$this->Cell(180,10,'Maintenance Job Order',0,1,'C');
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
$pdf->setTitle('Maintenance Job Order');
//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

 $sql = "SELECT
        maintenance_scheduled.id msid,
        scheduled_date,
        person_in_charge,
        firstname,
        middlename,
        lastname,
        customer.contact_number contact,
        property_name,
        property.address paddress,
        city,
        request_date,
        property_access_by,
        repair_request
        FROM maintenance_scheduled
        INNER JOIN maintenance_request 
        ON maintenance_scheduled.maintenance_request_id = maintenance_request.id
        INNER JOIN customer 
        ON maintenance_request.customer_id = customer.id 
        INNER JOIN property ON
        maintenance_request.property_id = property.id 
        WHERE property.deleted = 0
        AND maintenance_scheduled.deleted = 0
        AND maintenance_scheduled.id = '$id'";

$result = mysqli_query($mysqli,$sql);
while($row = mysqli_fetch_array($result)){

	  $id = $row['msid'];
	  $scheduled_date = $row['scheduled_date'];
	  $client_name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
	  $person_in_charge = $row['person_in_charge'];
	  $property_name = $row['property_name'];
	  $address = $row['paddress'].', '.$row['city'];
	  $request_date = $row['request_date'];
	  $property_access_by = $row['property_access_by'];
	  $repair_request = $row['repair_request'];
	  $contact_number = $row['contact'];

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
	$pdf->Cell(190,15,'Schedule Date : '.$scheduled_date,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);

	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Request Date : '.$request_date,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);

	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,15,'Requestor : '.$client_name,1,1,'',true);
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

	$pdf->MultiCell(190,10,'Comment/Addtnl Info : '.$repair_request,1,1,'',true);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(190,1,'','T',1,'',true);

	$pdf->Ln(15);
	$pdf->Cell(190,10,'Person in Charge : '.$person_in_charge,0,1,'',true);
	$pdf->SetDrawColor(255,255,255);
	$pdf->Cell(190,1,'','T',1,'',true);


}

$pdf->Output();
?>
