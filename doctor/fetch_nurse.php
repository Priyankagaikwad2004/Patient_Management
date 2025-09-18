<?php
require '../conn.php'; // Ensure this path is correct

$sql = "SELECT name FROM nurse"; 
$result = $conn->query($sql); // Execute the query

$nurses = []; // Use plural for clarity

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nurses[] = $row['name'];
    }
}

echo json_encode($nurses); // Return JSON response
$conn->close();
?>
