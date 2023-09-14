<?php
session_start();
// Connect to the database (replace with your database configuration)
$mysqli = new mysqli("168.119.235.149", "widener_test", "e4OKKS4yz1lwFvNQEGE5", "widener_test");

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
        <?php endif; ?>
    </nav>

    <h2>Student List</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Year</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </body>
    </html>

<?php
$mysqli->close();
?>