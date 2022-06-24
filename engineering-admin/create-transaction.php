<?php 
    session_start();
    require("../authorization.php");
	require("../connection.php");
	require("../function-center/create-transaction-function.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/notification-function.php");
	require("../function-center/time-conversion.php");
    authorizationCheck("engineering-admin", $_SESSION);

	$sidebar_class = [
		"home" => "sidebar-item", 
		"all_transactions" => "sidebar-item", 
		"create_transaction" => "sidebar-item active", 
		"notifications" => "sidebar-item", 
	];

	if(isset($_POST['submit'])){
		
		$createTransaction = new createTransaction;
		$createTransaction->createTransEngineering($_POST['pr-name'], $_POST['pr-code'], $_SESSION['id']);
		$project_code = $_POST['pr-code'];
	}

	
	// $now = DateTime::createFromFormat('U.u', $time)->setTimezone((new \DateTimezone('Asia/Jakarta')))->format("m-d-Y H:i:s"); // konversi dari microtime ke tanggal lokal
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Galangan Kapal | Engineering Admin</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/optional.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

		<?php 
			if(isset($_POST['submit'])){

		?>
		<button id="trigger-modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal" hidden="hidden">
			Modal
		</button>

		<!-- Modal -->
		<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 style="font-weight:bold;" class="modal-title" id="transactionModalLabel">Transaction Sent</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Transaction with the project code <b><?php echo $project_code ?></b> has been sent to the Material and Logistics division, please wait for confirmation.  
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<?php }?>

	<div class="wrapper">
		<?php include("../sidebar/engineering-sidebar.php"); ?>

		<div class="main">
			<?php include("../navigation/engineering-navigation.php"); ?>

			<main class="content scrollable">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Material & Logistics Transaction</h1>

					
						<div class="row">
							<div class="col">
								<form method= "post" action="">
									<div class="card flex-fill">
		
										<div class="row">
											<div class="col">
												
												<div class="card-body">
													<label for="">Project Name</label>
													<input name = "pr-name"type="text" class="form-control">
												</div>

                                                <div class="card-body">
                                                    <label for="">Project Code</label>
                                                    <input name = "pr-code"type="text" class="form-control">
                                                </div>
	
												
												<div class="card-body">
													<button type="submit" name="submit"  class="btn btn-primary">Send</button>
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
	<script>
		var triggerModalBtn = document.getElementById("trigger-modal");
		triggerModalBtn.click();
	</script>

</body>

</html>