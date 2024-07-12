<!DOCTYPE HTML>
<html lang="en">

<head><title>Pharmacy</title>
  <link rel="icon" href="administrator.png">
    <style>
        body {
            background: url("https://us.123rf.com/450wm/jardelbassi/jardelbassi2304/jardelbassi230401147/203506317-pharmacy-and-drugstore-blur-background-with-bokeh-image.jpg?ver=6") no-repeat fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            background-color: #3498db;
            padding: 15px;
            margin: 0;
            color: #fff;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form {
            width: 50%;
            padding: 20px;
            border: 3px solid #000;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input,
        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 2px solid #3498db;
            box-sizing: border-box;
            font-size: 16px;
        }

        #btn {
            width: 100%;
            color: #fff;
            background-color: rgb(108, 22, 189);
            padding: 10px;
            font-size: large;
            border-radius: 10px;
            border: none;
            cursor: pointer;
        }

        .button {
            width: 100%;
            height: 50px;
            background-color: limegreen;
            border-radius: 30px;
            border: none;
            cursor: pointer;
        }

        .button:hover,
        #btn:hover {
            background-color: green;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        .message {
            text-align: center;
            font-size: 18px;
            color: #2c3e50;
        }

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
    </style>
</head>

<body>
    <a href="main.php">Back</a>
    <div class="content">
        <div class="form">
            <h1>PHARMACY</h1>
            <h4 style="text-align: center;">-Your life Is Our Priority</h4>
            <h2>UPDATE PHARMACY BRANCH INFORMATION</h2>
            <form id="updatePharmacyForm" method="POST" action="" onsubmit="return validateForm()">
                <label for="branch_id_input">Enter Branch ID to Update:</label>
                <input type="number" name="branch_id_input" required
                    value="<?php echo isset($_POST['branch_id_input']) ? $_POST['branch_id_input'] : ''; ?>">

                <label for="attribute_to_update">Select Attribute to Update:</label>
                <select name="attribute_to_update" id="attribute_to_update" required>
                    <option value="branch_name">Branch Name</option>
                    <option value="branch_phoneno">Branch Phone Number</option>
                    <option value="branch_mail">Branch Email</option>
                    <option value="branch_location">Branch Location</option>
                    <!-- Add more options as needed for other attributes -->
                </select>

                <label for="updated_value">Updated Value:</label>
                <input type="text" name="updated_value" placeholder="Updated Value" required>

                <input type="submit" name="submit" class="button" value="UPDATE">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                $branch_id = $_POST["branch_id_input"];
                $attribute_to_update = $_POST["attribute_to_update"];
                $updated_value = $_POST["updated_value"];

                $link = mysqli_connect("localhost", "root", "", "dbms");

                if ($link === FALSE) {
                    die("ERROR - Could not connect: " . mysqli_connect_error());
                }

                // Check if branch_id exists
                $check_query = "SELECT * FROM pharmacy WHERE branch_id = ?";
                $check_stmt = mysqli_prepare($link, $check_query);
                mysqli_stmt_bind_param($check_stmt, 'i', $branch_id);
                mysqli_stmt_execute($check_stmt);
                mysqli_stmt_store_result($check_stmt);

                if (mysqli_stmt_num_rows($check_stmt) == 0) {
                    echo "<script>alert('BRANCH ID NOT FOUND! Please enter a valid branch ID.');</script>";
                } else {
                    // Use a switch statement to dynamically build the SQL query based on the attribute
                    switch ($attribute_to_update) {
                        case "branch_name":
                        case "branch_phoneno":
                        case "branch_mail":
                        case "branch_location":
                            // Add more cases as needed for other attributes
                            $sqli = "UPDATE pharmacy 
                                    SET $attribute_to_update=?
                                    WHERE branch_id=?";

                            $stmt = mysqli_prepare($link, $sqli);

                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, 'si', $updated_value, $branch_id);

                                if (mysqli_stmt_execute($stmt)) {
                                    echo "<script>alert('BRANCH $attribute_to_update UPDATED SUCCESSFULLY');</script>";
                                } else {
                                    $error_message = mysqli_stmt_error($stmt);
                                    echo "<script>alert('Error in query execution: $error_message');</script>";
                                }

                                mysqli_stmt_close($stmt);
                            } else {
                                echo "<script>alert('Error in query preparation');</script>";
                            }

                            break;

                        default:
                            echo "<script>alert('ERROR - Invalid attribute to update');</script>";
                    }
                }

                mysqli_close($link);
            }
            ?>

            <div class="message"></div>
        </div>
    </div>
</body>

</html>
