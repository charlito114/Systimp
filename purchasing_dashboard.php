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
        <!-- Custom styles for this page -->
          <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        
        <style>
            body{
                background-color: #f0f3e1;
            }
            .bg{
                background-color: #b4c540;
            }
            .tablinks{
              cursor: pointer;
            }
            .tabcontent {
              display: none;
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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Purchasing Dashboard</div>
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
                            
                                <div class="mb-4"></div>
                                <!--Charts-->
                                    <!-- Content Row -->
                                <div class="row">
                                    
                                    <!-- Ongoing Supplier Deliveries  Shar-->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                      <div class="card border-left-warning shadow h-100 py-2">
                                        <a class="tablinks" onclick="openTab(event, 'ongoing')">
                                          <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                              <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ongoing Supplier Deliveries</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                  <?php
                                                      $OSDcount = "SELECT COUNT(Status) c FROM p_purchasingmanagement WHERE status='ongoing'";
                                                      $count_result = mysqli_query($con, $OSDcount);
                                                      $row = $count_result->fetch_assoc();
                                                      echo $row['c'];
                                                      ?>
                                                </div>
                                              </div>
                                              <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                              </div>
                                            </div>
                                          </div>
                                        </a>
                                      </div>
                                    </div>

                                  <!-- Cancelled Supplier Deliveries Shar-->
                                  <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <a class="tablinks" onclick="openTab(event, 'cancelled')">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                  <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cancelled Supplier Deliveries</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                      $OSDcount = "SELECT COUNT(Status) c FROM p_purchasingmanagement WHERE status='canceled'";
                                                      $count_result = mysqli_query($con, $OSDcount);
                                                      $row = $count_result->fetch_assoc();
                                                      echo $row['c'];
                                                      ?></div>
                                                  </div>
                                                  <div class="col-auto">
                                                    <i class="fas fa-ban fa-2x text-gray-300"></i>
                                                  </div>
                                                </div>
                                              </div>
                                        </a>
                                    </div>
                                  </div>

                                  <!-- Overdue Supplier Deliveries Shar-->
                                  <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <a class="tablinks" onclick="openTab(event, 'overdue')">
                                           <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                              <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Overdue Supplier Deliveries</div>
                                                <div class="row no-gutters align-items-center">
                                                  <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php
                                                  $OSDcount = "SELECT COUNT(Status) c FROM p_purchasingmanagement WHERE status='ongoing' AND DATEDIFF(date,NOW()) >7";
                                                  $count_result = mysqli_query($con, $OSDcount);
                                                  $row = $count_result->fetch_assoc();
                                                  echo $row['c'];
                                                  ?></div>
                                                  </div>
                                                  <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-auto">
                                                <i class="fas fa-hourglass-end fa-2x text-gray-300"></i>
                                              </div>
                                            </div>
                                          </div> 
                                        </a>
                                    </div>
                                  </div>
                                </div>
                        
                        <!-- Ongoing Supplier Deliveries Table-->
                        <div id="ongoing" class="tabcontent" style="display: block;">
                          <div class="container-fluid">
                              <div class="col-lg-12 table-responsive" style="padding-top: 0; border-top:  .10rem solid #b4c540;">
                                  <form method='post' action = "view_purchase_order.php" class="navbar-expand col-lg-12">
                                  <header class="card-header font-weight-bold" style="border-bottom: none;">Ongoing Supplier Deliveries</header>
                                      <div class="align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                          <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>PO Number</th>
                                                <th>Supplier Name</th>                                           
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <!-- when po num is clicked and viewed and clicks back to go back to dashboard initially, it goes back to history instead -->
                                        <?php
                                          $viewTop = "SELECT * FROM p_purchasingmanagement WHERE status ='ongoing' ORDER BY PONum ASC LIMIT 5";
                                        $search_result = mysqli_query($con, $viewTop);
                                        if ($search_result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $search_result->fetch_assoc()) {
                                                echo "\t<tr><td >" . $row['Date'] . "</td><td><input type = 'submit' name = 'PONum' value = '" . $row['PONum'] . "' class = 'btn' style = 'color: #4e73df;'> </td><td>"  .  $row['SupplierName'] . "</td></tr><br>";
                                                }
                                            }
                                       
                                            
                                          ?>
                                          </tbody>
                                        </table>
                                    </div>
                                </form>
                              </div>
                          </div>
                        </div>
                        
                        <!-- Cancelled Supplier Deliveries Table-->
                        <div id="cancelled" class="tabcontent">
                          <div class="container-fluid">
                              <div class="col-lg-12 table-responsive" style="padding-top: 0; border-top:  .10rem solid #b4c540;">
                                  <form method='post' action = "view_purchase_order.php" class="navbar-expand col-lg-12">
                                  <header class="card-header font-weight-bold" style="border-bottom: none;">Cancelled Supplier Deliveries</header>
                                      <div class="align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                        <table class="table table-bordered" id="dataTable" width="125%" cellspacing="0">
                                          <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>PO Number</th>
                                                <th>Supplier Name</th>                                           
                                            </tr>
                                          </thead>
                                          <tbody>
                                           <?php
                                          $viewTop = "SELECT * FROM p_purchasingmanagement WHERE status ='cancelled' ORDER BY PONum";
                                        $search_result = mysqli_query($con, $viewTop);
                                        if ($search_result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $search_result->fetch_assoc()) {
                                                echo "\t<tr><td >" . $row['Date'] . "</td><td><input type = 'submit' name = 'PONum' value = '" . $row['PONum'] . "' class = 'btn' style = 'color: #4e73df;'> </td><td>"  .  $row['SupplierName'] . "</td></tr><br>";
                                                }
                                            }
                                          ?>
                                          </tbody>
                                        </table>
                                    </div>
                                </form>
                              </div>
                          </div>
                        </div>
                        
                        <!-- Overdue Supplier Deliveries Table-->
                        <div id="overdue" class="tabcontent">
                          <div class="container-fluid">
                              <div class="col-lg-12 table-responsive" style="padding-top: 0; border-top:  .10rem solid #b4c540;">
                                  <form method='post' action = "view_purchase_order.php" class="navbar-expand col-lg-12">
                                  <header class="card-header font-weight-bold" style="border-bottom: none;">Overdue Supplier Deliveries</header>
                                      <div class="align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                        <table class="table table-bordered" id="dataTable" width="125%" cellspacing="0">
                                          <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>PO Number</th>
                                                <th>Supplier Name</th>                                           
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                          $viewTop = "SELECT * FROM p_purchasingmanagement WHERE status='ongoing' AND DATEDIFF(date,NOW()) >7 ORDER BY PONum";
                                        $search_result = mysqli_query($con, $viewTop);
                                        if ($search_result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $search_result->fetch_assoc()) {
                                                echo "\t<tr><td >" . $row['Date'] . "</td><td><input type = 'submit' name = 'PONum' value = '" . $row['PONum'] . "' class = 'btn' style = 'color: #4e73df;'> </td><td>"  .  $row['SupplierName'] . "</td></tr><br>";
                                                }
                                            }
                                          ?>
                                          </tbody>
                                        </table>
                                    </div>
                                </form>
                              </div>
                          </div>
                        </div>
                       
                    </div>
                    
                </div>
            </div>
        </div>
        
        <script>
          function openTab(evt, tabName) {
            
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
          }
        </script>
                  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
        
    </body>
</html>
