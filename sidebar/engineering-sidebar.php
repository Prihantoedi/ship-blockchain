<?php 

	date_default_timezone_set("Asia/Jakarta");
	$current_time = date("d-m-Y H:i:s");

	$engineering_id = $_SESSION['id'];

	$query_transit = "SELECT * FROM transit_data WHERE user_id = $engineering_id";

	$transit = mysqli_query($conn, $query_transit);
	$notif_num_count = 0;

	$notif_data = array();

	while($row = mysqli_fetch_assoc($transit)){
		if($row["validation_status"] == "valid" || $row["validation_status"] == "reject"){
			$decrypt_decode = decryption(FALSE, $row["data"]);
			$decrypt_decode->validation_status = "valid";
		
			$submission_time = microtimeToDate($decrypt_decode->submission_time);
			
			$submission = date_create($submission_time);
			$current = date_create($current_time);

			$day_diff = $current->diff($submission)->days;
			
			$decrypt_decode->group = $day_diff <= 2 ? "recent" : "older";
			
			$decrypt_decode->validation_status = $row["validation_status"] == "valid" ? "valid" : "reject";		

			array_push($notif_data, $decrypt_decode);
			
			if($row["notification_status"] == TRUE){
				$notif_num_count++;
			}
		}
		
	}

	$current_url = $_SERVER['REQUEST_URI'];
	$notif_num_count = $current_url == "/ship-block/engineering-admin/notifications.php" ? 0 : $notif_num_count;

	$recent = array();
	$older = array();

	foreach($notif_data as $notif){
		$notif->group == "recent" ? array_push($recent, $notif) : array_push($older, $notif);
	}

	$recent = array_reverse($recent);
	$older = array_reverse($older);

?>

<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.php">
			<span class="align-middle">Engineering Admin</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Pages
			</li>

			<li class="<?php echo $sidebar_status["home"]; ?>">
				<a class="sidebar-link" href="index.php">
					<i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
				</a>
			</li>

			<li class="<?php echo $sidebar_status["all_transactions"]; ?>">
				<a class="sidebar-link" href="transactions.php">
					<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">All Transactions</span>
				</a>
			</li>

			<li class="<?php echo $sidebar_status["create_transaction"]; ?>">
				<a class="sidebar-link" href="create-transaction.php">
					<i class="align-middle" data-feather="file"></i> <span class="align-middle">Create Transaction</span>
				</a>
			</li>

			

			<li class="<?php echo $sidebar_status["notifications"]; ?>">
				<a class="sidebar-link" href="notifications.php">
					<i class="align-middle" data-feather="bell"></i> <span>Notifications</span> 
					<?php if($notif_num_count > 0) {?>
					<span id="notif-num"><?php echo $notif_num_count; ?></span>
					<?php }?>
			
				</a>
			</li>


		</ul>
	</div>
</nav>