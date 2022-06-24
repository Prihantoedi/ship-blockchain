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

    
    $all_transactions = array();
    $count_block = 1;
    foreach($transactions as $tr){
        $encode_tr = json_encode($tr);
        $tr->hash = hash("sha256", $encode_tr);
        $tr->block_no = $count_block;
        array_push($all_transactions, $tr);
        $count_block++;
    }

    $all_transactions = array_reverse($all_transactions);

	$sidebar_class = [
		"home" => "sidebar-item", 
		"all_transactions" => "sidebar-item active", 
		"create_transaction" => "sidebar-item", 
		"notifications" => "sidebar-item", 
		"validation" => "sidebar-item"
	];

	$material_logistics_id = $_SESSION['id'];

    $getPendingValidation = pendingValidation($material_logistics_id, $conn);
    $need_validation = $getPendingValidation["need-validation"];
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

			<?php include("../content-fraction/transaction-content.php"); ?>

		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>


</body>

</html>