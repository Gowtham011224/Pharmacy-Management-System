<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Pharmacy</title>
  <link rel="icon" href="administrator.png">    
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Roboto', sans-serif;
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
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
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
        
        .message {
            text-align: center;
            font-size: 18px;
            color: #2c3e50;
        }
    </style>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <div class="content">
        <h1><a class="back-button" href="main.php">Back</a>PHARMACY</h1>
        <H4 style="text-align: center;">-Your life Is Our Priority</H4>

        <div class="form">
            <h2 style="text-align:center">ADD PHARMACY</h2>
            <form id="pharmacyForm" method="POST" action="">
                Enter Branch ID:<br>
                <input type="number" name="branch_id" min=1 required><br>
                Enter Branch Name:<br>
                <input type="text" name="branch_name" required><br>
                Enter Branch Phone Number:<br>
                <input type="text" name="branch_phoneno" required><br>
                Enter Branch Email:<br>
                <input type="email" name="branch_mail" required><br>
                Enter Branch Location:<br>
                <input type="text" name="branch_location" required><br>
                <input type="submit" id="btn" value="INSERT">
            </form>
        </div>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $branch_id = $_POST["branch_id"];
        $branch_name = $_POST["branch_name"];
        $branch_phoneno = $_POST["branch_phoneno"];
        $branch_mail = $_POST["branch_mail"];
        $branch_location = $_POST["branch_location"];

        $link = mysqli_connect("localhost", "root", "", "dbms");

        if ($link === FALSE) {
            die("ERROR - Could not connect: " . mysqli_connect_error());
        }

        // Check if the branch ID already exists
        $check_query = "SELECT COUNT(*) FROM pharmacy WHERE branch_id = ?";
        $check_stmt = mysqli_prepare($link, $check_query);
        mysqli_stmt_bind_param($check_stmt, 'i', $branch_id);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $count);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt);

        if ($count > 0) {
            echo "<script>alert('Error: Branch ID already exists');</script>";
        } else {
            $sqli = "INSERT INTO pharmacy VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $sqli);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'issss', $branch_id, $branch_name, $branch_phoneno, $branch_mail, $branch_location);
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
    </div>
</body>

</html>
