<?php
require('../lib/fpdf17/fpdf.php');
include '../cli/global-functions.php';
require '../dbconnect/connect.php';
$id = $_GET['id'];		
$pid = $_GET['pid'];
		
class PDF extends FPDF {

	private $name;
	private $image;
	private $address;
	private $client;
	private $terms;
	private $total;
	
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
	
	public function setClient($client){
        $this->client = $client;
    }
    public function getClient(){
        return $this->client;
    }
    public function setTerms($terms){
        $this->terms = $terms;
    }
    public function getTerms(){
        return $this->terms;
    }
    public function setTotal($total){
        $this->total = $total;
    }
    public function getTotal(){
        return $this->total;
    }
  	  	

	function Header(){
		

		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo ./images/noimage.png
		$this->Image($this->getImage(),130,10,35);
		$this->Cell(160,10,'',0,1,'C');
		$this->Cell(276,20,$this->getName(),0,1,'C');
		$this->SetFont('Arial','',10);
		$this->Cell(276,0,$this->getAddress(),0,1,'C');
		$this->Cell(160,10,'',0,1,'C');
		$this->SetFont('Arial','',15);
		$this->Cell(276,5,'Payment History',0,1,'C');
		$this->SetFont('Arial','',10);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln();	
		$this->Cell(35,5,'Client Name: ',0,0,'C');
		$this->Cell(35,5,$this->getClient(),0,1,'C');
		$this->Ln();	
		$this->Cell(35,5,'Terms of Payment: ',0,0,'C');
		$this->Cell(35,5,$this->getTerms(),0,1,'C');
		$this->Ln();
		$this->Cell(35,5,'Total Amount: ',0,0,'C');
		$this->Cell(35,5,$this->getTotal().'.00',0,1,'C');
		$this->Ln();		
		$this->SetFont('Arial','B',11);		
		$this->SetFillColor(245,245,245);
		$this->SetDrawColor(51,51,51);
		
		$this->Cell(35,10,'Due Date',1,0,'C',true);
		$this->Cell(70,10,'Amount',1,0,'C',true);		
		$this->Cell(35,10,'Date Paid',1,0,'C',true);
		$this->Cell(40,10,'Amount Paid',1,0,'C',true);
		$this->Cell(50,10,'Payment Method',1,0,'C',true);
		$this->Cell(40,10,'Remaining',1,0,'C',true);
		$this->Ln();
		
		
	}

	function topTable($id,$pid,$mysqli){

		$sql = "SELECT 
				client_payment_transaction.date_paid date_paid,
				client_payment_transaction.amount_paid amount_paid,
				client_payment_transaction.method_of_payment method,
				property.payment_mode terms,
				property.price total,
				property.date_management_commence date_added,
				client.firstname cfname,
				client.middlename cmname,
				client.lastname clname
				FROM client_payment_transaction 
				INNER JOIN property
				ON client_payment_transaction.property_id = property.id 
				INNER JOIN client 
				ON client_payment_transaction.client_id = client.id
				WHERE client_payment_transaction.client_id = '$id'
				AND client_payment_transaction.property_id = '$pid'";

		$result = mysqli_query($mysqli,$sql);
		while($row = mysqli_fetch_array($result)){
			$name = $row['cfname'].' '.$row['cmname'].' '.$row['clname'];
			$terms = $row['terms'];
			$total = $row['total'];
			
			$this->Cell(35,10,$name,1,0,'L');
			$this->Ln();
			$this->Cell(35,10,$terms,1,0,'L');
			$this->Ln();
			$this->Cell(35,10,'₱ '.$total.'.00',1,0,'L');
			$this->Ln();
			break(1);
		}

	}
	function viewTables($id,$pid,$mysqli){

		$this->SetFont('Arial','B',11);

		$sql = "SELECT 
				client_payment_transaction.date_paid date_paid,
				client_payment_transaction.amount_paid amount_paid,
				client_payment_transaction.method_of_payment method,
				property.payment_mode terms,
				property.price total,
				property.date_management_commence date_added,
				client.firstname cfname,
				client.middlename cmname,
				client.lastname clname,
				property.monthly_payment month,
				client_payment_transaction.due_date due
				FROM client_payment_transaction 
				INNER JOIN property 
				ON client_payment_transaction.property_id = property.id 
				INNER JOIN client 
				ON client_payment_transaction.client_id = client.id
				WHERE client_payment_transaction.client_id = '$id'
				AND client_payment_transaction.property_id = '$pid'";

	
		$result = mysqli_query($mysqli,$sql);
		$x = 0;
		while($row = mysqli_fetch_array($result)){

			$date_paid = $row['date_paid'];		
			$amount_paid = $row['amount_paid'].'.00';
			$method = convertMethodOfPayment($row['method']);
			$terms = $row['terms'];
			$total = $row['total'];
			$date_added = $row['date_added'];
			$monthly_payment = $row['month'];
			$due_date = $row['due'];	

			if($x == 0){
				$remaining = getRemainingAmount($total,$id,'client',$mysqli);
				$x = 1;
			}else{
				$remaining = getRemainingAmount($remaining,$id,'client',$mysqli);
			}

			$this->SetDrawColor(51,51,51);

			$this->Cell(35,10,$due_date,1,0,'L');
			$this->Cell(70,10,'₱ '.$monthly_payment.'.00',1,0,'L');		
			$this->Cell(35,10,$date_paid,1,0,'L');
			$this->Cell(40,10,'₱ '.$amount_paid,1,0,'L');
			$this->Cell(50,10,$method,1,0,'L');
			$this->Cell(40,10,'₱ '.$remaining.'.00',1,0,'L');
			$this->Ln();

		}

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
$pid = $_GET['pid'];
$pdf = new PDF(); //use new class


$pdf->setName('First Davao Millennium Property Venture');
$pdf->setAddress('FDM Building, 59 Bolton Extension, Barangay 1-A, Davao City, 8000 Davao del Sur');
$pdf->setImage('../system-images/realty-logo.png');
$pdf->setTitle('Monthly Term Statement');
$pdf->setClient(getClient($id,$mysqli));
$pdf->setTerms(getPaymentMode($id,$pid,$mysqli));
$pdf->setTotal(getPropertyPrice($id,$pid,$mysqli));

//$pdf->setTerms(getCustomer($id,$mysqli));
//$pdf->setTotal(getCustomer($id,$mysqli));
//define new alias for total page numbers

$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);

$pdf->AddPage('L','A4',0);

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(245,245,245);

$pdf->viewTables($id,$pid,$mysqli);

$pdf->Output();

?>
