<?php
// Define variables for form submission
$feedback_type = $description = $anonymity = "";
$successMessage = $errorMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the key exists in $_POST before accessing it
    $feedback_type = isset($_POST["feedback_type"]) ? $_POST["feedback_type"] : "";
    $description = isset($_POST["description"]) ? $_POST["description"] : "";
    $anonymity = isset($_POST["anonymity"]) ? "Yes" : "No";

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "feedback_system";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO feedback_entries (feedback_type, description, anonymity) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $feedback_type, $description, $anonymity);

    // Execute SQL statement
    if ($stmt->execute()) {
        $successMessage = "Feedback submitted successfully!";
        // Clear form fields after successful submission
        $feedback_type = $description = $anonymity = "";
    } else {
        $errorMessage = "Error submitting feedback. Please try again later.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pavicon Feedback Form</title>
    <style>
        /* Inline CSS for simplicity */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(
                to bottom right,
                #027DFE 0%,
                #298CE7 20%,
                #519BD0 40%,
                #85AFB1 60%,
                #D9CF80 80%,
                #E3D37A 90%,
                #FFDE6A 100%
            );
            border-radius: 8px;
            padding: 20px;
        }

        .card {
            max-width: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            position: relative;
        }

        .logo {
            display: block;
            margin: 0 auto 20px; /* Center the logo horizontally */
            width: 100px;
            height: 100px;
            background-color: #000; /* Black background color */
            background-image: url("logo.jpeg"); /* Path to your logo image */
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 50%; /* For a circular logo */
        }

        .form-group {
            margin-top: 40px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .checkbox-group input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
        }

        .checkbox-group input[type="checkbox"]:checked {
            background-color: #007bff;
        }

        .checkbox-group label {
            cursor: pointer;
        }

        textarea {
            width: 97%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
        }

        button {
            padding: 10px 20px;
            background-color: #B5993A;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #B5993A;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- Using a div with background image for the logo -->
            <div class="logo"></div>
            
            <form id="feedbackForm" onsubmit="submitForm(event)">
                <div class="form-group">
                    <label>Type of Feedback:</label><br>
                    <div class="checkbox-group">
                        <input type="checkbox" id="complaint" name="feedbackType" value="complaint">
                        <label for="complaint">Complaint</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="compliment" name="feedbackType" value="compliment">
                        <label for="compliment">Compliment</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description/Comment:</label><br>
                    <textarea id="description" name="description" rows="4" cols="50" required></textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="anonymity" name="anonymity" required>
                    <label for="anonymity">I understand that my feedback will be submitted anonymously.</label>
                </div>
                <div class="button-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
