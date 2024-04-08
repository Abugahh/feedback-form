<?php
// Read the feedback data from the file
$feedbackFile = "feedback_data.txt";
$feedbackEntries = file($feedbackFile, FILE_IGNORE_NEW_LINES);

// Check if there are any feedback entries
if (!empty($feedbackEntries)) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Description</th>
                <th>Anonymity</th>
            </tr>";

    // Loop through each entry and display in table rows
    foreach ($feedbackEntries as $entry) {
        $fields = explode("|", $entry);
        echo "<tr>
                <td>" . $fields[0] . "</td>
                <td>" . $fields[1] . "</td>
                <td>" . $fields[2] . "</td>
                <td>" . $fields[3] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No feedback entries yet.";
}
?>
