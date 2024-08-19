<?php
include_once 'include/db.php';
include_once 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($_POST) {
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->role_id = 2; // Assuming '2' is for a regular user

    if($user->register()) {
        echo "Registration successful!";
    } else {
        echo "Failed to register.";
    }
}
?>

<form action="register.php" method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Register">
</form>
