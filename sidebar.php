<?php ob_start(); 

$userType = $_SESSION["userType"];
$firstName = $_SESSION["firstName"];
$lastName = $_SESSION["lastName"];

?>
<html>
    <head>
        <title>Lunatech Systems</title>
          <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
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

              <!-- Sidebar - Name and icon -->
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $firstName?> <?php echo $lastName?></div> <!-- shar please fix this -->

              </a>
                <a class="sidebar-heading">
                <div class="d-flex align-items-center justify-content-center" style="color:white; font-size: 15px"><?php echo $userType ?></div></a>

              <!-- Divider -->
              <hr class="sidebar-divider my-0">

            <!-- Nav Item - Inventory Management Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInv" aria-expanded="true" aria-controls="collapseInv">
                  <i class="fas fa-fw fa-archive"></i>
                  <span>Inventory Management</span>
                </a>
                <div id="collapseInv" class="collapse" aria-labelledby="headingInv" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                  <?php if($userType == "Manager"){?>
                    <a class="collapse-item" href="inventory_dashboard.php">Dashboard</a>
                    <a class="collapse-item" href="inventory.php">Inventory List</a>
                    <a class="collapse-item" href="inventory_add_product.php">Add Product</a>
                    <a class="collapse-item" href="inventory_remove_product.php">Remove Product</a>
                    <a class="collapse-item" href="inventory_inventory_report.php">Inventory Report</a>

                  <?php } else if ($userType == "Assistant Manager" or $userType == "Sales" or $userType == "Purchasing"){ ?>
                    <a class="collapse-item" href="inventory_dashboard.php">Dashboard</a>
                    <a class="collapse-item" href="inventory.php">Inventory List</a>
                  <?php } ?>
                  </div>
                </div>
          </li>

          <!-- Nav Item - Sales Management Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-fw fa-tags"></i>
              <span>Sales Management</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <?php if($userType == "Manager"){?>
                <a class="collapse-item" href="sales_dashboard.php">Dashboard</a>
                <a class="collapse-item" href="sales_sales_list.php">Sales List</a>
                <a class="collapse-item" href="sales_pending_cheques.php">Manage Pending Cheques</a>

                <a class="collapse-item" href="sales_sales_report.php">Sales Report</a>

                <?php } else if ($userType == "Assistant Manager" or $userType == "Sales" or $userType == "Purchasing"){ ?>
                  <a class="collapse-item" href="sales_dashboard.php">Dashboard</a>
                  <a class="collapse-item" href="sales_sales_list.php">Sales List</a>
                  <a class="collapse-item" href="sales_pending_cheques.php">Manage Pending Cheques</a>

                <?php } ?>
              </div>
            </div>
          </li>

          <?php if ($userType == "Manager" or $userType == "Assistant Manager" or $userType == "Purchasing"){?>

          <!-- Nav Item - Purchase Management Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-shopping-cart"></i>
              <span>Purchase Management</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="purchasing_dashboard.php">Dashboard</a>
                <a class="collapse-item" href="purchase_purchase_cart.php">Purchasing Cart</a>
                <a class="collapse-item" href="purchase_add_purchase_order.php">Add Purchase Order</a>
                <a class="collapse-item" href="purchase_purchase_history.php">Purchase Orders</a>
                <a class="collapse-item" href="purchase_pending_pos.php">Manage Purchase Orders</a>
              </div>
            </div>
          </li>
          <?php } ?>

          <!-- Nav Item - Order Management Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
              <i class="fas fa-fw fa-check-square"></i>
              <span>Order Management</span></a>

                  <div id="collapseOrder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                  <?php if($userType == "Manager" or $userType == "Sales" ){?>
                    <a class="collapse-item" href="order_dashboard.php">Dashboard</a>
                    <a class="collapse-item" href="order_sales_orders.php">Sales Orders</a>
                    <a class="collapse-item" href="order_pending_sos.php">Manage Sales Orders</a>
                    <a class="collapse-item" href="order_add_order.php">Add Order</a>
                    <?php } else if ($userType == "Assistant Manager" or $userType == "Sales" or $userType == "Purchasing"){ ?>
                    <a class="collapse-item" href="order_dashboard.php">Dashboard</a>
                    <a class="collapse-item" href="order_sales_orders.php">Sales Orders</a>
                    <a class="collapse-item" href="order_add_order.php">Add Order</a>
                    <?php } ?>
                  </div>
                </div>
          </li>

          <!-- Nav Item - User Management Collapse Menu -->
          <?php if($userType == "Manager"){?>

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
              <i class="fas fa-fw fa-users"></i>
              <span>User Management</span></a>

              <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="user_add_user.php">Add User</a>
                <a class="collapse-item" href="user_user_list.php">User List</a>
              </div>
            </div>
          </li>

          <?php } ?>

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
    </body>
</html>