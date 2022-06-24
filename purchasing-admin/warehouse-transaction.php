<?php 
    session_start();
	require("../authorization.php");
	require("../connection.php");
	require("../function-center/create-transaction-function.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/time-conversion.php");
	require("../function-center/notification-function.php");
	require("../function-center/validation-function.php");

	authorizationCheck("purchasing-admin", $_SESSION);
	require("../function-center/check-node.php");

	$purchasing_id = $_SESSION['id'];
	$submitted = 0;
	if(isset($_POST['submit'])){
		// die($_POST['pr-date']);
		require("../function-center/check-node.php");
		$submitted = 1;
		$pr_no = $_POST['pr-no'];
		$pr_date = $_POST['pr-date'];
		$po_no = $_POST['po-no'];
		$vendor_name = $_POST['vendor-name'];
		$vendor_code = $_POST['vendor-code'];
		$vendor_city = $_POST['vendor-city'];
		$f_item = $_POST['f-Item'];
		$item_description = $_POST['item-description'];
		$quantity = $_POST['quantity'];
		$unit = $_POST['unit'];
		$pr_status = $_POST['pr-status'];
		$price = $_POST['price'];

		$createTransaction = new createTransaction;
		$createTransaction->createTransPurchasing($pr_no, $pr_date, $po_no, $vendor_name, $vendor_code, $vendor_city, $f_item, $item_description, $quantity, $unit, $price, $pr_status, $purchasing_id, $majority, "material");
	}

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
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
	<!-- <link rel="shortcut icon" href="img/icons/icon-48x48.png" /> -->

	<!-- <link rel="canonical" href="https://demo-basic.adminkit.io/" /> -->

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

			<main class="content scrollable">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Warehouse Transaction</h1>

					
						<div class="row">
							<div class="col">
								<form action="">
									<div class="card flex-fill">
										<!-- <div class="card-header">
											<h5 class="card-title mb-0">Input Data</h5>
										</div> -->
		
										<div class="row">
											<div class="col">
												<!-- <div class="card"> -->
													<div class="card-header">
														<h5 class="card-title mb-0">No. GR</h5>
													</div>
													<div class="card-body">
														<input name = "no-gr"type="text" class="form-control">
													</div>
												<!-- </div> -->
	
												<!-- <div class="card"> -->
													<div class="card-header">
														<h5 class="card-title mb-0">F-Item</h5>
													</div>
													<div class="card-body">
														<input name="f-Item" type="text" class="form-control">
													</div>
												<!-- </div> -->

												<div class="card-header">
													<h5 class="card-title mb-0">Item Description</h5>
												</div>
												<div class="card-body">
													<input name="item-description" type="text" class="form-control">
												</div>

												<div class="card-header">
													<h5 class="card-title mb-0">Number of Item</h5>
												</div>

												<div class="card-body">
													<input name="num-of-item" type="text" class="form-control">
												</div>

												<div class="card-body">
													<a href="#" class="btn btn-primary">Send</a>
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