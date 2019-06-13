<?php
class DBHandler {
    private $db;

    function __construct() {
        $this->connect();
    }

    public function getInstance() {
        return $this->db;
    }

    private function connect() {
        define('HOST', 'localhost');
        define('USERNAME', 'root');
        define('PASSWORD', '');

        try {
            $conn_string = "mysql:host=" . HOST . ";dbname=login";
            $conn_array = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
            );
            $this->db = new PDO($conn_string, USERNAME, PASSWORD, $conn_array);
        } catch(PDOException $e) {
            $this->db = null;
        }
    }

    function register($fname, $lname, $username, $pw) {
        try {
            $query = "INSERT INTO user (firstname, lastname, username, password) VALUES (:fname, :lname, :username, :pw)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
            $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':pw', $pw, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $this->db = null;
            echo 'Error inserting: ' . $e->getMessage();
        }
    }

    function login($username, $pw) {
        try {
            $query = "SELECT * FROM user WHERE username = :username LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch();
                echo $result['password'] . '<br>';
                if (password_verify($pw, $result['password'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $this->db = null;
            echo $e->getMessage();
        }
    }
    function logout() {
        session_destroy();
        session_unset($_SESSION['user']);
        session_unset($_SESSION['active']);
    }
}

$db = new DBHandler();

if ($db->getInstance() === null) {
    die("Cannot establish database connection");
}


?>