<!DOCTYPE html>
<html>
<head>

      <div class="col-md-6 offset-md-0">
<div class="container mt-5">
  <meta charset="UTF-8">
  <h1>Prototip Editor</h1>
  <title>Editor</title>
  <h3>Page Search and Edit</h3>
  <p>Information: This is an editor page, please replace the helloworld part in the URL section with the name of your own website to edit it.</p>
  <p><strong><a href=#>Files</a></strong></p>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

        <div class="input-group">
          <input type="text" id="searchInput" class="form-control" placeholder="Dosya adını girin...">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="mesajGoster()">Search</button>
          </div>
        </div>
        <div id="codeEditor" class="form-group mt-3" style="display: none;">
          <textarea id="codeArea" class="form-control" rows="10"></textarea>
          <button class="btn btn-success mt-3" onclick="mesajGoster()">Save</button>
        </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>

	<title>Editor</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div>
<h3>Image upload</h3>
    <input type="file" name="image" id="fileInput" />
    <button onclick="mesajGoster()">Upload</button>
</form>
</div>


	<p><strong><a href=#>Images</a></strong></p>
</head>
<h3>Create Page</h3>
      
<form onclick="mesajGoster()">
    <div class="input-group">
        <input type="text" class="form-control" name="" required>
        <button onclick="mesajGoster() type="submit" class="btn btn-primary">Page Create</button>
    </div>
	
</form>

<div>
<h3>HTML, PHP, CSS, ASP File upload</h3>
    <input type="file" name="image" id="fileInput1" />
    <button onclick="mesajGoster()">Upload</button>
</form>
    <script>
        function mesajGoster() {
            alert("Information: This is an editor page, please replace the helloworld part in the URL section with the name of your own website to edit it.");
        }
    </script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<h3>Edit homepage</h3>
	<textarea id="editor" rows="10" cols="50"></textarea>
	<br>
	<button onclick="mesajGoster()">Save</button>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Site Opening Message Example</title>
    <style>
        /* Set the style of the splash screen */
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
            <p>Information: This is an editor page, please replace the helloworld part in the URL section with the name of your own website to edit it.</p>
 <button onclick="kapat()">OK</button>
        </div>
    </div>

    

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
