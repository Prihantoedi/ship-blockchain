<?php 
    session_start();
    require("../authorization.php");
    require("../connection.php");
    require("../function-center/encrypt-decrypt.php");
    require("../function-center/time-conversion.php");
    require("../function-center/notification-function.php");
    require("../function-center/validation-function.php");

    require("../function-center/validation-submit-purchasing.php");

    authorizationCheck("purchasing-admin", $_SESSION);

    $sidebar_class = [
		"home" => "sidebar-item", 
		"all_transactions" => "sidebar-item", 
		"create_transaction" => "sidebar-item", 
		"notifications" => "sidebar-item", 
		"validation" => "sidebar-item active"
	];

    $purchasing_id = $_SESSION['id'];

    $getPendingValidation = pendingValidation($purchasing_id, $conn);
    $need_validation = $getPendingValidation["need-validation"];
    $validate_num_count = $getPendingValidation["validate-num-count"];

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
    <?php 
        if(isset($_POST['submit-validation'])){

		?>
		<button id="trigger-modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal" hidden="hidden">
			Modal
		</button>

		<!-- Modal -->
		<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 style="font-weight:bold;" class="modal-title" id="transactionModalLabel">Validation Completed</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<?php echo $_SESSION['complete-validation']; ?>  
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

					<h1 class="h3 mb-3"><strong>Validate Transactions</strong></h1>


					<div class="row">
						<div class="col">
                            <!-- Bila tidak ada validasi -->
                            <?php if(count($need_validation) == 0) { ?>
							<div class="card flex-fill mt-2">
                                <div class="card-body">
                                  <span style="font-weight: bold;">You have no validation request</span>
                                </div>

							</div>
                            <?php } 
                                else{
                                    foreach($need_validation as $validate){
                                    
                                        if($validate[1]->sender == "material & logistics"){

                            ?>
                                <form method="post" action="">
                                <div class="card flex-fill mt-2">
                                    <div class="card-header">
                                    </div>

                                    <div class="card-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Sender</td>
                                                    <td><?php echo $validate[1]->sender; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Recipient</td>
                                                    <td><?php echo $validate[1]->recipient; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Project Code</td>
                                                    <td><?php echo $validate[1]->project_code; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>PO No.</td>
                                                    <td><?php echo $validate[1]->po_no; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Vendor Name</td>
                                                    <td><?php echo $validate[1]->vendor_name; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Vendor Code</td>
                                                    <td><?php echo $validate[1]->vendor_code; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Vendor City</td>
                                                    <td><?php echo $validate[1]->vendor_city; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>F-Item</td>
                                                    <td><?php echo $validate[1]->f_item; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Item Description</td>
                                                    <td><?php echo $validate[1]->item_description; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Quantity</td>
                                                    <td><?php echo $validate[1]->quantity; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Unit</td>
                                                    <td><?php echo $validate[1]->unit; ?></td>
                                                </tr>

                                                
                                            </tbody>

                                        </table>
                                        <input id="input-trans-validation-<?php echo $validate[0]; ?>" name="trans-validation" type="hidden" value="">
                                        <input id="input-trans-id-<?php echo $validate[0]; ?>" name="trans-id" type="hidden" value="">
                                        
                                        <a type="button" id="validate-<?php echo $validate[0]; ?>" class="validate btn btn-primary valid">Validate</a>
                                        <a type="button" id="reject-<?php echo $validate[0];?>" class="reject btn btn-danger">Reject</a>
                                        <button name="submit-validation" type="submit" id="btn-validation-status-<?php echo $validate[0]; ?>" hidden="hidden"></button>
                                        
                                    </div>
                                </div>
                                </form>
                            <?php } else { ?>
                                <form action="" method="post">
                                <div class="card flex-fill mt-2">
                                    <div class="card-header">
                                    </div>

                                    <div class="card-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Sender</td>
                                                    <td>Purchasing</td>
                                                </tr>
                                                <tr>
                                                    <td>Recipient</td>
                                                    <td>Material & Logistics</td>
                                                </tr>

                                                <tr>
                                                    <td>PR No.</td>
                                                    <td>RQBH1-20002570</td>
                                                </tr>

                                                <tr>
                                                    <td>PR Date</td>
                                                    <td>30-Apr-2020</td>
                                                </tr>

                                                <tr>
                                                    <td>PO No.</td>
                                                    <td>POAK1-20000225</td>
                                                </tr>
                                                

                                                <tr>
                                                    <td>F-Item</td>
                                                    <td>104-0006</td>
                                                </tr>

                                                <tr>
                                                    <td>Item Description</td>
                                                    <td>Besi Siku Uk. 30 x 30 x 5 x 6</td>
                                                </tr>

                                                <tr>
                                                    <td>Quantity</td>
                                                    <td>15</td>
                                                </tr>

                                                <tr>
                                                    <td>Unit</td>
                                                    <td>Btg</td>
                                                </tr>

                                                <tr>
                                                    <td>Status PR</td>
                                                    <td>Open</td>
                                                </tr>
                                                
                                            </tbody>

                                        </table>
                                        <a type="button" class="btn btn-primary valid">Validate</a>
                                        <a href="#" class="btn btn-danger">Reject</a>
                                    </div>
                                </div>

                                </form>
                            <?php 
                                        }
    
                                    }
    
                                }
                            ?>


                            <!-- <div class="card flex-fill mt-2">
								<div class="card-header">
								</div>

                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sender</td>
                                                <td>Material & Logistics</td>
                                            </tr>
                                            <tr>
                                                <td>Recipient</td>
                                                <td>Purchasing</td>
                                            </tr>

                                            <tr>
                                                <td>PO No.</td>
                                                <td>RQBH1-20002570</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor Name</td>
                                                <td>PT. SAMASUNDU ABIDRAYA</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor Code</td>
                                                <td>V-000019</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor City</td>
                                                <td>MKS</td>
                                            </tr>

                                            <tr>
                                                <td>F-Item</td>
                                                <td>104-0006</td>
                                            </tr>

                                            <tr>
                                                <td>Item Description</td>
                                                <td>Besi Siku Uk. 30 x 30 x 5 x 6</td>
                                            </tr>

                                            <tr>
                                                <td>Quantity</td>
                                                <td>15</td>
                                            </tr>

                                            <tr>
                                                <td>Unit</td>
                                                <td>Btg</td>
                                            </tr>

                                            <tr>
                                                <td>Status PO</td>
                                                <td>Close</td>
                                            </tr>
                                            
                                        </tbody>

                                    </table>
									<a type="button" class="btn btn-primary valid">Validate</a>
                                    <a href="#" class="btn btn-danger">Reject</a>
								</div>
							</div>

                            <div class="card flex-fill mt-2">
								<div class="card-header">
								</div>

                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sender</td>
                                                <td>Material & Logistics</td>
                                            </tr>
                                            <tr>
                                                <td>Recipient</td>
                                                <td>Purchasing</td>
                                            </tr>
                                            <tr>
                                                <td>PO No.</td>
                                                <td>RQBH1-20002570</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>PO Date</td>
                                                <td>14-Apr-20</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor Name</td>
                                                <td>PT. SAMASUNDU ABIDRAYA</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor Code</td>
                                                <td>V-000019</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor City</td>
                                                <td>MKS</td>
                                            </tr>

                                            <tr>
                                                <td>Project Code</td>
                                                <td>DV1-18000003</td>
                                            </tr>

                                            <tr>
                                                <td>F-Item</td>
                                                <td>104-0006</td>
                                            </tr>

                                            <tr>
                                                <td>Item Description</td>
                                                <td>Besi Siku Uk. 30 x 30 x 5 x 6</td>
                                            </tr>

                                            <tr>
                                                <td>Quantity</td>
                                                <td>15</td>
                                            </tr>

                                            <tr>
                                                <td>Unit</td>
                                                <td>Btg</td>
                                            </tr>

                                            <tr>
                                                <td>Status PO</td>
                                                <td>Open</td>
                                            </tr>

                                        </tbody>

                                    </table>
									<a type="button" class="btn btn-primary valid">Validate</a>
                                    <a href="#" class="btn btn-danger">Reject</a>
								</div>
							</div>        
                            
                            <div class="card flex-fill mt-2">
								<div class="card-header">
								</div>

                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sender</td>
                                                <td>Material & Logistics</td>
                                            </tr>
                                            <tr>
                                                <td>Recipient</td>
                                                <td>Purchasing</td>
                                            </tr>
                                            <tr>
                                                <td>PO No.</td>
                                                <td>POAK1-19000669</td>
                                            </tr>

                                            <tr>
                                                <td>PO Date</td>
                                                <td>1-Oct-19</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor Name</td>
                                                <td>PT. SAMASUNDU ABIDRAYA</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor Code</td>
                                                <td>V-000019</td>
                                            </tr>

                                            <tr>
                                                <td>Vendor City</td>
                                                <td>MKS</td>
                                            </tr>

                                            <tr>
                                                <td>Project Code</td>
                                                <td>DV1-19000008</td>
                                            </tr>

                                            <tr>
                                                <td>F-Item</td>
                                                <td>146-0006</td>
                                            </tr>

                                            <tr>
                                                <td>Item Description</td>
                                                <td>Paku Uk. 5 cm</td>
                                            </tr>

                                            <tr>
                                                <td>Quantity</td>
                                                <td>1</td>
                                            </tr>

                                            <tr>
                                                <td>Unit</td>
                                                <td>Kg</td>
                                            </tr>

                                            <tr>
                                                <td>Status PO</td>
                                                <td>Open</td>
                                            </tr>

                                        </tbody>

                                    </table>
									<a type="button" class="btn btn-primary valid">Validate</a>
                                    <a href="#" class="btn btn-danger">Reject</a>
								</div>
							</div> -->
                        </div>
					</div>

				</div>
			</main>

		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>

    <script>
        document.addEventListener("click", function(e){
            var btnClicked = e.target;
            if(btnClicked.className === "validate btn btn-primary valid"){
                var getId = btnClicked.id;
                var splitId = getId.split("-");
                var id = splitId.pop();
                
                var transDecision = document.getElementById("input-trans-validation-"+id);
                var transId = document.getElementById("input-trans-id-" + id);
                transDecision.setAttribute("value" , "valid");
                transId.setAttribute("value", id);
                var btnSubmitStatus = document.getElementById("btn-validation-status-" + id);
                btnSubmitStatus.click();
            } 
            
            if(btnClicked.className === "reject btn btn-danger"){
                var getId = btnClicked.id;
                var splitId = getId.split("-");
                var id = splitId.pop();
                
                var transDecision = document.getElementById("input-trans-validation-"+id);
                var transId = document.getElementById("input-trans-id-" + id);
                transDecision.setAttribute("value" , "reject");
                transId.setAttribute("value", id);
                var btnSubmitStatus = document.getElementById("btn-validation-status-" + id);
                btnSubmitStatus.click();
            }
            

            
        });

        var triggerModalBtn = document.getElementById("trigger-modal");
        if(triggerModalBtn){
            triggerModalBtn.click();
        }
		


    </script>

</body>

</html>