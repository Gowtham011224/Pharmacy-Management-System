<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Pharmacy</title>
  <link rel="icon" href="administrator.png">    
    <style>
        body {
            background-image: url("medbg.jpg");
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
            margin: 0; font-size: 1cm;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 30px;
        }

        .form {
            width: 50%;
            padding: 20px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 3px solid #f6efef;
            box-sizing: border-box;
            font-size: 16px;
        }

        .button {
            width: 100%;
            height: 50px;
            background-color: limegreen;
            border-radius: 30px;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: green;
        }

        h2 {
            text-align: center;
        }

        hr {
            border: 0;
            height: 1px;
            background: #333;
            margin-bottom: 20px;
        }

        .heading {
            text-align: center;
            color: #333;
            font-size: 0.5cm;
            font-weight:bold;  
        } a {
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
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
<body>
    <a href="main.php">Back</a>

    <div class="content">
        <div class="form">
            <h1>SUPPLIER</h1>
            <h4><center>-Your life Is Our Priority</center></h4>
            <div class="heading">ADD SUPPLIER</div>
            <form id="supplierForm" method="POST">
                <hr>
                Enter Supplier ID:<br>
                <input type="number" name="s_id" min=1 required><br>

                Enter Supplier Name:<br>
                <input type="text" name="s_name" required><br>

                Enter Supplier Phone Number:<br>
                <input type="text" name="s_pnum" required><br>

                Enter Supplier Email:<br>
                <input type="email" name="s_mail" required><br>

                Enter Supplier Location:<br>
                <input type="text" name="s_location" required><br>

                <input type="submit" class="button" value="INSERT"><br>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $s_id = $_POST["s_id"];
        $s_name = $_POST["s_name"];
        $s_pnum = $_POST["s_pnum"];
        $s_mail = $_POST["s_mail"];
        $s_location = $_POST["s_location"];

        $link = mysqli_connect("localhost", "root", "", "dbms");

        if ($link === FALSE) {
            die("ERROR - Could not connect: " . mysqli_connect_error());
        }

        // Check if the Supplier ID already exists
        $check_query = "SELECT COUNT(*) FROM suppliers WHERE s_id = ?";
        $check_stmt = mysqli_prepare($link, $check_query);
        mysqli_stmt_bind_param($check_stmt, 'i', $s_id);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $count);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt);

        if ($count > 0) {
            echo "<script>alert('Error: Supplier ID already exists');</script>";
        } else {
            $sqli = "INSERT INTO suppliers VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $sqli);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'issss', $s_id, $s_name, $s_pnum, $s_mail, $s_location);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>showAlert('Record added successfully');</script>";
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
</body>

</html>
