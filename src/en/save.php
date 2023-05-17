<?php

if(isset($_POST['data'])) {
	$data = $_POST['data'];
	$file = fopen("index.html", "w");
	fwrite($file, $data);
	fclose($file);
	echo "Değişiklikler kaydedildi.";
} else {
	echo "Geçersiz istek.";
}

?>
