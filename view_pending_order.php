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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Manage Purchase Order</div>
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
                                    if(isset($_POST['PONum']))
                                    {
                                        $PONum = $_POST['PONum'];
                                        $_SESSION['PONum'] = $PONum;
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
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">Pending Products</header>
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
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                           $viewDetails = "SELECT * FROM p_podetails WHERE PONum = " . $_SESSION['PONum']. " AND status = 'Processing'" ;
                                           $result2 = $con->query($viewDetails);
                                           if ($result2->num_rows > 0) {
                                           // output data of each row
                                           while($row = $result2->fetch_assoc()) {
                                               echo "<form method = 'post' action = '' >";
                                               echo "\t<tr><td ><input type = 'submit' name = 'ProductCode' value = '" . $row['ProductCode'] . "' class = 'btn' style = 'color: #4e73df;' ></td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['ToReceive'] . "</td> <td><button type = 'submit' name = 'receive' ' formaction = 'view_purchase_order2.php'  value = '" . $row['ProductCode']. "' class = 'btn'> <i class='fas fa-fw fa-pen' style = 'color:#b4c540;'/>  </button></td>
                                               <td><button type = 'submit' name = 'cancel' formaction = 'view_purchase_order_cancel.php'  value = '" . $row['ProductCode']. "' class = 'btn'> <i class='fas fa-fw fa-trash' style = 'color:#ff0000;'/>  </button></td></tr>\n";
                                               
                                               
                                              
                                           }
                                               echo "</form>";
                                           } 
                                           else {
                                               echo "<tr><td colspan='7'><center> 0 results </center></td></tr>";
                                               }
                                                    
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        
                        <?php
                             if(isset($_POST['ProductCode'])){
                                $ProdDetails = $_POST['ProductCode'];                            
                             ?>
                        <div class="col-lg-12">
                            <form class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">Audit Log</header>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Product Code</th>
                                                <th>Quantity Received</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                 $viewAudit = "SELECT * FROM purchaseaudit WHERE PONum = " . $_SESSION['PONum']. " AND ProductCode = $ProdDetails" ;
                                                 $result2 = $con->query($viewAudit);
                                                 if ($result2->num_rows > 0) {
                                                     // output data of each row
                                                     while($row = $result2->fetch_assoc()) {
                                                         echo "<form method = 'post' action = '' >";
                                                         echo "\t<tr><td >" . $row['Date'] . "</td><td>" . $row['ProductCode'] . "</td><td>"  .  $row['Received'] . "</td></tr>\n";
                                                     }
                                                         echo "</form>";
                                                     } 
                                                else {
                                                   echo "<tr><td colspan='3'><center> No data available in table </center></td></tr>";
                                                   }
                                                ?>
                                        </tbody>      
                                    </table>
                                </div>
                            </form>
                        </div>
                        <?php } ?>

                            <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">Received Products</header>
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
                                           $viewDetails = "SELECT * FROM p_podetails WHERE PONum = " . $_SESSION['PONum'] . " AND (status = 'Timeframe' OR status = 'Insufficient Stock')";
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

                            

                            <form method="post"> 
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <div style="width: 70%; float: left;"></div>
                                    <div class="d-flex" style="width: 30%; float: right;">
                                        <!-- Back Button-->
                                        <div style="width: 80%; float: right;">
                                            <button type = 'submit' name = 'back' formaction =  'purchase_pending_pos.php' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px; float: right;"> Back </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
    </body>
</html>