<?php
session_start();
require '../conn.php';
if (isset($_SESSION["username"])) {
    $name = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management System</title>
    <link rel="stylesheet" href="../CSS/home_page.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Dr. <?php echo $name; ?></h1>
    </div>

    <div class="search-section">
        <input type="text" class="search-bar" id="searchBar" placeholder="🔍 Search for patients...">
        <a href="Diagnosed_patient.php"><button class="view-button">Diagnosed patient</button></a>
    </div>

    <div class="table-container">
        <table id="patientTable">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Action</th>
                </tr>
            </thead>

<?php

// Fetch patient data
$sql = "SELECT * FROM user_info WHERE `doctor_name` = '$name' AND `prescription` IS NULL";
$result = $conn->query($sql);

$patients = [];

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $name = $row['name'];
        $age = $row['age'];
        $weight = $row['weight'];
        $id = $row['id'];
        

            echo "<tbody>
                <tr>
                    <td> $name </td>
                    <td>$age</td>
                    <td>$weight</td>
                    <td><form action='patient_dignosis.php' method='POST'>
                            <input type='hidden' name='id' value=$id>
                            <button class='view-button' type='submit'>View</button>
                        </form> 
                    </td>
                </tr>
            </tbody>";
    
    }
}

?>
        </table>
    </div>
</div>

<script>
    // Get the search bar element
    const searchBar = document.getElementById('searchBar');

    // Add an input event listener to the search bar
    searchBar.addEventListener('input', function () {
        const searchTerm = searchBar.value.toLowerCase(); // Get the search term and convert to lowercase
        const rows = document.querySelectorAll('#patientTable tbody tr'); // Get all table rows

        // Loop through each row
        rows.forEach(row => {
            const patientName = row.cells[0].textContent.toLowerCase(); // Get the patient name from the first column

            // If the search term is empty, show all rows (home screen)
            if (searchTerm === '') {
                row.style.display = ''; // Show the row
            }
            // If the patient name includes the search term, show the row
            else if (patientName.includes(searchTerm)) {
                row.style.display = ''; // Show the row
            }
            // Otherwise, hide the row
            else {
                row.style.display = 'none'; // Hide the row
            }
        });
    });
</script>

</body>
</html>


<?php

}
else {
    echo " Dont Try to Hack the System";
}
?>
