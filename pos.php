<html>
    <?php
    error_reporting(0);
    //function phpAlert($message){
      //echo 'script type="text/javascript">alert("'. $message . '")</script>';
    //  echo "<script type='text/javascript'>alert('$message');</script>";
   // }
   //  if (isset($_GET['message'])) {
     //  phpAlert( $_GET['message']);
     //}
        session_start();
        require_once("db/connection.php");
    ?>
    <head>
        <title>Lunatech Systems</title>
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <style>
            body{
                background-color: #f0f3e1;
            }
            .bg{
                background-color: #b4c540;
            }
            
            *, *:before, *:after {
              -webkit-box-sizing: border-box;
              -moz-box-sizing: border-box;
              box-sizing: border-box;
              margin: 0;
              padding: 0;
            }
            /* Buttons styles */
            input::-moz-focus-inner,
            button::-moz-focus-inner {
                border: 0;
                padding: 0;
            }
            input[type="submit"].btn,
            button.btn {
                cursor: pointer;
            }
            .pos-btn,.pos-btn {
                display: inline-block;
                outline: none;
                *zoom: 1;
                text-align: center;
                text-decoration: none;
                font-family: inherit;
                font-weight: 300;
                letter-spacing: 1px;
                vertical-align: middle;
                border: 1px solid;
                transition: all 0.2s ease;
                box-sizing: border-box;
                text-shadow: 0 1px 0 rgba(0,0,0,0.01);
                margin: auto;
                margin-bottom: 10px;
                width: 40%;
                height: 60px;
                background: #fff;
            }
            .pos-btn-medium {
                font-size: 0.9375em;
                padding: 0.5375em 1.375em;
            }
            /* Colors */
            .pos-btn-green {
                color: #3CB371;
                border-color: #3CB371;
            }
            .pos-btn-green:hover {
              background: #3CB371;
              color: #fff;
              border-color: #3CB371;
              text-decoration: none;
            }
            .pos-btn-blue {
                color: #4682B4;
                border-color: #4682B4;
            }
            .pos-btn-blue:hover {
              background: #4682B4;
              color: #fff;
              border-color: #4682B4;
              text-decoration: none;
            }
            .c-label{
                margin: 10px;
            }
            .c-input{
                margin-right: 90px;
            }
        </style>
    </head>
    <body>
        
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php include 'sidebar.php' ?>
            
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light mb-4 bg topbar static-top shadow">
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">POS System</div>
                      <!-- Sidebar Toggle (Topbar) -->
                      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                      </button>

                      <!-- Topbar Navbar -->
                      <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                          </a>
                          <!-- Dropdown - Messages -->
                          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                              <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </li>

                        <!-- COPY START -->
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw text-white"></i>
                            <!-- Counter - Alerts 
                            <span class="badge badge-danger badge-counter">3+</span> -->
                          </a>
                          <!-- Dropdown - Alerts -->
                          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                              Notifications Center
                            </h6>
                            <form method = "post" class="table-responsive-lg">
                            <table class="table table-wrapper">
                                <?php
                                $getNotifs ="SELECT * FROM notifications";
                                $search_result = mysqli_query($con, $getNotifs);
                                    if ($search_result->num_rows > 0) {
                                        while($row = $search_result->fetch_assoc()) {
                                            $status = $row['status'];
                                            if($status == 'Unread'){
                                              echo "\t<tr class='table-active'><td style='width: 1%;'><span class='icon-circle bg-warning '><i class='fas fa-exclamation-triangle text-white'></i></span></td>
                                                  <td><button class='btn' name = 'notification' value = '" . $row['notifID'] . "'>" . $row['date']  . "<br>". $row['description'] . "  </button></td></tr>";
                                            }
                                            else if($status == 'Read') {                                              
                                              echo "\t<tr><td style='width: 1%;'><span class='icon-circle bg-warning '><i class='fas fa-exclamation-triangle text-white'></i></span></td>
                                              <td><button class='btn' name = 'notification' value = '" . $row['notifID'] . "'>" . $row['date']  . "<br>". $row['description'] . "  </button></td></tr>";
                                            }
                                                                        
                                        }
                                      }
                                  
                                ?>
                                <!--<tr>
                                    <td style="width: 2%;"><span class="icon-circle bg-danger "><i class="fas fa-exclamation-triangle text-white"></i></span></td>
                                    <td><button class="btn">You have low stock!</button></td>
                                </tr>-->
                                
                            </table>
                            </form>

                            <?php
                            if(isset($_POST['notification'])) {
                                $notifID = $_POST['notification']; 
                                $specificNotif ="SELECT * FROM notifications WHERE notifID = $notifID";
                                $search_result = mysqli_query($con, $specificNotif);
                                if ($search_result->num_rows > 0) {
                                    while($row = $search_result->fetch_assoc()) {
                                        $redirect = $row['type'];
                                        $code = $row['code'];
                                    }
                                }
                                $updateStatus = "UPDATE notifications 
                                SET status = 'Read' 
                                WHERE notifID = $notifID";
                                if(mysqli_query($con,$updateStatus)){
                                    $alert = 'Yay';
                                }
                                else{
                                    $alert = mysqli_error($con);
                                    echo $alert;
                                            }
                                if($redirect == 'Inventory' ){
                                    header("location:purchase_purchase_cart.php");       
                                }
                                else if($redirect == 'Purchase' ){
                                    $_SESSION['PONum'] = $code;
                                    header("location:view_pending_order.php");       
                                }
                                
                            }
                            ?>
                          </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-home fa-fw text-white"></i>
                          </a>
                        </li>
                          
