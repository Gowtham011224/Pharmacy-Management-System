<!DOCTYPE HTML>
<html lang="en">

<head><title>Employee</title>
    <link rel="icon" href="administrator.png">
    <style>
        body {
            background-image: url("https://images.unsplash.com/photo-1549488341-b58b3ed34f57");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            background-color: #3498db;
            color: #fff;
            padding: 15px;
            margin: 0;
        }

        form {
            margin: 20px auto;
            max-width: 500px;
            border: 3px solid #3498db;
            border-radius: 10px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input,
        select {
            width: 100%;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 2px solid #3498db;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        #btn {
            width: 100%;
            color: #fff;
            background-color: #2c3e50;
            padding: 12px;
            font-size: 18px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #btn:hover {
            background-color: #1a252f;
        }

        .button {
            width: 150px;
            height: 50px;
            background-color: #27ae60;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #218c53;
        }
        .back-button {
      display: inline-block;
      padding: 5px 2px;
      text-decoration: none;
      font-size:20px;
      background-color: white;
      color: black;
      border: 1px solid #2980b9;
      border-radius: 5px;
      transition: background-color 0.3s;
      float:left;
    }

    .back-button:hover {
      background-color: #a2e1de;}
    </style>
</head>



<body>

    <div class="content">
        <hr>
        <h1 class="heading"><a class="back-button" href="main.php">Back</a><center>EMPLOYEE</center></h1>
        <H4 style="padding-left:650px;">-Your life Is Our Priority</H4>
        <hr><br><br><br>

        <div class="form"><br><br>
            <b><center><h2>UPDATE EMPLOYEE INFORMATION!!!</h2></b>
            <form id="updateEmployeeForm" method="POST" action="" onsubmit="return validateForm()">
                Enter Employee ID to Update:<br>
                <input type="number" name="emp_id_input" required
                    value="<?php echo isset($_POST['emp_id_input']) ? $_POST['emp_id_input'] : ''; ?>"><br><br>
                <label for="attribute_to_update">Select Attribute to Update:</label>
                <select name="attribute_to_update" id="attribute_to_update" required>
                    <option value="emp_name">Employee Name</option>
                    <option value="emp_type">Employee Type</option>
                    <option value="emp_wages">Employee Wages</option>
                    <option value="emp_phoneno">Employee Phone Number</option>
                    <option value="emp_doj">Employee Date of Joining</option>
                    <option value="emp_experience">Employee Experience</option>
                    <option value="emp_qualification">Employee Qualification</option>
                    <option value="emp_mail">Employee Email</option>
                    <option value="emp_address">Employee Address</option>
                    <option value="branch_id">Branch ID</option>
                </select><br><br>
                <input type="text" name="updated_value" placeholder="Updated Value" required><br><br>
                <input type="submit" name="submit" class="button" value="UPDATE">
            </form>

           <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $emp_id = $_POST["emp_id_input"];
    $attribute_to_update = $_POST["attribute_to_update"];
    $updated_value = $_POST["updated_value"];

    // Format the date if the attribute is related to date fields
    if ($attribute_to_update == "emp_doj") {
        $updated_value = date("Y-m-d", strtotime($updated_value));
    }

    $link = mysqli_connect("localhost", "root", "", "dbms");

    if ($link === FALSE) {
        die("ERROR - Could not connect: " . mysqli_connect_error());
    }

    // Check if emp_id exists
    $check_emp_query = "SELECT * FROM employee WHERE emp_id = ?";
    $check_emp_stmt = mysqli_prepare($link, $check_emp_query);
    mysqli_stmt_bind_param($check_emp_stmt, 'i', $emp_id);
    mysqli_stmt_execute($check_emp_stmt);
    mysqli_stmt_store_result($check_emp_stmt);

    // Check if branch_id exists only when "Branch ID" is selected
    if ($attribute_to_update == "branch_id") {
        $check_branch_query = "SELECT * FROM pharmacy WHERE branch_id = ?";
        $check_branch_stmt = mysqli_prepare($link, $check_branch_query);
        mysqli_stmt_bind_param($check_branch_stmt, 's', $updated_value);
        mysqli_stmt_execute($check_branch_stmt);
        mysqli_stmt_store_result($check_branch_stmt);

        if (mysqli_stmt_num_rows($check_branch_stmt) == 0) {
            echo "<script>alert('BRANCH ID NOT FOUND IN PHARMACY TABLE! Please enter a valid branch ID.');</script>";
            mysqli_stmt_close($check_branch_stmt);
            mysqli_stmt_close($check_emp_stmt);
            mysqli_close($link);
            exit; // Stop further processing
        }

        mysqli_stmt_close($check_branch_stmt);
    }

    if (mysqli_stmt_num_rows($check_emp_stmt) == 0) {
        echo "<script>alert('EMPLOYEE ID NOT FOUND! Please enter a valid employee ID.');</script>";
    } else {
        // Continue with the update process
        switch ($attribute_to_update) {
            case "emp_name":
            case "emp_type":
            case "emp_wages":
            case "emp_phoneno":
            case "emp_doj":
            case "emp_experience":
            case "emp_qualification":
            case "emp_mail":
            case "emp_address":
            case "branch_id":
                $sqli = "UPDATE employee
                        SET $attribute_to_update=?
                        WHERE emp_id=?";

                $stmt = mysqli_prepare($link, $sqli);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'si', $updated_value, $emp_id);

                    try {
                        mysqli_stmt_execute($stmt);
                        echo "<script>alert('EMPLOYEE $attribute_to_update UPDATED SUCCESSFULLY');</script>";
                    } catch (mysqli_sql_exception $e) {
                        if (strpos($e->getMessage(), 'Cannot add or update a child row') !== false) {
                            echo "<script>alert('Error: Foreign key constraint violation for Branch ID. Please provide a valid Branch ID.');</script>";
                        } else {
                            echo "<script>alert('Error in query execution: " . $e->getMessage() . "');</script>";
                        }
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

    mysqli_stmt_close($check_emp_stmt);
    mysqli_close($link);
}
?>

            <script>
                function validateForm() {
                    var empId = document.getElementById("updateEmployeeForm").elements["emp_id_input"].value;

                    if (empId < 1) {
                        alert("Employee ID must be greater than 0");
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