<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (replace with your database configuration)
    $mysqli = new mysqli("168.119.235.149", "widener_test", "e4OKKS4yz1lwFvNQEGE5", "widener_test");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve user input
    $name = $_POST['name'];
    $year = $_POST['year'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to insert data into the database
    $sql = "INSERT INTO students (name, year, username, password) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $name, $year, $username, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: login.php"); // Redirect to the login page after successful registration
        exit();
    } else {
        $registrationError = "Registration failed. Please try again.";
    }

    $stmt->close();
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
