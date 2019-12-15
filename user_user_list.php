<?php	
    require_once("db/connection.php");	
    session_start();
?>

<html>
    
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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">User List</div>
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

                        <!-- Nav Item - Messages 
                        <li class="nav-item dropdown no-arrow mx-1">
                          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-home fa-fw text-white"></i>
                          </a>
                        </li>-->
                          
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
                    
                    <div class="card-body mb-4">
                        <!-- Search Bar-->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                            <form action="user_user_list.php" class="navbar-search" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light small" placeholder="Search by Email, Name, or Type" aria-label="Search" aria-describedby="basic-addon2" style="width: 450px" name="valueToSearch">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="search" value="search">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                            <?php
                                if(isset($_POST['search']))
                                {
                                    $valueToSearch = $_POST['valueToSearch'];
                                    // search in all table columns
                                    // using concat mysql function
                                    $query = "SELECT * FROM users WHERE CONCAT(Email, FirstName, LastName, UserType) LIKE '%".$valueToSearch."%'";
                                    $search_result = filterTable($query);
                                }
                                else {
                                    $query = "SELECT * FROM users";
                                    $search_result = filterTable($query);
                                }
                                function filterTable($query)
                                {
                                    $con = mysqli_connect("localhost", "root", "", "inventory");
                                    $filter_Result = mysqli_query($con, $query);
                                    return $filter_Result;
                                }
                            ?>
                            
                        </div>
                       
                        
                        <!-- Table -->
                        <div class="table-responsive">
                            <form method = 'post' action = ''>
                                <div class="card-body mb-4" style="padding-top: 0; display: flex;">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top: 0; padding-top: 0; border-top: .20rem solid #b4c540;">
                                  <thead>
                                    <tr>
                                      <th>Email</th>
                                      <th>Last Name</th>
                                      <th>First Name</th>
                                      <th>Birthday</th>
                                      <th>User Type</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      if ($search_result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $search_result->fetch_assoc()) {
                                        echo "<form method = post>";
                                        $currentstatus = $row['Status'];
                                        if($currentstatus == 'Active' ){
                                        echo "\t<tr><td >" . $row['Email'] . "</td><td>" . $row['LastName'] . "</td><td>"  .  $row['FirstName'] . "</td><td>" . $row['Birthday'] .  "</td><td>" . $row['UserType'] . "</td><td>" . $row['Status'] ."</td><td><button type = 'submit' name = 'disable'  value = '" . $row['Email'] . "' class = 'btn' style = 'color: #e74a3b;' > <i class='fas fa-fw fa-user-alt-slash'/> </button></td></tr><br>";
                                        }
                                        else{
                                          echo "\t<tr><td >" . $row['Email'] . "</td><td>" . $row['LastName'] . "</td><td>"  .  $row['FirstName'] . "</td><td>" . $row['Birthday'] .  "</td><td>" . $row['UserType'] . "</td><td>" . $row['Status'] ."</td><td><button type = 'submit' name = 'enable'  value = '" . $row['Email'] . "' class = 'btn' style = 'color: #2e59d9;' > <i class='fas fa-fw fa-user-check'/> </button></td></tr><br>";
                                        }
                                        echo "</form>";
                                        }
                                        if (isset($_POST['disable'])) {
                                            $email= $_POST['disable'];
                                            $status = "Inactive";
                                            $statusquery = "UPDATE users 
                                                            SET status = '".$status."'
                                                            WHERE Email = '".$email."'";
                                            if(mysqli_query($con,$statusquery)){
                                                $alert = "Successfully updated user!";
                                                echo '<script type="text/javascript">';
                                                echo 'alert("'.$alert.'")';
                                                echo '</script>'; 
                                            }
                                            else{
                                                $alert = mysqli_error($con);
                                                echo $alert;
                                                echo '<script type="text/javascript">';
                                                echo 'alert("'.$alert.'")';
                                                echo '</script>';  
                                                }
                                        }
                                        else if (isset($_POST['enable'])){
                                          $email= $_POST['enable'];
                                          $status = "Active";
                                            $statusquery = "UPDATE users 
                                                            SET status = '".$status."'
                                                            WHERE Email = '".$email."'";
                                            if(mysqli_query($con,$statusquery)){
                                                $alert = "Successfully updated user!";
                                                echo '<script type="text/javascript">';
                                                echo 'alert("'.$alert.'")';
                                                echo '</script>'; 
                                            }
                                            else{
                                                $alert = mysqli_error($con);
                                                echo $alert;
                                                echo '<script type="text/javascript">';
                                                echo 'alert("'.$alert.'")';
                                                echo '</script>';  
                                                }
                                        }
                                    } 
                                     #please add these error checking codes
                                    else if (isset($_POST['search']) &&($search_result->num_rows == 0)){
                                        echo '<script language="javascript">';
                                        echo 'alert("Invalid Search Parameter. Please Try Again")';
                                        echo '</script>';
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
          <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
    </body>
</html>