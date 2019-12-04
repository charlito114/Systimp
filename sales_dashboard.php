<html>
    <?php
     $connect = mysqli_connect("localhost", "root", "", "inventory");  
     $query = "SELECT invoicedetails.ProdCode as productcode, sum(invoicedetails.quantity) as quansold
FROM invoicedetails 
JOIN salesmanagement ON invoicedetails.SONum = salesmanagement.SONum
WHERE salesmanagement.date BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01 00:00:00')
AND DATE_FORMAT(LAST_DAY(NOW() - INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')
GROUP BY ProdCode
ORDER BY quansold desc;";  
     $query2 = "SELECT sum(salesafterVat) AS TotalSalesoftheDay, date FROM salesmanagement ORDER BY date"; // PROBLEM IS IN THIS LINE OF CODE IDK Y, IF U CHANGE THIS QUERY TO SOMETHING ELSE GUMAGANA YUN GRAPH 2
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
                          ['Product Code', 'Quantity Sold'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["productcode"]."', ".$row["quansold"]."],";  
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
                                            <a class="tablinks" onclick="openTab(event, 'totalSales')">
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
                                            </a>
                                            
                                            <!-- Top Selling Products -->                                            
                                            <a class="tablinks" onclick="openTab(event, 'topProducts')">
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
                                                </div>
                                            </a>
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
                             
                        <!-- Top Sales Table -->
                        <div id="totalSales" class="tabcontent" style="display: block;">
                            <!-- INSERT HERE Table -->
                        </div>
                        
                        <!-- Top Products Table -->
                        <div id="topProducts" class="tabcontent" style="display: block;">
                            <div class="col-lg-12">
                            <form method="post" class="navbar-expand col-lg-12">
                            <header class="card-header font-weight-bold" style="border-bottom: none;">TOP SELLING PRODUCTS</header>
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
                                            echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDescription'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['Reorder'] . "</td><td>" . $row['Quansold'] . "</td><td>" . $row['Price'] ."</td></tr><br>";
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
          <!-- Bootstrap core JavaScript-->
          <script src="vendor/jquery/jquery.min.js"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

          <!-- Core plugin JavaScript-->
          <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

          <!-- Custom scripts for all pages-->
          <script src="js/sb-admin-2.min.js"></script>

          <!-- Page level plugins -->
          <script src="vendor/chart.js/Chart.min.js"></script>

          <!-- Page level custom scripts -->
          <script src="js/demo/chart-area-demo.js"></script>
          <script src="js/demo/chart-bar-demo.js"></script>

          <!-- Page level custom scripts -->
          <script src="js/demo/datatables-demo.js"></script>
    </body>
</html>
