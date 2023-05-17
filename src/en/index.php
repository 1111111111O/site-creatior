<?php
session_start();
include 'connect.php';

if(isset($_SESSION['username'])) {
    $sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "How are you, ".$row["username"]."?";
    }
} else {
    echo '<a href="register">Register Now</a>';
}


?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="../">Create Site</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
                    <a class="nav-link" href="">Homepage</a>
                </li>
					<li class="nav-item">
						<a class="nav-link" href="login">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="register">Register</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container my-5">
		<h1>Welcome</h1>
		<p>You can create your own sites by registering on our site. To edit <a href=helloworld/editor.php>site/yoursitename/editor.php</a></p>
		<p><strong>The Editor page has been redesigned with added features such as page creation, page editing, and image uploading. The appearance has been enhanced, and bugs have been fixed. The login and registration screen has been modernized and made mobile-friendly. File creation for PHP, CSS, HTML, and ASP has been added. Viewing all created files is now possible. An option to upload ready-made HTML files has been included. Two language options.<br><br>Upcoming additions: Visual editing (beta)</strong></p>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Site Creation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<h2>Site Creation</h2>
		<form method="post" action="create_site.php">
			<div class="form-group">
				<label for="sitename">Site Name:</label>
				<input type="text" class="form-control" id="sitename" placeholder="Site Name" name="sitename">
			</div>
			<button type="submit" class="btn btn-primary" name="submit">Create Site</button>
		</form>

		<hr>

		<h2>Oluşturulan Siteler</h2>
		<table class="table">
			<thead>
				<tr>
					<th>Sites</th>
				</tr>
			</thead>
			<tbody>
					<?php
				include 'connect.php'; // we include the connect.php file for database connection

			

				if(isset($_SESSION['username'])){ // if the user is registered

					$username = $_SESSION['username'];

					$query = "SELECT * FROM users WHERE username='$username'";
					$result = mysqli_query($conn, $query);

					if(mysqli_num_rows($result) > 0){

						$row = mysqli_fetch_assoc($result);

						if($row['sites'] != ""){ // If there are created sites

							$sites = explode(',', $row['sites']);

							foreach ($sites as $site) {
								echo "<tr><td>$site</td></tr>";
							}
							
							

						} else {
							echo "<tr><td>No site created yet!</td></tr>";
						}

					}

				} else {
					echo "<tr><td>You are not registered!</td></tr>";
				}
				?>
			</tbody>
		</table>
	</div>

</body>
</html>
