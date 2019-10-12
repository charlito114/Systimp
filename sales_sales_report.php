<?php
session_start();
require_once("db/connection.php");
        ?>
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
            h1{
                font-family: calibri; color: #cc0000; font-weight: bold;
            }
            header{
                font-family: arial;
                color: black;
                margin: 10px;
            }
            table {border: none;}
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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Sales Report</div>
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
                    
                    <!-- Inventory Stuff -->
                    
                    <div class="card-body mb-4">
                        <!-- Search Bar-->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                            <form class="navbar-search" method="post">
                                <div class="input-group">
                                    <input type="month" name = "trial" class="form-control bg-light small" style="width: 200px; margin-left: 50px;" name="valueToSearch">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="submit" value="submit">
                                           <i class="fas fa-calendar fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- Print and Page -->
                            <div class="d-flex" style=" margin-right: 5%;">
                                <div style="width: 80%;">
                                    <button name="print" value="print" formaction="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="margin-left: 30px; width: 100px;" onclick="printContent('report')"> Print </button>
                                </div>
                            </div> 
                            
                            <?php
                               if (isset($_POST['submit']))
                                { 
                                    $trial = $_POST['trial'];
                                    $month =date("m", strtotime($trial));
                                    $year= date("Y", strtotime($trial));
                                    //echo $month; 
                                    //echo $year;

                                    $query = "SELECT * FROM salesreport WHERE month = $month AND year = $year";
                                    $search_result = filterTable($query);

                                }
                                    else {
                                        $query = "SELECT * FROM salesreport";
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
                            <div class="card-body mb-4" id="report" style="padding-top: 0;">
                            <div class="d-sm-flex align-items-center justify-content-between" style="margin-bottom: 30px;">
                                <div style="width: 100%; display: inline-block; text-align: center;">
                                    <h1>Jansy Commercial</h1>
                                    <header class="justify-content-between">528A T. Alonzo St., Sta. Cruz Manila <br>Tel: 554-15-89 | Tel Fax: 554-15-85 <br>Email: jansycommercial@yahoo.com</header>
                                    <header style="font-weight: bold;">YEARLY SALES AND INCOME REPORT <br>FOR THE YEAR BLANK </header>
                                </div>
                            </div>
                            <table class="" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Sales Before Tax</th>
                                    <th>VAT 12%</th>
                                    <th>Sales After Tax</th>
                                    <th>Cost of Goods Sold</th>
                                    <th>Gross Profit</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  if ($search_result->num_rows > 0) {
                                    // output data of each row

                                    while($row = $search_result->fetch_assoc()) {
                                        echo "\t<tr><td >" . $row['year'] . "</td><td>" . $row['month'] . "</td><td>"  .  $row['salesbeforetax'] . "</td><td>" . $row['vat'] . "</td><td>" . $row['salesaftertax'] . "</td></tr>\n";
                                        }
                                    } 

                                     #please add these error checking codes
                                    else {
                                        $alert = mysqli_error($con);
                                        echo '<script type="text/javascript">';
                                        echo 'alert("'.$alert.'")';
                                        echo '</script>';  
                                    }
                                  ?>
                              </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
            window.print();
        }
        
        function printContent(el){
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
        </script>
    </body>
</html>
