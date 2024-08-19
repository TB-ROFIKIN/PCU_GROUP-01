<?php
include_once 'include/db.php';
include_once 'user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($_POST) {
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if($user->login()) {
        session_start();
        $_SESSION['user_id'] = $user->id;
        $_SESSION['role_id'] = $user->role_id;
        header("Location: /view/" . ($_SESSION['role_id'] == 1 ? "admin" : "user") . "/index.php");
    } else {
        echo "Login failed.";
    }
}
?>

<form action="index.php" method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Login">
</form>
