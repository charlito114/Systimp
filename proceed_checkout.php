<html>
    <?php
        session_start();
        require_once("db/connection.php");
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
            <?php include 'sidebar.php' ?>
            
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg topbar mb-4 static-top shadow">
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Checkout</div>
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

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                          </a>
                          <!-- Dropdown - Alerts -->
                          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                              Notifications Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                  <i class="fas fa-file-alt text-white"></i>
                                </div>
                              </div>
                              <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                              </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                <div class="icon-circle bg-success">
                                  <i class="fas fa-donate text-white"></i>
                                </div>
                              </div>
                              <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                              </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                  <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                              </div>
                              <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                              </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
                          </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-home fa-fw"></i>
                          </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <div class="btn btn-sm btn-primary shadow-sm" style="height: 30px; margin-top: 15px">
                                Logout
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
                                <?php
                                    $date = date('Y-m-d');
                                    $_SESSION['date' ] = $date;
                                    $InvoiceQuery = ("SELECT count(invoiceNum) AS INVOICECOUNT FROM salesmanagement ");
                                    $result =  $con->query($InvoiceQuery);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            $invoiceNum= $row['INVOICECOUNT'] +1 ;
                                            $_SESSION['invoiceNum'] = $invoiceNum;     
                                ?>
                                <div class="card-header font-weight-bold">
                                    Sales Order Details
                                </div>
                                
                                <!--SO Details Form -->
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Invoice Number:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $_SESSION['invoiceNum']; 
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                                <?php
                                                    }
                                                    } 
                                                else {
                                                        echo "0 results";
                                                    }
                                                $SONum = $_SESSION ['SONum']; 
                                                $customerDetails = ("SELECT  customerName, address FROM ordermanagement WHERE SONUm = $SONum ");
                                                $result2 = $con->query($customerDetails);
                                                if ($result2->num_rows > 0) {
                                                    // output data of each row
                                                    while($row = $result2->fetch_assoc()) {
                                                ?>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Customer Name:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['customerName']; 
                                                        ?>
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
                                                            echo $date; 
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Address:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['address']; 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        }
                                        } else {
                                            echo "0 results";
                                            }
                                        ?>
                                        
                                    </div>
                            </div> 
                        
                        <!-- Table -->
                        
                            <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold">Product Details</header>
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
                                          <th>Quantity Ordered</th>
                                          <th>Issued</th>
                                          <th>Item Price</th>
                                          <th>Total Price</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $viewSODetails = ("SELECT  * FROM salesorderdetails WHERE SONUm = $SONum ");
                                            $result3 = $con->query($viewSODetails);
                                            if ($result3->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result3->fetch_assoc()) {
                                                    echo "\t<tr><td >" . $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Available'] . "</td><td>" . $row['ProdQuan'] . "</td><td>" . $row['Issued'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['TotalPrice'] ."</td><td><button type = 'submit' name = 'addtocart'  value = '" . $row['ProdCode'] . "' class = 'btn'> <i class='fas fa-fw fa-plus-square' style = 'color:#2e59d9;'/> </button></td></tr><br>";
                                                    }
                                                }
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                            
                            <?php
                                if(isset($_POST['addtocart']))
                                {

                                $itemSelected =  $_POST['addtocart'];
                                $selectDetails =  "SELECT * FROM salesorderdetails WHERE SONum = $SONum AND ProdCode = $itemSelected";
                                $result = $con->query($selectDetails);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $prodcode= $row['ProdCode'];
                                    $category = $row['Category'];
                                    $brand= $row['Brand'];
                                    $proddesc= $row['ProdDesc'];
                                    $size= $row['Size'];
                                    $prodquan= $row['ProdQuan'];
                                    $price= $row['Price'];
                                    $_SESSION['prodcode'] = $prodcode;
                                    $_SESSION['category'] = $category;
                                    $_SESSION['brand'] = $brand;
                                    $_SESSION['proddesc'] = $proddesc;
                                    $_SESSION['size'] = $size;
                                    $_SESSION['prodquan'] = $prodquan;
                                    $_SESSION['price '] = $price;

                                }
                            }
                                else {
                                    echo "0 results";
                                }
                            ?>
                                
                                <form method = "post" action = "">
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Product Code:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                       <?php echo $prodcode; ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Category:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                       <?php echo $category; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Brand:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $brand; ?>
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
                                                        <?php echo $proddesc; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Size:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $size; ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Quantity Issued:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="quantityIssued" class="form-control ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Buttons -->
                                    <div class="d-flex" style=" margin-top: 10px;">
                                    <div style="width: 80%; float: left;">
                                    </div>
                                        <div class="d-flex" style="width: 30%; float: right;">
                                        <!-- Add Button-->
                                        <button name="add" value="add" type="submit" formaction = 'proceed_checkout.php' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 100px;float: left; margin-right: 20%;"> Add </button>
                                        <!-- Cancel Button-->
                                        <button type = 'submit' name = 'cancel'  value = 'cancel' formaction = 'proceed_checkout.php' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px;float: right;"> Cancel </button>
                                        </div>
                                </div>
                            </form>
                                
                            <?php
            
            }

            if(isset($_POST['add'])){
                $quantityIssued = $_POST['quantityIssued'];
                $_SESSION['quantityIssued'] = $quantityIssued;
                $priceQuery= ("SELECT price FROM products WHERE prodcode = '".$_SESSION['prodcode']."' ");
                $price = mysqli_fetch_row(mysqli_query($con, $priceQuery));
                $totalPrice = $quantityIssued * $price[0];
                $_SESSION['totalPrice'] = $totalPrice;
    
                $InvoiceDetailsQuery = "INSERT INTO temporaryinvoice (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, QuantityIssued, Price)


                VALUES ('". $_SESSION['invoiceNum']."','". $_SESSION['SONum']."', '". $_SESSION['prodcode']."', '". $_SESSION['category']."','". $_SESSION['brand']."','". $_SESSION['proddesc']."' ,'". $_SESSION['size']."', '". $_SESSION['prodquan']."' , '".$_SESSION['quantityIssued']."'  , '". $_SESSION['totalPrice']."'  )";

                if(mysqli_query($con,$InvoiceDetailsQuery)){
                    $alert = "Successfully added new records!";
                    
                }
                else{
                    $alert = mysqli_error($con);
                    echo '<script type="text/javascript">';
                    echo 'alert("'.$alert.'")';
                    echo '</script>';  
                }

            }
                                ?>
                            <form method="post" class="navbar-expand col-lg-12">
                                 <header class="card-header font-weight-bold">Shopping Cart</header>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>Product Code</th>
                                          <th>Category</th>
                                          <th>Brand</th>
                                            <th>Description</th>
                                          <th>Size</th>
                                          <th>Quantity Ordered</th>
                                          <th>Quantity Issued</th>
                                          <th>Total Price</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $viewDetailsQuery = "SELECT * FROM temporaryinvoice";
                                            $result2 = $con->query($viewDetailsQuery);
                                            if ($result2->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result2->fetch_assoc()) {
                                                echo "\t<tr><td >" .  $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>" . $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] ."</td><td>" . $row['QuantityIssued'] . "</td><td>" .  $row['Price']  ."</td><td><button type = 'submit' name = 'remove'  value = '" . $row['ProdCode'] . "' class = 'btn'> <i class='fas fa-fw fa-minus-square' style = 'color:#e74a3b;'/> </button></td></tr><br>";
                                                }
                                            }
                                          
                                          if(isset($_POST['remove'])){
                    $deleteProd = $_POST['remove'];
                    $deleteQuery = " DELETE FROM temporaryinvoice WHERE prodcode = $deleteProd ";
                    if(mysqli_query($con,$deleteQuery)){
                        $alert = "successful"; 
                            }
                    else{
                        echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>'; 
                            }
                }
                                          
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>     
                            
                            <form method="post"> 
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <!-- Remove Button-->
                                    <div style="width: 80%; float: left;">
                                        <!--<button name="add" value="add" formaction="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 10%;float: left;"> Remove </button>-->
                                    </div>
                                    <div class="d-flex" style="width: 30%; float: right;">
                                    <!-- Submit Button-->
                                    <button type = 'submit' name = 'submit'  value = 'Proceed to checkout' formaction =  'processcheckout.php' class="d-flex d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 200px; float: left; margin-right: 20%;"> Proceed to Checkout </button>
                                    <!-- Cancel Button-->
                                    <button type = 'submit' name = 'back'  value = 'back' formaction =  '' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px; float: right;"> Back </button>
                                    </div>
                                </div>
                            </form>
                                <?php
                        if(isset($_POST['back'])){
        
                            $refreshQuery = "DELETE FROM temporaryinvoice";
                            if(mysqli_query($con,$refreshQuery)){
                                header("location:order_sales_orders.php");
                                session_unset(); 
                                session_destroy();

                                    }
                            else{
                                $alert = mysqli_error($con);
                                echo '<script type="text/javascript">';
                                echo 'alert("'.$alert.'")';
                                echo '</script>';    
                                    }
                        }
                        ?>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>