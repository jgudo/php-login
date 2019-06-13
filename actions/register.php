<?php
include '../config/dbhandler.php';

function add() {
    global $db;

   
    if (isset($_POST['signup'])) {
        $firstname = htmlentities($_POST['firstname']);
        $lastname = htmlentities($_POST['lastname']);
        $username = htmlentities($_POST['username']);
        $pw = htmlentities($_POST['password']);

        $db->register($firstname, $lastname, $username, $pw);
        echo 'Registration successful!';
    }
}
?>