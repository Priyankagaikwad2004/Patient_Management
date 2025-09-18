<?php
require '../conn.php';

$id = $_POST['id'];
$condition = $_POST['dis'];
$Prescription = $_POST['Prescription'];


// Validate ID before executing query
if ($id <= 0) {
    die("Invalid ID");
}

// Escape strings to prevent SQL injection
$condition = mysqli_real_escape_string($conn, $condition);
$Prescription = mysqli_real_escape_string($conn, $Prescription);

// Corrected SQL query (Note: `condition` is a reserved word, so use backticks)
$sql = "UPDATE user_info SET `condition` = '$condition', `Prescription` = '$Prescription' WHERE id = $id";

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: Diagnosed_patient.php");
    exit();

} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
