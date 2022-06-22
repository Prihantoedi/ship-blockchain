<?php 
    session_start();
    require("../authorization.php");
	require("../connection.php");
	require("../function-center/create-transaction-function.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/time-conversion.php");
    authorizationCheck("engineering-admin", $_SESSION);

	$sidebar_class = [
		"home" => "sidebar-item", 
		"all_transactions" => "sidebar-item", 
		"create_transaction" => "sidebar-item", 
		"notifications" => "sidebar-item active", 
	];
	
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Galangan Kapal | Engineering Admin</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/optional.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<?php 
			include("../sidebar/engineering-sidebar.php"); 	

			// UPDATE ALL NOTIFICATION STATUS TO FALSE

			$query_notification_status = "UPDATE transit_data SET notification_status = FALSE WHERE user_id = $engineering_id"; 
			$update_notification_status = mysqli_query($conn, $query_notification_status);

		?>

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
                Engineering Admin
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

					<h1 class="h3 mb-3"><strong>Notifications</strong></h1>


					<div class="row">
						<div class="col">

							<!-- Bila tidak ada notifikasi -->
							<?php if(count($notif_data) <= 0){?>
							<div class="card flex-fill mt-2">
                                <div class="card-body">
                                  <span style="font-weight: bold;">You have no notification</span>
                                </div>

							</div>
							<?php } else{ ?> 
								<!-- Bila ada notifikasi -->
								<?php if(count($recent) > 0){ ?>
									<div class="card flex-fill mt-2">
										<div class="card-header">
											<h5 class="card-title mb-0">Recent</h5>
										</div>
										<?php foreach($recent as $r){ ?>
												<div class="card-body">
													<?php if($r->validation_status == "valid") {?>
													<i class="align-middle text-success" data-feather="check-circle"></i> <span class="align-middle"> Close : Material & Logistics validate your transaction with Project Name "<?php echo $r->project_name; ?>"</span>
													<?php } else {?>
														<i class="align-middle text-danger" data-feather="x-circle"></i> <span class="align-middle"> Reject : Material & Logistics reject your transaction with Project Name "<?php echo $r->project_name; ?>"</span>	
													<?php }?>
												</div>
										<?php 
												}		
									}
								?>
								</div>
								<?php if(count($older) > 0){?>
									<div class="card flex-fill mt-2">
										<div class="card-header">
											<h5 class="card-title mb-0">Older</h5>
										</div>
										<?php foreach($older as $o){?>
												<div class="card-body">
													<?php if($o->validation_status == "valid") {?>
													<i class="align-middle text-success" data-feather="check-circle"></i> <span class="align-middle"> Close : Material & Logistics validate your transaction with Project Name "<?php echo $o->project_name; ?>"</span>
													<?php } else {?>
														<i class="align-middle text-danger" data-feather="x-circle"></i> <span class="align-middle"> Reject : Material & Logistics reject your transaction with Project Name "<?php echo $o->project_name; ?>"</span>	
													<?php }?>
												</div>
											
										<?php 

											}
										} 
								?>
									</div>
							
							<?php 
								}
							?>

                            
                        </div>
					</div>

				</div>
			</main>

		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>

</body>

</html>