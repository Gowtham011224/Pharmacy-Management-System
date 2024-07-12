<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Doctor</title>
  <link rel="icon" href="administrator.png">
    <style>
        a {
            display: inline-block;
            padding: 5px;
            margin: 5px;
            text-decoration: none;
            font-size: 20px;
            background-color: white;
            color: black;
            border: 1px solid #2980b9;
            border-radius: 5px;
            transition: background-color 0.3s;
            float: left;
        }

        a:hover {
            background-color: #a2e1de;
        }
        body {
            background-image: url("medbg1.jpg");
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
            width: 70%;
            border-radius: 4px;
            border: 3px solid gray;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
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
            width: 50%;
            max-width: 600px;
            padding: 20px;
            border: 3px solid #000;
            border-radius: 10px;
            background-color: white;
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
    </style>
</head>

<body><a href="main.php">Back</a>
    <div class="content">
        <hr>
        <h1 class="heading"><center>DOCTOR</center></h1>
        <h4 style="padding-left:40px;">-Your Trusted Healthcare Partner</h4>
        <hr><br><br><br>

        <div class="form"><br><br>
            <b><center><h2>UPDATE DOCTOR INFORMATION!!!</h2></b>
            <h1></h1>
            <form id="updateDoctorForm" method="POST" action="" onsubmit="return validateForm()">
                Enter Doctor ID to Update:<br>
                <input type="number" name="doc_id_input" required value="<?php echo isset($_POST['doc_id_input']) ? $_POST['doc_id_input'] : ''; ?>"><br><br>
                <label for="attribute_to_update">Select Attribute to Update:</label>
                <select name="attribute_to_update" id="attribute_to_update" required>
                    <option value="doc_name">Doctor Name</option>
                    <option value="doc_phoneno">Doctor Phone Number</option>
                    <option value="doc_email">Doctor Email</option>
                    <option value="hospital_name">Hospital Name</option>
                    <option value="hospital_loc">Hospital Location</option>
                    <!-- Add more options as needed for other attributes -->
                </select><br><br>
                <input type="text" name="updated_value" placeholder="Updated Value" required><br><br>
                <input type="submit" name="submit" class="button" value="UPDATE">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                $doc_id = $_POST["doc_id_input"];
                $attribute_to_update = $_POST["attribute_to_update"];
                $updated_value = $_POST["updated_value"];

                try {
                    $link = mysqli_connect("localhost", "root", "", "dbms");

                    if ($link === FALSE) {
                        throw new Exception("ERROR - Could not connect: " . mysqli_connect_error());
                    }

                    // Check if doc_id exists
                    $check_query = "SELECT * FROM doctor WHERE doc_id = ?";
                    $check_stmt = mysqli_prepare($link, $check_query);
                    mysqli_stmt_bind_param($check_stmt, 'i', $doc_id);
                    mysqli_stmt_execute($check_stmt);
                    mysqli_stmt_store_result($check_stmt);

                    if (mysqli_stmt_num_rows($check_stmt) == 0) {
                        throw new Exception("DOCTOR ID NOT FOUND! Please enter a valid doctor ID");
                    }

                    // Perform foreign key checks
                    if ($attribute_to_update == "hospital_name" || $attribute_to_update == "hospital_loc") {
                        $check_hospital_query = "SELECT COUNT(*) FROM hospital WHERE hospital_name = ? AND hospital_loc = ?";
                        $check_hospital_stmt = mysqli_prepare($link, $check_hospital_query);
                        mysqli_stmt_bind_param($check_hospital_stmt, 'ss', $updated_value, $updated_value);
                        mysqli_stmt_execute($check_hospital_stmt);
                        mysqli_stmt_bind_result($check_hospital_stmt, $hospital_count);
                        mysqli_stmt_fetch($check_hospital_stmt);
                        mysqli_stmt_close($check_hospital_stmt);

                        if ($hospital_count == 0) {
                            throw new Exception("Error: Hospital not found");
                        }
                    }

                    $sqli = "UPDATE doctor 
                            SET $attribute_to_update=?
                            WHERE doc_id=?";

                    $stmt = mysqli_prepare($link, $sqli);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'si', $updated_value, $doc_id);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "<b><br><center>DOCTOR $attribute_to_update UPDATED SUCCESSFULLY";
                        } else {
                            throw new Exception("Error in query execution: " . mysqli_stmt_error($stmt));
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        throw new Exception("Error in query preparation: " . mysqli_error($link));
                    }

                    mysqli_close($link);
                } catch (Exception $e) {
                    echo "<script>alert('" . $e->getMessage() . "');</script>";
                }
            }
            ?>

            <script>
                function validateForm() {
                    var docId = document.getElementById("doc_id_input").value;

                    if (docId < 1) {
                        alert("Doctor ID must be greater than 0");
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