<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fp";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get feedback data
$sql = "SELECT * FROM feedback2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>User Feedback</h1>";
    while ($row = $result->fetch_assoc()) {
        echo "<p>Name: " . htmlspecialchars($row['name']) . "</p>";
        echo "<p>Address: " . htmlspecialchars($row['address']) . "</p>";
        echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
        echo "<p>Complaint: " . htmlspecialchars($row['complaint']) . "</p>";
        echo "<p>Suggestions: " . htmlspecialchars($row['suggestions']) . "</p>";
        echo "<hr>";
    }
} else {
    echo "No feedback found.";
}

$conn->close();
?>
