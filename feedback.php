<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "feedback_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback_type = $_POST["feedback_type"] ?? "";
    $description = $_POST["description"] ?? "";
    $anonymity = isset($_POST["anonymity"]) ? "Yes" : "No";

    if (empty($feedbackType) || empty($description)) {
        echo "Type and Description are required.";
        exit;
    }

    // Generate a unique ID
    $id = uniqid();

    // Prepare SQL statement
    $sql = "INSERT INTO feedback_entries (id, feedback_type, description, anonymity) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement.";
        exit;
    }

    // Bind parameters and execute
    $stmt->bind_param("ssss", $id, $feedbackType, $description, $anonymity);
    $result = $stmt->execute();

    if ($result === false) {
        echo "Error executing statement.";
        exit;
    }

    echo "Feedback submitted successfully.";

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
