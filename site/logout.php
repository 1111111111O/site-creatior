<?php
session_start();

// Kullanıcının oturumunu sonlandır
session_destroy();

// Ana sayfaya yönlendir
header("Location: .");
exit;
?>
