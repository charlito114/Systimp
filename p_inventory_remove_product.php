<?php ob_start();  
require_once("db/connection.php");?>

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
            <?php include 'p_sidebar.php' ?>
            
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                
                <!-- Main Content -->
                <div id="content">
                    
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg topbar mb-4 static-top shadow">
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Remove Product</div>
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
                    
                    <!-- Remove Product-->
                    
                    <div class="card-body mb-4">
                        <!-- Search Bar-->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                            <form action="p_inventory_remove_product.php" class="navbar-search" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light small" placeholder="Search by product category, brand, code or description" aria-label="Search" aria-describedby="basic-addon2" style="width: 450px" name="valueToSearch">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="search" value="Filter">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                            <?php
                            if(isset($_POST['search']))
                            {   
                                session_start();
                                $valueToSearch = $_POST['valueToSearch'];
                                $_SESSION['search'] = $valueToSearch;
                                // search in all table columns
                                // using concat mysql function
                                $query = "SELECT * FROM products WHERE CONCAT(prodcode) LIKE '%".$_SESSION['search']."%'";
                                $search_result = filterTable($query);

                            }
                            else {
                                $query = "SELECT * FROM products WHERE prodcode =' ' ";
                                $search_result = filterTable($query);
                                $query = "SELECT * FROM salesorderdetails WHERE prodcode =' ' ";

                            }


                            function filterTable($query)
                            {
                                $con = mysqli_connect("localhost", "root", "", "inventory");
                                $filter_Result = mysqli_query($con, $query);
                                return $filter_Result; 
                            }
                            
                            if (isset($_POST['search']) &&($search_result->num_rows > 0) && $valueToSearch!= null) {
                                                                 

                            // output data of each row
                            ?>
                            
                        </div>
                        
                        <!-- Table -->
                        <div class="table-responsive">
                            <form class="navbar-expand">
                                 <header class="panel-heading">Product Details</header>
                            <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0; border-top: .20rem solid #b4c540;">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Product Code</th>
                                  <th>Category</th>
                                  <th>Brand</th>
                                  <th>Description</th>
                                  <th>Size</th>
                                  <th>Quantity</th>
                                  <th>Reorder Point</th>
                                  <th>Price</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                
                                  	while($row = $search_result->fetch_assoc()) {
                                    echo "\t<tr  ><td >" . $row['prodcode'] . "</td><td>" . $row['category'] . "</td><td>"  .  $row['brand'] . "</td><td>" . $row['proddesc'] . "</td><td>" . $row['size'] . "</td><td>" . $row['prodquan'] . "</td><td>" . $row['repoint'] . "</td><td>" . $row['price'] ."</td></tr>\n";
                                    }
                                  ?>
                              </tbody>
                            </table>
                            </div>
                            
                            <header class="panel-heading">Ongoing Customer Orders</header>
                            <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0; border-top: .20rem solid #b4c540;">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Date</th>
                                  <th>PO Number</th>
                                  <th>Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  
                                $viewpendingorder = "SELECT o.Date, o.SONum, o.TotalAmount FROM salesorderdetails sod LEFT JOIN ordermanagement o ON sod.SONum = o.SONum WHERE CONCAT(prodcode) LIKE '%".$valueToSearch."%' LIMIT 1";
                                $result = $con->query($viewpendingorder);
                                if ($result->num_rows > 0) {
                                    $countorder =1;
                                    $_SESSION['countorder'] = $countorder;
                                    while($row = $result->fetch_assoc()) {
                                        echo "\t<tr  ><td >" . $row['Date'] . "</td><td>" . $row['SONum'] . "</td><td>"  .  $row['TotalAmount'] ."</td></tr>\n"; }
                                ?>
                            <?php } ?>
                              </tbody>
                            </table>
                            </div>
     
                            <header class="panel-heading">Ongoing Supplier Orders</header>
                            <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0; border-top: .20rem solid #b4c540;">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Date</th>
                                  <th>SO Number</th>
                                  <th>Supplier Name</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                    $viewpendingpurchase = "SELECT p.Date, p.PONum, p.SupplierName FROM p_podetails pod LEFT JOIN p_purchasingmanagement p ON pod.PONum = p.PONum WHERE CONCAT(ProductCode) LIKE '%".$_SESSION['search']."%' LIMIT 1";
                                    $result = $con->query($viewpendingpurchase);
                                    if ($result->num_rows > 0) {
                                        $countpurchase =1;
                                        $_SESSION['countpurchase'] = $countpurchase;
                                        while($row = $result->fetch_assoc()) {
                                            echo "\t<tr  ><td >" . $row['Date'] . "</td><td>" . $row['PONum'] . "</td><td>"  .  $row['SupplierName'] ."</td></tr>\n";
                                        } 
                                    }  
                                    ?>
                              </tbody>
                            </table>
                            </div>
                                
                            <!-- Remove Button-->
                            <div class="d-flex" style=" margin-top: 10px;">
                                <div style="width: 90%; float: left;"></div>
                                <button name='remove' value ='remove' formaction = 'p_delrow.php' onclick='myFunction()' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 100px;float: right;"> Remove </button>
                            </div>
                            
                            <?php
                                 } //if before all tables
                                else if (isset($_POST['search']) &&$valueToSearch== null){
                                    echo '<script language="javascript">';
                                    echo 'alert("Please enter a value")';
                                    echo '</script>';
                                }

                                    #please add these error checking codes
                                else if (isset($_POST['search']) &&($search_result->num_rows == 0)){
                                    echo '<script language="javascript">';
                                    echo 'alert("Invalid Search Parameter. Please Try Again")';
                                    echo '</script>';
                                }    
                            ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>