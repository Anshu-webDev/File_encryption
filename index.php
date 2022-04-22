<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title> Sign up / Login Form</title>
		<link rel="stylesheet" href="./signupstyle.css">

	</head>

	<body>
		<!-- partial:index.partial.html -->
		<!DOCTYPE html>
		<html>

			<head>
				<title>Slide Navbar</title>
				<!-- <link rel="stylesheet" type="text/css" href="slide navbar style.css"> -->
				<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
			</head>

			<body>
				<div class="main">
					<input type="checkbox" id="chk" aria-hidden="true">

					<div class="signup">
						<form action="register.php" method="POST">
							<label for="chk" aria-hidden="true">Sign up</label>
							<input type="text" name="name" placeholder="User name" required="">
							<input type="email" name="email" placeholder="Email" required="">
							<input type="password" name="pswd" placeholder="Password" required="">
							<input type="password" name="pswd" placeholder="Confirm Password" required="">
							<button type="submit" name="submit">Sign up</button>
						</form>
					</div>

					<div class="login">
						<form action="login.php" method="POST">
							<label for="chk" aria-hidden="true">Login</label>
							<input type="email" name="email" placeholder="Email" required="">
							<input type="password" name="pswd" placeholder="Password" required="">
							<button type="submit" name="submit">Login</button>
						</form>
					</div>
				</div>
			</body>

		</html>
		<!-- partial -->

	</body>

</html>