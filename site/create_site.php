<?php
include 'connect.php'; // veritabanı bağlantısı için connect.php dosyasını dahil ediyoruz

session_start(); // session'ı başlatıyoruz

if(!isset($_SESSION['username'])){ // kullanıcı girişi yapılmamışsa
    header("Location: register"); // login.php sayfasına yönlendiriyoruz
}

if(isset($_POST['submit'])){ // form gönderildi mi kontrol ediyoruz

    $sitename = $_POST['sitename'];

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){ // kullanıcı kayıtlı ise

        $row = mysqli_fetch_assoc($result);

        if($row['sites'] == ""){ // daha önce bir site oluşturulmadıysa

            // kontrol etmek için oluşturulacak klasör yolunu tanımlıyoruz
            $folder_path = __DIR__ . "/$sitename";

            // klasör daha önce oluşturulmuşsa hata mesajı gösteriyoruz
            if(file_exists($folder_path)){
                echo "Aynı isimde bir site bulunuyor. Lütfen başka bir isim deneyin.";
                exit;
            }

            // sites adını veritabanına kaydediyoruz
            $query = "UPDATE users SET sites='$sitename' WHERE username='$username'";
            mysqli_query($conn, $query);

            // site adıyla bir klasör oluşturuyoruz
            mkdir($folder_path);

            // klasöre index.html dosyası oluşturuyoruz
            $file = fopen("$folder_path/index.html","w");

            // index.html dosyasına yazıyoruz
            fwrite($file,"<html><head><title>$sitename</title></head><body><h1>$sitename</h1><p>Welcome to my website!</p></body></html>");

            // editor.php ve save.php dosyalarını kopyalayarak klasöre atıyoruz
            if (copy("editor.php", $folder_path . "/editor.php")) {
                echo "Dosya kopyalandı: editor.php -> " . $folder_path . "/editor.php <br>";
            } else {
                echo "Dosya kopyalanamadı: editor.php -> " . $folder_path . "/editor.php <br>";
            }

            if (copy("save.php", $folder_path . "/save.php")) {
                echo "Dosya kopyalandı: save.php -> " . $folder_path . "/save.php <br>";
            } else {
                echo "Dosya kopyalanamadı: save.php -> " . $folder_path . "/save.php <br>";
            }

            fclose($file);

            echo "Site oluşturuldu!";
            header("Refresh: 0; url=./");
        } else {
            echo "Daha önce bir site oluşturulmuş!";
            header("Refresh: 2; url=./");
        }

    } else {
        echo "Kullanıcı kayıtlı değil!";
        header("Refresh: ; url=./");
    }
}

?>
