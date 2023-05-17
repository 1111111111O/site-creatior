<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Resimler</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    
    h1 {
      text-align: center;
    }
    
    ul {
      list-style-type: none;
      padding: 0;
    }
    
    li {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Resimler</h1>
	<p>Herkese açıktır.</p>
    <ul class="list-group">
      <?php
        $dosyaKlasoru = "image/";
        $dosyalar = glob($dosyaKlasoru . "/*.{jpeg,jpg,png,svg}", GLOB_BRACE);
        
        foreach($dosyalar as $dosya) {
          $dosyaAdi = basename($dosya);
          echo "<li class='list-group-item'>" . htmlspecialchars($dosyaAdi) . "</li>";
        }
      ?>
    </ul>
  </div>
</body>
<body>
  <div class="container">
    <p>Sitenin içeriği burada olabilir.</p>
    <a class="back-link" href="editor.php">&larr; Geri Dön</a>
  </div>
</body>
</html>