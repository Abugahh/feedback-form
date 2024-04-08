<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["feedbackType"] ?? "";
    $description = $_POST["description"] ?? "";
    $anonymity = isset($_POST["anonymity"]) ? "Yes" : "No";

    if (empty($type) || empty($description)) {
        echo "Type and Description are required.";
        exit;
    }

    $newEntry = "\n" . uniqid() . "|" . $type . "|" . $description . "|" . $anonymity;

    file_put_contents("feedback_data.txt", $newEntry, FILE_APPEND);

    // Redirect back to the form or wherever you need
    header("Location: feedback_form.php");
    exit;
}
?>
