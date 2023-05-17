<?php
require_once 'connect.php';

// Process data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username has already been registered
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $error = "This username is already taken.";
    } else {
        // Add username and password data to the users table
        if (strlen($username) < 6) {
            $error = "The username must be at least 6 characters.";
        } elseif (strlen($password) < 6) {
            $error = "The password must be at least 6 characters.";
        } elseif ($username == $password) {
            $error = "The username and password cannot be the same.";
        } else {
            $password = mysqli_real_escape_string($conn, $password);
            if (!preg_match("/[0-9]/", $password)) {
                $error = "The password must contain at least one number.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
                if (mysqli_query($conn, $sql)) {
                    $error = "Registration successful!";
                    header("location: login");
                } else {
                    $error = "Kayıt hatası: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>




<!DOCTYPE html>
<html>
<head>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="../">Create Site</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
				<li class="nav-item">
                    <a class="nav-link" href="./">Homepage</a>
                </li>
					<li class="nav-item">
						<a class="nav-link" href="login">Login</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="register">Register</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

      <div class="col-md-6 offset-md-0">
<div class="container mt-5">
<?php if(isset($error)) { ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>
  <?php echo isset($message) ? $message : ''; ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
	<h2>Register</h2>
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
	         
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>
</div>
</body>
</html>
