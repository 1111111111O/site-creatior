<?php
session_start();
include 'connect.php';

if(isset($_SESSION['username'])) {
    $sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Nasılsın, ".$row["username"]."?";
    }
} else {
    echo '<a href="register">Kayıt Ol</a>';
}


?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<title>Driver Download</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="../">Driver Download</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
				<li class="nav-item">
						<a class="nav-link" href="../en">English</a>
					</li>
				<li class="nav-item active">
                    <a class="nav-link" href="">Ana Sayfa</a>
                </li>
					<li class="nav-item">
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

	<div class="container my-5">
		<h1>Hoşgeldiniz</h1>
		<p>Sitemize kayıt olarak kendi sitelerinizi oluşturabilirsiniz. Düzenlemek için <a href=http://driverdownload.duckdns.org/site/tr/helloworld/editor.php>site/tr/siteadın/editor.php</a></p>
		<p><strong>Yenilikler: Editor sayfası yenilendi sayfa oluşturma, sayfa düzenleme, resim yükleme eklendi resimleri görüntüleme görünüm güzelleştirildi hatalar düzeltildi. Giriş yap kayıt ol ekranı modernleşti ve mobile uygun hale getirildi. PHP, CSS, HTML, ASP dosya oluşturma eklendi. Oluşturulan tüm dosyaları görüntüleme düzenleme, sayfa(HTML, PHP vs.) yükleme ve iki dil desteği eklendi.<br><br>Eklenecekler: Görsel düzenleme(beta)</strong></p>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Site Oluşturma</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<h2>Site Oluşturma</h2>
		<form method="post" action="create_site.php">
			<div class="form-group">
				<label for="sitename">Site Adı:</label>
				<input type="text" class="form-control" id="sitename" placeholder="Site Adı" name="sitename">
			</div>
			<button type="submit" class="btn btn-primary" name="submit">Site Oluştur</button>
		</form>

		<hr>

		<h2>Oluşturulan Siteler</h2>
		<table class="table">
			<thead>
				<tr>
					<th>Siteler</th>
				</tr>
			</thead>
			<tbody>
					<?php
				include 'connect.php'; // veritabanı bağlantısı için connect.php dosyasını dahil ediyoruz

			

				if(isset($_SESSION['username'])){ // kullanıcı kayıtlı ise

					$username = $_SESSION['username'];

					$query = "SELECT * FROM users WHERE username='$username'";
					$result = mysqli_query($conn, $query);

					if(mysqli_num_rows($result) > 0){

						$row = mysqli_fetch_assoc($result);

						if($row['sites'] != ""){ // oluşturulmuş siteler varsa

							$sites = explode(',', $row['sites']);

							foreach ($sites as $site) {
								echo "<tr><td><a href=http://driverdownload.duckdns.org/site/tr/$site>Siten</td></tr>";
							}
							
							

						} else {
							echo "<tr><td>Henüz site oluşturulmadı!</td></tr>";
						}

					}

				} else {
					echo "<tr><td>Kayıtlı Değilsin!</td></tr>";
				}
				?>
			</tbody>
		</table>
	</div>

</body>
</html>
