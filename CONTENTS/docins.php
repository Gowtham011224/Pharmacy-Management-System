<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Doctor</title>
  <link rel="icon" href="administrator.png">
    <style>
        body {
            background-image: url("medbg1.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            font-size:20px;
            font-family: 'Arial', sans-serif;
            color: black;
        }

        h1 {
            text-align: center;
            background-color: white;
            padding: 15px;
            margin: 0;
            color: #333;
        }

        h4 {
            text-align: center;
            margin: 10px 0;
            color: #555;
        }

        input {
            width: 70%;
            border-radius: 4px;
            border: 3px solid #f6efef;
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
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form {
            text-align: left;
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
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body><a class="back-button" href="main.php">Back</a>
    <div class="content">
        <h1>Doctor</h1>
        <h4>Your life is our priority</h4>

        <div class="form">
            <b>ADD DOCTOR</b>
            <form id="doctorForm" method="POST">
                <hr>
                Doctor ID:<br>
                <input type="number" name="doc_id" required><br>
                Doctor Name:<br>
                <input type="text" name="doc_name" required><br>
                Doctor Phone Number:<br>
                <input type="text" name="doc_phoneno" required><br>
                Doctor Email:<br>
                <input type="email" name="doc_email" required><br>
                Hospital Name:<br>
                <input type="text" name="hospital_name" required><br>
                Hospital Location:<br>
                <input type="text" name="hospital_loc" required><br>
                <input type="submit" class="button" value="INSERT">
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $doc_id = $_POST["doc_id"];
            $doc_name = $_POST["doc_name"];
            $doc_phoneno = $_POST["doc_phoneno"];
            $doc_email = $_POST["doc_email"];
            $hospital_name = $_POST["hospital_name"];
            $hospital_loc = $_POST["hospital_loc"];

            try {
                $link = mysqli_connect("localhost", "root", "", "dbms");

                if ($link === FALSE) {
                    throw new Exception("ERROR - Could not connect: " . mysqli_connect_error());
                }

                // Check if the Doctor ID already exists
                $check_query = "SELECT COUNT(*) FROM doctor WHERE doc_id = ?";
                $check_stmt = mysqli_prepare($link, $check_query);
                mysqli_stmt_bind_param($check_stmt, 'i', $doc_id);
                mysqli_stmt_execute($check_stmt);
                mysqli_stmt_bind_result($check_stmt, $count);
                mysqli_stmt_fetch($check_stmt);
                mysqli_stmt_close($check_stmt);

                if ($count > 0) {
                    throw new Exception("Error: Doctor ID already exists");
                }

                $sqli = "INSERT INTO doctor VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $sqli);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'isssss', $doc_id, $doc_name, $doc_phoneno, $doc_email, $hospital_name, $hospital_loc);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script>showAlert('Record added successfully');</script>";
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
    </div>
</body>

</html>
