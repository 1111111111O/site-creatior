<?php
$filename = $_POST['filename'];
$code = $_POST['code'];

// Measures should be taken to control the file path.
$file = 'page/' . $filename;

// Update the source code of the file.
file_put_contents($file, $code);

// Check the result of the operation and return an appropriate response.
if (file_exists($file)) {
  echo 'File saved!';
} else {
  echo 'Youre not smart, stupid.';
}
?>
