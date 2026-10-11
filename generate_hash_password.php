<?php

$password = 'uems123'; 
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

echo "Hashed password: " . $hashed_password;
?>