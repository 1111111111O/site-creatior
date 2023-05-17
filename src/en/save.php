<?php

if(isset($_POST['data'])) {
	$data = $_POST['data'];
	$file = fopen("index.html", "w");
	fwrite($file, $data);
	fclose($file);
	echo "Changes were recorded.";
} else {
	echo "Invalid request.";
}

?>
