<?php 
    session_start();
	require("../authorization.php");
    authorizationCheck("material-logistics-admin", $_SESSION);
	$sidebar_class = [
		"home" => "sidebar-item", 
		"all_transactions" => "sidebar-item", 
		"create_transaction" => "sidebar-item active", 
		"notifications" => "sidebar-item", 
		"validation" => "sidebar-item"
	];

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Galangan Kapal | Material & Logistics Admin</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/optional.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<?php include("../sidebar/material-logistics-sidebar.php"); ?>	

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
				
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

			  <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                Material & Logistics Admin
              </a>
							<div class="dropdown-menu dropdown-menu-end">

								<a class="dropdown-item" href="#">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content scrollable">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Purchasing Transaction</h1>

					
						<div class="row">
							<div class="col">
								<form action="">
									<div class="card flex-fill">
		
										<div class="row">
											<div class="col">

                                                <div class="card-body">
                                                    <label for="">PO No.</label>
                                                    <input name = "po-no"type="text" class="form-control">
                                                </div>
                                                
                                                <div class="card-body">
                                                    <label for="">Project Code</label>
                                                    <input name="f-Item" type="text" class="form-control">
                                                </div>

												<div class="card-body">
                                                    <label for="">Vendor Name</label>
                                                    <input name="vendor-name" type="text" class="form-control">
                                                </div>

												<div class="card-body">
                                                    <label for="">Vendor Code</label>
                                                    <input name="vendor-code" type="text" class="form-control">
                                                </div>

												<div class="card-body">
                                                    <label for="">Vendor City</label>
                                                    <input name="vendor-city" type="text" class="form-control">
                                                </div>
												<!-- <div class="card"> -->

													<div class="card-body">
                                                        <label for="">F-Item</label>
														<input name="f-Item" type="text" class="form-control">
													</div>
												<!-- </div> -->
												<div class="card-body">
                                                    <label for="">Item Description</label>
													<input name="item-description" type="text" class="form-control">
												</div>

                                                <div class="card-body">
                                                    <label for="">Quantity</label>
													<input name="quantity" type="text" class="form-control">
												</div>

                                                <div class="card-body">
                                                    <label for="">Unit</label>
													<input name="quantity" type="text" class="form-control">
												</div>

												<div class="card-body">
													<a type="button" href="#" class="btn btn-primary">Send</a>
												</div>
												
											</div>
										</div>
										
									</div>

								</form>
								
						</div>

					

				</div>
			</main>

		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>


</body>

</html>