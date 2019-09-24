<?php ob_start(); ?>
<html>
    <head>
        <title>Lunatech Systems</title>
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        
        <style>
            .bg-side{
                background-color: #575a6c;
            }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
            <ul class="navbar-nav bg-side sidebar sidebar-dark accordion" id="accordionSidebar">

              <!-- Sidebar - Brand -->
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Janelle Sy</div>

              </a>
                <a class="sidebar-heading">
                <div class="d-flex align-items-center justify-content-center" style="color:white; font-size: 15px">Manager</div></a>

              <!-- Divider -->
              <hr class="sidebar-divider my-0">

              <!-- Nav Item - Pages Collapse Menu -->
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-fw fa-credit-card"></i>
                  <span>Point of Sale</span>
                </a>
                <!--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                  </div>
                </div>-->
              </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInv" aria-expanded="true" aria-controls="collapseInv">
                  <i class="fas fa-fw fa-archive"></i>
                  <span>Inventory Management</span>
                </a>
                <div id="collapseInv" class="collapse" aria-labelledby="headingInv" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Components:</h6>
                    <a class="collapse-item" href="buttons.html">Dashboard</a>
                    <a class="collapse-item" href="inventory.php">Inventory List</a>
                    <a class="collapse-item" href="inventory_add_product.php">Add Product</a>
                    <a class="collapse-item" href="inventory_remove_product.php">Remove Product</a>
                  </div>
                </div>
          </li>

          <!-- Nav Item - Utilities Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-fw fa-tags"></i>
              <span>Sales Management</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components:</h6>
                <a class="collapse-item" href="sales_dashboard.php">Dashboard</a>
                <a class="collapse-item" href="sales_sales_list.php">Sales List</a>
                <a class="collapse-item" href="sales_sales_report.php">Sales Report</a>
              </div>
            </div>
          </li>

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-shopping-cart"></i>
              <span>Purchase Management</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components:</h6>
                <a class="collapse-item" href="login.html">Dashboard</a>
                <a class="collapse-item" href="purchase_purchase_cart.php">Purchase Cart</a>
                <a class="collapse-item" href="purchase_add_purchase_order.php">Add Purchase Order</a>
                <a class="collapse-item" href="purchase_purchase_history.php">Purchase History</a>
              </div>
            </div>
          </li>

          <!-- Nav Item - Charts -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
              <i class="fas fa-fw fa-check-square"></i>
              <span>Order Management</span></a>

                  <div id="collapseOrder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Components:</h6>
                    <a class="collapse-item" href="order_sales_orders.php">Dashboard</a>
                    <a class="collapse-item" href="order_sales_orders.php">Sales Orders</a>
                    <a class="collapse-item" href="order_add_order.php">Add Order</a>
                  </div>
                </div>
          </li>

          <!-- Nav Item - Tables -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
              <i class="fas fa-fw fa-users"></i>
              <span>User Management</span></a>

              <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components:</h6>
                <a class="collapse-item" href="user_add_user.php">Add User</a>
                <a class="collapse-item" href="user_user_list.php">User List</a>
              </div>
            </div>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
        </ul>
        
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
      <script src="js/demo/chart-pie-demo.js"></script>
    </body>
</html>