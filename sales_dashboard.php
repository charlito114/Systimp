<html>
    <?php
     $connect = mysqli_connect("localhost", "root", "", "inventory");  
     $query = "SELECT invoicedetails.ProdCode as productcode, sum(invoicedetails.quantity) as quansold, invoicedetails.brand as BRAND, invoicedetails.category as CATEGORY, invoicedetails.proddesc as prodesc
FROM invoicedetails 
JOIN salesmanagement ON invoicedetails.SONum = salesmanagement.SONum
WHERE salesmanagement.date BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01 00:00:00')
AND DATE_FORMAT(LAST_DAY(NOW() - INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')
GROUP BY ProdCode
ORDER BY quansold desc;";  
     $query2 = "SELECT sum(salesafterVat) AS TotalSalesoftheDay, date FROM salesmanagement WHERE date >= DATE(NOW()) - INTERVAL 7 DAY Group BY date ORDER BY date asc  LIMIT 7"; // PROBLEM IS IN THIS LINE OF CODE IDK Y, IF U CHANGE THIS QUERY TO SOMETHING ELSE GUMAGANA YUN GRAPH 2
     $result = mysqli_query($connect, $query);  
     $result2 = mysqli_query($connect, $query2);  
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
        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           google.charts.setOnLoadCallback(lineChart); 
               
           function drawChart()  
           {
            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var d = new Date();
var month = "For the month of " + monthNames[d.getMonth()-1];
                var data = google.visualization.arrayToDataTable([  
                          ['Product Code', 'Quantity Sold',{label: 'T1', role: 'tooltip'}],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["productcode"]."', ".$row["quansold"].", '".$row["BRAND"]."| ".$row["CATEGORY"]."| ".$row["prodesc"]."' ],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: month ,
                        width: '100%',
                        legend: { position: 'bottom'},
                        isStacked: 'true'
                    
                     };  
                var chart = new google.visualization.BarChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }
               
               function lineChart()  
           {
                var data = google.visualization.arrayToDataTable([  
                          ['Date', 'Sales After Vat'],  
                          <?php  
                          while($row = mysqli_fetch_array($result2))  
                          {  
                               echo "['".$row["date"]."', ".$row["TotalSalesoftheDay"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {
                      title: 'Sales per Day',
                      curveType: 'function',
                      legend: { position: 'bottom'}
                     };  
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));  
                chart.draw(data, options);  
           }
           </script>  
        
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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Sales Management Dashboard</div>
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
                                $getNotifs ="SELECT notifID, TIMESTAMPDIFF(hour, date, now()) as temptime, if(TIMESTAMPDIFF(hour, date, now())>24, ROUND(TIMESTAMPDIFF(hour, date, now())/24,0), TIMESTAMPDIFF(hour, date, now())) as notiftime, code, description, type, status FROM notifications";
                                $search_result = mysqli_query($con, $getNotifs);
                                    if ($search_result->num_rows > 0) {
                                        while($row = $search_result->fetch_assoc()) {
                                            $status = $row['status'];
                                            $temptime = $row['temptime'];
                                            if($status == 'Unread' && $temptime>24){
                                              echo "\t<tr class='table-active'><td style='width: 1%;'><span class='icon-circle bg-warning '><i class='fas fa-exclamation-triangle text-white'></i></span></td>
                                                  <td><button class='btn' name = 'notification' value = '" . $row['notifID'] . "'>" . $row['notiftime']  . " days ago<br>". $row['description'] . "  </button></td></tr>";
                                            }
                                            else if ($status == 'Unread' && $temptime<=24){
                                              echo "\t<tr class='table-active'><td style='width: 1%;'><span class='icon-circle bg-warning '><i class='fas fa-exclamation-triangle text-white'></i></span></td>
                                              <td><button class='btn' name = 'notification' value = '" . $row['notifID'] . "'>" . $row['notiftime']  . " hours ago <br>". $row['description'] . "  </button></td></tr>";
                                            }
                                            else if($status == 'Read' && $temptime>24) {                                              
                                              echo "\t<tr><td style='width: 1%;'><span class='icon-circle bg-warning '><i class='fas fa-exclamation-triangle text-white'></i></span></td>
                                              <td><button class='btn' name = 'notification' value = '" . $row['notifID'] . "'>" . $row['notiftime']  . " days ago<br>". $row['description'] . "  </button></td></tr>";
                                            }
                                            else if($status == 'Read' && $temptime<=24) {    
                                              echo "\t<tr><td style='width: 1%;'><span class='icon-circle bg-warning '><i class='fas fa-exclamation-triangle text-white'></i></span></td>
                                              <td><button class='btn' name = 'notification' value = '" . $row['notifID'] . "'>" . $row['notiftime']  . " hours ago<br>". $row['description'] . "  </button></td></tr>";                                          
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
                        </li> -->
                          
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
                    <div class="container">
                            
                                <div class="mb-4"></div>
                                <!--Charts-->
                                    <div class="row" style="display: flex;">
                                        <div class="col-xl-4 col-lg-2">

                                          <!-- Chart -->
                                          <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                              <h6 class="m-0 font-weight-bold text-primary">Total Daily Sales</h6>
                                            </div>
                                            <div class="card-body">
                                              <div class="chart-area">
                                              <div class="chartjs-size-monitor">
                                                    <div class="chartjs-size-monitor-expand">
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink">
                                                        <div class=""></div>
                                                    </div>
                                                </div>
                                                <div id="curve_chart" style="width: 100%; height: 100%;"></div> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <!-- Total Daily Sales  -->
                                        <?php 
                                        $totalQuery = "SELECT sum(salesafterVat) AS totalsales FROM salesmanagement WHERE date = current_date()";
                                        $result3 = $con->query($totalQuery);
                                        if ($result3->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result3->fetch_assoc()) {
                                          $totalsales = $row['totalsales'];
                                        }
                                      }
                                        ?>
                                        <div class="" style="height: 20%;">
                                            <div class="card-body">
                                              <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                  <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Daily Sales</div>
                                                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "₱".$totalsales ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            <!-- Top Selling Products                              
                                            <div class="card-body">
                                              <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                  <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Top Selling Products</div>
                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                                                    </div>
                                                    <div class="col-auto">
                                                      <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>-->
                                        </div>

                                        <div class="col-xl-5 col-lg-2">
                                          <!-- Chart -->
                                          <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                              <h6 class="m-0 font-weight-bold text-primary">Top Selling Products</h6>
                                            </div>
                                            <div class="card-body">
                                              <div class="chart-bar">
                                                <div id="piechart" style="width: 100%; height: 100%;"></div>
                                              </div>
                                            </div>
                                          </div>

                                        </div>                                        
                                    </div>
                             
                        
                        <!-- Top Products Table -->
                        <div style="display: block;">
                            <div class="col-lg-12">
                            <form method="post" class="navbar-expand col-lg-12">
                                <div class="d-flex" style=" margin-right: 5%;">
                                      <div class="col-lg-9">
                                          <header class="card-header font-weight-bold" style="border-bottom: none;">Top Selling Products</header>
                                      </div>
                                        
                                    </div>
                            
                            <div class=" align-items-center justify-content-between mb-4" style="padding-top: 0; display: flex;">
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
                                    <th>Quantity Sold</th>
                                    <th>Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $viewTop = "SELECT invoicedetails.prodcode as ProductCode, invoicedetails.category as Category,invoicedetails.brand as Brand,
                                                  invoicedetails.proddesc as ProdDescription,invoicedetails.size as Size,invoicedetails.quantity as Quantity,products.repoint as Reorder, 
                                                  sum(invoicedetails.quantity) as Quansold, products.price as Price
                                                  FROM invoicedetails 
                                                  JOIN salesmanagement ON invoicedetails.SONum = salesmanagement.SONum
                                                  JOIN products ON products.prodcode = invoicedetails.prodcode
                                                  WHERE salesmanagement.date BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01 00:00:00')
                                                  AND DATE_FORMAT(LAST_DAY(NOW() - INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')
                                                  GROUP BY invoicedetails.ProdCode 
                                                  ORDER BY Quansold desc
                                                  LIMIT 5;";
                                    $search_result = mysqli_query($con, $viewTop);
                                    if ($search_result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $search_result->fetch_assoc()) {
                                            echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDescription'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['Reorder'] . "</td><td>" . $row['Quansold'] . "</td><td>&#8369; " . $row['Price'] ."</td></tr><br>";
                                            }
                                        }
                                    else {
                                       echo "<tr><td colspan='10'><center> 0 results </center></td></tr>";
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

    </body>
</html>
