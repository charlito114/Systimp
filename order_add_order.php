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
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Create Sales Order</div>
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
                            <div class="col-lg-12">
                                <div class="card-header font-weight-bold">
                                    Sales Order Details
                                </div>
                                
                                <!--SO Details Form -->
                                <form method = "post" action = "order_add_order2.php">
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Sales Order Number:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            $SOQuery = ("SELECT count(SONum) AS SOCOUNT FROM ordermanagement ");
                                                            $SOresult =  $con->query($SOQuery);
                                                            if ($SOresult->num_rows > 0) {

                                                                while($row = $SOresult->fetch_assoc()) {
                                                                    $SONum= $row['SOCOUNT'] +1 ;
                                                                    $_SESSION['SONum'] = $SONum;
                                                                    echo "SO Num: " .  $_SESSION['SONum'] . "<br>";
                                                                    }
                                                                } else {
                                                                    echo "0 results";
                                                                    }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Customer Name:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="customer" class="form-control">
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
                                                            $date = date('Y-m-d');
                                                            $_SESSION['date' ] = $date;
                                                            echo $date . "<br>" ;
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Address:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="address" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Proceed Button-->
                                    <div class="d-flex" style=" margin-top: 10px;">
                                        <div style="width: 80%; float: left;"></div>
                                        <div style="width: 20%;">
                                          <button type = "submit" name = "proceed"  value = "proceed" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 100px;float: right;"> Proceed </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                                       
                        <div class="container-fluid">
                            <div class="col-lg-12">
                                <header class="card-header font-weight-bold">Add Product Details</header>
                                
                                <!--Product Details Form -->
                                <form method = "post" action = "">
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Product Code:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="prodcode" class="form-control" placeholder="Search code">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit" name="search" value="search">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php
                                                if(isset($_POST['search']))
                                                    {
                                                        $valueToSearch = $_POST['prodcode'];

                                                        //EDITED: it shows a popup kung left blank yung search (working pero it shows an error message and idk how to get rid of it)
                                                        if (empty($_POST['prodcode']) )
                                                        {
                                                            $alert = "Please fill up empty fields.";
                                                            echo '<script type="text/javascript">';
                                                            echo 'alert("'.$alert.'")';
                                                            echo '</script>';  
                                                        }
                                                        else{

                                                        $query = "SELECT * FROM products WHERE ProdCode = ". $valueToSearch;
                                                        $search_result = filterTable($query);
                                                        }

                                                    }

                                                    else {
                                                        $query = "SELECT * FROM products WHERE ProdCode = NULL ";
                                                        $search_result = filterTable($query);
                                                    }


                                                    function filterTable($query)
                                                    {
                                                        $con = mysqli_connect("localhost", "root", "", "inventory");
                                                        $filter_Result = mysqli_query($con, $query);
                                                        return $filter_Result;
                                                    }
                                                
                                                if ($search_result->num_rows > 0) {

                                                while($row = $search_result->fetch_assoc()) {
                                                    $prodcode= $row['prodcode'];
                                                    $category = $row['category'];
                                                    $brand= $row['brand'];
                                                    $proddesc= $row['proddesc'];
                                                    $size= $row['size'];
                                                    $available= $row['prodquan']; // EDITED: added available quantity
                                                    $_SESSION['available'] = $available; // EDITED: for available quantity
                                                    $_SESSION['prodcode'] = $prodcode;
                                                    $_SESSION['category'] = $category;
                                                    $_SESSION['brand'] = $brand;
                                                    $_SESSION['proddesc'] = $proddesc;
                                                    $_SESSION['size'] = $size;

                                                ?>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Product Code:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                       <?php echo $_SESSION['prodcode']; ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Category:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                       <?php echo $_SESSION['category']; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Brand:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['brand']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 mb-4" style="float: right;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Description:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['proddesc']; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Size:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['size']; ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Quantity Available:</label>
                                                    </div>

                                                    <div name="available" class="input-group col-sm-6 m-bot15">
                                                        <?php echo $_SESSION['available']; ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Quantity Ordered:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <input type="text" name="quantity" class="form-control ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Add Button-->
                                    <div class="d-flex" style=" margin-top: 10px;">
                                        <div style="width: 90%; float: left;"></div>
                                        <button name="add" value="add" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 10%;float: right;"> Add </button>
                                    </div>
                                </form>
                                <?php
                                   }

                                }

                                else if (isset($_POST['search']) &&($search_result->num_rows == 0) ){
                                    echo '<script language="javascript">';
                                    echo 'alert("Invalid Search Parameter. Please Try Again")';
                                    echo '</script>';
                                }

                                if(isset($_POST['add']) && $_POST['add']){
                                    $quantity = $_POST['quantity'];
                                    $_SESSION['quantity'] = $quantity;
                                    $availQuery= ("SELECT prodquan FROM products WHERE prodcode = '".$_SESSION['prodcode']."' ");
                                    $available = mysqli_fetch_row(mysqli_query($con, $availQuery));
                                    $priceQuery= ("SELECT price FROM products WHERE prodcode = '".$_SESSION['prodcode']."' ");
                                    $price = mysqli_fetch_row(mysqli_query($con, $priceQuery));
                                    $totalPrice = $price[0] * $_SESSION['quantity']; // EDITED: to compute total price 


                                    //EDITED: added a column, TotalPrice sa database (please add it for both salesorderdetails saka temporaryorders)
                                    $OrderDetailsQuery = "INSERT INTO temporaryOrders ( SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, Available, Price, TotalPrice ) 
                                    VALUES('". $_SESSION['SONum']."','". $_SESSION['prodcode']."', '". $_SESSION['category']."', '". $_SESSION['brand']."','". $_SESSION['proddesc']."','". $_SESSION['size']."' ,'". $_SESSION['quantity']."', '".$available[0]."', '".$price[0]."', '".$totalPrice."')";
                                     if(mysqli_query($con,$OrderDetailsQuery)){
                                        $alert = "Successfully added new records!";
                                                    }
                                    //EDITED: added an alert kung di successful sa pag add sa temporary orders 
                                        else{
                                            $alert = mysqli_error($con);
                                            echo '<script type="text/javascript">';
                                            echo 'alert("'.$alert.'")';
                                            echo '</script>';  
                                        }
                                    }  
                                ?>
                            </div>
                        </div>
                            
                        
                        <!-- Table -->
                        
                            <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold">Product Order Summary</header>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>Product Code</th>
                                          <th>Category</th>
                                          <th>Brand</th>
                                          <th>Description</th>
                                          <th>Size</th>
                                          <th>Quantity</th>
                                          <th>Availability</th>
                                          <th>Price</th>
                                          <th>Total Price</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $viewDetailsQuery = "SELECT * FROM temporaryOrders";
                                            $result = $con->query($viewDetailsQuery);
                                            if ($result->num_rows > 0) {

                                                //EDITED: added field for totalprice and a button to remove items from temporaryorders 
                                            while($row = $result->fetch_assoc()) {
                                                echo    "<form method = 'post' >"; 
                                                echo "\t<tr><td >" . $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['Available'] . "</td><td>&#8369; " . $row['Price'] . "</td><td>&#8369; " . $row['TotalPrice'] . "</td><td><button type = 'submit' name = 'remove'  value = '" . $row['ProdCode'] . "' class = 'btn'> <i class='fas fa-fw fa-minus-square' style = 'color:#e74a3b;'/> </button></td></tr><br>";
                                                }
                                            }
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                            
                            <form method="post"> 
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <!-- Remove Button-->
                                    <div style="width: 80%; float: left;">
                                        <!--<button name="add" value="add" formaction="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 10%;float: left;"> Remove </button>-->
                                    </div>
                                    <div class="d-flex" style="width: 30%; float: right;">
                                    <!-- Submit Button-->
                                    <button type = 'submit' name = 'submit'  value = 'submit' formaction = 'processOrder2.php' class="d-flex d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 35%; float: left; margin-right: 20%;"> Submit </button>
                                    <!-- Cancel Button-->
                                    <button type = 'submit' name = 'back'  value = 'back' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 35%; float: right;"> Cancel </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                            
                            
                            <?php
                                    //EDITED: remove process
                                if(isset($_POST['remove'])){
                                    $deleteProd = $_POST['remove'];
                                    $deleteQuery = " DELETE FROM temporaryorders WHERE prodcode = $deleteProd ";
                                    if(mysqli_query($con,$deleteQuery)){
                                        header("location:order_add_order.php");
                                            }
                                    else{
                                        header("location:order_add_order.php");
                                            }
                                        }


                                if(isset($_POST['back'])){
                                    $refreshQuery = " DELETE FROM temporaryorders";
                                    if(mysqli_query($con,$refreshQuery)){
                                        header("location:order_sales_orders.php");
                                        
                                            }
                                    else{
                                        header("location:order_sales_orders.php");
                                            }
                                }
                            ?>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>
