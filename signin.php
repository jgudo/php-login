<?php
    include 'config/dbhandler.php';
    session_start();

    if (isset($_POST['login'])) {
        $username = htmlentities($_POST['username']);
        $pw = htmlentities($_POST['password']);
        $result = $db->login($username, $pw);

        if ($result) {
            $_SESSION['user'] = $username;
            $_SESSION['active'] = true;
            header('location: home.php');
        } else {
            echo 'Not found';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
</head>
<body>
    <h1>Sign In</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="password" placeholder="Password">
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>