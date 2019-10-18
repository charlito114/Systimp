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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Order Management Dashboard</div>
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
                            
                                <div class="mb-4"></div>
                                <!--Charts-->
                                    <!-- Content Row -->
                                <div class="row">
                                    
                                    <!-- Ready Orders-->
                                  <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                      <a class="tablinks" onclick="openTab(event, 'readyOrders')">
                                        <div class="card-body">
                                          <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ready Orders</div>
                                              <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                  <?php
                                                $OSDcount = "SELECT COUNT(Status) c FROM ordermanagement WHERE status='completed' ";
                                                $count_result = mysqli_query($con, $OSDcount);
                                                $row = $count_result->fetch_assoc();
                                                echo $row['c'];
                                                ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                              <i class="fas fa-check fa-2x text-gray-300"></i>
                                            </div>
                                          </div>
                                        </div>
                                      </a>
                                    </div>
                                  </div>

                                  <!-- Recently Placed Orders-->
                                  <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                      <a class="tablinks" onclick="openTab(event, 'recentlyPlacedOrders')">
                                        <div class="card-body">
                                          <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Recently Placed Orders</div>
                                              <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                  <!-- Insert PHP Here-->
                                                  <?php
                                                    $OSDcount = "SELECT COUNT(Status) c FROM ordermanagement";
                                                    $count_result = mysqli_query($con, $OSDcount);
                                                    $row = $count_result->fetch_assoc();
                                                    echo $row['c'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                          </div>
                                        </div>
                                      </a>
                                    </div>
                                  </div> 
                                </div>
                             
                        
                        <!-- Ready Orders-->
                          <div id="readyOrders" class="tabcontent" style="display: block;">
                            <div class="col-lg-12 " style="padding-top: 0; border-top:  .10rem solid #b4c540;">
                              <form method="post" class="navbar-expand col-lg-12">
                              <header class="card-header font-weight-bold" style="border-bottom: none;">READY ORDERS</header>
                                  <div class="align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                          <tr>
                                          <th>Date</th>
                                          <th>Sales Order Number</th>
                                          <th>Total Amount</th>
                                          <th>Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $viewTop = "SELECT * FROM ordermanagement WHERE status ='Completed' ORDER BY date ASC LIMIT 5";
                                          $search_result = mysqli_query($con, $viewTop);
                                          if ($search_result->num_rows > 0) {
                                              // output data of each row

                                              while($row = $search_result->fetch_assoc()) {
                                                  echo "\t<tr><td >" . $row['Date'] . "</td><td>" . $row['SONum'] . "</td><td>"  .  $row['TotalAmount'] . "</td>". "</td><td>"  .  $row['Status'] . "</td></tr><br>";
                                                  }
                                              }
                                          else{
                                              echo "0 results";
                                          }
                                              
                                            ?>
                                        </tbody>
                                      </table>
                                  </div>
                              </form>  
                            </div> 
                          </div>

                          <!-- Recently Placed Orders-->
                          <div id="recentlyPlacedOrders" class="tabcontent">
                          <div class="col-lg-12 " style="padding-top: 0; border-top:  .10rem solid #b4c540;">
                              <form method="post" class="navbar-expand col-lg-12">
                              <header class="card-header font-weight-bold" style="border-bottom: none;">READY ORDERS</header>
                                  <div class="align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Sales Order Number</th>
                                      <th>Total Amount</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <!-- Insert PHP Here-->
                                    <?php
                                      $viewTop = "SELECT * FROM ordermanagement ORDER BY date ASC LIMIT 5";
                                    $search_result = mysqli_query($con, $viewTop);
                                    if ($search_result->num_rows > 0) {
                                        // output data of each row

                                        while($row = $search_result->fetch_assoc()) {
                                            echo "\t<tr><td >" . $row['Date'] . "</td><td>" . $row['SONum'] . "</td><td>"  .  $row['TotalAmount'] . "</td>". "</td><td>"  .  $row['Status'] . "</td></tr><br>";
                                            }
                                        }
                                    else{
                                        echo "0 results";
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
