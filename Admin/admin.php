<?php
// Database connection details
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

// Check if delete form is submitted
if (isset($_POST['delete'])) {
    // Get array of selected feedback entry IDs
    $deleteIDs = $_POST['delete_ids'];

    // Delete selected feedback entries
    foreach ($deleteIDs as $id) {
        $deleteQuery = "DELETE FROM feedback_entries WHERE id=$id";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "<p>Feedback entry with ID $id deleted successfully.</p>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// SQL query to fetch feedback entries
$sql = "SELECT * FROM feedback_entries";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Feedback Entries</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo" class="logo">
            <h1>Admin Panel - Feedback Entries</h1>
        </div>
        
        <!-- Delete Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <button type="submit" name="delete" class="delete-btn">Delete Selected</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Feedback Type</th>
                        <th>Description</th>
                        <th>Anonymity</th>
                        <th>Date</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["feedback_type"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . $row["anonymity"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td><input type='checkbox' name='delete_ids[]' value='" . $row["id"] . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No feedback entries found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
