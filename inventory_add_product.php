<?php
session_start();
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
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          echo "<tr> <td>$category</td> <td>$brand</td> <td>$desc</td> <td>$size</td> <td>$quantity</td>  <td>$repoint</td> <td> $price</td></tr>";
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
                }     

                #please add these error checking codes
                else if(isset($_POST['add']) && ( empty($_POST['description']) || empty($_POST['size']) ||  empty($_POST['quantity']) || empty($_POST['repoint']) ||  empty($_POST['price']))){
                    echo '<script language="javascript">';
                            echo 'alert("Cannot Leave Fields Blank")';
                            echo '</script>';
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