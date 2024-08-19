<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $role_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new user
    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (username, email, password, role_id) VALUES (:username, :email, :password, :role_id)";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT); // Hash the password
        $this->role_id = htmlspecialchars(strip_tags($this->role_id));

        // Bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role_id", $this->role_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Login user
    public function login() {
        $query = "SELECT id, username, password, role_id FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $stmt->bindParam(":username", $this->username);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->role_id = $row['role_id'];
                return true;
            }
        }
        return false;
    }
}
?>
