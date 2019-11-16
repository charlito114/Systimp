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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Cancel Purchase Order Details</div>
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
                        <div class="d-flex" style="padding-top: 0;">
                            <div class="container-fluid" style="width: 50%"></div>
                            <div style="float: right;">
                                <p class="text-gray-800">
                                <?php echo(strftime("Today | %B %d, %Y | %A")); ?></p>
                            </div> 
                        </div>
                    </div>
                    
                    <!-- Purchase Orders -->
                    <div class="container-fluid">
                            <div class="col-lg-12">
                                <?php
                                    if(isset($_POST['receive']))
                                    {
                                        $EditCode = $_POST['receive'];
                                        $_SESSION['EditCode'] = $EditCode;
                                        $PONum = $_SESSION['PONum'];
                                    
                                    }
                                        
                                    $viewOrder = "SELECT * FROM p_purchasingmanagement WHERE PONum = " . $_SESSION['PONum'];
                                    $result = $con->query($viewOrder);
                                    if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        $status = $row['Status']; //added this part to get the status
                                ?>
                                <div class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">
                                    Purchase Order Details
                                </div>
                                
                                <!--PO Details Form -->
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">PO Number:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['PONum']; 
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Supplier Name:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['SupplierName']
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
                                                            echo $row['Date']; 
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Address:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['Address']
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Status:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['Status']; 
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
                                <form method="post" class="navbar-expand col-lg-12" action = "processreceive.php" >
                                <header class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">Processing Products</header>
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
                                          <th>Quantity To Be Received</th>
                                          <th>Quantity Received</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                           $viewDetails = "SELECT * FROM p_podetails WHERE PONum = " . $_SESSION['PONum']. " AND status = 'Processing'";
                                           $result2 = $con->query($viewDetails);
                                           if ($result2->num_rows > 0) {
                                           // output data of each row
                                           while($row = $result2->fetch_assoc()) {
                                             
                                               if($row['ProductCode'] == $EditCode){
                                              
                                               echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  . 
                                                $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>"
                                                 . $row['ToReceive'] . "</td><td><input type = 'text' name = 'receivevalue'  value = '' class = 'form-control' ></td> <td><button type = 'submit' name = 'submit'  value = '" . $row['ProductCode'] . "' class = 'btn btn-sm btn-success shadow-sm'> Submit </button></td></tr>\n";
                                               }
                                               else{
                                                 
                                                echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . 
                                                "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] .
                                                 "</td><td>" . $row['ToReceive'] . "</td><td></td></tr>\n";
                                       
                                               }
                                           } 
                                       }
                                           else {
                                               echo "<tr><td colspan='6'><center> No data available in table </center></td></tr>";
                                               }
                             ?>

                                    </tbody>
                                    </table>
                                </div>
                            </form>

                            <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">Fully Received Products</header>
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
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                           $viewDetails = "SELECT * FROM p_podetails WHERE PONum = " . $_SESSION['PONum'] . " AND status = 'Fully Received'";
                                           $result2 = $con->query($viewDetails);
                                           if ($result2->num_rows > 0) {
                                           // output data of each row
                                           while($row = $result2->fetch_assoc()) {
                            
                                               echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td>
                                               </tr>\n";
                                               
                                           }
                                           } 
                                          else {
                                               echo "<tr><td colspan='6'><center> No data available in table </center></td></tr>";
                                               }
                                                    
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>

                            <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">Cancelled Products</header>
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
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                           $viewDetails = "SELECT * FROM p_podetails WHERE PONum = " . $_SESSION['PONum'] . " AND status = 'Timeframe' OR status = 'Insufficient Stock'";
                                           $result2 = $con->query($viewDetails);
                                           if ($result2->num_rows > 0) {
                                           // output data of each row
                                           while($row = $result2->fetch_assoc()) {
                            
                                               echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td>
                                               </tr>\n";
                                               
                                           }
                                           } 
                                          else {
                                               echo "<tr><td colspan='6'><center> No data available in table </center></td></tr>";
                                               }
                                                    
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                            
                            <form > 
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <div style="width: 70%; float: left;"></div>
                                    <div class="d-flex" style="width: 30%; float: right;">
                                        
                                        <div style="width: 80%; float: right;">
                                            <button type = 'submit' name = 'back' formaction =  'view_pending_order.php' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 100px; float: right;"> Back </button>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>