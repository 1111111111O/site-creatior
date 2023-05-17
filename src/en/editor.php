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

  // Gelen verileri güvenli hale getir
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);

  // Şifreyi hashle
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Hazırlanan ifadeyi kullanarak sorguyu oluştur
  $stmt = $conn->prepare("SELECT * FROM users WHERE sites = ? AND username = ?");
  $stmt->bind_param("ss", $current_directory, $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Veritabanındaki şifreyi kontrol et
    if (password_verify($password, $row['password'])) {
      // Giriş başarılıysa gizli HTML kodunu göster
      $message = '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Arama ve Kaynak Kodu Düzenleme</title>
  <h3>Sayfa Ara ve Düzenle</h3>
  <p>Bilgi: Sayfalarınız site/seninsiteninadı/page kısmındadır ve dosya oluştur yada ararken sonuna .html ekleyiniz.</p>
  <p><strong><a href=sayfalar.php>Dosyalar</a></strong></p>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

        <div class="input-group">
          <input type="text" id="searchInput" class="form-control" placeholder="Dosya adını girin...">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="searchFile()">Ara</button>
          </div>
        </div>
        <div id="codeEditor" class="form-group mt-3" style="display: none;">
          <textarea id="codeArea" class="form-control" rows="10"></textarea>
          <button class="btn btn-success mt-3" onclick="saveFile()">Kaydet</button>
        </div>

    
  <script>
    function searchFile() {
      var fileName = document.getElementById("searchInput").value;

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var codeEditor = document.getElementById("codeEditor");
            var codeArea = document.getElementById("codeArea");

            codeEditor.style.display = "block";
            codeArea.value = xhr.responseText;
          } else {
            alert("Dosya bulunamadı!");
          }
        }
      };
      xhr.open("GET", "page/" + fileName, true);
      xhr.send();
    }

    function saveFile() {
      var fileName = document.getElementById("searchInput").value;
      var code = document.getElementById("codeArea").value;

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            alert("Dosya kaydedildi!");
          } else {
            alert("Dosya kaydedilirken bir hata oluştu!");
          }
        }
      };
      xhr.open("POST", "save2.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("filename=" + fileName + "&code=" + encodeURIComponent(code));
    }
  </script>
</body>
</html>
<!DOCTYPE html>
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
<div>
<h3>Resim yükle sitene ekle</h3>
<form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="fileInput" />
    <input type="submit" value="Yükle" id="uploadButton" />
</form>
</div>
<div id="progressBar" style="width: 0%;"></div>
<div id="status"></div>
<script>
$(document).ready(function() {
    $("#uploadForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        
        $.ajax({
            url: "upload.php",
            type: "POST",
            data: formData,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $("#progressBar").css("width", percentComplete + "%");
                        $("#status").html(percentComplete.toFixed(2) + "% Yüklendi");
                    }
                }, false);
                return xhr;
            },
            success: function(data) {
                $("#status").html(data);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>

	<p><strong><a href=resimler.php>Resimler</a></strong></p>
</head>
<h3>Sayfa Oluştur</h3>
      
<form method="POST" action="sayfa.php">
    <div class="input-group">
        <input type="text" class="form-control" name="dosya_adi" required>
        <button type="submit" class="btn btn-primary">Sayfa Oluştur</button>
    </div>
	
</form>

<div>
<h3>HTML, PHP, CSS, ASP Dosyası yükle</h3>
<form id="uploadForm1" action="upload2.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="fileInput1" />
    <input type="submit" value="Yükle" id="uploadButton1" />
</form>
</div>
<div id="progressBar2" style="width: 0%;"></div>
<div id="status2"></div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<script>
$(document).ready(function() {
    $("#uploadForm1").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        
        $.ajax({
            url: "upload2.php",
            type: "POST",
            data: formData,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $("#progressBar2").css("width", percentComplete + "%");
                        $("#status2").html(percentComplete.toFixed(2) + "% Yüklendi");
                    }
                }, false);
                return xhr;
            },
            success: function(data) {
                $("#status2").html(data);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>

<body>
	<h3>Anasayfayı düzenle</h3>
	<textarea id="editor" rows="10" cols="50"></textarea>
	<br>
	<button onclick="saveChanges()">Kaydet</button>
</body>
</html>';
    } else {
      // Giriş başarısızsa hata mesajı göster
      $message = '<div class="alert alert-danger" role="alert">Kullanıcı adı, şifre veya site adı yanlış.</div>';
    }
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
  <title>Site Düzenleme</title>
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
<h1>Editor</h1>
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
    <button type="submit" class="btn btn-primary">Giriş</button>
  </form>
</div>
</div>
</body>
</html>

<?php
// Veritabanı bağlantısını kapat
$conn->close();
?>