<!-- COPY END -->

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <div class="btn btn-sm btn-primary shadow-sm" style="height: 30px; margin-top: 15px">
                                <a href ="logout.php" class = "text-white"> Logout </a>
                          </div>
                      </ul>
                    </nav>
                    
                   <!-- Begin Page Content -->
                    
                    <!--DateTime 
                    <div class="container-fluid" style="padding-top: 0;">
                        <div class="d-flex" style="padding-top: 0; border-bottom:  .10rem solid #b4c540;">
                            <div class="container-fluid" style="width: 50%"></div>
                            <div style="float: right;">
                                <p class="text-gray-800">
                                <?php echo(strftime("Today | %B %d, %Y | %A")); ?></p>
                            </div> 
                        </div>
                    </div>-->
                    
                    <?php
            
                        $SONum = $_SESSION ['SONum']; 
                        $payment = 0;
                        $change = 0;
                        $discount1=0;
                        $InvoiceQuery = ("SELECT count(invoiceNum) AS INVOICECOUNT FROM salesmanagement ");
                        $result =  $con->query($InvoiceQuery);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $invoiceNum= $row['INVOICECOUNT'] +1 ;
                                $_SESSION['invoiceNum'] = $invoiceNum;
                                }
                            } 
                        //else {
                        //        echo "0 results";
                         //   }
                        
                            $CustomerQuery = ("SELECT CustomerName FROM ordermanagement WHERE SONum = $SONum ");
                            $result =  $con->query($CustomerQuery);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $custName= $row['CustomerName'] ;
                                    $_SESSION['CustomerName'] = $custName;
                                    }
                                } 
                            //else {
                              //      echo "0 results";
                              //  }
                    ?>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="card col-lg-8 shadow mb-4">
                                <div class="card-body">
                                    <!-- POS Details -->
                                    <div class="row">
                                        <div class="col-lg-7 mb-4" style="float: left;">
                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                <div>
                                                    <label class="control-label">SO Number: </label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <?php
                                                        echo $SONum 
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                <div>
                                                    <label class="control-label">Invoice Number:</label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <?php
                                                         echo $invoiceNum
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 mb-4" style="float: right;">
                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                <div>
                                                    <label class="control-label">Customer Name:</label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <?php
                                                     echo $custName;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Product Table -->
                                    <div class="table-responsive">
                                        <form method = "post" action = "">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                              <thead>
                                                <tr>
                                                  <th>Code</th>
                                                  <th>Description</th>
                                                  <th>Size</th>
                                                  <th>Available</th>
                                                  <th>Quantity to Issue</th>
                                                  <th>Price</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  <!-- INSERT PHP -->
                                                  <?php   
                                          if(isset($_POST['submitcheckout'])){
                                                      $insertQuery = "INSERT INTO temporaryinvoice (SONum, ProdCode, Category, Brand, ProdDesc, Size, Available, Quantity, QuantityIssued, ToBeIssued, Price, TotalPrice) 
                                                      SELECT s.SONum, s.ProdCode, s.Category, s.Brand, s.ProdDesc, s.Size, s.Available, s.ProdQuan, s.Issued, s.ProdQuan - s.Issued, s.Price, s.TotalPrice
                                                      FROM salesorderdetails s
                                                      WHERE s.SONum = $SONum AND (s.ProdQuan - s.Issued)!= 0 AND s.Status!= 'Cancelled'";
                                                      if(mysqli_query($con,$insertQuery)){
                                                        header("message=Successfully added new records");
                                                        $updateInvoice = "UPDATE temporaryinvoice 
                                                        SET invoiceNum =  $invoiceNum 
                                                        WHERE SONum = $SONum";
                                                            if(mysqli_query($con,$updateInvoice)){
                                                              header("message=Sucess in adding the record");
                                                              }
                                                              else{
                                                                $alert = mysqli_error($con);
                                                                echo $alert;
                                                            }
                                                            
                                                      
                                                    }
                                                  }
                                                           
                                                           
                                                            
                                                      $viewDetailsQuery = "SELECT * FROM temporaryinvoice";
                                                      $result2 = $con->query($viewDetailsQuery);
                                                      if ($result2->num_rows > 0) {
                                                      // output data of each row
                                                      while($row = $result2->fetch_assoc()) {
                                                          
                                                          echo "<form method = 'post' action = '' >";
                                                          echo "\t<tr><td><input type = 'submit' name = 'ProdCode' value = '" . $row['ProdCode'] . "' class = 'btn' style = 'color: #4e73df;' > </td><td>" .  $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" .  $row['Available'] . "</td><td>" .  $row['ToBeIssued'] . "</td><td>" .  $row['Price'] . " </td></tr><br>";
                                                          echo "</form>";
                                                          }
                                                      }
                                                  else {
                                                       echo "<tr><td colspan='7'><center> No data available in table </center></td></tr>";
                                                       }
                                                       if(isset($_POST['ProdCode']))
                                                      {
                                                        $ProdCode = $_POST['ProdCode'];
                                                        $_SESSION['ProdCode'] = $ProdCode;
                                                      }
                                                  ?>
                                              </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- POS Sidebar -->
                            <div class="card shadow col-lg-4 mb-4">
                                <div class="card-body">
                                    <!-- POS Buttons -->
                                    <div class="row">
                                        <button id="truncateBtn" class="pos-btn pos-btn-medium pos-btn-blue" data-toggle="modal" data-target="#truncateModal">Void <br> Sale</button>                                        
                                        <button id="voidBtn" class="pos-btn pos-btn-medium pos-btn-blue" data-toggle="modal" data-target="#voidModal">Void <br> Product</button>
                                    </div>
                                    
                                    <!-- 1st Set of Modals -->
                                    <div id="truncateModal" class="modal">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Void Sale</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              <form method = "post" action = "processvoidsale.php">
                                                <div class="modal-body">
                                                    <label>Note: Please request for manager approval </label><br>
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Password: </label>
                                                        <input class="c-input form-control col-sm-6" type = "password" name= "password">
                                                    </div>
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type = "submit" class="btn btn-success" onclick = "return confirm('Are you sure you want to void this sale?')" name = "submitvoid"> Submit </button>
                                                  </div>
                                              </form>
                                            
                                          </div>
                                      </div>
                                    </div>
                                    <div id="voidModal" class="modal">                                         
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Void Product</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              <form method = "post" action = "processvoiditem.php">
                                                <div class="modal-body">
                                                    <label>Note: Please request for manager approval </label><br>
                                                    <!--<div class="row d-flex justify-content-between">
                                                        <label class="c-label">Product Code:<?php echo  $_SESSION['ProdCode'] ?> </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= "prodcode">
                                                    </div> -->
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Password: </label>
                                                        <input class="c-input form-control col-sm-6" type = "password" name= "password">
                                                    </div>
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type = "submit" class="btn btn-success" name = "submit" onclick = "return confirm('Are you sure you want to remove this product?')"> Submit </button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                    </div>
                                    
                                    <!-- POS Buttons -->
                                    <div class="row">
                                       <!-- <button class="pos-btn pos-btn-medium pos-btn-blue" data-toggle="modal" data-target="#addModal">Add <br> Product</button>-->
                                       <button class="pos-btn pos-btn-medium pos-btn-blue" data-toggle="modal" data-target="#changeQuantity">Change <br> Quantity</button>

                                        <button class="pos-btn pos-btn-medium pos-btn-blue" data-toggle="modal" data-target="#discountSale">Discount <br> Sale </button>
                                    </div>
                                    
                                    <!-- 2nd Set of Modals -->
                                <!--    <div id="addModal" class="modal">                                         
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Add Products</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              <form method = "post" action = "">
                                                <div class="modal-body">
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Product Code: </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= prodcode>
                                                    </div>
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Quantity: </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= newQty>
                                                    </div> 
                                                    <header class="card-header font-weight-bold">Sales Order Details</header>
                                                    <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                          <thead>
                                                            <tr>
                                                               <td>Product Code</td>
                                                              <td>Category</td>
                                                              <td>Brand</td>
                                                              <td>Description</td>
                                                              <td>Size</td>
                                                              <td>Quantity Ordered </td>
                                                              <td>Quantity Available </td>
                                                              <td>Quantity to Issue </td>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <?php 
                                                                $viewDetailsQuery = "SELECT * FROM salesorderdetails WHERE SONum = $SONum AND Issued!= ProdQuan";
                                                                $result = $con->query($viewDetailsQuery);
                                                                if ($result->num_rows > 0) {
                                                                // output data of each row
                                                                // gets variables from table
                                                                    while($row = $result->fetch_assoc()) {
                                                                        $toIssue = $row['ProdQuan'] - $row['Issued'];
                                                                        echo    "<form method = 'post' >"; 
                                                                        echo "\t<tr><td >" . $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" .  $row['ProdQuan'] . "</td><td>" .  $row['Available'] . "</td><td>" .  $toIssue ."</td><td><button type = 'submit' name = 'add'  value = '" . $row['ProdCode']. "' class = 'btn'> <i class='fas fa-fw fa-plus-square' style = 'color:#2e59d9;'/>  </button></td></tr><br>";
                                                                        echo    "</form >"; 
                                                                    }
                                                                  }
                                                                else {
                                                                   echo "<tr><td colspan='8'><center> No data available </center></td></tr>";
                                                                   }
                                                                  /*if(isset($_POST['add']))
                                                                        {
                                                                          $prodcode = $_POST['add'];
                                                                          $viewDetails = "SELECT * FROM salesorderdetails WHERE SONum = $SONum ProdCode = $prodcode";
                                                                          $search_result = mysqli_query($con, $viewDetails);
                                                                          if ($search_result->num_rows > 0) {
                                                                              // output data of each row
                                                                          while($row = $search_result->fetch_assoc()) {
                                                                                      $category = $row['Category'];
                                                                                      $brand= $row['Brand'];
                                                                                      $proddesc= $row['ProdDesc'];
                                                                                      $size= $row['Size'];
                                                                                      $quantity= $row['ProdQuan'];
                                                                                      $available= $row['Available'];
                                                                                      $issued= $row['Issued'];
                                                                                      $_SESSION['category'] = $category;
                                                                                      $_SESSION['brand'] = $brand;
                                                                                      $_SESSION['proddesc'] = $proddesc;
                                                                                      $_SESSION['size'] = $size;
                                                                                      $_SESSION['quantity'] = $quantity;
                                                                                      $_SESSION['available'] = $available;
                                                                                      $_SESSION['issued'] = $issued;
                                                                                      $_SESSION['toissue'] = $toIssue;
                                                                          }
                                                                          }
                                                                          $addQuery = "INSERT INTO temporaryinvoice (SONum, ProdCode, Category, Brand, ProdDesc, Size, Available, Quantity, QuantityIssued, ToBeIssued)
                                                                          VALUES('". $SONum."', '". $prodcode."','". $category."', '". $brand."', '". $proddesc."','". $size."', '".$available."' ,'". $quantity."' ,'". $issued."' ,'". $toIssue."')";
                                                                          if(mysqli_query($con,$addQuery)){
                                                                              header("message=Successfully added new records");  
                                                                                  }
                                                                          else{
                                                                              $alert = mysqli_error($con);
                                                                              echo '<script type="text/javascript">';
                                                                              echo 'alert("'.$alert.'")';
                                                                              echo '</script>';    
                                                                                  }
                                                                                }
                                                                                */
                                                            ?>
                                                          </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type = "submit" class="btn btn-success" name = "submit"> Submit </button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                    </div> -->
                                    <div id="changeQuantity" class="modal">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Change Quantity</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              <form method = "post" action = "processchangequan.php">
                                                <div class="modal-body">
                                                    <div class="col-lg-10">
                                                        <div class="row d-flex justify-content-between">
                                                            <label class="c-label">Product Code: <?php echo  $_SESSION['ProdCode'] ?> </label>
                                                        </div>
                                                            <!--<input class="c-input form-control col-sm-6" type = "number" name= "prodcode">-->
                                                        <?php                                         
                                                        $DefaultQuery =  "SELECT * FROM salesorderdetails WHERE SONum = $SONum AND Issued!= ProdQuan AND ProdCode =". $_SESSION['ProdCode'] ;
                                                        $result = $con->query($DefaultQuery);
                                                        if ($result->num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                $toIssue = $row['ProdQuan'] - $row['Issued'];
                                                            }
                                                        }
                                                        ?>

                                                        <div class="row d-flex justify-content-between">
                                                            <label class="c-label">Quantity: </label>
                                                            <input class="c-input form-control col-sm-4" type = "number" name= "newQty" placeholder = " <?php echo $toIssue ?>"  >

                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type = "submit" class="btn btn-success" name = "submit" onclick = "return confirm('Change the product quantity?')"> Submit </button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                    </div>
                                    
                                    <!-- ALY START HERE: ALL U NEED TO CHANGE IS INPUT NAME AND FORM ACTIONS -->
                                    <div id="discountSale" class="modal">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Discount Sale</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              <form method = "post" action = "">
                                                <div class="modal-body">
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Discount Amount: </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= "discount">
                                                    </div>
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Password: </label>
                                                        <input class="c-input form-control col-sm-6" type = "password" name= password>
                                                    </div>
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type = "submit" class="btn btn-success" name = "discsubmit" onclick = "return confirm('Add a discount for the order?')"> Submit </button>
                                                  </div>
                                              </form>
                                              <?php
                                              if(isset($_POST['discsubmit'])){
                                                $inputpw =$_POST['password'];
                                                $pwQuery = ("SELECT Password FROM users WHERE Email = 'janelle.sy@gmail.com'");
                                                $result =  $con->query($pwQuery);
                                                    if ($result->num_rows > 0) {
                                                        // output data of each row
                                                        while($row = $result->fetch_assoc()) {
                                                            $password= $row['Password'];
                                                            }
                                                        } else {
                                                            echo "0 results";
                                                            }
                                                        
                                               if(($_SESSION['discount'] == 0) && ($inputpw == $password))
                                               {
                                                $message = "Discount applied";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";
                                                $discount = $_POST['discount'];   
                                                $_SESSION['discount'] = $discount;
                                               }
                                                else if(($_SESSION['discount'] !=0) || ($inputpw != $password)){
                                                    $message = "Cannot Update Discount";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";
                                                 //header("location:pos.php?message= Cannot Update Discount.");
                                                 
                                                }
                                 
                                              }
                                                $discount1= $_SESSION['discount'];
                                                $_SESSION['discount1'] = $discount1;
                                              ?>
                                          </div>
                                      </div>
                                    </div>
                                    
                                    <?php 
                                        
                                        $numQuery = "SELECT COUNT(ProdCode) AS Count FROM temporaryinvoice";
                                        $numresult =  $con->query($numQuery);
                                            if ($numresult->num_rows > 0) {
                                                // output data of each row
                                                while($row = $numresult->fetch_assoc()) {
                                                    $numItems= $row['Count'];
                                                    }
                                                } //else {
                                                  //  echo "0 results";
                                                   // }
                                        $SubtotalQuery = "SELECT SUM(Price * ToBeIssued) AS Subtotal FROM temporaryinvoice";
                                        $Subtotalresult =  $con->query($SubtotalQuery);
                                            if ($Subtotalresult->num_rows > 0) {
                                                // output data of each row
                                                while($row = $Subtotalresult->fetch_assoc()) {
                                                    $Subtotal= $row['Subtotal'];
                                                    $_SESSION['Subtotal'] = $Subtotal;
                                                    }
                                                } //else {
                                                  //  echo "0 results";
                                                  //  }
                                            $Subtotal1 =  $_SESSION['Subtotal'];
                                            $_SESSION['Subtotal1'] = $Subtotal1 - $discount1;
                                            $VAT = $_SESSION['Subtotal1']  * 0.12; 
                                            $Total = $_SESSION['Subtotal1']  + $VAT; 
                                            $_SESSION['total'] = $Total; 
                                            $_SESSION['VAT'] = $VAT;
                                            
                                    ?>

                                    <!-- POS Buttons -->
                                    <div class="row">
                                    <button class="pos-btn pos-btn-medium pos-btn-blue" data-toggle="modal" data-target="#chequePayment">Cheque <br> Payment</button>

                                        <button class="pos-btn pos-btn-medium pos-btn-blue" data-toggle="modal" data-target="#cashPayment">Cash <br> Payment</button>
                                    </div>
                                    
                                    <!-- 3rd Set of Modals -->
                                    <div id="chequePayment" class="modal">                                         
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Cheque Payment</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              <form method = "post" action = "">
                                                <div class="modal-body">
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Bank Number: </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= "banknumber">
                                                    </div>
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Cheque Number: </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= "chequenumber">
                                                    </div>
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Enter Amount: </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= "payment">
                                                    </div>
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type = "submit" class="btn btn-success" name = "submitcheck" onclick = "return confirm('Add a check payment?')"> Submit </button>
                                                  </div>
                                              </form>    
                                              <?php
                                              if(isset($_POST['submitcheck'])){
                                                if( $_POST['payment']>=  $_SESSION['total']){
                                                $payment = $_POST['payment'];
                                                $_SESSION['payment'] = $payment;
                                                $change = $payment - $Total;
                                                $_SESSION['change'] = $change;
                                                $banknumber = $_POST['banknumber'];
                                                $_SESSION['banknumber'] = $banknumber;
                                                $chequenumber = $_POST['chequenumber'];
                                                $_SESSION['chequenumber'] = $chequenumber;
                                                }
                                                else{$message = "Failed to add checque";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";}
                                              }
                                              ?>                                          
                                          </div>
                                      </div>
                                    </div>


                                    
                                    <div id="cashPayment" class="modal">                                         
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Cash Payment</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              <form method = "post" action = "">
                                                <div class="modal-body">
                                                    <div class="row d-flex justify-content-between">
                                                        <label class="c-label">Enter Amount: </label>
                                                        <input class="c-input form-control col-sm-6" type = "number" name= "payment" >
                                                    </div>
                                                </div>
                                                  <div class="modal-footer">
                                                      <button type = "submit" class="btn btn-success" name = "submit" onclick = "return confirm('Add cash payment?')"> Submit </button>
                                                  </div>
                                              </form>
                                              <?php
                                              if(isset($_POST['submit'])){
                                                if( $_POST['payment']>=  $_SESSION['total']){
                                                $payment = $_POST['payment'];
                                                $_SESSION['payment'] = $payment;
                                                $change = $payment - $Total;
                                                $_SESSION['change'] = $change;
                                                }
                                                else {$message = "Error In adding amount";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";}
                                              }
                                              ?>
                                              
                                          </div>
                                      </div>
                                    </div>
                                    
                                    <!-- POS Buttons 
                                    <div class="row">
                                        <button class="pos-btn pos-btn-medium pos-btn-blue">Customer <br> Details </button>
                                        <button class="pos-btn pos-btn-medium pos-btn-blue">Cheque <br> Payment</button>
                                    </div> -->
                                    
                                    <!-- POS Lower Content -->

                                   <!-- NEW CHANGES HERE -->
                                    <div class="navbar-expand" style="float: left; width: 100% !important;">
                                      <form method = "post" style="mb-20"> 
                                        <table class="table" style="margin: auto; margin: 20 0px;" id="dataTable" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td>Total Items:</td>
                                                    <td><?php echo $numItems; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Subtotal:</td>
                                                    <td><?php echo  $_SESSION['Subtotal1']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>12% VAT:</td>
                                                    <td>&#8369; <?php echo $VAT; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Discount:</td>
                                                    <td><?php echo  $_SESSION['discount1']; ?></td>
                                                </tr>
                                                <!-- ALY TOTAL IS HERE, FOR UR CODE KANINA DURING WEBTECH -->
                                                <tr>
                                                    <td>TOTAL:</td>
                                                    <td>&#8369; <?php echo $_SESSION['total']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Amount Received:</td>
                                                    <td>&#8369; <?php if ($payment< "0") {
                                                              echo "0";
                                                            }
                                                            else{
                                                              echo round($payment,2);
                                                            } ?></td>                                                </tr>
                                                <tr>
                                                    <td>Change:</td>
                                                    <td>&#8369; <?php if ($change< "0") {
                                                              echo "0";
                                                            }
                                                            else{
                                                              echo round($change,2);
                                                            } ?></td>
                                                </tr>
                                            </tbody>      
                                        </table>
                                        <!-- NEW CHANGES HERE -->  
                                            <div class="d-flex" style=" margin-top: 10px;">
                                                <div class="d-flex" style="margin-left: 10%; float: right;">
                                                    <!-- Checkout Button-->
                                                    <button name="submit" value="" formaction="processinvoice.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="margin-right: 30px; width: 100px;"> Checkout </button>
                                                    <!-- Back Button-->
                                                    <button type = 'submit' name = 'back'  value = 'back' formaction =  'order_pending_sos.php' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px; float: right;"> Back </button>
                                                </div>
                                            </div>
                            
                                        </form>             
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        
                  <!-- Page level plugins -->
          <script src="vendor/datatables/jquery.dataTables.min.js"></script>
          <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    </body>
</html>