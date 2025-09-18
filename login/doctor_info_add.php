<?php
    session_start();
    require '../conn.php';

    
    $drName = $_POST['drName'];
    $pass = $_POST['pass'];

    // echo $pass ,$drName;
    
    $sql = "INSERT INTO doctors (name, pass)
        VALUES ('$drName', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo "<script> alert('Doctor add successfully!')
    window.location.href = '../index.php';
    </script>";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header('../index.php');
}



?>