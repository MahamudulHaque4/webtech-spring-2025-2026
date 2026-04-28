<?php
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<form method="POST">
    <input type="text" name="first_name" placeholder="First Name" required><br/><br/>
    <input type="text" name="last_name" placeholder="Last Name" required><br/><br/>
    <input type="email" name="email" placeholder="Email" required><br/><br/>
    <input type="password" name="password" placeholder="Password" required><br/><br/>

    <button type="submit" name="signup">Register</button>
</form>

<?php
if(isset($_POST['signup'])) {

    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, password)
            VALUES ('$first', '$last', '$email', '$pass')";

    if($conn->query($sql)) {
        echo "Signup Successful! <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

</body>
</html>