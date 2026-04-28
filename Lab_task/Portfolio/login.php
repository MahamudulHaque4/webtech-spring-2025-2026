<?php
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php 
session_start();
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br/><br/>
    <input type="password" name="password" placeholder="Password" required><br/><br/>

    <button type="submit" name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if(password_verify($pass, $user['password'])) {

            $_SESSION['user'] = $user['first_name'];

            header("Location: dashboard.php");
        } else {
            echo "Wrong Password!";
        }

    } else {
        echo "User not found!";
    }
}
?>

</body>
</html>