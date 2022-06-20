<?php 
    session_start();
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
							<h1 class="h2">Get started</h1>
							<p class="lead">
								Enter Your Divison Here
							</p>
						</div>
                        <?php 
                            if(isset($_SESSION['err'])){
                            
                        ?>
                            <div class="text-center text-danger"><p>Division quota is full, please enter another division</p></div>
                        <?php 
                                unset($_SESSION['err']);
                            }
                        ?>
                        
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form method="POST" action="sign-up-create.php">
										<div class="mb-3">
											<label class="form-label">Division</label>
											<input class="form-control form-control-lg" type="text" name="division" placeholder="Enter your division" />
										</div>
									
										<div class="text-center mt-3">
											<button type="submit" name="submit" class="btn btn-lg btn-primary">Sign up</button>
										
										</div>
									</form>
									<div style="margin-top: 10px; text-align:center;"><p>Already have an account? <a href="sign-in.php">Click here</a></p></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>