<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Form Submission</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 80vh; */
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 2%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: none;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            align-items:center;
            margin-left: 40%;
            width: 25%;
            margin-top: 15px;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .btn{
            width: 20%;;
            margin-left: 30px; 
            background-color: rgb(152, 224, 255);
            color: black;
        }

        .btn:hover{
            background-color: rgb(87, 197, 244);
        }
    </style>
</head>
<body>
        <a href="../index.php"><button class="btn">Home</button></a>
        <div class="container">
        <form id="userForm">
        <h2>Personal Information Form</h2>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" required>

        <label for="bloodGroup">Blood Group:</label>
        <select id="bloodGroup" name="bloodGroup">
            <option value="">Select Blood Group</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" cols="50" required></textarea>

        <label for="contactNumber">Contact Number:</label>
        <input type="tel" id="contactNumber" name="contactNumber" pattern="[0-9]{10}" required>

        <label for="doctor">Doctors</label>
        <select id="doctor" name="doctor">
            <option value="">Select Doctor</option>
            <!-- Dynamic doctor names will be loaded here -->
        </select>

        <button type="button" id="submitForm">Submit</button>
    </form>

    <script>
        // Fetch doctor names dynamically
        $(document).ready(function() {
            $.ajax({
                url: "fetch_doctors.php",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let select = $("#doctor");
                    data.forEach(doctor => {
                        select.append(`<option value="${doctor}">${doctor}</option>`);
                    });
                },
                error: function() {
                    console.error("Error fetching doctors.");
                }
            });

            // Form Submission
            $("#submitForm").click(function() {
                var name = $("#name").val().trim();
                var age = $("#age").val().trim();
                var weight = $("#weight").val().trim();
                var bloodGroup = $("#bloodGroup").val();
                var address = $("#address").val().trim();
                var contactNumber = $("#contactNumber").val().trim();
                var doctor = $("#doctor").val();

                if (!name || !age || !weight || !bloodGroup || !address || !contactNumber || !doctor) {
                    alert("Please fill out all fields before submitting.");
                    return;
                }

                if (!/^[A-Za-z\s]+$/.test(name)) {
                    alert("Invalid name. Please enter only letters and spaces.");
                    return;
                }

                if (!/^\d{10}$/.test(contactNumber)) {
                    alert("Enter a valid 10-digit contact number.");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: {
                        name: name,
                        age: age,
                        weight: weight,
                        bloodGroup: bloodGroup,
                        address: address,
                        contactNumber: contactNumber,
                        doctor: doctor
                    },
                    success: function(response) {
                        alert(response);
                        $("#userForm")[0].reset();
                    },
                    error: function() {
                        alert("An error occurred while submitting the form.");
                    }
                });
            });
        });
    </script>

</div>

</body>
</html>
