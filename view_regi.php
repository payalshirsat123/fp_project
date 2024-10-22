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
$sql = "SELECT * FROM companies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>User Feedback</h1>";
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>companyName:</strong> " . htmlspecialchars($row['companyName']) . "</p>";
        echo "<p><strong>email:</strong> " . htmlspecialchars($row['email']) . "</p>"; // Corrected this line
        echo "<p><strong>phone:</strong> " . htmlspecialchars($row['phone']) . "</p>"; // Corrected this line
        echo "<p><strong>address:</strong> " . htmlspecialchars($row['address']) . "</p>"; // Corrected this line
     
        echo "<p><strong>wasteType:</strong> " . htmlspecialchars($row['wasteType']) . "</p>";
        echo "<hr>";
    }
} else {
    echo "No feedback found.";
}

$conn->close();
?>
