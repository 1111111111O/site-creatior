<?php
require_once 'connect.php';

// Form gönderildiğinde verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı adının daha önce kaydedilip kaydedilmediğini kontrol etme
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Bu kullanıcı adı zaten alınmış.";
    } else {
        // Kullanıcı adı ve şifre verilerini users tablosuna ekleme
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "Kayıt başarılı!";
            header("location: login");
        } else {
            echo "Kayıt hatası: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<p><strong> <a href=login>Giriş yap</a> - <a href=.>Anasayfa</a></strong></p>
    <div class="container">
        <h1>Kayıt Ol</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydol</button>
        </form>
    </div>
</body>
</html>
