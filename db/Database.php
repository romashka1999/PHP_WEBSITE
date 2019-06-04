<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $database;

    private $connection;

    public function __construct()
    {
        $config = require 'config.php';
        $this->servername = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['database'];
        $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function loginUser($email, $password)
    {
        $stmt = $this->getConnection()
            ->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($password, $user['password'])){
            return false;
        }
        $_SESSION['currentUser'] = $user;
        return true;
    }

    public function signUpUser($name,$lastname,$username,$email,$picture,$password)
    {

        // variable to store the current time in seconds
        $currentTimeinSeconds = time();

        // converts the time in seconds to current date
        $regTime = date('Y-m-d-h-m-s', $currentTimeinSeconds);

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $verification = 0;
        $cristal = 100;
        $vkey = md5(time().$username);

        //connect to mysql
        $config = require 'config.php';
        $servername = $config['host'];
        $usernamecon = $config['username'];
        $password = $config['password'];
        $database = $config['database'];

        $conn = new PDO("mysql:host=$servername", $usernamecon, $password);
        $conn->query("use $database");


        $sql = "SELECT COUNT(id) AS numEmail FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['numEmail'] > 0){
            return false;
        }

        $sql = "SELECT COUNT(id) AS numUsername FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['numUsername'] > 0){
            return false;
        }

        $sql = "INSERT INTO users (name, lastname, username, email, password, picture, verification, vkey, cristal, reg_date)
        VALUES ('$name', '$lastname','$username','$email','$passwordHash','$picture','$verification','$vkey','$cristal','$regTime')";
        $conn->exec($sql);

        return true;
    }

    public function editUser($email,$name,$lastname,$password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'lastname' => $lastname,
            'password' => $passwordHash,
            'email' => $email,
        ];
        $sql = "UPDATE users SET name =:name, lastname =:lastname, password =:password WHERE email = :email";
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);

        $_SESSION['currentUser']['name'] = $name;
        $_SESSION['currentUser']['lastname'] = $lastname;
    }

    public function setCristal($email,$cristal)
    {
        $data = [
            'cristal' => $cristal,
            'email' => $email,
        ];
        $sql = "UPDATE users SET cristal=:cristal WHERE email =:email";
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    public function setPost($email,$postName,$postBody)
    {
        $conn = $this->getConnection();
        $sql = "INSERT INTO userposts (email, post_name, post_body)
        VALUES ('$email','$postName','$postBody')";
        $conn->exec($sql);
    }

    public function getPost($email)
    {
        $stmt = $this->getConnection()
            ->prepare("SELECT * FROM userposts WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $userPosts = $stmt->fetchAll();

        return $userPosts;
    }

    public function getAllPost()
    {
        $stmt = $this->getConnection()
            ->prepare("SELECT * FROM userposts");
        $stmt->execute();
        $posts = $stmt->fetchAll();

        return $posts;
    }

}
