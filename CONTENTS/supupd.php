<!DOCTYPE HTML>
<html lang="en">

<head><title>Pharmacy</title>
  <link rel="icon" href="administrator.png">
    <style>
        body {
            background-image: url("https://us.123rf.com/450wm/jardelbassi/jardelbassi2304/jardelbassi230401147/203506317-pharmacy-and-drugstore-blur-background-with-bokeh-image.jpg?ver=6");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            background-color: white;
            padding: 15px;
            margin: 0;
            color: #333;
        }

        input {
            width: 100%;
            border-radius: 4px;
            border: 3px solid #f6efef;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        select,
        input[type="text"] {
            width: 100%;
            border-radius: 4px;
            border: 3px solid #f6efef;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            box-sizing: border-box;
        }

        #btn {
            width: 100%;
            color: white;
            background-color: rgb(108, 22, 189);
            padding: 10px;
            font-size: large;
            border-radius: 10px;
            border: none;
            cursor: pointer;
        }

        div.content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form {
            width: 70%;
            max-width: 600px;
            padding: 20px;
            border: 3px solid #000;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .button {
            width: 100%;
            height: 50px;
            background-color: limegreen;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: green;
        }

        /* Back button styles */
        .back-button {
            display: inline-block;
            padding: 10px;
            margin: 10px;
            text-decoration: none;
            font-size: 16px;
            background-color: white;
            color: black;
            border: 1px solid #2980b9;
            border-radius: 5px;
            transition: background-color 0.3s;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .back-button:hover {
            background-color: #3498db;
            color: white;
        }

    </style>
</head>

<body>

    <div class="content">
        <h1><a class="back-button" href="main.php">Back</a>SUPPLIERS</h1>
        <h4>Your Reliable Business Partners</h4>

        <div class="form">
            <h2>UPDATE SUPPLIER INFORMATION</h2>
            <form id="updateSupplierForm" method="POST" action="" onsubmit="return validateForm()">
                Enter Supplier ID to Update:<br>
                <input type="number" name="s_id_input" required value="<?php echo isset($_POST['s_id_input']) ? $_POST['s_id_input'] : ''; ?>"><br>
                <label for="attribute_to_update">Select Attribute to Update:</label>
                <select name="attribute_to_update" id="attribute_to_update" required>
                    <option value="s_name">Supplier Name</option>
                    <option value="s_pnum">Supplier Phone Number</option>
                    <option value="s_mail">Supplier Email</option>
                    <option value="s_location">Supplier Location</option>
                    <!-- Add more options as needed for other attributes -->
                </select><br>
                <input type="text" name="updated_value" placeholder="Updated Value" required><br>
                <input type="submit" name="submit" class="button" value="UPDATE">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                $s_id = $_POST["s_id_input"];
                $attribute_to_update = $_POST["attribute_to_update"];
                $updated_value = $_POST["updated_value"];

                $link = mysqli_connect("localhost", "root", "", "dbms");

                if ($link === FALSE) {
                    die("ERROR - Could not connect: " . mysqli_connect_error());
                }

                // Check if s_id exists
                $check_query = "SELECT * FROM suppliers WHERE s_id = ?";
                $check_stmt = mysqli_prepare($link, $check_query);
                mysqli_stmt_bind_param($check_stmt, 'i', $s_id);
                mysqli_stmt_execute($check_stmt);
                mysqli_stmt_store_result($check_stmt);

                if (mysqli_stmt_num_rows($check_stmt) == 0) {
                    echo "<b><br><center>SUPPLIER ID NOT FOUND! Please enter a valid supplier ID.";
                } else {
                    $sqli = "UPDATE suppliers 
                            SET $attribute_to_update=?
                            WHERE s_id=?";

                    $stmt = mysqli_prepare($link, $sqli);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'si', $updated_value, $s_id);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "<b><br><center>SUPPLIER $attribute_to_update UPDATED SUCCESSFULLY";
                        } else {
                            $error_message = mysqli_stmt_error($stmt);
                            echo "Error in query execution: " . $error_message;
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error in query preparation: " . $error_message;
                    }
                }

                mysqli_close($link);
            }
            ?>

            <script>
                function validateForm() {
                    var sId = document.getElementById("s_id_input").value;

                    if (sId < 1) {
                        alert("Supplier ID must be greater than 0");
                        return false;
                    }

                    // You can add more validation checks here if needed

                    return true;
                }
            </script>
        </div>
    </div>

</body>

</html>
