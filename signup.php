<?php
    session_start();
    include 'config/dbhandler.php';
    
    if (isset($_POST['signup'])) {

        $firstname = htmlentities($_POST['firstname']);
        $lastname = htmlentities($_POST['lastname']);
        $username = htmlentities($_POST['username']);
        $pw = password_hash(htmlentities($_POST['password']), PASSWORD_BCRYPT, array('costs' => 14));

        $result = $db->register($firstname, $lastname, $username, $pw);

        $_SESSION['user'] = $firstname;
        $_SESSION['active'] = TRUE;
        header('location: home.php');
        // echo 'Registration successful!';
    }

    if (isset($_SESSION['user']) && isset($_SESSION['active'])) {
        header('location: home.php');
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="signup">Sign Up</button>
    </form>
</body>
</html>