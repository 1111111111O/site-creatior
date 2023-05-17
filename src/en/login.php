<?php
session_start();
require_once 'connect.php';

// Form gönderildiğinde verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]); // Veriyi temizleme
    $password = $_POST["password"];

    // Kullanıcı adı ve şifreyi kontrol etme
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Giriş başarılı, kullanıcıyı oturum açtırma
            $_SESSION["username"] = $username;
            header("location: index.php");
        } else {
            // Giriş başarısız, hata mesajı gösterme
            $error = "Geçersiz kullanıcı adı veya şifre!";
        }
    } else {
        // Giriş başarısız, hata mesajı gösterme
        $error = "Geçersiz kullanıcı adı veya şifre!";
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
					<li class="nav-item active">
						<a class="nav-link" href="login">Giriş Yap</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="register">Kayıt Ol</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout">Çıkış Yap</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
  <title>Login</title>
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
  <?php echo isset($message) ? $message : ''; ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
	<h2>Giriş Yap</h2>
      <label for="username">Kullanıcı Adı:</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Şifre:</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
	            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
    <button type="submit" class="btn btn-primary">Giriş</button>
  </form>
</div>
</div>
</body>
</html>