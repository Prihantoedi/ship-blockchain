<?php 
    session_start();
	require("../authorization.php");
    require("../connection.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/notification-function.php");
	require("../function-center/validation-function.php");
	require("../function-center/time-conversion.php");

    authorizationCheck("material-logistics-admin", $_SESSION);

    require("../function-center/check-node.php");
	$transactions = decryption(False, $majority);

	$block_no = $_GET["block"];
	$block_info = $transactions[(int)$block_no - 1];
	$encode_block_info = json_encode($block_info);
	$block_info->hash = hash("sha256", $encode_block_info);
	$block_info->block_no = $block_no;

	$sidebar_class = [
		"home" => "sidebar-item", 
		"all_transactions" => "sidebar-item active", 
		"create_transaction" => "sidebar-item", 
		"notifications" => "sidebar-item", 
		"validation" => "sidebar-item"
	];

	$material_logistics_id = $_SESSION['id'];

    $getPendingValidation = pendingValidation($material_logistics_id, $conn);
    $validate_num_count = $getPendingValidation["validate-num-count"];

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
			<?php include("../navigation/material-logistics-navigation.php"); ?>

			<?php include("../content-fraction/transaction-detail-content.php"); ?>

		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>


</body>

</html>