<?php 
    session_start();
	require("../authorization.php");
	require("../connection.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/time-conversion.php");
	require("../function-center/notification-function.php");
	require("../function-center/validation-function.php");

	authorizationCheck("purchasing-admin", $_SESSION);
	require("../function-center/check-node.php");

	$purchasing_id = $_SESSION['id'];

	$getPendingValidation = pendingValidation($purchasing_id, $conn);
    $need_validation = $getPendingValidation["need-validation"];
    $validate_num_count = $getPendingValidation["validate-num-count"];

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
	
	<title>Galangan Kapal | Purchasing Admin</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/optional.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<?php include("../sidebar/purchasing-sidebar.php"); ?>

		<div class="main">
			<?php include("../navigation/purchasing-navigation.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Start Transaction</h1>


					<div class="row">
						<div class="col">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Choose Transaction Recipient</h5>
								</div>

                                <div class="card-body">
									<a href="warehouse-transaction.php" class="btn btn-primary">Warehouse</a>
								</div>

                                <div class="card-body">
									<a href="material-logistics-transaction.php" class="btn btn-success">Material & Logistics</a>
								</div>
								
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