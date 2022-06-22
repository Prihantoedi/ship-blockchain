<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.php">
			<span class="align-middle">Material & Logistics Admin</span>
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
					<i class="align-middle" data-feather="bell"></i> <span>Notifications</span> <span id="notif-num">2</span>
				</a>
			</li>

			<li class="<?php echo $sidebar_status["validation"]; ?>">
				<a class="sidebar-link" href="validation.php">
					<i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Validation</span> <span id="validate-num">2</span>
				</a>
			</li>

		</ul>
	</div>
</nav>