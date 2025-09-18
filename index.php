<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/diagnosed_patient.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            overflow-x: hidden;
        }
        a{
            margin: 50px;
            /* border-width:5px; */
            border-radius:5px;
            text-decoration: none;
            transition: all 0.5s ease;
        }
        
        .navbar {
    /* margin: auto; */
    background-color: rgba(128, 255, 187, 0.83);
    color: black;
    width: 100%;
    display: flex;
    align-items: center;
    padding: 10px 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.navbar img {
    border-radius: 8px;
    height: 60px;
    width: 60px;
    margin-right: 15px;
}

.navbar .title h1 {
    font-size: 1.8rem;
    margin: 0;
    line-height: 1.2;
}

/* Responsive */
@media (max-width: 600px) {
    .navbar {
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        padding: 10px;
    }

    .navbar img {
        height: 50px;
        width: 50px;
        margin-right: 10px;
    }

    .navbar .title h1 {
        font-size: 1.2rem;
        text-align: left;
    }
}

    .search-section {
    width: 100%;
    display: flex;
    justify-content: center;
    margin: 40px 0;
}

.search-bar {
    width: 60%;
    max-width: 400px;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 25px;
    border: 2px solid #28a745;
    outline: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.search-bar:focus {
    border-color: #20c997;
    box-shadow: 0 0 8px rgba(32, 201, 151, 0.5);
}

@media (max-width: 600px) {
    .search-bar {
        width: 90%;
        font-size: 14px;
    }
}



        @media (max-width: 900px) {
            .navbar img {
                height: 12vh;
                width: 15vw;
            }
        }

        @media (max-width: 600px) {
            .navbar img {
                height: 10vh;
                width: 20vw;
                margin-left: 2%;
                margin-right: 2%;
            }
            .content {
                flex-direction: column;
            }
        }

        .navbar h1 {
            margin: 0;
            font-size: 2rem;
        }


        button{
            margin-bottom: 5px;
            margin-top:5px;
            padding: 5px 10px;
            border-radius: 8px;
            font-size:30px;
            border: 8px solid black;
            background-color: rgb(0,0,0);
            color: white;
            transition: all 0.5s ease;
            border-top-color: rgb(103, 103, 103);
            border-left-color: rgb(103, 103, 103);
    
        }
        button:hover{
            cursor:pointer;
            background-color: rgb(103, 103, 103);
            border-top-color: rgb(179, 178, 178);
            border-left-color: rgb(179, 178, 178);
            border-bottom-color: black;
            border-right-color: black;
            box-shadow: 3px 3px 5px rgb(111, 111, 111);
        }
        h2{
            text-align: center;
        }

        table{
            border-radius: 8px;
            margin-bottom :30px;
        }
        .table-container{
            border-radius: 8px;
        }
        
        @media (max-width: 600px) {
    .content {
        display: flex;
        flex-direction: row; /* buttons in one line */
        flex-wrap: wrap;     /* wrap if needed */
        justify-content: center;
        gap: 5px;
        width: 90%;
        padding: 10px;
    }

    .content a {
        margin: 0;
        width: auto;
        flex: 1 1 30%; /* allows wrapping */
        text-align: center;
    }

    .content button {
        font-size: 14px; /* smaller font */
        padding: 6px 10px;
        margin: 0;
        width: 100%; /* fill parent <a> */
    }
}



    </style>
</head>
<body>
    <div class="navbar">
        <img src="https://th.bing.com/th/id/OIP.88pznW0RxP_aZwiLOOQyawHaHa?rs=1&pid=ImgDetMain" alt="Hospital Logo" />
        <h1>Keystone's Hospital</h1>
    </div>

    <h2>"Your Health, Our Priority.!!!"</h2>

    <div class="content">
    <a href="login/register.php"><button>Register</button></a>
    <!-- <a href="patient/add_patient.php"><button>Take Appointment</button></a> -->
    <a href="login/login.html"><button>Login</button></a>
    <a href="patient/add_patient.php"><button>Add patient</button></a>
    </div>


<div class="container" style="width:90%;">

    <div class="search-section">
        <input type="text" class="search-bar" id="searchBar" placeholder="🔍 Search for patients...">
    </div>


    <div class="table-container">
        <table id="patientTable">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Doctor</th>
                </tr>
            </thead>

<?php
require 'conn.php';
// Fetch patient data
$sql = "SELECT * FROM user_info WHERE  `prescription` IS NULL ";
$result = $conn->query($sql);

$patients = [];

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $name = $row['name'];
        $age = $row['age'];
        $weight = $row['weight'];
        $Drname = $row['doctor_name'];
        

            echo "<tbody>
                <tr>
                    <td> $name </td>
                    <td>$age</td>
                    <td>$weight</td>
                    <td>Dr. $Drname</td>
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

