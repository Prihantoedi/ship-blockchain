<?php 
    session_start();
    if(!isset($_SESSION['prk'])){
		header("Location: sign-up.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Sign Up | Galangan Kapal</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Private Key</h1>
							<p class="lead">
								Your private key is : 
							</p>
						</div>
                        
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<p><?php echo $_SESSION['prk']?></p>
									<p>Please note this private key in your secret note because this private key cannot be requested anymore, and never share it with others!</p>
									<div style="margin-top: 10px; text-align:center;"><a href="sign-in.php">Sign in with private key</a></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
	<?php 
		unset($_SESSION['prk']);
	?>

	<script src="js/app.js"></script>

</body>

</html>