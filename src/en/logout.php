<?php
session_start();

// End the user's session
session_destroy();

// Redirect to home page
header("Location: .");
exit;
?>
