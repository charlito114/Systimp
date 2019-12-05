<?php
session_start();
require_once("connection.php");
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
            <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">Add Product</div>
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

        <div class="container-fluid">
            <!--Add New Product Form -->
            <form action = "" method= "post"  onsubmit="return confirm('Add new product?');">
                <div class="col-lg-12">
                    <div class="card-header font-weight-bold">
                        Add New Product
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mb-4" style="float: left;">
                            <div class="card-body">
                                <!--
                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Product Code:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="number" name="cname" class="form-control">
                                    </div>
                                </div> -->

                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Category:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <select name="category" class="form-control m-bot15 col-lg-12">
                                            <option>Select Category</option>
                                            <option value="pvc blue">PVC Blue</option>
                                            <option value="ppr white">PPR White</option>
                                            <option value="sanitary orange">Sanitary  Orange</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Brand:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <select name="brand" class="form-control m-bot15 col-lg-12">
                                            <option>Select Brand</option>
                                            <option value="moldex">Moldex</option>
                                            <option value="tian">Tian</option>
                                            <option value="era">Era</option>
                                            <option value="emerald">Emerald</option>
                                            <option value="neltex">Neltex</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Price:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="number" name="price" class="form-control">
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
                                        <input type="text" name="description" class="form-control">
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Size:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="text" name="size" class="form-control">
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Quantity:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="number" name="quantity" class="form-control">
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                   <div>
                                       <label class="control-label">Reorder Point:</label>
                                    </div>

                                    <div class="input-group col-sm-6 m-bot15">
                                        <input type="number" name="repoint" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Button-->
                    <div class="d-flex" style=" margin-top: 10px;">
                        <div style="width: 90%; float: left;"></div>
                        <button name = "add" value = "add" formaction = "inventory_add_product.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 100px; float: right;"> Add </button>
                    </div>
                    
                    <?php
                    
                        if (isset($_POST['add']) && !empty($_POST['description']) && !empty($_POST['size']) &&  !empty($_POST['quantity']) && !empty($_POST['repoint']) &&  !empty($_POST['price'])){
                         
                        $category = $_POST['category'];
                        $brand = $_POST['brand'];
                        $desc = $_POST['description'];
                        $size = $_POST['size'];
                        $quantity = $_POST['quantity'];
                        $repoint = $_POST['repoint'];
                        $price = $_POST['price'];
                        $_SESSION['category'] = $category;
                        $_SESSION['brand'] = $brand;
                        $_SESSION['proddesc'] = $desc;
                        $_SESSION['size'] = $size;
                        $_SESSION['quantity'] = $quantity;
                        $_SESSION['repoint'] = $repoint;
                        $_SESSION['price'] = $price; 

                        $inventoryQuery = "INSERT INTO temporaryinventory (category, brand, proddesc, size, prodquan, repoint, price)
                        VALUES('". $_SESSION['category']."','". $_SESSION['brand']."', '". $_SESSION['proddesc']."', '". $_SESSION['size']."','". $_SESSION['quantity']."','". $_SESSION['repoint']."','". $_SESSION['price']."')";
                        if(mysqli_query($con,$inventoryQuery)){
                            header("message=Successfully added new records");  
                                }
                        else{
                            header("message=Error in adding the record");
                                } 
                              }
                              else if(isset($_POST['add']) && ( empty($_POST['description']) || empty($_POST['size']) ||  empty($_POST['quantity']) || empty($_POST['repoint']) ||  empty($_POST['price']))){
                                echo '<script language="javascript">';
                                        echo 'alert("Cannot Leave Fields Blank")';
                                        echo '</script>';
                                    }
                     ?>

                    
                    <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold">New Product Details</header>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>Category</th>
                                          <th>Brand</th>
                                          <th>Description</th>
                                          <th>Size</th>
                                          <th>Quantity</th>
                                          <th>Reorder Point</th>
                                          <th>Price</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                        $viewDetailsQuery = "SELECT * FROM temporaryinventory";
                                        $result = $con->query($viewDetailsQuery);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        // gets variables from table
                                            while($row = $result->fetch_assoc()) {
                                                echo "\t<tr><td >"  . $row['category'] . "</td><td>"  .  $row['brand'] . "</td><td>" . $row['proddesc'] . "</td><td>" . $row['size'] . "</td><td>" .  $row['prodquan'] .  "</td><td>" .  $row['repoint'] . "</td><td>" . $row['price'] .  "</td> <td><button type = 'submit' name = 'remove'  value = '" . $row['id'] . "' class = 'btn'> <i class='fas fa-fw fa-minus-square' style = 'color:#e74a3b;'/> </button></td>
                                                </tr>\n";
                                            }
                                        } 
                                      ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                            
                            <form method="post" onsubmit="return confirm('Are you sure you want to continue action?');"> 
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <!-- Remove Button-->
                                    <div style="width: 80%; float: left;">
                                        <!--<button name="add" value="add" formaction="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 10%;float: left;"> Remove </button>-->
                                    </div>
                                    <div class="d-flex" style="width: 30%; float: right;">
                                    <!-- Submit Button-->
                                    <button type = 'submit' name = 'submit'  value = 'submit' formaction = 'insert.php'  class="d-flex d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 35%; float: left; margin-right: 20%;"> Submit </button>
                                    <!-- Cancel Button-->
                                    <button type = 'submit' name = 'back'  value = 'back' formaction = 'inventory_add_product.php'  class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 35%; float: right;"> Cancel </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                    
                <?php
                    echo '<script language="javascript">';
                    echo 'function myFunction(){';
                    echo 'alert("Successfully added a product!")}';
                    echo '</script>';
                   

                #please add these error checking codes
               
                    ?>
                    
                </div>
            </form>

            <?php
                                 

                                 if(isset($_POST['submit'])){
                                     $refreshQuery = " DELETE FROM temporarypurchasing";
                                     if(mysqli_query($con,$refreshQuery)){
                                         header("location:purchase_purchase_history.php");
                                         session_unset(); 
                                         session_destroy();
 
                                             }
                                     else{
                                         header("location:inventory.php");
                                             }
                                 }
                         
                         //EDITED: remove process
                                 if(isset($_POST['remove'])){
                                    $deleteProd = $_POST['remove'];
                                    $deleteQuery = " DELETE FROM temporaryinventory WHERE id = $deleteProd ";
                                    if(mysqli_query($con,$deleteQuery)){
                                        header("location:inventory_add_product.php");
                                            }
                                    else{
                                        header("location:inventory_add_product.php");
                                            }
                                        }
 
 
                                 if(isset($_POST['back'])){
                                     $refreshQuery = " DELETE FROM temporaryinventory";
                                     if(mysqli_query($con,$refreshQuery)){
                                         header("location:inventory.php");
                                         session_unset(); 
                                         session_destroy();
 
                                             }
                                     else{
                                         header("location:inventory.php");
                                             }
                                 }
                             ?>
                         
        </div>
    </div>
</div>
</div>
</body>
</html>
