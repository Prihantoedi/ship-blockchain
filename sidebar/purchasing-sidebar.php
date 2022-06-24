<?php 

	date_default_timezone_set("Asia/Jakarta");
	$current_time = date("d-m-Y H:i:s");

	$material_logistics_id = $_SESSION['id'];
	$current_url = $_SERVER['REQUEST_URI'];
	$getNotifData = getNotification($material_logistics_id, $current_url, $conn);

	$notif_data = $getNotifData["notif-data"];
	$notif_num_count = $getNotifData["notif-num-count"];
	
	$recent = $getNotifData["recent"];
	$older = $getNotifData["older"];

?>

<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.php">
			<span class="align-middle">Purchasing Admin</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Pages
			</li>

			<li class="<?php echo $sidebar_class["home"]; ?>">
				<a class="sidebar-link" href="index.php">
					<i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
				</a>
			</li>

			<li class="<?php echo $sidebar_class["all_transactions"]; ?>">
				<a class="sidebar-link" href="transactions.php">
					<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">All Transactions</span>
				</a>
			</li>

			<li class="<?php echo $sidebar_class["create_transaction"]; ?>">
				<a class="sidebar-link" href="create-transaction.php">
					<i class="align-middle" data-feather="file"></i> <span class="align-middle">Create Transaction</span>
				</a>
			</li>

			

			<li class="<?php echo $sidebar_class["notifications"]; ?>">
				<a class="sidebar-link" href="notifications.php">
					<i class="align-middle" data-feather="bell"></i> <span>Notifications</span> 
					<?php if($notif_num_count > 0) {?>
					<span id="notif-num"><?php echo $notif_num_count; ?></span>
					<?php }?>
				</a>
			</li>

			<li class="<?php echo $sidebar_class["validation"]; ?>">
				<a class="sidebar-link" href="validation.php">
					<i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Validation</span>
					<?php if($validate_num_count > 0){?>
						<span id="validate-num"><?php echo $validate_num_count; ?></span>
					<?php } ?>
				</a>
			</li>

		</ul>
	</div>
</nav>