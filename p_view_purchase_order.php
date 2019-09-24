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
            <?php include 'p_sidebar.php' ?>
            
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg topbar mb-4 static-top shadow">
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">View Purchase Order Details</div>
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
                        <div class="d-flex" style="padding-top: 0;">
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
                                <?php
                                    if(isset($_POST['PONum']))
                                    {
                                        $PONum = $_POST['PONum'];
                                        $_SESSION['PONum'] = $PONum;


                                    }
                                        
                                   $viewOrder = "SELECT * FROM p_purchasingmanagement WHERE PONum = " . $_SESSION['PONum'];
                                    $result = $con->query($viewOrder);
                                    if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {   
                                ?>
                                <div class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">
                                    Sales Order Details
                                </div>
                                
                                <!--SO Details Form -->
                                    <div class="row">
                                        <div class="col-lg-5 mb-4" style="float: left;">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">PO Number:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['PONum']; 
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Supplier Name:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['SupplierName']
                                                        ?>
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
                                                            echo $row['Date']; 
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Address:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['Address']
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                   <div>
                                                       <label class="control-label">Status:</label>
                                                    </div>

                                                    <div class="input-group col-sm-6 m-bot15">
                                                        <?php
                                                            echo $row['Status']; 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        }
                                    } else {
                                        echo "0 results";
                                        } 
                                        ?>
                                        
                                    </div>
                            </div> 
                        
                        <!-- Table -->
                        
                            <div class="col-lg-12">
                                <form method="post" class="navbar-expand col-lg-12">
                                <header class="card-header font-weight-bold" style="border-bottom:  .10rem solid #b4c540;">Product Order</header>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="padding-top: 0;">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>Product Code</th>
                                          <th>Category</th>
                                          <th>Brand</th>
                                          <th>Description</th>
                                          <th>Size</th>
                                          <th>Quantity Ordered</th>
                                          <th>Quantity Received</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                              $viewDetails = "SELECT * FROM p_podetails WHERE PONum = " . $_SESSION['PONum'];
                                                $result2 = $con->query($viewDetails);
                                                if ($result2->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result2->fetch_assoc()) {
                                                    echo "<form method = 'post' action = '' >";
                                                    echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['ReceivedQuantity'] . "</td><td>" . $row['status'] .   "</td></tr>\n";
                                                    }
                                                    echo "</form>";
                                                } 
                                                else {
                                                    echo "0 results";
                                                    } 
                                            
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </form>
                            
                            <form method="post"> 
                                <div class="d-flex" style=" margin-top: 10px;">
                                    <div style="width: 70%; float: left;"></div>
                                    <div class="d-flex" style="width: 30%; float: right;">
                                        <!-- Update Button-->
                                        <div style="width: 60%; float: left;">
                                            <button type = 'submit' name = 'update' class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 100px;float: left; margin-right: 10px;"> Update </button>
                                        </div>

                                        <!-- Cancel Button-->
                                        <div style="width: 80%; float: right;">
                                            <button type = 'submit' name = 'cancel' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px;float: left; margin-right: 10px;"> Cancel </button>
                                        </div>

                                        <!-- Back Button-->
                                        <div style="width: 80%; float: right;">
                                            <button type = 'submit' name = 'back' formaction =  'p_purchase_purchase_history.php' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="width: 100px; float: right;"> Back </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php 
                        if(isset($_POST['cancel']))
                        { ?>
                            <form method = 'post'>
                            <div class="row d-flex" style="margin-top: 10px;">
                               <div>
                                   <label class="control-label">Product Code:</label>
                                </div>
                                <div class="input-group col-sm-4 m-bot15">
                                    <input type = 'text' name = 'prodcode' placeholder = 'Search by product code' class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" input type = 'submit' name = 'cancelsearch'>
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        }

                        else if(isset($_POST['update']))
                        { ?>
                        <form method = 'post'>
                            <div class="row d-flex" style="margin-top: 10px;">
                               <div>
                                   <label class="control-label">Product Code:</label>
                                </div>
                                <div class="input-group col-sm-4 m-bot15">
                                    <input type = 'text' name = 'prodcode' placeholder = 'Search by product code' class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" input type = 'submit' name = 'updatesearch'>
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                            
                        <?php
                        }

                        if(isset($_POST['updatesearch']) && ($_POST['prodcode']) )
                        {
                            $valueToSearch = $_POST['prodcode'];
                            $_SESSION['searchvalue']= $valueToSearch;    
                            $query = "SELECT * FROM p_podetails WHERE ProductCode = $valueToSearch AND PONum ="  . $_SESSION['PONum'];
                            $search_result = $con->query($query);
                            
                        if ($search_result->num_rows > 0) {
                            while($row = $search_result->fetch_assoc()) {
                                $prodcode= $row['ProductCode'];
                                $category = $row['Category'];
                                $brand= $row['Brand'];
                                $proddesc= $row['ProductDesc'];
                                $size= $row['Size'];
                                $quantity= $row['Quantity'];
                                $_SESSION['prodcode'] = $prodcode;
                                $_SESSION['category'] = $category;
                                $_SESSION['brand'] = $brand;
                                $_SESSION['proddesc'] = $proddesc;
                                $_SESSION['size'] = $size;
                                $_SESSION['quantity'] = $quantity; 
                        ?>
                               
                        <form method = "post" action = "" style="margin-top: 70px; border-top:  .10rem solid #b4c540;">
                            <div class="row">
                                <div class="col-lg-5 mb-4" style="float: left;">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Product Code:</label>
                                            </div>

                                            <div name="prodcode" class="input-group col-sm-6 m-bot15">
                                                <?php
                                                   echo $_SESSION['prodcode']; 
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Category:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['category'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 mb-4" style="float: right;">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Brand:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php
                                                    echo $_SESSION['brand'];
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Description:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['proddesc'];
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Size:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['size'];
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Quantity Purchased:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['quantity'];
                                                ?>
                                            </div>
                                        </div>

                                         <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Quantity Received:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <input type = 'number' name = 'quantityReceived' class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Proceed Button-->
                            <div class="d-flex" style=" margin-top: 10px;">
                                <div style="width: 80%; float: left;"></div>
                                <div style="width: 20%;">
                                  <button type = 'submit' name = 'submit'  value = 'submit' formaction = 'p_processUpdate.php' class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 100px;float: left;"> Submit </button>
                                  <button type = 'submit' name = 'undoupdate'  value = 'back' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px;float: right;"> Back </button>
                                </div>
                            </div>
                        </form>
                        
                        <?php
                            }

                            }
                            else if (isset($_POST['updatesearch']) &&($search_result->num_rows == 0)){
                                echo '<script language="javascript">';
                                echo 'alert("Invalid Search Parameter. Please Try Again")';
                                echo '</script>';
                            }
                            }

                            else if  (isset($_POST['updatesearch']) && empty($_POST['prodcode']))
                            {
                                $alert = "Please fill up empty fields.";
                                echo '<script type="text/javascript">';
                                echo 'alert("'.$alert.'")';
                                echo '</script>';  
                            }
                        
                        if(isset($_POST['cancelsearch']) && ($_POST['prodcode']) )
{
    $valueToSearch = $_POST['prodcode'];
    $_SESSION['searchvalue']= $valueToSearch;    
    $query = "SELECT * FROM p_podetails WHERE ProductCode = $valueToSearch AND PONum ="  . $_SESSION['PONum'];
    $search_result = $con->query($query);



if ($search_result->num_rows > 0) {
while($row = $search_result->fetch_assoc()) {
    $prodcode= $row['ProductCode'];
    $category = $row['Category'];
    $brand= $row['Brand'];
    $proddesc= $row['ProductDesc'];
    $size= $row['Size'];
    $quantity= $row['Quantity'];
    $_SESSION['prodcode'] = $prodcode;
    $_SESSION['category'] = $category;
    $_SESSION['brand'] = $brand;
    $_SESSION['proddesc'] = $proddesc;
    $_SESSION['size'] = $size;
    $_SESSION['quantity'] = $quantity; ?>
       
    <form method = "post" action = "" style="margin-top: 70px; border-top:  .10rem solid #b4c540;">
                            <div class="row">
                                <div class="col-lg-5 mb-4" style="float: left;">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Product Code:</label>
                                            </div>

                                            <div name="prodcode" class="input-group col-sm-6 m-bot15">
                                                <?php
                                                   echo $_SESSION['prodcode']; 
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Category:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['category'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 mb-4" style="float: right;">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Brand:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php
                                                    echo $_SESSION['brand'];
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Description:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['proddesc'];
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Size:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['size'];
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Quantity Purchased:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php 
                                                    echo $_SESSION['quantity'];
                                                ?>
                                            </div>
                                        </div>

                                         <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                           <div>
                                               <label class="control-label">Reason:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <select name='reason'>
                                                    <option> ------- </option>
                                                    <option> Shipment Timeframe </option>
                                                    <option> Product Unavailability </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Proceed Button-->
                            <div class="d-flex" style=" margin-top: 10px;">
                                <div style="width: 80%; float: left;"></div>
                                <div style="width: 20%;">
                                  <button type = 'submit' name = 'submit'  value = 'submit' formaction = 'p_processcancel.php' class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="width: 100px;float: left;"> Submit </button>
                                  <button type = 'submit' name = 'undocancel'  value = 'back' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" style="width: 100px;float: right;"> Back </button>
                                </div>
                            </div>
                        </form>
                        
<?php
}

}
else if (isset($_POST['cancelsearch']) &&($search_result->num_rows == 0)){
    echo '<script language="javascript">';
    echo 'alert("Invalid Search Parameter. Please Try Again")';
    echo '</script>';
}
}

else if  (isset($_POST['cancelsearch']) && empty($_POST['prodcode']))
{
    $alert = "Please fill up empty fields.";
    echo '<script type="text/javascript">';
    echo 'alert("'.$alert.'")';
    echo '</script>';  
}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>