<?php
$klasor = 'page/'; // "page" klasörünün yolu

if(isset($_POST['dosya_adi'])) {
    $dosya_adi = $_POST['dosya_adi']; // Formdan gelen dosya adı

    // Dosya adının geçerli bir isim olduğunu kontrol edelim
    if(preg_match('/^[a-zA-Z0-9-_]+\.(html|css|php|asp)$/', $dosya_adi)) {
        $dosya_yolu = $klasor . $dosya_adi; // Klasör yolu ve dosya adını birleştir

        // Dosya oluşturma işlemi
        if(!file_exists($dosya_yolu)) {
            $dosya = fopen($dosya_yolu, 'w'); // Dosyayı oluştur
            fclose($dosya); // Dosyayı kapat
            echo "Dosyanız oluşturuldu: $dosya_adi";
        } else {
            echo "Hata: Dosya zaten mevcut!";
        }
    } else {
        echo "Hata: Geçersiz dosya adı!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sayfa Oluştur</title>
<script>
    setTimeout(function() {
        history.back();
    }, 3000); // 3 saniye bekletme
</script>
</head>
<body>
<p>3 saniye sonra geriye yönlendirileceksiniz...</p>
</body>
</html>