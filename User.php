<?php
include_once "../includes/Database.php";

class User
{
    private $db;

    public function __construct() {
        $this->db = new Database(); 
        session_start(); 
    }

    public function register($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->db->run("INSERT INTO users (username, password) VALUES (:username, :password)", [
            ':username' => $username,
            ':password' => $hashedPassword
        ]);   
    }


    public function login($username, $password)
    {
        $userDB = $this->db->run("SELECT * FROM users WHERE username = :username", [
            ':username' => $username ])->fetch(); 
        

        if ($userDB && password_verify($password, $userDB['password'])) {
            $_SESSION["username"] = $userDB["username"];
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }
}