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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Add Purchase Order</div>
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
                                <header class="card-header font-weight-bold">Purchase Order Details</header>
                                
                                <!--SO Details Form -->
                                <form method = "post" action = "purchase_add_purchase_order2.php">
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">PO Number:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            if(isset($_POST['proceed']))
                                                            {
                                                                $supplier = $_POST['Supplier'];
                                                                $address = $_POST['Address'];
                                                                $_SESSION['SupplierName'] = $supplier;
                                                                $_SESSION['address'] = $address; 
                                                            }
                                                        
                                                            $POQuery = ("SELECT count(PONum) AS POCount FROM p_purchasingmanagement");
                                                            $POresult =  $con->query($POQuery);
                                                            if ($POresult->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $POresult->fetch_assoc()) {
                                                                    $PONum= $row['POCount'] + 1 ;
                                                                    $_SESSION['PONum'] = $PONum;
                                                                    echo $_SESSION['PONum'];
                                                                    }
                                                                } else {
                                                                    echo "0 results";
                                                                    }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Supplier Name:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="Supplier" value="<?php echo $_SESSION['SupplierName'] ?>" class="form-control" readonly>
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
                                                        <input type="text" name="Address" value= "<?php echo $_SESSION['address'] ?>" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                </form>
                            </div>
                                                       
                        <div class="container-fluid">
                            <div class="col-lg-12">
                                <header class="card-header font-weight-bold">Add Product Order Details</header>
                                
                                <!--Product Details Form -->
                                <form method = "post" action = "">
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
                                                    $valueToSearch = $_POST['prodcode'];
                                                    // search in all table columns
                                                    // using concat mysql function
                                                    $query = "SELECT * FROM products WHERE prodcode  = ".$valueToSearch;
                                                    $search_result = filterTable($query);
                                                }

                                                else {
                                                    $query = "SELECT * FROM products WHERE prodcode =' ' ";
                                                    $search_result = filterTable($query);
                                                }

                                                function filterTable($query)
                                                {
                                                    $con = mysqli_connect("localhost", "root", "", "inventory");
                                                    $filter_Result = mysqli_query($con, $query);
                                                    return $filter_Result;
                                                }


                                                if ($search_result->num_rows > 0) {
                                                // output data of each row

                                                while($row = $search_result->fetch_assoc()) {

                                                    $prodcode= $row['prodcode'];
                                                    $category = $row['category'];
                                                    $brand= $row['brand'];
                                                    $proddesc= $row['proddesc'];
                                                    $size= $row['size'];
                                                    $PONum = $_SESSION['PONum'];
                                                    $_SESSION['prodcode'] = $prodcode;
                                                    $_SESSION['category'] = $category;
                                                    $_SESSION['brand'] = $brand;
                                                    $_SESSION['proddesc'] = $proddesc;
                                                    $_SESSION['size'] = $size;

                                                ?>

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
                                                       <label class="control-label">Quantity:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="number" name="quantity" value = 'quantity' class="form-control ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Add Button-->
                                    <div class="d-flex" style=" margin-top: 10px;">
                                        <div style="width: 90%; float: left;"></div>
                                        <button name="add" value="add" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 10%;float: right;"> Add </button>
                                    </div>
                                </form>
                                <?php
                                     }
                                }


                                #please add these error checking codes
                                else if (isset($_POST['search']) &&($search_result->num_rows == 0)){
                                echo '<script language="javascript">';
                                echo 'alert("Invalid Search Parameter. Please Try Again")';
                                echo '</script>';
                                }

                                if(isset($_POST['add']) && $_POST['add']){    
                                    $quantity = $_POST['quantity'];
                                    $_SESSION['quantity'] = $quantity;

                                    $PurchaseOrderQuery = "INSERT INTO temporarypurchasing (PONum, ProductCode, Category, Brand, ProductDesc, Size, QuantitytobeOrdered)
                                    VALUES('". $_SESSION['PONum']."', '". $_SESSION['prodcode']."','". $_SESSION['category']."', '". $_SESSION['brand']."', '". $_SESSION['proddesc']."','". $_SESSION['size']."','". $_SESSION['quantity']."')";
                                    if(mysqli_query($con,$PurchaseOrderQuery)){
                                        header("message=Successfully added new records");  
                                            }
                                    else{
                                        header("message=Error in adding the record");
                                            } 
                                }
                                ?>
                            </div>
                        </div>
                            
                        
                        <!-- Table -->
                        <div class="col-lg-12">
                            <form method="post" class="navbar-expand col-lg-12" >
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
                                      <th>Quantity to be Ordered</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                        $viewDetailsQuery = "SELECT * FROM temporarypurchasing";
                                        $result = $con->query($viewDetailsQuery);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        // gets variables from table
                                            while($row = $result->fetch_assoc()) {
                                                echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" .  $row['QuantitytobeOrdered'] . "</td>
                                                <td><button type = 'submit' name = 'remove'  value = '" . $row['ProductCode'] . "' class = 'btn'> <i class='fas fa-fw fa-minus-square' style = 'color:#e74a3b;'/> </button></td>
                                                </tr>\n";
                                            }
                                        } 
                                      ?>
                                  </tbody>
                                </table>
                            </div>
                        </form>

                        <form method="post"  onsubmit="return confirm('Are you sure you want to continue action?');"> 
                            <div class="d-flex" style=" margin-top: 10px;">
                                <!-- Remove Button-->
                                <div style="width: 80%; float: left;">
                                    <!--<button name="add" value="add" formaction="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 10%;float: left;"> Remove </button>-->
                                </div>
                                <div class="d-flex" style="width: 30%; float: right;">
                                <!-- Submit Button-->
                                <button type = 'submit' name = 'submit'  value = 'submit' formaction = 'processPurchasing.php' class="d-flex d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 35%; float: left; margin-right: 20%;"> Submit </button>
                                <!-- Cancel Button-->
                                <button type = 'submit' name = 'back'  value = 'back' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 35%; float: right;"> Back </button>
                                </div>
                            </div>
                        </form>
                        </div>
                            
                            
                            <?php
                                 

                                if(isset($_POST['submit'])){
                                    $refreshQuery = " DELETE FROM temporarypurchasing";
                                    if(mysqli_query($con,$refreshQuery)){
                                        header("location:purchase_purchase_history.php");
                                        session_unset(); 
                                        session_destroy();

                                            }
                                    else{
                                        header("location:purchase_purchase_history.php");
                                            }
                                }
                        
                        //EDITED: remove process
                                if(isset($_POST['remove'])){
        $deleteProd = $_POST['remove'];
        $deleteQuery = " DELETE FROM temporarypurchasing WHERE ProductCode = $deleteProd ";
        if(mysqli_query($con,$deleteQuery)){
            header("location:purchase_add_purchase_order.php");
                }
        else{
            header("location:purchase_add_purchase_order.php");
                }
            }


                                if(isset($_POST['back'])){
                                    $refreshQuery = " DELETE FROM temporarypurchasing";
                                    if(mysqli_query($con,$refreshQuery)){
                                        header("location:purchase_purchase_history.php");
                                        session_unset(); 
                                        session_destroy();

                                            }
                                    else{
                                        header("location:purchase_purchase_history.php");
                                            }
                                }
                            ?>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>