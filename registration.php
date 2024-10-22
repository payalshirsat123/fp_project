<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $companyName = htmlspecialchars(trim($_POST['companyName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $wasteType = htmlspecialchars(trim($_POST['wasteType']));

    // Database connection (replace with your own credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO companies (companyName, email, phone, address, wasteType) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $companyName, $email, $phone, $address, $wasteType);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
