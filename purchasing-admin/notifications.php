<?php 
    session_start();
	require("../authorization.php");
	require("../connection.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/time-conversion.php");
	require("../function-center/notification-function.php");
	require("../function-center/validation-function.php");

    authorizationCheck("purchasing-admin", $_SESSION);
	$sidebar_class = [
		"home" => "sidebar-item", 
		"all_transactions" => "sidebar-item", 
		"create_transaction" => "sidebar-item", 
		"notifications" => "sidebar-item active", 
		"validation" => "sidebar-item"
	];

	$purchasing_id = $_SESSION['id'];

    $getPendingValidation = pendingValidation($purchasing_id, $conn);
    $validate_num_count = $getPendingValidation["validate-num-count"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Galangan Kapal | Purchasing Admin</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/optional.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<?php include("../sidebar/purchasing-sidebar.php"); ?>

		<div class="main">
			<?php 
				include("../navigation/purchasing-navigation.php"); 
				$query_notification_status = "UPDATE transit_data SET notification_status = FALSE WHERE user_id = $purchasing_id"; 
				$update_notification_status = mysqli_query($conn, $query_notification_status);
			?>

			<main class="content scrollable">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Notifications</strong></h1>


					<div class="row">
						<div class="col">
							<!-- Bila tidak ada notifikasi -->
							<?php if($notif_data <= 0) {?>
								<div class="card flex-fill mt-2">
									<div class="card-body">
									<span style="font-weight: bold;">You have no notification</span>
									</div>
								</div>

							<?php } else{?>
								<!-- Bila ada notifikasi -->

								<?php if(count($recent) > 0){?>
									<div class="card flex-fill mt-2">
										<div class="card-header">
											<h5 class="card-title mb-0">Recent</h5>
										</div>

										<?php foreach($recent as $r){ 
											if($r->recipient === "material & logistics"){
												if($r->validation_status === "Valid"){
										?>
													<div class="card-body">
														<i class="align-middle text-success" data-feather="check-circle"></i> <span class="align-middle"> <?php echo ucfirst($r->pr_status); ?> : Material & Logistics validate your transaction with PR No. <?php echo $r->pr_no; ?></span>
													</div>
												<?php } else{?>
													<div class="card-body">
														<i class="align-middle text-danger" data-feather="x-circle"></i> <span class="align-middle"> Reject : Material & Logistics reject your transaction with PR No. <?php echo $r->pr_no; ?></span>
													</div>
											<?php } 
												} else {
													if($r->validation_status === "Valid"){	
												?>
													<div class="card-body">
														<i class="align-middle text-success" data-feather="check-circle"></i> <span class="align-middle"> <?php echo ucfirst($r->gr_status); ?> : Warehouse validate your transaction with GR No. <?php echo $r->gr_no; ?></span>
													</div>
												<?php } else{?>
														<div class="card-body">
															<i class="align-middle text-danger" data-feather="x-circle"></i> <span class="align-middle"> Reject : Warehouse reject your transaction with GR No. <?php echo $r->gr_no; ?></span>
														</div>
													<?php 
														}
													}
											}
										?>
									</div>
								<?php } 
								
									if(count($older) > 0) {?>
										<div class="card flex-fill mt-2">
										<div class="card-header">
											<h5 class="card-title mb-0">Older</h5>
										</div>

										<?php foreach($older as $o){ 
											
											if($o->recipient === "material & logistics"){
												if($o->validation_status === "Valid"){
										?>
													<div class="card-body">
														<i class="align-middle text-success" data-feather="check-circle"></i> <span class="align-middle"> <?php echo ucfirst($o->pr_status); ?> : Material & Logistics validate your transaction with PR No. <?php echo $o->pr_no; ?></span>
													</div>
												<?php } else{?>
													<div class="card-body">
														<i class="align-middle text-danger" data-feather="x-circle"></i> <span class="align-middle"> Reject : Material & Logistics reject your transaction with PR No. <?php echo $o->pr_no; ?></span>
													</div>
											<?php } 
												} else {
													if($o->validation_status === "Valid"){	
												?>
													<div class="card-body">
														<i class="align-middle text-success" data-feather="check-circle"></i> <span class="align-middle"> <?php echo ucfirst($o->gr_status); ?> : Warehouse validate your transaction with GR No. <?php echo $o->gr_no; ?></span>
													</div>
												<?php } else{?>
														<div class="card-body">
															<i class="align-middle text-danger" data-feather="x-circle"></i> <span class="align-middle"> Reject : Warehouse reject your transaction with GR No. <?php echo $o->gr_no; ?></span>
														</div>
													<?php 
														}
													}
											}
										?>
									</div>
								<?php }?>
							
							<?php }?>
                            
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