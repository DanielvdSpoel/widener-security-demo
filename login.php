<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (replace with your database configuration)
    $mysqli = new mysqli("localhost", "demo", "9S6WAL3VIxfLG6IztksA", "demo");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve user input without proper validation
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerable to SQL injection
    $sql = "SELECT * FROM students WHERE username = '$username' AND password = '$password'";
    echo $sql;
    $result = $mysqli->query($sql);

    if ($result->num_rows > 1) {
        // Successful login
        $_SESSION['user'] = $username;
        header("Location: index.php"); // Redirect to the home page
        exit();
    } else {
        $loginError = "Invalid username or password. Please try again.";
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h1>Login</h1>

<?php if (isset($loginError)) : ?>
    <p style="color: red;"><?php echo $loginError; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="text" name="password" required><br>

    <input type="submit" value="Login">
</form>
</body>
</html>