<?php
require_once("db/connection.php"); ?>

<html> 
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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Purchasing Cart</div>
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
                    
                    <!-- Purchase Product-->
                    
                    <div class="card-body mb-4">
                        <?php 
                        $POQuery = ("SELECT count(PONum) AS POCount FROM p_purchasingmanagement");
                            $POresult =  $con->query($POQuery);
                          if ($POresult->num_rows > 0) {
                        // output data of each row
                        while($row = $POresult->fetch_assoc()) {
                            $PONum= $row['POCount'] + 1 ;
                            $_SESSION['PONum'] = $PONum;
                            }
                        } else {
                            echo "0 results";
                            }
                        ?>
                        <!-- Table -->
                        <div class="table-responsive">
                            <header class="panel-heading">Low Stock Products</header>
                            <form method="post" action="">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0; border-top: .20rem solid #b4c540;">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Product Code</th>
                                  <th>Category</th>
                                  <th>Brand</th>
                                  <th>Description</th>
                                  <th>Size</th>
                                  <th>Quantity on Hand</th>
                                  <th>For Inventory</th>
                                  <th>For Orders</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php  
                            $viewLowStock = ("SELECT * FROM lowstockproducts");
                            $search_result = mysqli_query($con, $viewLowStock);
                            if ($search_result->num_rows > 0) {
                                // output data of each row

                                while($row = $search_result->fetch_assoc()) {
                                            $prodcode= $row['prodcode'];
                                            $category = $row['category'];
                                            $brand= $row['brand'];
                                            $proddesc= $row['proddesc'];
                                            $size= $row['size'];
                                            $prodquan= $row['onhand'];
                                            $forinventory= $row['forinventory'];
                                            $fororders= $row['fororders'];
                                            $_SESSION['prodcode'] = $prodcode;
                                            $_SESSION['category'] = $category;
                                            $_SESSION['brand'] = $brand;
                                            $_SESSION['proddesc'] = $proddesc;
                                            $_SESSION['size'] = $size;
                                            $_SESSION['onhand'] = $prodquan;
                                            $_SESSION['forinventory'] = $forinventory;
                                            $_SESSION['fororders'] = $fororders;
                                  
                                    echo "\t<tr><td >" . $row['prodcode'] . "</td><td>" . $row['category'] . "</td><td>"  .  $row['brand'] . "</td><td>" . $row['proddesc'] . "</td><td>" . $row['size'] . "</td><td>" . $row['onhand'] . "</td><td>" . $row['forinventory'] . "</td><td>" . $row['fororders'] .  "</td><td><button type = 'submit' name = 'add'  value = '" . $row['prodcode']. "' class = 'btn'> <i class='fas fa-fw fa-plus-square' style = 'color:#2e59d9;'/>  </button></td></tr><br>";
                                    }
                                  ?>
                                    
                              </tbody>
                            </table>
                            </div>
                        </form>
                    <?php 
                        
                       if(isset($_POST['add']))
                        {
                          $prodcode = $_POST['add'];
                          $viewDetails = "SELECT * FROM lowstockproducts WHERE prodcode = $prodcode";
                          $search_result = mysqli_query($con, $viewDetails);
                          if ($search_result->num_rows > 0) {
                              // output data of each row

                          while($row = $search_result->fetch_assoc()) {
                                      $prodcode= $row['prodcode'];
                                      $category = $row['category'];
                                      $brand= $row['brand'];
                                      $proddesc= $row['proddesc'];
                                      $size= $row['size'];
                                      $prodquan= $row['onhand'];
                                      $forinventory= $row['forinventory'];
                                      $fororders= $row['fororders'];
                                      $_SESSION['prodcode'] = $prodcode;
                                      $_SESSION['category'] = $category;
                                      $_SESSION['brand'] = $brand;
                                      $_SESSION['proddesc'] = $proddesc;
                                      $_SESSION['size'] = $size;
                                      $_SESSION['onhand'] = $prodquan;
                                      $_SESSION['forinventory'] = $forinventory;
                                      $_SESSION['fororders'] = $fororders;
                          }
                          }
                            ?>  
                        <form onsubmit="return confirm('Are you sure you want to continue action?');" method = "post" action = "purchase_purchase_cart.php" style="width: 100%;">
                        <div class="col-lg-12 navbar-expand">
                            <header class="panel-heading" style="padding-top: 0; border-bottom:  .10rem solid #b4c540;">Product Details</header>
                            
                            <!--Product Details Form -->
                                <div class="row">
                                    <div class="col-lg-5 mb-4" style="float: left;">
                                        <div class="card-body">

                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                               <div>
                                                   <label class="control-label">Product Code:</label>
                                                </div>

                                                <div name = 'prodcode' class="input-group col-sm-6 m-bot15">
                                                    <?php echo $prodcode; ?>
                                                </div>
                                            </div>
                                            
                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                               <div>
                                                   <label class="control-label">Category:</label>
                                                </div>

                                                <div name = 'category' class="input-group col-sm-6 m-bot15">
                                                    <?php echo $category; ?>
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                               <div>
                                                   <label class="control-label">Brand:</label>
                                                </div>

                                                <div name = 'brand' class="input-group col-sm-6 m-bot15">
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

                                                <div name = 'proddesc' class="input-group col-sm-6 m-bot15">
                                                    <?php echo $proddesc; ?>
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                               <div>
                                                   <label class="control-label">Size:</label>
                                                </div>

                                                <div name = 'size' class="input-group col-sm-6 m-bot15">
                                                    <?php echo $size; ?>
                                                </div>
                                            </div>
                                            
                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                               <div>
                                                   <label class="control-label">Suggested Quantity:</label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <input type="number" name="suggestedQuan" value="<?php echo $suggestedQuan = $forinventory + $fororders; ?>" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                               <div>
                                                   <label class="control-label">Quantity to be Ordered:</label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <input type = "text" name = "orderQuan" class="form-control" placeholder="Quantity">
                                                </div>
                                            </div>   
                                        </div> 
                                    </div>
                                </div>
                            
                                <!-- Submit and Cancel Button-->
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <div style="width: 80%; float: left;">
                                    </div>

                                    <div class="d-flex" style="width: 30%; float: right;">
                                    <!-- Remove Button-->
                                    <button type = "submit" name = "submit"  value = "submit" class="d-flex d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 100px; float: left; margin-right: 20%;"> Submit </button>

                                    <!-- Create PO Button-->
                                    <button type = "submit" name = "cancel"  value = "cancel" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px; float: right;"> Cancel </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                       
                            <?php     
                                }
                            if(isset($_POST['submit']))
                            {   
                                $suggestedQuan = $_POST['suggestedQuan'];
                                $orderQuan = $_POST['orderQuan'];
                                $PurchaseOrderQuery = "INSERT INTO temporarypurchasing (PONum, ProductCode, Category, Brand, ProductDesc, Size,SuggestedQuantity, QuantitytobeOrdered)
                                VALUES('". $PONum."', '". $_SESSION['prodcode']."','". $_SESSION['category']."', '". $_SESSION['brand']."', '". $_SESSION['proddesc']."','". $_SESSION['size']."', '".$suggestedQuan."' ,'". $orderQuan."')";
                                if(mysqli_query($con,$PurchaseOrderQuery)){
                                    header("message=Successfully added new records");  
                                        }
                                else{
                                    $alert = mysqli_error($con);
                                    echo '<script type="text/javascript">';
                                    echo 'alert("'.$alert.'")';
                                    echo '</script>';    
                                        }

                            }
                        //}
                    }
                else{
                    echo "0 results";
                }    
                                  
                          ?>
                            
                        <header class="panel-heading">Purchasing Cart</header>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0; border-top: .20rem solid #b4c540;">
                            <form method="post" action="purchase_purchase_cart.php">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>Product Code</th>
                                      <th>Category</th>
                                      <th>Brand</th>
                                      <th>Description</th>
                                      <th>Size</th>
                                      <th>Suggested Quantity</th>
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
                                                echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" .  $row['SuggestedQuantity'] . "</td><td>" .  $row['QuantitytobeOrdered']. "</td><td><button type = 'submit' name = 'remove'  value = '" . $row['ProductCode'] . "' class = 'btn'> <i class='fas fa-fw fa-minus-square' style = 'color:#e74a3b;'/> </button></td></tr><br>";
                                            }

                                        } 
                                      ?>
                                  </tbody>
                                </table>
                            </form>
                            
                        </div>
                            
                            <?php 
                                 if(isset($_POST['remove'])){
                                $deleteProd = $_POST['remove'];
                                $deleteQuery = " DELETE FROM temporarypurchasing WHERE ProductCode = $deleteProd ";
                                if(mysqli_query($con,$deleteQuery)){
                                    header("location:purchase_purchase_cart.php");
                                        }
                                else{
                                    header("location:purchase_purchase_cart.php");
                                        }
                                    }           
                                                    ?>
                            
                            <!-- Create PO Button-->
                            <div class="d-flex" style=" margin-top: 10px;">
                                <div style="width: 80%; float: left;">
                                </div>

                                <div class="d-flex" style="width: 30%; float: right;">
                                <!-- Remove Button
                                <button name="" value="" formaction="" class="d-flex d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px; float: left; margin-right: 20%;"> Remove </button> -->

                                <!-- Create PO Button-->
                                <a href = "purchase_add_purchase_order.php">
                                <button type = "submit" name="" value="" formaction="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 100px; float: right;"> Create PO </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>