<?php
    class User{
        private $conn;
        private $table_name = "users";

        public $id;
        public $username;
        public $email;
        public $password;
        public $role_id;

        public function __construct($db) {
            $this -> conn = $db;
        }

    // Register 
        public function register() {
            $query = "insert into " . $this -> table_name . " (username, email, password, role_id) values (:username, :email, :password, :role_id)";
            $stmt = $this -> conn -> prepare($query);

    // Input
        $this -> username = htmlspecialchars(strip_tags($this->username));
        $this -> email = htmlspecialchars(strip_tags($this->email));
        $this -> password = password_hash($this->password, PASSWORD_DEFAULT); // hash the password
        $this -> role_id = htmlspecialchars(strip_tags($this->role_id));

    // Bind Data
        $stmt -> bindParam(":username", $this->usermame);
        $stmt -> bindParam(":email", $this->email);
        $stmt -> bindParam(":password", $this->password);
        $stmt -> bindParam(":role_id", $this->role_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Login
        public function login() {
            $query = "select id, username, password, role_id from " . $this->table_name . " where username = :username limit 0,1";
            $stmt = $this->conn->prepare($query);
            $this->username = htmlspecialchars(strip_tags($this->username));
            $stmt->bingParam(":username", $this->username);

            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $row = $stmt -> fetct(PDO::FETCT_ASSOC);

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