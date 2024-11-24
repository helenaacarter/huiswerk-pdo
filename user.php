<?php
session_start(); 

class User {
    private $pdo;

    public function __construct($db)
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=$db", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error met database: " . $e->getMessage());
        }
    }

    public function register($name, $email, $password)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Fout bij de registratie: " . $e->getMessage();
            return false;
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Sessie starten en gegevens opslaan
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['logged_in'] = true;

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error met inloggen: " . $e->getMessage();
            return false;
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }
}
?>
