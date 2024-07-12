<!DOCTYPE HTML>
<html lang="en">

<head><title>Disease</title>
  <link rel="icon" href="administrator.png">
    <style>
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
            border: 3px solid #f6efef;
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
        }.back-button {
      display: inline-block;
      padding: 5px 2px;
      text-decoration: none;
      font-size:20px;
      background-color: #3498db;
            margin:20px;
      color: #fff;
      border: 1px solid lightgreen;
      border-radius: 5px;
      transition: background-color 0.3s;
      float:left;
    }

    .back-button:hover {
      background-color: #2980b9;}
    </style>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body><a class="back-button" href="main.php">Back</a>
    <div class="content">
        <h1 class="heading"><center>DISEASE</center></h1>
        <h4 style="text-align:center">-Your Life Is Our Priority</h4>

        <div class="form">
            <b>ADD DISEASE!!!</b>
            <h1></h1>
            <form id="diseaseForm" method="POST">
                <hr><hr>
                Enter Disease ID:<br>
                <input type="number" name="dis_id" required><br>
                Enter Disease Name:<br>
                <input type="text" name="dis_name" required><br>
                Enter Disease Class:<br>
                <input type="text" name="dis_class" required><br>
                Enter Medicine ID :<br>
                <input type="number" name="med_id" required><br>
                <input type="submit" class="button" value="INSERT">
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $dis_id = $_POST["dis_id"];
            $dis_name = $_POST["dis_name"];
            $dis_class = $_POST["dis_class"];
            $med_id = $_POST["med_id"];

            try {
                $link = mysqli_connect("localhost", "root", "", "dbms");

                if ($link === FALSE) {
                    throw new Exception("Could not connect: " . mysqli_connect_error());
                }

                // Check if the Medicine ID exists in the medicine table
                $check_med_query = "SELECT COUNT(*) FROM medicine WHERE med_id = ?";
                $check_med_stmt = mysqli_prepare($link, $check_med_query);
                mysqli_stmt_bind_param($check_med_stmt, 'i', $med_id);
                mysqli_stmt_execute($check_med_stmt);
                mysqli_stmt_bind_result($check_med_stmt, $med_count);
                mysqli_stmt_fetch($check_med_stmt);
                mysqli_stmt_close($check_med_stmt);

                if ($med_count == 0) {
                    throw new Exception("Error: Medicine ID does not exist");
                }

                // Check if the Disease ID already exists
                $check_query = "SELECT COUNT(*) FROM disease WHERE dis_id = ?";
                $check_stmt = mysqli_prepare($link, $check_query);
                mysqli_stmt_bind_param($check_stmt, 'i', $dis_id);
                mysqli_stmt_execute($check_stmt);
                mysqli_stmt_bind_result($check_stmt, $count);
                mysqli_stmt_fetch($check_stmt);
                mysqli_stmt_close($check_stmt);

                if ($count > 0) {
                    throw new Exception("Error: Disease ID already exists");
                }

                $sqli = "INSERT INTO disease VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $sqli);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'isss', $dis_id, $dis_name, $dis_class, $med_id);
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