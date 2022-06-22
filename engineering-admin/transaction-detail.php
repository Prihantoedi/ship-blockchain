<?php 
    session_start();
    require("../authorization.php");
	require("../connection.php");
	// require("../function-center/create-transaction-function.php");
	require("../function-center/encrypt-decrypt.php");
	require("../function-center/time-conversion.php");
    authorizationCheck("engineering-admin", $_SESSION);

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

			<main class="content scrollable">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Transaction Detail</strong></h1>

					<div class="row">
						<div class="col">


                            <div class="card flex-fill mt-2">
								<div class="card-header">
									<h5 class="card-title mb-0">Block Number: <?php echo $block_no; ?></h5>
								</div>

                                <div class="card-body">
                                    <table class="table">
										<tbody>

										
										<?php if(isset($block_info->type)){?>
											<tr>
												<td>Previous</td>
												<td><?php echo $block_info->previous; ?></td>
											</tr>

											<tr>
												<td>Type</td>
												<td><?php echo $block_info->type; ?></td>
											</tr>

											<tr>
												<td>Nonce</td>
												<td><?php echo $block_info->nonce; ?></td>
											</tr>

											<tr>
												<td>Timestamp</td>
												<td><?php echo $block_info->timestamp; ?></td>
											</tr>

											<tr>
												<td>Hash</td>
												<td><?php echo $block_info->hash; ?></td>
											</tr>
										
										<!-- end if isset -->
										<?php } else{ if($block_info->sender == "engineering"){?>
											<tr>
												<td>Previous</td>
												<td><?php echo $block_info->previous; ?></td>
											</tr>
											<tr>
												<td>Sender</td>
												<td><?php echo $block_info->sender; ?></td>
											</tr>

											<tr>
												<td>Recipient</td>
												<td><?php echo $block_info->recipient; ?></td>
											</tr>

											<tr>
												<td>Project Name</td>
												<td><?php echo $block_info->project_name; ?></td>
											</tr>

											<tr>
												<td>Project Code</td>
												<td><?php echo $block_info->project_code; ?></td>
											</tr>

											<tr>
												<td>Status</td>
												<td><?php echo $block_info->validation_status; ?></td>
											</tr>

											<tr>
												<td>Nonce</td>
												<td><?php echo $block_info->nonce; ?></td>
											</tr>

											<tr>
												<td>Submission Time</td>
												<td><?php echo microtimeToDate($block_info->submission_time); ?></td>
											</tr>

											<tr>
												<td>Timestamp</td>
												<td><?php echo $block_info->timestamp; ?></td>
											</tr>

											<tr>
												<td>Hash</td>
												<td><?php echo $block_info->hash; ?></td>
											</tr>


											
										<?php }?>
										<!-- end of else isset -->
										<?php }?>
									

                                    </table>
									
								</div>
							</div>

                           
                        </div>
					</div>

				</div>
			</main>

		</div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/additional.js"></script>


</body>

</html>