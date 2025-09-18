<?php
// Database connection
require '../conn.php';

// Get form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$bloodGroup = $_POST['bloodGroup'];
$address = $_POST['address'];
$contactNumber = $_POST['contactNumber'];
$doctor = $_POST['doctor'];

// SQL query to insert data into the table
$sql = "INSERT INTO user_info (name, weight, blood_group, address, contact_number,age,doctor_name)
        VALUES ('$name', '$weight', '$bloodGroup', '$address', '$contactNumber','$age','$doctor')";

// Check if the query was successful
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
