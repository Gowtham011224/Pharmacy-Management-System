<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Employee</title>
  <link rel="icon" href="administrator.png">
    <style>
        body {
            background-image: url("medbg1.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0.5px;font-size:17px;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            background-color: lightgray;
            padding: 15px;
            margin: 0;
            color: #333;
        }

        h4 {
            text-align: center;
            margin: 10px 0;
            color: #555;background-color: lightgray;
        }

        input {
            width: 70%;
            border-radius: 4px;
            border: 3px solid #f6efef;background-color: lightgray;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .button {
            width: 100%;
            height: 50px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #45a049;
        }

        div.content {
            padding: 20px;
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .back-button:hover {
            background-color: lightgreen;
        }
        .back-button {
      display: inline-block;
      padding: 5px 2px;
      text-decoration: none;
      font-size:20px;margin-left:20px;
      background-color: white;
      color: black;
      border: 1px solid #2980b9;
      border-radius: 5px;
      transition: background-color 0.3s;
      float:left;
    }
        
    </style>
</head>

<body><a class="back-button" href="main.php">Back</a>
    <div class="content">
        <hr>
        <h1 class="heading"><CENTER>EMPLOYEE</CENTER></h1>
        <H4 >-Your life Is Our Priority</H4>
        <hr><br>
        <div class="form"><br>
            <b>ADD EMPLOYEE!!!</b>
                <form id="employeeForm" method="POST">
                <hr><hr>
                Employee ID:<br>
                <input type="number" name="emp_id" min=0 required><br><br>
                Name:<br>
                <input type="text" name="emp_name" required><br><br>
                Type of employee:<br>
                <input type="text" name="emp_type" required><br><br>
                Wages:<br>
                <input type="number" name="emp_wages" min=0 required><br><br>
                Phone Number:<br>
                <input type="text" name="emp_phoneno" maxlength="10" required><br><br>
                Date of Joining (yyyy-mm-dd):<br>
                <input type="text" name="emp_doj" pattern="\d{4}-\d{2}-\d{2}" placeholder="yyyy-mm-dd" required><br><br>
                Experience:<br>
                <input type="text" name="emp_experience" min=0 required><br><br>
                Qualification:<br>
                <input type="text" name="emp_qualification" required><br><br>
                Email:<br>
                <input type="email" name="emp_mail" required><br><br>
                Address:<br>
                <input type="text" name="emp_address" required><br><br>
                Branch ID:<br>
                <input type="number" name="branch_id"  min="1" required><br><br>
                <input type="submit" class="button" value="INSERT"><br>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $emp_id = $_POST["emp_id"];
        $emp_name = $_POST["emp_name"];
        $emp_type = $_POST["emp_type"];
        $emp_wages = $_POST["emp_wages"];
        $emp_phoneno = $_POST["emp_phoneno"];
        $emp_doj_input = $_POST["emp_doj"];
        $emp_doj = date_create_from_format('Y-m-d', $emp_doj_input);
        $emp_experience = $_POST["emp_experience"];
        $emp_qualification = $_POST["emp_qualification"];
        $emp_mail = $_POST["emp_mail"];
        $emp_address = $_POST["emp_address"];
        $branch_id = $_POST["branch_id"];

        $emp_doj_input = $_POST["emp_doj"];
        $emp_doj = date_create_from_format('Y-m-d', $emp_doj_input);

        if (!$emp_doj) {
            die("Invalid date format. Use yyyy-mm-dd for the date of joining.");
        }

        // Store the result of date_create_from_format in a variable
        $formatted_doj = $emp_doj->format('Y-m-d');

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

        // Check if branch_id exists in the pharmacy table
        $check_branch_query = "SELECT * FROM pharmacy WHERE branch_id = ?";
        $check_branch_stmt = mysqli_prepare($link, $check_branch_query);
        mysqli_stmt_bind_param($check_branch_stmt, 'i', $branch_id);
        mysqli_stmt_execute($check_branch_stmt);
        mysqli_stmt_store_result($check_branch_stmt);

        if (mysqli_stmt_num_rows($check_emp_stmt) > 0) {
            echo '<script>alert("EMPLOYEE ID ALREADY EXISTS! Please choose a different ID.");</script>';
        } elseif (mysqli_stmt_num_rows($check_branch_stmt) == 0) {
            echo '<script>alert("BRANCH ID NOT FOUND! Please enter a valid branch ID.");</script>';
        } else {
            $sqli = "INSERT INTO employee VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $sqli);

            if ($stmt) {
                // Pass the variable by reference
               mysqli_stmt_bind_param($stmt, 'isssisssssi', $emp_id, $emp_name, $emp_type, $emp_wages, $emp_phoneno, $formatted_doj, $emp_experience, $emp_qualification, $emp_mail, $emp_address, $branch_id);


                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('RECORD ADDED SUCCESSFULLY');</script>";
                } else {
                    $error_message = mysqli_stmt_error($stmt);
                    echo "Error in query execution: " . $error_message;
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error in query preparation: " . $error_message;
            }
        }

        mysqli_stmt_close($check_emp_stmt);
        mysqli_stmt_close($check_branch_stmt);
        mysqli_close($link);
    }
    ?>
</body>

</html>