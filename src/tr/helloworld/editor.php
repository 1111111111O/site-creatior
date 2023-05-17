<!DOCTYPE html>
<html>
<head>

      <div class="col-md-6 offset-md-0">
<div class="container mt-5">
  <meta charset="UTF-8">
  <h1>Prototip Editor</h1>
  <title>Editor</title>
  <h3>Sayfa Ara ve Düzenle</h3>
  <p>Bilgi: Bu protip bir editor sayfası,  lütfen kendi siteni düzenlemek için url kısmındaki "helloworld" kısmını oluşturduğun site adı ile değiştir.</p>
  <p><strong><a href=#>Dosyalar</a></strong></p>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

        <div class="input-group">
          <input type="text" id="searchInput" class="form-control" placeholder="Dosya adını girin...">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="mesajGoster()">Ara</button>
          </div>
        </div>
        <div id="codeEditor" class="form-group mt-3" style="display: none;">
          <textarea id="codeArea" class="form-control" rows="10"></textarea>
          <button class="btn btn-success mt-3" onclick="mesajGoster()">Kaydet</button>
        </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>

	<title>Editor</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div>
<h3>Resim yükle</h3>
    <input type="file" name="image" id="fileInput" />
    <button onclick="mesajGoster()">Yükle</button>
</form>
</div>


	<p><strong><a href=#>Resimler</a></strong></p>
</head>
<h3>Sayfa Oluştur</h3>
      
<form onclick="mesajGoster()">
    <div class="input-group">
        <input type="text" class="form-control" name="" required>
        <button onclick="mesajGoster() type="submit" class="btn btn-primary">Sayfa Oluştur</button>
    </div>
	
</form>

<div>
<h3>HTML, PHP, CSS, ASP Dosyası yükle</h3>
    <input type="file" name="image" id="fileInput1" />
    <button onclick="mesajGoster()">Yükle</button>
</form>
    <script>
        function mesajGoster() {
            alert("Bu bir prototip, siteni düzenlemek için urldeki helloworld kısmını sitenin adı ile değiştir.");
        }
    </script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<h3>Anasayfayı düzenle</h3>
	<textarea id="editor" rows="10" cols="50"></textarea>
	<br>
	<button onclick="mesajGoster()">Kaydet</button>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Site Açılış Mesajı Örneği</title>
    <style>
        /* Açılış ekranının stilini belirleyin */
        #acilisEkrani {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #acilisEkrani .mesaj {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="acilisEkrani">
        <div class="mesaj">
            <h2>Dikkat!</h2>
            <p>Bu protip bir editor sayfası,  lütfen kendi siteni düzenlemek için url kısmındaki "helloworld" kısmını oluşturduğun site adı ile değiştir.</p>
 <button onclick="kapat()">ok</button>
        </div>
    </div>

    <!-- Sayfa içeriği buraya gelecek -->

    <script>
        window.onload = function() {
           
            var acilisEkrani = document.getElementById("acilisEkrani");
  
        };
    </script>
	<script>
	 function kapat() {
		 var acilisEkrani = document.getElementById("acilisEkrani");

		  acilisEkrani.style.display = "none";
	 }
	 </script>
</body>
</html>