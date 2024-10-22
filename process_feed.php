<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost"; // Change if needed
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "fp"; // Your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO feedback2 (name, address, email, complaint, suggestions) VALUES (?, ?, ?, ?, ?)");
    
    // Check if statement preparation was successful
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssss", $name, $address, $email, $complaint, $suggestions);

    // Retrieve and sanitize user input
    $name = htmlspecialchars(trim($_POST['name']));
    $address = htmlspecialchars(trim($_POST['address']));
    $email = htmlspecialchars(trim($_POST['email']));
    $complaint = htmlspecialchars(trim($_POST['complaint']));
    $suggestions = htmlspecialchars(trim($_POST['suggestions']));

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<h1>Thank You for Your Feedback!</h1>";
        echo "<p>Name: $name</p>";
        echo "<p>Address: $address</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Complaint: $complaint</p>";
        echo "<p>Suggestions: $suggestions</p>";
    } else {
        echo "Error: " . $stmt->error; // More helpful error output
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
