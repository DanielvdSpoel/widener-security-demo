<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (replace with your database configuration)
    $mysqli = new mysqli("localhost", "demo", "9S6WAL3VIxfLG6IztksA", "demo");
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve user input without proper validation
    $name = $_POST['name'];
    $year = $_POST['year'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO students (name, year, username, password) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $name, $year, $username, $hashedPassword);
    if ($stmt->execute() === TRUE) {
        header("Location: login.php"); // Redirect to login page after successful registration
        exit();
    } else {
        $registrationError = "Registration failed. Please try again.";
    }

    $mysqli->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
<h1>Register for an Account</h1>

<?php if (isset($registrationError)) : ?>
    <p style="color: red;"><?php echo $registrationError; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="year">Year:</label>
    <input type="text" name="year" required><br>

    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="text" name="password" required><br>

    <input type="submit" value="Register">
</form>
</body>
</html>
