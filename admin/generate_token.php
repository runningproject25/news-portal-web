<?php
session_start();

$token = bin2hex(random_bytes(32));
$_SESSION['signup_token'] = $token;

// Otomatis menyesuaikan path
$host = $_SERVER['HTTP_HOST'];
$path = dirname(dirname($_SERVER['PHP_SELF'])); // naik 1 folder dari /admin/
echo "Signup URL: http://" . $host . $path . "/signup.php?token=" . $token;
?>