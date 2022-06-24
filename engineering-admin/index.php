<?php 
    session_start();
    require("../authorization.php");
	require("../connection.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/time-conversion.php");
	require("../function-center/notification-function.php");
    authorizationCheck("engineering-admin", $_SESSION);
	
	require("../function-center/check-node.php");

	$transactions = decryption(False, $majority);
	
	$num_of_transaction = count($transactions) > 5 ? count($transactions) - 5 : 0;
	
	$slice_transaction = array_slice($transactions, $num_of_transaction);
	$slice_transaction = array_reverse($slice_transaction);
	
	$transaction_for_home = array();
	$count_block = count($transactions);
	foreach($slice_transaction as $slice){
		$encode_slice = json_encode($slice);
		$slice->hash = hash("sha256", $encode_slice);
		$slice->block_no = $count_block;
		array_push($transaction_for_home, $slice);
		$count_block--;
	}
	
	$sidebar_class = [
		"home" => "sidebar-item active", 
		"all_transactions" => "sidebar-item", 
		"create_transaction" => "sidebar-item", 
		"notifications" => "sidebar-item", 
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
		<?php include("../sidebar/engineering-sidebar.php"); ?>

		<div class="main">
			<?php include("../navigation/engineering-navigation.php"); ?>
			<?php include("../content-fraction/home-content.php"); ?>
		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>
</body>

</html>