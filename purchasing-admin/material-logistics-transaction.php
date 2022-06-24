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
		$pr_status = $_POST['pr-status'];
		$pr_date = isset($_POST['pr-date']) ? $_POST['pr-date'] : "" ;
		$po_no = isset($_POST['po-no']) ? $_POST['po-no'] : "";
		$vendor_name = isset($_POST['vendor-name']) ? $_POST['vendor-name'] : "";
		$vendor_code = isset($_POST['vendor-code']) ? $_POST['vendor-code'] : "";
		$vendor_city = isset($_POST['vendor-city']) ? $_POST['vendor-city'] : "";
		$f_item = isset($_POST['f-Item']) ? $_POST['f-Item'] : "";
		$item_description = isset($_POST['item-description']) ? $_POST['item-description'] : "";
		$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
		$unit = isset($_POST['unit']) ? $_POST['unit'] : "";
		
		$price = isset($_POST['price']) ? $_POST['price'] : "";

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

	<title>Galangan Kapal | Purchasing Admin</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/optional.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

<?php if(isset($_POST['submit'])){?>
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
						Transaction with the PR No. <b><?php echo $pr_no; ?></b> has been sent to the Material & Logistics, please wait for confirmation.  
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

	<?php }?>
	<div class="wrapper">
		<?php include("../sidebar/purchasing-sidebar.php"); ?>

		<div class="main">
			<?php include("../navigation/purchasing-navigation.php"); ?>

			<main class="content scrollable">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Material & Logistics Transaction</h1>
						<div class="row">
							<div class="col">
								<form action="" method="post">
									<div class="card flex-fill">
										<div class="row">
											<div class="col">
												
												<div class="card-body">
													<label for="">PR No.</label>
													<input name = "pr-no"type="text" id="pr-no" class="form-control">
												</div>

												<div class="card-body">
                                                    <label for="">Status PR</label>
													<select class="form-select" name="pr-status" id="pr-status-select">
														<option id="open-status" selected>Open</option>
														<option id="close-status">Close</option>
													</select>
												</div>

												<div class="card-body">
													<label for="">PR Date</label>
													<input name = "pr-date" type="date" id="pr-date" class="form-control">
												</div>
												

                                                <div class="card-body">
                                                    <label for="">PO No.</label>
                                                    <input name = "po-no"type="text" id="po-no" class="form-control">
                                                </div>

												<div class="card-body">
                                                    <label for="">Vendor Name</label>
                                                    <input name = "vendor-name" id="vendor-name" type="text" class="form-control">
                                                </div>

												<div class="card-body">
                                                    <label for="">Vendor Code</label>
                                                    <input name = "vendor-code" id="vendor-code" type="text" class="form-control">
                                                </div>

												<div class="card-body">
                                                    <label for="">Vendor City</label>
                                                    <input name = "vendor-city" id="vendor-city" type="text" class="form-control">
                                                </div>
											

													<div class="card-body">
                                                        <label for="">F-Item</label>
														<input name="f-Item" id="f-Item" type="text" class="form-control">
													</div>

												<div class="card-body">
                                                    <label for="">Item Description</label>
													<input name="item-description" id="item-description" type="text" class="form-control">
												</div>

                                                <div class="card-body">
                                                    <label for="">Quantity</label>
													<input name="quantity" id="quantity" type="text" class="form-control">
												</div>

                                                <div class="card-body">
                                                    <label for="">Unit</label>
													<input name="unit" id="unit" type="text" class="form-control">
												</div>

												<div class="card-body">
                                                    <label for="">Price (Rp.)</label>
													<input name="price" id="price" type="text" class="form-control">
												</div>

												<div class="card-body">
													<button type="submit" name="submit" class="btn btn-primary">Send</button>
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

	<script src="../js/purchasing-material-input-control.js"></script>

	<script>
		
		var submittedForm = "<?php echo $submitted ?>";
		if(submittedForm === "1"){
			var triggerModalBtn = document.getElementById("trigger-modal");
			triggerModalBtn.click();
		}

	</script>
</body>

</html>