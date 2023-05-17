<?php
include 'connect.php'; // we include the connect.php file for database connection

session_start(); // initializing the session

if(!isset($_SESSION['username'])){ // if the user is not logged in
    header("Location: register"); // redirect to login.php page
}

if(isset($_POST['submit'])){ // checking if the form has been submitted

    $sitename = $_POST['sitename'];

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){ // if the user is registered

        $row = mysqli_fetch_assoc($result);

        if($row['sites'] == ""){ // if a site has not been created before

            // we define the path to the folder to be created to control
            $folder_path = __DIR__ . "/$sitename";

            // we show an error message if the folder has already been created
            if(file_exists($folder_path)){
                echo "There is a site with the same name. Please try another name.";
                exit;
            }

            // save the site name in the database
            $query = "UPDATE users SET sites='$sitename' WHERE username='$username'";
            mysqli_query($conn, $query);

            // create a folder with the site name
            mkdir($folder_path);

            // create an index.html file in the folder
            $file = fopen("$folder_path/index.html","w");

            // write to index.html file
            fwrite($file,"<!DOCTYPE html><html><head><title>$sitename</title></head><body><h1>$sitename</h1><p>Welcome to my website! <a href=editor_en.php>Editor</a> </p></body></html>");

            // copy the editor.php and save.php files and put them in the folder
            if (copy("save.php", $folder_path . "/save.php")) {
                echo "File copied: save.php -> " . $folder_path . "/save.php <br>";
            } else {
                echo "The file could not be copied: save.php -> " . $folder_path . "/save.php <br>";
            }
			
			if (copy("save2.php", $folder_path . "/save2.php")) {
                echo "File copied: save2.php -> " . $folder_path . "/save2.php <br>";
            } else {
                echo "The file could not be copied: save2.php -> " . $folder_path . "/save2.php <br>";
            }
			
			if (copy("upload.php", $folder_path . "/upload.php")) {
                echo "File copied: upload.php -> " . $folder_path . "/upload.php <br>";
            } else {
                echo "The file could not be copied: upload.php -> " . $folder_path . "/upload.php <br>";
            }
			
			if (copy("sayfa.php", $folder_path . "/sayfa.php")) {
                echo "File copied: sayfa.php -> " . $folder_path . "/sayfa.php <br>";
            } else {
                echo "The file could not be copied: sayfa.php -> " . $folder_path . "/sayfa.php <br>";
            }
		
			if (copy("sayfalar.php", $folder_path . "/sayfalar.php")) {
                echo "File copied: sayfalar.php -> " . $folder_path . "/sayfalar.php <br>";
            } else {
                echo "The file could not be copied: sayfalar.php -> " . $folder_path . "/sayfalar.php <br>";
            }
			
			if (copy("upload2.php", $folder_path . "/upload2.php")) {
                echo "File copied: upload2.php -> " . $folder_path . "/upload2.php <br>";
            } else {
                echo "The file could not be copied: upload2.php -> " . $folder_path . "/upload2.php <br>";
            }
			
				if (copy("resimler.php", $folder_path . "/resimler.php")) {
                echo "File copied: resimler.php -> " . $folder_path . "/resimler.php <br>";
            } else {
                echo "The file could not be copied: resimler.php -> " . $folder_path . "/resimler.php <br>";
            }
			
					if (copy("editor_en.php", $folder_path . "/editor_en.php")) {
                echo "File copied: editor_en.php -> " . $folder_path . "/editor_en.php <br>";
            } else {
                echo "The file could not be copied: editor_en.php -> " . $folder_path . "/editor_en.php <br>";
            }
			
			$folder_path1 = "$folder_path/image"; // First folder name
			$folder_path2 = "$folder_path/page"; // Second folder name

			// Create the first folder
			if (!is_dir($folder_path1)) {
    if (mkdir($folder_path1)) {
        echo "Folder created: $folder_path1 <br>";
    } else {
        echo "Failed to create folder: $folder_path1 <br>";
    }
} else {
    echo "The folder already exists: $folder_path1 <br>";
}

			// Create the second folder
			if (!is_dir($folder_path2)) {
    if (mkdir($folder_path2)) {
        echo "Klasör oluşturuldu: $folder_path2 <br>";
    } else {
        echo "Failed to create folder: $folder_path2 <br>";
    }
} else {
    echo "The folder already exists: $folder_path2 <br>";
}
            fclose($file);

            echo "Site created!";
            header("Refresh: 0; url=../en");
        } else {
            echo "A site has been created before!";
            header("Refresh: 2; url=../en");
        }

    } else {
        echo "User not registered!";
        header("Refresh: ; url=../en");
    }
}

?>
