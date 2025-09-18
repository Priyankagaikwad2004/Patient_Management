<?php
require '../conn.php';

$id = $_POST['id'];
// Fetch patient data
$sql = "SELECT * FROM user_info WHERE `id` = $id";
$result = $conn->query($sql);

$patients = [];

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $age = $row['age'];
        $weight = $row['weight'];
        $blood = $row['blood_group'];
        $Dr = $row['doctor_name'];
        $Prescription = $row['Prescription'];
        $condition = $row['condition'];

// echo $id ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Diagnosis</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Container */
        .info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-items: center;
            width: 90%;
            max-width: 1000px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #007bff;
        }
        .upper{
          width: 50%;
        }

        .middle{
          width: 50%;
        }
         #input {

        }

        h2 {
            color: #007bff;
        }

        p {
            /* margin: 5px 5%; */
        }

        input, textarea, button {
            /* width: 100%; */
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

         /* Modal Styles */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .modal {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      width: 400px;
    }

    .modal h2 {
      margin-top: 0;
    }

    input, textarea {
      width: 100%;
      margin-top: 10px;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    select{
      width: 100%;
      height: 30px;
    }

    .close-btn {
      background-color: #dc3545;
    }

    .close-btn:hover {
      background-color: #c82333;
    }

    
    </style>
</head>
<body>
    <div class="info">
            <div class="upper">
        <?php
            if($row['condition'] && $row['Prescription'] == NULL){
            echo "<p><b>Name:</b> $name</p>";
            echo "<p><b>Age:</b> $age</p>";
            echo "<p><b>Weight:</b> $weight kg</p>";
            echo "<p><b>Blood Group:</b> $blood</p>";
            echo "<p><b>Doctor:</b> $Dr</p>";
            
            } else {
                echo "<p><b>Name:</b> $name</p>";
                echo "<p><b>Age:</b> $age</p>";
                echo "<p><b>Weight:</b> $weight kg</p>";
                echo "<p><b>Blood Group:</b> $blood</p>";
                echo "<p><b>Doctor:</b> $Dr</p>";
        ?>
        </div>     
        <div class="middle">  
        <?php
            echo "<div class='prc'><p><b>Disease:</b> $condition</p>";
            echo "<p><b>Prescription:</b> $Prescription</p></div>";
        } ?>
        </div>
        

        <div class="lower">
        <button onclick="openModal1()">Update Details</button>
        <button onclick="openModal()">Assign Task</button>
        </div>
</div>

        <div class="modal-overlay" id="modalOverlay">
            <div class="modal">
            <h2>Update Patient Details</h2>
            <form action="update_detail.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="dis">Disease:</label>
                <input type="text" id="dis" name="dis" placeholder="Enter Disease" required>

                <label for="Prescription">Prescription:</label>
                <textarea id="Prescription" name="Prescription" placeholder="Enter Prescription" rows="5" required></textarea>

                <button type="submit">Submit</button>
                <button type="button" class="close-btn" onclick="closeModal1()">Cancel</button>
            </form>
         </div>
    </div>

    <div class="modal-overlay" id="modal">
  <div class="modal">
    <h2>Assign Task to Nurse</h2>
    <form action="inser_assign_task.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="text" name="task" placeholder="Enter Task" required>
      <label for="nurse">Nurses</label>
      <select id="nurse" name="nurse" required>
        <option value="">Select Nurse</option>
      </select>
      <button type="submit">Submit</button>
      <button onclick="closeModal()">Close</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Open Modal
  function openModal() {
    document.getElementById("modal").style.display = "flex";
  }

  // Close Modal
  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }

  // Open Modal for prescription
  function openModal1() {
    document.getElementById("modalOverlay").style.display = "flex";
  }

  // Close Modal for prescription
  function closeModal1() {
    document.getElementById("modalOverlay").style.display = "none";
  }

  // Fetch nurse names dynamically
  $(document).ready(function() {
    $.ajax({
      url: "fetch_nurse.php",
      type: "GET",
      dataType: "json",
      success: function(data) {
        let select = $("#nurse");
        data.forEach(nurse => {
          select.append(`<option value="${nurse}">${nurse}</option>`);
        });
      },
      error: function() {
        console.error("Error fetching nurses.");
      }
    });
  });
</script>
</body>
</html>

<?php
    }
}
?>