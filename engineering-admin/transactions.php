<?php 
    session_start();
    require("../authorization.php");
	require("../connection.php");
    require("../function-center/encrypt-decrypt.php");
	require("../function-center/time-conversion.php");
    authorizationCheck("engineering-admin", $_SESSION);


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

            <?php include("../content-fraction/transaction-content.php"); ?>
		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>


</body>

</html>