<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Connect to the database (replace with your database configuration)
$mysqli = new mysqli("localhost", "demo", "9S6WAL3VIxfLG6IztksA", "demo");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if a user is logged in
$loggedInUser = isset($_SESSION['user']) ? $_SESSION['user'] : null;

// Get all students from the database
$sql = "SELECT * FROM students";
$result = $mysqli->query($sql);
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Student List</title>
    </head>
    <body>
    <nav>
        <h1>Welcome to the Student Portal</h1>
        <?php if ($loggedInUser) : ?>
            <p>Welcome, <?= $loggedInUser ?></p>
        <?php else : ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>

        <?php endif; ?>
    </nav>

    <h2>Student List</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Year</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='name'>" .  $row['username'] . "</td>";
            echo "<td class='year'>" . $row['year'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </body>
    </html>

<?php
$mysqli->close();
?>