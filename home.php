<?php
session_start();

if(!isset($_SESSION['user']) && !isset($_SESSION['active'])) {
    header('location: signup.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <h1>Home</h1>
</body>
</html>