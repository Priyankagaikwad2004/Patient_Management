<?php
require '../conn.php'; // Ensure conn.php is correct

$sql = "SELECT name FROM doctors"; // Change to `doctor` if table name is wrong
$result = $conn->query($sql);

$doctors = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row['name'];
    }
}

echo json_encode($doctors); // Return JSON response
$conn->close();
?>
