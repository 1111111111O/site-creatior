<?php
$filename = $_POST['filename'];
$code = $_POST['code'];

// Dosya yolunu kontrol etmek için gerekli önlemler alınmalıdır.
$file = 'page/' . $filename;

// Dosyanın kaynak kodunu güncelleyin.
file_put_contents($file, $code);

// İşlem sonucunu kontrol edin ve uygun bir yanıt döndürün.
if (file_exists($file)) {
  echo 'Dosya kaydedildi!';
} else {
  echo 'Dosya kaydedilirken bir hata oluştu!';
}
?>
