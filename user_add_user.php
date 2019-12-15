
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

<?php

session_start();
include 'sidebar.php' ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg topbar mb-4 static-top shadow">
            <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Add User</div>
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
            <div class="d-flex" style="padding-top: 0; border-bottom:  .10rem solid #b4c540;">
                <div class="container-fluid" style="width: 50%"></div>
                <div style="float: right;">
                    <p class="text-gray-800">
                    <?php echo(strftime("Today | %B %d, %Y | %A")); ?></p>
                </div> 
            </div>
        </div>

        <div class="container-fluid">
            <!--Add New Product Form -->
            <form action = "" method= "post">
                <div class="col-lg-12">
                    <div class="card-header font-weight-bold">
                        Add New User
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4" style="float: left;">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label"> First Name:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="text" name="firstname" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Last Name:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="text" name="lastname" class="form-control">
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Birthday:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="date" name="birthday" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Email:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Password:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">User Type:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <select name = "usertype" class="form-control m-bot15 col-lg-12">
                                            <option> ----- </option>
                                            <option> Sales </option>
                                            <option> Purchasing </option>
                                            <option> Assistant Manager</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-lg-5 mb-4" style="float: right;">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>

                    <!-- Add Button-->
                    <div class="d-flex" style=" margin-top: 10px;">
                        <div style="width: 80%; float: left;"></div>
                        <button type = "submit" name = "adduser" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 100px; float: left; margin-right: 20px;"> Confirm </button>
                        <button name = "cancel" value = "cancel" formaction = "user_user_list.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px; float: right;"> Cancel </button>
                    </div>
                    
                    <?php 
                    require_once("db/connection.php");
                    if (isset($_POST['adduser']))
                    { 
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $birthday = $_POST['birthday'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $usertype = $_POST['usertype'];
                        $query = "INSERT INTO users (Email, LastName, FirstName, Birthday, Password, UserType)
                            VALUES('".$email."', '".$lastname."', '".$firstname."', '".$birthday."' , '".$password."', '".$usertype."')";
                        if(mysqli_query($con,$query)) { 
                            $alert= "successfully added new user"; header("location:user_user_list.php");
                            echo "<script language='javascript'>";
                            echo "alert('.$alert.')";
                            echo '</script>';
                        }
                        else { 
                            $errormessage = mysqli_error($con);
                            echo "<script language='javascript'>";
                            echo "alert('.$errormessage.')";
                            echo '</script>';

                        }
                    }
                    ?>
                    
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
