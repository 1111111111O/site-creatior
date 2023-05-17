<?php
require_once 'connect.php';

// Form gönderildiğinde verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı adının daha önce kaydedilip kaydedilmediğini kontrol etme
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $error = "Bu kullanıcı adı zaten alınmış.";
    } else {
        // Kullanıcı adı ve şifre verilerini users tablosuna ekleme
        if (strlen($username) < 6) {
            $error = "Kullanıcı adı en az 6 karakter olmalıdır.";
        } elseif (strlen($password) < 6) {
            $error = "Şifre en az 6 karakter olmalıdır.";
        } elseif ($username == $password) {
            $error = "Kullanıcı adı ve şifre aynı olamaz.";
        } else {
            $password = mysqli_real_escape_string($conn, $password);
            if (!preg_match("/[0-9]/", $password)) {
                $error = "Şifre en az bir sayı içermelidir.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
                if (mysqli_query($conn, $sql)) {
                    $error = "Kayıt başarılı!";
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
			<a class="navbar-brand" href="../">Driver Download</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
				<li class="nav-item">
                    <a class="nav-link" href="./">Ana Sayfa</a>
                </li>
					<li class="nav-item">
						<a class="nav-link" href="login">Giriş Yap</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="register">Kayıt Ol</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout">Çıkış Yap</a>
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
	<h2>Kayıt Ol</h2>
      <label for="username">Kullanıcı Adı:</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Şifre:</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
	         
    <button type="submit" class="btn btn-primary">Kayıt ol</button>
  </form>
</div>
</div>
</body>
</html>