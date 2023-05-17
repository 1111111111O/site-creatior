<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";

$conn = new mysqli($servername, $username, $password, $dbname);

// Get the name of the directory where the PHP script is located
$current_directory = basename(__DIR__);

// Code to run when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Username, password and site name check

  // Secure incoming data
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Create the query using the prepared expression
  $stmt = $conn->prepare("SELECT * FROM users WHERE sites = ? AND username = ?");
  $stmt->bind_param("ss", $current_directory, $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Check the password in the database
    if (password_verify($password, $row['password'])) {
      // Show hidden HTML code if login is successful
      $message = '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>:D</title>
  <h3>Page Search and Edit</h3>
  <p>Information: Your pages are located in the "site/yourwebsitename/page" section, and when creating or searching for a file, remember to add ".html" to the end.</p>
  <p><strong><a href=sayfalar.php>Files</a></strong></p>
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
            alert("File not found!");
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
            alert("File saved!");
          } else {
            alert("An error occurred while saving the file!");
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
					alert("An error has occurred. Please try again.");
				}
			});
		}
	</script>
<div>
<h3>Upload image</h3>
<form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="fileInput" />
    <input type="submit" value="Upload" id="uploadButton" />
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

	<p><strong><a href=resimler.php>İmage</a></strong></p>
</head>
<h3>Page Create</h3>
      
<form method="POST" action="sayfa.php">
    <div class="input-group">
        <input type="text" class="form-control" name="dosya_adi" required>
        <button type="submit" class="btn btn-primary">Create Page</button>
    </div>
	
</form>

<div>
<h3>Upload HTML, PHP, CSS, ASP File</h3>
<form id="uploadForm1" action="upload2.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="fileInput1" />
    <input type="submit" value="Upload" id="uploadButton1" />
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
	<h3>Edit homepage</h3>
	<textarea id="editor" rows="10" cols="50"></textarea>
	<br>
	<button onclick="saveChanges()">Save</button>
</body>
</html>';
    } else {
      // Show error message if input failed
      $message = '<div class="alert alert-danger" role="alert">Username, password or site name is incorrect.</div>';
    }
  } else {
    // Show error message if input failed
    $message = '<div class="alert alert-danger" role="alert">Username, password or site name is incorrect.</div>';
  }
}

// HTML form
?>

<!DOCTYPE html>
<html>
<head>
  <title>Site Editing</title>
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
	<h2>Sign in</h2>
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
</div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
