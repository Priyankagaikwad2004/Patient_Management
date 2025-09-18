<?php
session_start();
    include '../conn.php';
    $Username = $_POST['Username'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM doctors WHERE `name`= '$Username'";
    $result = mysqli_query($conn, $sql);
    
    
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = $result->fetch_assoc()) {

            

            if($pass === $row['Pass']){
                echo "<script>alert('login Successful!')</script>";
                $drName = $row['name'];
                $_SESSION["username"] = $drName;
                
            } else {
                echo "Invalid Password";
            }
        }

    } else{
        echo "Invalid Username!!!";
    }

    echo "
            <script>
                var userName = '$drName';

                // Encode values and pass them in the URL
                window.location.href = '../doctor/doctor.php?name=' + encodeURIComponent(userName);
            </script>";
?>
