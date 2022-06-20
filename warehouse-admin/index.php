<?php 
    session_start();
	require("../authorization.php");
    authorizationCheck("warehouse-admin", $_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Galangan Kapal | Warehouse Admin</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/optional.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">Warehouse Admin</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.html">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="transactions.html">
							<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">All Transactions</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="validation.html">
							<i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Validation</span> <span id="validate-num">1</span>
						</a>
					</li>

				</ul>
			</div>
		</nav>

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
				Warehouse Admin
              </a>	
							<div class="dropdown-menu dropdown-menu-end">

								<a class="dropdown-item" href="../sign-out.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Latest<strong> Transaction</strong> List</h1>


					<div class="row">
						<div class="col">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Latest Transactions</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
                                            <th>Block Number</th>
											<th>Hash</th>
											<th class="d-none d-xl-table-cell">Timestamp</th>

										</tr>
									</thead>
									<tbody>
                                        <tr>
											<td>7</td>
											<td><a href="transaction-detail.html?block=7">F9DKPQWNYMIBURE8JLGAO45063SX2C1ZT7VH</a></td>
											<td class="d-none d-xl-table-cell">1885502175.117211</td>
										</tr>
                                        <tr>
											<td>6</td>
											<td><a href="transaction-detail.html?block=6">765N0AH9J4FPV2RBDYI3O8MXCGWZSKQE1LTU</a></td>
											<td class="d-none d-xl-table-cell">1655093755.117837</td>
										</tr>
										<tr>
											<td>5</td>
											<td><a href="transaction-detail.html?block=5">Z0PKESG2LY5IOJCBNUA39W8F6DX1QHM7VRT4</a></td>
											<td class="d-none d-xl-table-cell">1655093755.117837</td>
										</tr>

                                        <tr>
											<td>4</td>
											<td><a href="transaction-detail.html?block=4">853D2KO1HXQEMRP6S4ZGFAVUL7WNYTI09CJB</a></td>
											<td class="d-none d-xl-table-cell">12334093755.11123</td>
										</tr>

                                        <tr>
											<td>3</td>
											<td><a href="transaction-detail.html?block=3">MT1BUN34RCG8PSJH96IKAYOEXLZ5WQ702FDV</a></td>
											<td class="d-none d-xl-table-cell">12334093755.11123</td>
										</tr>

									</tbody>
								</table>
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