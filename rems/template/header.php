<?php 
include '../dbconnect/connect.php';

require_once '../snippet/session.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Real Estate Management System</title>



    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="../vendor/bootstrap/css/bootstrap-grid.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <!-- date time picker-->

  
     
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="../css/dropzone.css" rel="stylesheet">
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html"><img class="logo-top" src="../system-images/FDM.png" /></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
   
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <!--
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
          -->
          <div class="btn btn-success" style="cursor: default;border:none;background:#52565afa !important;">User: <?php echo $_SESSION['user_type']; ?></div>
        </div>
      </form>
    
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0" style="background: #515559;">
      <!--
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      -->
        <li class="nav-item dropdown no-arrow menu-myprofile">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="../pages/myprofile.php">My Profile</a>
            <!--<a class="dropdown-item" href="#">Activity Log</a>-->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">  
    <?php 
      $image_path = $_SESSION['image_path'];
      $name = $_SESSION['user'];

      if($image_path == 'noimage.png'){
        $image_path = 'noimage-white.png';
      }
    ?>
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">

        <li class="nav-item active text-center avatar-content">
          <a class="nav-link" href="../pages/dashboard.php" style="padding-bottom: 0">
            
            <span><img class="avatar" src="../uploads/<?php echo $image_path; ?>" /></span>
          </a>
          <a class="nav-link" href="../pages/myprofile.php" style="padding-bottom: 0.3em; border-bottom: 1px solid rgba(255,255,255,0.1)">            
            <span><?php echo $name; ?></span>
          </a>
          <a class="nav-link" href="../pages/myprofile.php" style="padding: 0.3em 0; border-bottom: 1px solid rgba(255,255,255,0.1)">            
            <span>My Profile</span>
          </a>
          <a class="nav-link" href="../snippet/logout.php" style="padding-top: 0.3em;" data-toggle="modal" data-target="#logoutModal">             
            <span>Logout</span>
          </a>
        </li>

       
      <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="login.html">Login</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item" href="blank.html">Blank Page</a>
          </div>
        </li>
        -->
        
         <li class="nav-item menu-dashboard active"><!--active class removed -->
          <a class="nav-link" href="../pages/dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>        

        <!--Customer -->
        <?php if($_SESSION['user_type'] == 'Customer'){ ?>

         <li class="nav-item menu-property-list">
          <a class="nav-link" href="property-list.php">
             <i class="fas fa-book"></i>
            <span>Property List</span></a>
        </li>          
         <li class="nav-item menu-legal-document-own">
          <a class="nav-link" href="legal-document-own.php">
            <i class="fas fa-link"></i>
            <span>Legal Documents</span></a>
        </li>

        <li class="nav-item menu-payment-history">
          <a class="nav-link" href="payment-history.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Payment History</span></a>
        </li>

        <li class="nav-item menu-maintenance-request">
          <a class="nav-link" href="maintenance-request.php">
            <i class="fas fa-wrench"></i>
            <span>Maintenance Request</span></a>
        </li> 
        
        <?php } ?>
        <!--Customer -->
        
        <!--Client jonel gwapo-->
        <?php if($_SESSION['user_type'] == 'Client'){ ?>

         <li class="nav-item menu-client-property-sold">
          <a class="nav-link" href="client-property-sold.php">
             <i class="fas fa-book"></i>
            <span>Property Sold</span></a>
        </li>          
       
        <li class="nav-item menu-client-transaction-history">
          <a class="nav-link" href="client-transaction-history.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transaction History</span></a>
        </li>        
        
        <?php } ?>
        <!--Client -->

        <!--Clerk -->
         <?php if($_SESSION['user_type'] == 'Clerk'){ ?>
           <li class="nav-item menu-customer-list">
              <a class="nav-link" href="customer-list.php">
                <i class="fas fa-user-alt"></i>
                <span>Customer</span></a>
            </li>
            <li class="nav-item menu-client-list">
              <a class="nav-link" href="client-list.php">
                <i class="fas fa-briefcase"></i>
                <span>Client</span></a>
            </li>
             <li class="nav-item menu-pay-to-client">
              <a class="nav-link" href="pay-to-client.php">
                <i class="fab fa-apple-pay"></i>
                <span>Pay to Client</span></a>
            </li>
            <li class="nav-item menu-attach-property">
              <a class="nav-link" href="attach-property.php">
                <i class="fas fa-link"></i>
                <span>Attach Property</span></a>
            </li>
            <!--
             <li class="nav-item">
              <a class="nav-link" href="sub-devide-property.php">
                <i class="fas fa-divide"></i>
                <span>Sub Devide Property</span></a>
            </li> 
            -->

            <li class="nav-item dropdown menu-sales-property">
              <a class="nav-link dropdown-toggle" href="#" id="salesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-money-check-alt"></i>
                <span>Sales & Property</span>
              </a>
              <div class="dropdown-menu " aria-labelledby="salesDropdown">            
                <a class="dropdown-item " href="sell-property.php">Sell Property</a>
                <a class="dropdown-item" href="payment-transaction.php">Payment Transaction</a>              
                <a class="dropdown-item" href="property-sold.php">Property Sold</a> 
              </div>
            </li>

            <li class="nav-item dropdown menu-records-documents">
              <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Records & Documents</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="recordsDropdown">                            
                <a class="dropdown-item" href="property.php">Property</a>
                <a class="dropdown-item" href="legal-document.php">Legal Documents</a>            
              </div>
            </li>
            <li class="nav-item menu-maintenance-request">
              <a class="nav-link" href="maintenance-request.php">
                <i class="fas fa-wrench"></i>
                <span>Maintenance Request</span></a>
            </li> 

          <?php } ?>
        <!--Clerk -->

        <!--Manager -->
      <?php if($_SESSION['user_type'] == 'Manager'){ ?>
        <li class="nav-item menu-customer-list">
          <a class="nav-link" href="customer-list.php">
            <i class="fas fa-user-alt"></i>
            <span>Customer</span></a>
        </li>
        <li class="nav-item menu-client-list">
          <a class="nav-link" href="client-list.php">
            <i class="fas fa-briefcase"></i>
            <span>Client</span></a>
        </li>
        <li class="nav-item menu-property-sold">
          <a class="nav-link" href="property-sold.php">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Property Sold</span></a>
        </li>
         <li class="nav-item dropdown menu-records-documents">
          <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Records & Documents</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="recordsDropdown">                        
            <a class="dropdown-item" href="property.php">Property</a>
            <a class="dropdown-item" href="legal-document.php">Legal Documents</a>   

          </div>
        </li>
        <!--
         <li class="nav-item">
          <a class="nav-link" href="sub-devide-property.php">
            <i class="fas fa-divide"></i>
            <span>Sub Devide Property</span></a>
        </li> 
        -->
         <li class="nav-item menu-issue-legal-documents">
          <a class="nav-link" href="issue-legal-documents.php">
           <i class="fab fa-accusoft"></i>
            <span>Issue Legal Document</span></a>
        </li>
         <li class="nav-item dropdown menu-reports">
          <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book"></i>
            <span>Reports</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="reportsDropdown">            
            <a class="dropdown-item" href="financial-report.php">Financial Report</a>
            <!--
            <a class="dropdown-item" href="customer-report.php">Customer Report</a>  
            
            <a class="dropdown-item" href="maintenance-report.php">Maintenance Report</a>         
            -->
          </div>
        </li>
        <li class="nav-item dropdown menu-tracking-sheet">
          <a class="nav-link dropdown-toggle" href="#" id="trackingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fab fa-trello"></i>
            <span>Tracking Sheet</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="trackingDropdown">            
            <a class="dropdown-item" href="account-balance.php">Account Balance</a>
            <a class="dropdown-item" href="property-tracking.php">Property Tracking</a> 
                      
          </div>
        </li>
         <li class="nav-item dropdown menu-maintenance">
          <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-wrench"></i>
            <span>Maintenance </span></a>
          </a>
          <div class="dropdown-menu" aria-labelledby="maintenanceDropdown">                       
            <a class="dropdown-item" href="maintenance-request-list.php">Request List</a>            
            <a class="dropdown-item" href="maintenance-scheduled-list.php">Scheduled List</a>  

          </div>
        </li> 
        <?php } ?>
        <!--Manager -->

       <!-- Administrator-->
       <?php if($_SESSION['user_type'] == 'Administrator'){ ?>

        <li class="nav-item menu-attach-property">
          <a class="nav-link" href="attach-property.php">
            <i class="fas fa-link"></i>
            <span>Attach Property</span></a>
        </li>
        <!--
         <li class="nav-item">
          <a class="nav-link" href="sub-devide-property.php">
            <i class="fas fa-divide"></i>
            <span>Sub Devide Property</span></a>
        </li> 
        -->

        <li class="nav-item menu-customer-list">
          <a class="nav-link" href="customer-list.php">
            <i class="fas fa-user-alt"></i>
            <span>Customer</span></a>
        </li>
        <li class="nav-item menu-client-list">
          <a class="nav-link" href="client-list.php">
            <i class="fas fa-briefcase"></i>
            <span>Client</span></a>
        </li>
         <li class="nav-item menu-pay-to-client">
              <a class="nav-link" href="pay-to-client.php">
                <i class="fab fa-apple-pay"></i>
                <span>Pay to Client</span></a>
          </li>
         <li class="nav-item menu-employee-list">
          <a class="nav-link" href="employee-list.php">
            <i class="fas fa-users"></i>
            <span>Employee</span></a>
        </li>

         <li class="nav-item dropdown menu-sales-property">
          <a class="nav-link dropdown-toggle" href="#" id="salesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fas fa-money-check-alt"></i>
            <span>Sales & Property</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="salesDropdown">            
            <a class="dropdown-item" href="sell-property.php">Sell Property</a>
            <a class="dropdown-item" href="payment-transaction.php">Payment Transaction</a>   
            <a class="dropdown-item" href="property-sold.php">Property Sold</a>            
          </div>
        </li>
        
        <li class="nav-item dropdown menu-records-documents">
          <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Records & Documents</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="recordsDropdown">            
            <!--<a class="dropdown-item" href="payment-history.php">Payment History</a>-->
            <a class="dropdown-item" href="property.php">Property</a>
            <a class="dropdown-item" href="legal-document.php">Legal Documents</a>            
          </div>
        </li>
        <li class="nav-item menu-issue-legal-documents">
          <a class="nav-link" href="issue-legal-documents.php">
           <i class="fab fa-accusoft"></i>
            <span>Issue Legal Document</span></a>
        </li>
        <li class="nav-item dropdown menu-reports">
          <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book"></i>
            <span>Reports</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="reportsDropdown">            
            <a class="dropdown-item" href="financial-report.php">Financial Report</a>
            <!--
            <a class="dropdown-item" href="customer-report.php">Customer Report</a>  
                
            <a class="dropdown-item" href="maintenance-report.php">Maintenance Report</a>         
            -->
          </div>
        </li>
         <li class="nav-item dropdown menu-tracking-sheet">
          <a class="nav-link dropdown-toggle" href="#" id="trackingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fab fa-trello"></i>
            <span>Tracking Sheet</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="trackingDropdown">            
            <a class="dropdown-item" href="account-balance.php">Account Balance</a>
            <a class="dropdown-item" href="property-tracking.php">Property Tracking</a> 
                       
          </div>
        </li>
         <li class="nav-item dropdown menu-maintenance">
          <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-wrench"></i>
            <span>Maintenance </span></a>
          </a>
          <div class="dropdown-menu" aria-labelledby="maintenanceDropdown">                       
            <a class="dropdown-item" href="maintenance-request-list.php">Request List</a>            
            <a class="dropdown-item" href="maintenance-scheduled-list.php">Scheduled List</a>  

          </div>
        </li>   
        <li class="nav-item menu-maintenance-request">
          <a class="nav-link" href="maintenance-request.php">
            <i class="fas fa-wrench"></i>
            <span>Maintenance Request</span></a>
        </li>     
         <li class="nav-item dropdown menu-website-details">
          <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book"></i>
            <span>Website Details</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="reportsDropdown">            
            <a class="dropdown-item" href="about-us-details.php">Edit Website Details</a>
            <a class="dropdown-item" href="gallery_site.php">Gallery</a> 
            <a class="dropdown-item" href="attach-image-property.php">Manage Property</a> 
            <a class="dropdown-item" href="news_updates.php">News and Updates</a>      
            <a class="dropdown-item" href="c-quires.php">Enquiries</a>   
            <a class="dropdown-item" href="referenceNumber.php">Reference Number</a>       
          </div>
        </li> 
       <?php if(isset($jonel)){ ?> 
        <!--Customer View -->  
        <hr class="hr">
        <span class="title-mode">Customer view</span>
        <li class="nav-item">
          <a class="nav-link" href="property-list.php">
             <i class="fas fa-book"></i>
            <span>Property List</span></a>
        </li>          
         <li class="nav-item">
          <a class="nav-link" href="legal-document-own.php">
            <i class="fas fa-link"></i>
            <span>Legal Documents</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="payment-history.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Payment History</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="maintenance-request.php">
            <i class="fas fa-wrench"></i>
            <span>Maintenance Request</span></a>
        </li> 
        <!--Customer View -->  

        <!--Client View -->
        <hr class="hr">
        <span class="title-mode">Client view</span>
        <li class="nav-item">
          <a class="nav-link" href="client-property-sold.php">
             <i class="fas fa-book"></i>
            <span>Property Sold</span></a>
        </li>          
       
        <li class="nav-item">
          <a class="nav-link" href="transaction-history.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transaction History</span></a>
        </li>   
        <!--Client View -->

         <!--Clerk View -->
         <hr class="hr">
         <span class="title-mode">Clerk view</span>

         <li class="nav-item">
              <a class="nav-link" href="customer-list.php">
                <i class="fas fa-user-alt"></i>
                <span>Customer</span></a>
            </li>
            <li class="nav-item menu-client-list">
              <a class="nav-link" href="client-list.php">
                <i class="fas fa-briefcase"></i>
                <span>Client</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="attach-property.php">
                <i class="fas fa-link"></i>
                <span>Attach Property</span></a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="salesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-money-check-alt"></i>
                <span>Sales & Property</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="salesDropdown">            
                <a class="dropdown-item" href="sell-property.php">Sell Property</a>
                <a class="dropdown-item" href="payment-transaction.php">Payment Transaction</a>              
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Records & Documents</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="recordsDropdown">                            
                <a class="dropdown-item" href="property.php">Property</a>
                <a class="dropdown-item" href="legal-document.php">Legal Documents</a>            
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="maintenance-request.php">
                <i class="fas fa-wrench"></i>
                <span>Maintenance Request</span></a>
            </li> 
         <!--Clerk View -->

         <!--Manager View -->
          <hr class="hr">
         <span class="title-mode">Manager view</span>
         <li class="nav-item menu-customer-list">
          <a class="nav-link" href="customer-list.php">
            <i class="fas fa-user-alt"></i>
            <span>Customer</span></a>
        </li>
        <li class="nav-item menu-client-list">
          <a class="nav-link" href="client-list.php">
            <i class="fas fa-briefcase"></i>
            <span>Client</span></a>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Records & Documents</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="recordsDropdown">                        
            <a class="dropdown-item" href="property.php">Property</a>
            <a class="dropdown-item" href="legal-document.php">Legal Documents</a>            
          </div>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="issue-legal-documents.php">
           <i class="fab fa-accusoft"></i>
            <span>Issue Legal Document</span></a>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book"></i>
            <span>Reports</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="reportsDropdown">            
            <a class="dropdown-item" href="financial-report.php">Financial Report</a>
            <!--
            <a class="dropdown-item" href="customer-report.php">Customer Report</a>  
               
            <a class="dropdown-item" href="maintenance-report.php">Maintenance Report</a>         
            -->
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="trackingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fab fa-trello"></i>
            <span>Tracking Sheet</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="trackingDropdown">            
            <a class="dropdown-item" href="account-balance.php">Account Balance</a>
            <a class="dropdown-item" href="property-tracking.php">Property Tracking</a> 
                       
          </div>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="recordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-wrench"></i>
            <span>Maintenance </span></a>
          </a>
          <div class="dropdown-menu" aria-labelledby="maintenanceDropdown">                       
            <a class="dropdown-item" href="maintenance-request-list.php">Request List</a>            
            <a class="dropdown-item" href="maintenance-scheduled-list.php">Scheduled List</a>  

          </div>
        </li> 
         <!--Manager View -->
         <?php } ?> <!-- isset jonel -->
        <?php } ?>                   
       <!--Administrator -->

      </ul>
<style type="text/css">
  .hr{
    border: 1px solid #fff;
    width: 100%;
  }
  .title-mode{
    color: #fff;
    margin-left: 1em;
    font-size: 13px;
  }
</style>
