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
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        
        <style>
            body{
                background-color: #f0f3e1;
            }
            .bg{
                background-color: #b4c540;
            }
            
            *, *:before, *:after {
              -webkit-box-sizing: border-box;
              -moz-box-sizing: border-box;
              box-sizing: border-box;
              margin: 0;
              padding: 0;
            }

            /* Buttons styles */
            input::-moz-focus-inner,
            button::-moz-focus-inner {
                border: 0;
                padding: 0;
            }

            input[type="submit"].btn,
            button.btn {
                cursor: pointer;
            }

            a.pos-btn,.pos-btn {
                display: inline-block;
                outline: none;
                *zoom: 1;
                text-align: center;
                text-decoration: none;
                font-family: inherit;
                font-weight: 300;
                letter-spacing: 1px;
                vertical-align: middle;
                border: 1px solid;
                transition: all 0.2s ease;
                box-sizing: border-box;
                text-shadow: 0 1px 0 rgba(0,0,0,0.01);
                margin: auto;
                margin-bottom: 10px;
                width: 40%;
                height: 60px;
            }

            .pos-btn-medium {
                font-size: 0.9375em;
                padding: 0.5375em 1.375em;
            }

            /* Colors */
            .pos-btn-green {
                color: #3CB371;
                border-color: #3CB371;
            }
            .pos-btn-green:hover {
              background: #3CB371;
              color: #fff;
              border-color: #3CB371;
              text-decoration: none;
            }
            .pos-btn-blue {
                color: #4682B4;
                border-color: #4682B4;
            }
            .pos-btn-blue:hover {
              background: #4682B4;
              color: #fff;
              border-color: #4682B4;
              text-decoration: none;
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
                    <nav class="navbar navbar-expand navbar-light mb-4 bg topbar static-top shadow">
                        <div class="sidebar-brand-text mx-3" style="color:white; font-size: 30px;">POS System</div>
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
                    
                    <!--DateTime 
                    <div class="container-fluid" style="padding-top: 0;">
                        <div class="d-flex" style="padding-top: 0; border-bottom:  .10rem solid #b4c540;">
                            <div class="container-fluid" style="width: 50%"></div>
                            <div style="float: right;">
                                <p class="text-gray-800">
                                <?php echo(strftime("Today | %B %d, %Y | %A")); ?></p>
                            </div> 
                        </div>
                    </div>-->

                    <div class="container-fluid">
                        <div class="row">
                            <div class="card col-lg-8 shadow mb-4">
                                <div class="card-body">
                                    <!-- POS Details -->
                                    <div class="row">
                                        <div class="col-lg-7 mb-4" style="float: left;">
                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                <div>
                                                    <label class="control-label">SO Number:</label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <?php

                                                    ?>
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                <div>
                                                    <label class="control-label">Invoice Number:</label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <?php

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 mb-4" style="float: right;">
                                            <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                                <div>
                                                    <label class="control-label">Customer Name:</label>
                                                </div>

                                                <div class="input-group col-sm-6 m-bot15">
                                                    <?php

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Product Table -->
                                    <div class="table-responsive">
                                        <form method = "post" action = "">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                              <thead>
                                                <tr>
                                                  <th>Product Code</th>
                                                  <th>Product Description</th>
                                                  <th>Size</th>
                                                  <th>Quantity</th>
                                                  <th>Price</th>
                                                  <th>Total Amount</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  <!-- INSERT PHP -->
                                              </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- POS Sidebar -->
                            <div class="card shadow col-lg-4 mb-4">
                                <div class="card-body">
                                    <!-- POS Buttons -->
                                    <div class="row">
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Void <br> Sale</a>
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Void <br> Product</a>
                                    </div>
                                    <div class="row">
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Search <br> Product</a>
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Discount <br> Sale </a>
                                    </div>
                                    <div class="row">
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Change <br> Quantity</a>
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Customer <br> Details </a>
                                    </div>
                                    <div class="row">
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Cash <br> Payment</a>
                                        <a class="pos-btn pos-btn-medium pos-btn-blue" href="#">Cheque <br> Payment</a>
                                    </div>
                                    
                                    <!-- POS Lower Content -->
                                    <div class="col-lg-7 mb-4" style="float: left;">
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                            <div>
                                                <label class="control-label">Total Items:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php

                                                ?>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                            <div>
                                                <label class="control-label">Subtotal:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php

                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                            <div>
                                                <label class="control-label">12% VAT:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php

                                                ?>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                            <div>
                                                <label class="control-label">TOTAL:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php

                                                ?>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                            <div>
                                                <label class="control-label">Amount Received:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php

                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row d-flex justify-content-between" style="margin-top: 10px;">
                                            <div>
                                                <label class="control-label">Change:</label>
                                            </div>

                                            <div class="input-group col-sm-6 m-bot15">
                                                <?php

                                                ?>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        
                                        <div class="d-flex justify-content-between" style="margin-left: 50%">
                                            <div style="width: 80%;">
                                                <button name="" value="" formaction="" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="margin-left: 30px; width: 100px;"> Done </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                
            </div>
        </div>
    </body>
</html>
