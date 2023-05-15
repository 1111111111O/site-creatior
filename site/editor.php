<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";

$conn = new mysqli($servername, $username, $password, $dbname);

// PHP betiği bulunduğu dizinin adını al
$current_directory = basename(__DIR__);

// Form gönderildiğinde çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Kullanıcı adı, şifre ve site adı kontrolü
  $sql = "SELECT * FROM users WHERE sites = '".$current_directory."' AND username = '".$_POST['username']."' AND password = '".$_POST['password']."'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Giriş başarılıysa gizli HTML kodunu göster
    $message = '<div class="alert alert-success" role="alert"><!DOCTYPE html>
<html>
<head>
	<title>Editor</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$.get("index.html", function(data) {
				$("#editor").val(data);
			});
		});

		function saveChanges() {
			var data = $("#editor").val();
			$.ajax({
				url: "save.php",
				type: "POST",
				data: { data: data },
				success: function(response) {
					alert(response);
				},
				error: function() {
					alert("Bir hata oluştu. Lütfen tekrar deneyin.");
				}
			});
		}
	</script>
</head>
<body>
	<h1>Editor</h1>
	<textarea id="editor" rows="10" cols="50"></textarea>
	<br>
	<button onclick="saveChanges()">Kaydet</button>
</body>
</html>
</div></div>';
  } else {
    // Giriş başarısızsa hata mesajı göster
    $message = '<div class="alert alert-danger" role="alert">Kullanıcı adı, şifre veya site adı yanlış.</div>';
  }
}

// HTML formu
?>
<!DOCTYPE html>
<html>
<head>
  <title>Giriş Yap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <h2>Giriş Yap</h2>
  <?php echo isset($message) ? $message : ''; ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="username">Kullanıcı Adı:</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Şifre:</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Giriş</button>
  </form>
</div>

</body>
</html>

<?php
// Veritabanı bağlantısını kapat
$conn->close();
?>
