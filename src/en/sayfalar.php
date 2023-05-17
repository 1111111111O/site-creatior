<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pages</title>
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
    <h1>Pages</h1>
	<p>Public.</p>
    <ul class="list-group">
      <?php
        $dosyaKlasoru = "page";
        $dosyalar = glob($dosyaKlasoru . "/*.{html,css,asp,php}", GLOB_BRACE);
        
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
    <p>The content of the site can be here.</p>
    <a class="back-link" href="editor.php">&larr; Go Back</a>
  </div>
</body>
</html>
