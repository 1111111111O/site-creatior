<?php
session_start();
require_once 'connect.php';

// Form gönderildiğinde verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı adı ve şifreyi kontrol etme
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Giriş başarılı, kullanıcıyı oturum açtırma
        $_SESSION["username"] = $username;
        header("location: index.php");
    } else {
        // Giriş başarısız, hata mesajı gösterme
        $error = "Geçersiz kullanıcı adı veya şifre!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<p><strong> <a href=register>Kayıt ol</a> - <a href=.>Anasayfa</a></strong></p>
    <div class="container">
        <h1>Giriş Yap</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Giriş Yap</button>
        </form>
    </div>
</body>
</html>
