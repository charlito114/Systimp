<html>
    <?php
        session_start();
        require_once("config.php");
        error_reporting(0);


        /*
        */
    ?>
    <head>
        <title>Lunatech Systems</title>
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        
        <style>
            body{
                background-color: #f0f3e1;
            }
            .bg{
                background-color: #b4c540;
            }
        </style>
    </head>
    <body>
        
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php include "sidebar.php"  ?>
            
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg topbar mb-4 static-top shadow">
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Create Sales Order</div>
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
                               /* $getNotifs ="SELECT * FROM notifications";
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
                                      */
                                  
                                ?>
                                <!--<tr>
                                    <td style="width: 2%;"><span class="icon-circle bg-danger "><i class="fas fa-exclamation-triangle text-white"></i></span></td>
                                    <td><button class="btn">You have low stock!</button></td>
                                </tr>-->
                                
                            </table>
                            </form>

                            <?php
                            /*if(isset($_POST['notification'])) {
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
                            */
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
                    
                    <!--DateTime -->
                    <div class="container-fluid" style="padding-top: 0;">
                        <div class="d-flex" style="padding-top: 0; border-bottom:  .10rem solid #b4c540;">
                            <div class="container-fluid" style="width: 50%"></div>
                            <div style="float: right;">
                                <p class="text-gray-800">
                                <?php echo(strftime("Today | %B %d, %Y | %A")); ?></p>
                            </div> 
                        </div>
                    </div>
                    
                    <!-- Sales Orders -->
                    <div class="container-fluid">
                            <div class="col-lg-12">
                                <div class="card-header font-weight-bold">
                                    Sales Order Details
                                </div>
                                
                                <!--SO Details Form -->
                                <form method = "post" action = "">
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Sales Order</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                        if(isset($_POST['proceed']))
                                                        {
                                                            $customer = $_POST['customer'];
                                                            $address = $_POST['address'];
                                                            $_SESSION['customer'] = $customer;
                                                            $_SESSION['address'] = $address; 

                                                            // EDITED:  this checks if nag enter sila ng data sa first form and gives an error message if left blank
                                                            if (empty($_POST['customer']) || empty ($_POST['address']))
                                                                {
                                                                    $alert = "Please fill up empty fields.";
                                                                    echo '<script type="text/javascript">';
                                                                    echo 'alert("'.$alert.'")';
                                                                    echo '</script>';  
                                                                }

                                                        }
                                                        
                                                            /*$SOQuery = ("SELECT count(SONum) AS SOCOUNT FROM ordermanagement ");
                                                            $SOresult =  $con->query($SOQuery);
                                                            if ($SOresult->num_rows > 0) {

                                                                while($row = $SOresult->fetch_assoc()) {
                                                                    $SONum= $row['SOCOUNT'] +1 ;
                                                                    $_SESSION['SONum'] = $SONum;
                                                                    echo "SO Num: " .  $_SESSION['SONum'] . "<br>";
                                                                    }
                                                                } else {
                                                                    echo "0 results";
                                                                    }
                                                                    */
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Customer Name:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="customer" value = "<?php echo $_SESSION['customer'] ?>" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 mb-4" style="float: right;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Date:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            $date = date('Y-m-d');
                                                            $_SESSION['date' ] = $date;
                                                            echo $date . "<br>" ;
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Address:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="address" value = "<?php echo $_SESSION['address'] ?>" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Proceed Button-->
                                    <div class="d-flex" style=" margin-top: 10px;">
                                        <div style="width: 80%; float: left;"></div>
                                        <div style="width: 20%;">
                                       <!--   <button type = "submit" name = "proceed"  value = "proceed" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 100px;float: right;"> Proceed </button>-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                                                       
                        <div class="container-fluid">
                            <div class="col-lg-12">
                                <header class="card-header font-weight-bold">Add Product Details</header>
                                
                                <!--Product Details Form -->
                                <form method = "post" action = "" >
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Product Code:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="prodcode" class="form-control" placeholder="Search code">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit" name="search" value="search">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php
                                                if(isset($_POST['search']))
                                                    {
                                                        $valueToSearch = (int)$_POST['prodcode'];

                                                        //EDITED: it shows a popup kung left blank yung search (working pero it shows an error message and idk how to get rid of it)
                                                        if (empty($_POST['prodcode']) )
                                                        {
                                                            $alert = "Please fill up empty fields.";
                                                            echo '<script type="text/javascript">';
                                                            echo 'alert("'.$alert.'")';
                                                            echo '</script>';  
                                                        }
                                                        else{

                                                            $filter = ["prodcode" => $valueToSearch];
                                                            $option = [];
                                                            // select data in descending order from table/collection "users"
                                                            $read = new MongoDB\Driver\Query($filter, $option);
                                                            $result = $conn->executeQuery("$dbname.$c_users", $read);
                        
                                                            foreach ($result as $res) {
                                                                if($res->status == "unavailable" ){
                                                                    header("location:order_add_order2.php?message= Item has been discontinued.");

                                                                }
                                                                else{
                                                                $prodcode = $res->prodcode;
                                                                 $category = $res->category;
                                                                 $brand = $res->brand;
                                                                 $proddesc = $res->proddesc;
                                                                 $size = $res->size;
                                                                 $prodquan = $res->prodquan;	
                                                                // $repoi$res->repoint;
                                                                 $price = $res->price;	
                                                                 $_SESSION['prodquan'] = $prodquan;
                                                                 $_SESSION['prodcode'] = $prodcode;
                                                                 $_SESSION['category'] = $category;
                                                                 $_SESSION['brand'] = $brand;
                                                                 $_SESSION['proddesc'] = $proddesc;
                                                                 $_SESSION['size'] = $size;  
                                                            }
                                                        }
                                                                 
                                                                 
                                                            
                                                            
                                                        }
                                                                    

                                                            
                                                    

                                                  
                                                        
                                                       
                                                 //   }

                                                //}
                                                  //  }
                                                    
                                                    /*

                                                    function filterTable($query)
                                                    {
                                                        $con = mysqli_connect("localhost", "root", "", "inventory");
                                                        $filter_Result = mysqli_query($con, $query);
                                                        return $filter_Result;
                                                    }
                                                    
                                                
                                                if ($search_result->num_rows > 0) {

                                                while($row = $search_result->fetch_assoc()) {
                                                    $prodcode= $row['prodcode'];
                                                    $category = $row['category'];
                                                    $brand= $row['brand'];
                                                    $proddesc= $row['proddesc'];
                                                    $size= $row['size'];
                                                    $available= $row['prodquan']; // EDITED: added available quantity
                                                    $_SESSION['available'] = $available; // EDITED: for available quantity
                                                    $_SESSION['prodcode'] = $prodcode;
                                                    $_SESSION['category'] = $category;
                                                    $_SESSION['brand'] = $brand;
                                                    $_SESSION['proddesc'] = $proddesc;
                                                    $_SESSION['size'] = $size;
                                                    */

                                                ?>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Product Code:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                       <?php echo $_SESSION['prodcode'] ; ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Category:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                       <?php echo $_SESSION['category']; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Brand:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['brand']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 mb-4" style="float: right;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Description:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['proddesc']; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Size:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['size']; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Quantity Available:</label>
                                                    </div>

                                                    <div name="available" class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['prodquan']; ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Quantity Ordered:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="quantity" class="form-control ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Add Button-->
                                    <div class="d-flex" style=" margin-top: 10px;">
                                        <div style="width: 90%; float: left;"></div>
                                        <button name="add" value="add" type="submit" formaction="updateinventory.php"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 10%;float: right;"> Add </button>
                                    </div>
                                </form>
                                <?php
                                   }
                                   $prodquan1=   $_SESSION['prodquan'] ;
                                   $prodcode1= $_SESSION['prodcode'];
                                   $category1=  $_SESSION['category'];
                                   $brand1=  $_SESSION['brand'];
                                   $proddesc1= $_SESSION['proddesc'];
                                   $size1= $_SESSION['size'] ;

                                    $_SESSION['prodquan1'] = $prodquan1;
                                  $_SESSION['prodcode1']= $prodcode1;
                                   $_SESSION['category1'] = $category1;
                                  $_SESSION['brand1'] = $brand1;
                                   $_SESSION['proddesc1'] = $proddesc1;
                                  $_SESSION['size1'] = $size1;
                                

                               // }

                                /*else if (isset($_POST['search']) &&($search_result->num_rows == 0) ){
                                    echo '<script language="javascript">';
                                    echo 'alert("Invalid Search Parameter. Please Try Again")';
                                    echo '</script>';

                                }
                                */

                                if(isset($_POST['add']) && $_POST['add']){
                                   
                                  
                                   /* 
                                    $_SESSION['quantity'] = $quantity;
                                    $availQuery= ("SELECT prodquan FROM products WHERE prodcode = '".$_SESSION['prodcode']."' ");
                                    $available = mysqli_fetch_row(mysqli_query($con, $availQuery));
                                    $priceQuery= ("SELECT price FROM products WHERE prodcode = '".$_SESSION['prodcode']."' ");
                                    $price = mysqli_fetch_row(mysqli_query($con, $priceQuery));
                                    $totalPrice = $price[0] * $_SESSION['quantity']; // EDITED: to compute total price 


                                    //EDITED: added a column, TotalPrice sa database (please add it for both salesorderdetails saka temporaryorders)
                                    $OrderDetailsQuery = "INSERT INTO temporaryOrders ( SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, Available, Price, TotalPrice ) 
                                    VALUES('". $_SESSION['SONum']."','". $_SESSION['prodcode']."', '". $_SESSION['category']."', '". $_SESSION['brand']."','". $_SESSION['proddesc']."','". $_SESSION['size']."' ,'". $_SESSION['quantity']."', '".$available[0]."', '".$price[0]."', '".$totalPrice."')";
                                     if(mysqli_query($con,$OrderDetailsQuery)){
                                        $alert = "Successfully added new records!";
                                                    }
                                    //EDITED: added an alert kung di successful sa pag add sa temporary orders 
                                        else{
                                            $alert = mysqli_error($con);
                                            echo '<script type="text/javascript">';
                                            echo 'alert("'.$alert.'")';
                                            echo '</script>';  
                                        }
                                        */
                                        
                                 
                                      /* $product = array (
                                            'prodcode' => $_SESSION['prodcode'],
                                            'category' => $_SESSION['category'],
                                            'brand' => $_SESSION['brand'],
                                            'proddesc' => $_SESSION['proddesc'],
                                            'size' => $_SESSION['size'],
                                            'prodquan' => $_SESSION['prodquan'],
                                            'order' => $order,

                                            
                                        );

                                        $errorMessage = '';
                                        foreach ($product as $key => $value) {
                                            if (empty($value)) {
                                                $errorMessage .= $key . ' field is empty<br />';
                                            }
                                        }
                                        
                                        if ($errorMessage) {
                                            // print error message & link to the previous page
                                            echo '<span style="color:red">'.$errorMessage.'</span>';
                                            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";	
                                        } else {
                                            //insert data to database table/collection named 'users'
                                            $single_insert = new MongoDB\Driver\BulkWrite();
                                            $single_insert->insert($product);
                                            $conn->executeBulkWrite("$dbname.$temporder", $single_insert);
                                
                                        }*/
                                    }
                                        

                                ?>
                            </div>
                        </div>
                            
                        
                        <!-- Table -->
                        
                           <!-- <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold">Product Order Summary</header>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>Product Code</th>
                                          <th>Category</th>
                                          <th>Brand</th>
                                          <th>Description</th>
                                          <th>Size</th>
                                          <th>Available</th>
                                          <th>Quantity</th>
                                         < <th>Price</th>
                                          <th>Total Price</th> 
                                        </tr>
                                      </thead>
                                      <tbody> -->
                                        <?php

                                          /*  $filter = [];
                                            $option = [];
                                            // select data in descending order from table/collection "users"
                                            $read = new MongoDB\Driver\Query($filter, $option);
                                            $result = $conn->executeQuery("$dbname.$temporder", $read);

                                            foreach ($result as $res) {
                                                echo "<tr>";
                                            // echo "<td>".$res->prodcode."</td>";
                                                echo "<td>".$res->prodcode."</td>";
                                                echo "<td>".$res->category."</td>";
                                                echo "<td>".$res->brand."</td>";	
                                                echo "<td>".$res->proddesc."</td>";	
                                                echo "<td>".$res->size."</td>";	
                                                echo "<td>".$res->prodquan."</td>";	
                                                echo "<td>".$res->order."</td>";	
                                             //   echo "<td>".$res->repoint."</td>";
                                              //  echo "<td>".$res->price."</td>";
                                                echo  "<td><button type = 'submit' formaction = ''  name = 'remove'  value = '" . $res->_id. "' class = 'btn'> <i class='fas fa-fw fa-minus-square' style = 'color:#e74a3b;'/> </button></td>";
                                                echo "</tr>";
                                            }
                                          /*$viewDetailsQuery = "SELECT * FROM temporaryOrders";
                                            $result = $con->query($viewDetailsQuery);
                                            if ($result->num_rows > 0) {

                                                //EDITED: added field for totalprice and a button to remove items from temporaryorders 
                                            while($row = $result->fetch_assoc()) {
                                                echo    "<form method = 'post' >"; 
                                                echo "\t<tr><td >" . $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['Available'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['TotalPrice'] . "</td><td><button type = 'submit' name = 'remove'  value = '" . $row['ProdCode'] . "' class = 'btn'> <i class='fas fa-fw fa-minus-square' style = 'color:#e74a3b;'/> </button></td></tr><br>";
                                                }
                                            }
                                            */
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                            
                           <!-- <form method="post"> 
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <div style="width: 80%; float: left;">
                                    </div>
                                    <div class="d-flex" style="width: 30%; float: right;">
                                    <button type = 'submit' name = 'submit'  value = 'submit' formaction = 'updateinventory.php' class="d-flex d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 35%; float: left; margin-right: 20%;"> Submit </button>
                                    <button type = 'submit' name = 'back'  value = 'back' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 35%; float: right;"> Cancel </button>
                                    </div>
                                </div>
                            </form> -->
                            </div>
                            
                            
                            <?php
                                    //EDITED: remove process
                                if(isset($_POST['remove'])){
                                    $id = $_POST['remove'];
                                    $delete = new MongoDB\Driver\BulkWrite();
                                    $delete->delete(
                                        ['_id' => new MongoDB\BSON\ObjectId($id)],
                                        ['limit' => 0]
                                    );
                                    
                                    $result = $conn->executeBulkWrite("$dbname.$temporder", $delete);
                                    
                                    
                                    //redirecting to the display page (index.php in our case)
                                  //  header("Location:order_add_order2.php");
                                    
                                    
                                    
                                        }


                                if(isset($_POST['back'])){
                                    /*
                                    $refreshQuery = " DELETE FROM temporaryorders";
                                    if(mysqli_query($con,$refreshQuery)){
                                        header("location:order_sales_orders.php");
                                      
                                            }
                                    else{
                                        header("location:order_sales_orders.php");
                                            }
                                            */
                                }
                            ?>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>