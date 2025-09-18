<?php
    session_start();
    require '../conn.php';

    $patId = $_POST['id'];
    $task = $_POST['task'];
    $nuName = $_POST['nurse'];
    
    $sql = "INSERT INTO assigntask(nuName, task, patientId) 
            VALUES ('$nuName', '$task', '$patId')";

    if ($conn->query($sql) === TRUE) {
    echo "<script> alert('Task assign successfully!')
    window.location.href = 'Diagnosed_patient.php';
    </script>";
    
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header('patient_dignosis.php');
    }
?>