<?php
$klasor = 'page/'; // path to the "page" folder

if(isset($_POST['dosya_adi'])) {
    $dosya_adi = $_POST['dosya_adi']; // File name from the form

    // Check that the file name is a valid name
    if(preg_match('/^[a-zA-Z0-9-_]+\.(html|css|php|asp)$/', $dosya_adi)) {
        $dosya_yolu = $klasor . $dosya_adi; // Klasör yolu ve dosya adını birleştir

        // File creation
        if(!file_exists($dosya_yolu)) {
            $dosya = fopen($dosya_yolu, 'w'); // Create the file
            fclose($dosya); // Close file
            echo "Your file has been created: $dosya_adi";
        } else {
            echo "Error: File already exists!";
        }
    } else {
        echo "Error: Invalid file name!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Create Page</title>
<script>
    setTimeout(function() {
        history.back();
    }, 3000); // 3 second hold
</script>
</head>
<body>
<p>After 3 seconds you will be redirected back...</p>
</body>
</html>
