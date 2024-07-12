<!DOCTYPE HTML>
<html lang="en">
<head>
    
  <title>Medicine</title>
  <link rel="icon" href="administrator.png">
    <style>
        body {
            background-image: url("https://img.freepik.com/free-photo/medicine-capsules-global-health-with-geometric-pattern-digital-remix_53876-126742.jpg?size=626&ext=jpg&ga=GA1.1.1222169770.1704153600&semt=sph");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 2px;font-size:17px;
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
        <h1 class="heading"><CENTER>MEDICINE</CENTER></h1>
        <H4 >-Your life Is Our Priority</H4>
        <hr><br>
        <div class="form"><br>
            <b>ADD MEDICINES!!!</b>
          <form method="POST">
                <hr><hr>
                Med Id:<br>
                <input type="number" name="aa" min=0 required><br><br>
                Medicine Name:<br>
                <input type="text" name="bb" required><br><br>
                Medicine Class:<br>
                <input type="text" name="cc" required><br><br>
                Quantity Sold:<br>
                <input type="number" name="dd" min=0 required><br><br>
                Quantity Left:<br>
                <input type="number" name="ee" min=0 required><br><br>
                Manufacture Date(dd-mm-yyyy):<br>
                <input type="text" name="ff" pattern="\d{2}-\d{2}-\d{4}" placeholder="dd-mm-yyyy" required><br><br>
                Expire Date (dd-mm-yyyy):<br>
                <input type="text" name="gg" pattern="\d{2}-\d{2}-\d{4}" placeholder="dd-mm-yyyy" required><br><br>
                MRP:<br>
                <input type="number" name="hh" min=0 required><br><br>
                Supplier Id:<br>
                <input type="number" name="ii" min=0 required><br><br>
                Cost Price:<br>
                <input type="number" name="jj" min=0 required><br><br>
                Scientific Name:<br>
                <input type="text" name="kk" required><br><br>
                Medicine Type:<br>
                <input type="text" name="ll" required><br><br>
                Branch Id:format([n1,n2,..])<br>
                <input type="text" name="mm" required><br><br>
                <input type="submit" class="button" value="INSERT"><br>
            </form>
            <h1></h1>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $a = $_POST["aa"];
            $b = $_POST["bb"];
            $c = $_POST["cc"];
            $d = $_POST["dd"];
            $e = $_POST["ee"];
            $f = date_create_from_format('d-m-Y', $_POST["ff"]);
            $g = date_create_from_format('d-m-Y', $_POST["gg"]);
            $h = $_POST["hh"];
            $i = $_POST["ii"];
            $j = $_POST["jj"];
            $k = $_POST["kk"];
            $l = $_POST["ll"];
            $m = $_POST["mm"];

            if (!$f || !$g) {
                echo "<script>alert('Invalid date format. Use dd-mm-yyyy for manufacture and expiration dates.');</script>";
                die();
            }

            $link = mysqli_connect("localhost", "root", "", "dbms");

            if ($link === FALSE) {
                echo "<script>alert('ERROR - Could not connect: " . mysqli_connect_error() . "');</script>";
                die();
            }

            // Check if med_id exists
            $check_med_query = "SELECT * FROM medicine WHERE med_id = ?";
            $check_med_stmt = mysqli_prepare($link, $check_med_query);
            mysqli_stmt_bind_param($check_med_stmt, 'i', $a);
            mysqli_stmt_execute($check_med_stmt);
            mysqli_stmt_store_result($check_med_stmt);

            // Check if sup_id exists
            $check_sup_query = "SELECT * FROM suppliers WHERE s_id = ?";
            $check_sup_stmt = mysqli_prepare($link, $check_sup_query);
            mysqli_stmt_bind_param($check_sup_stmt, 'i', $i);
            mysqli_stmt_execute($check_sup_stmt);
            mysqli_stmt_store_result($check_sup_stmt);

            if (mysqli_stmt_num_rows($check_med_stmt) > 0) {
                echo '<script>alert("MEDICINE ID ALREADY EXISTS! Please choose a different ID.");</script>';
            } elseif (mysqli_stmt_num_rows($check_sup_stmt) == 0) {
                echo '<script>alert("SUPPLIER ID NOT FOUND! Please enter a valid supplier ID.");</script>';
            } else {
                $sqli = "INSERT INTO medicine VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $sqli);

                if ($stmt) {
                    $manufactureDate = $f->format('Y-m-d');
                    $expireDate = $g->format('Y-m-d');
                    mysqli_stmt_bind_param($stmt, 'issiisssidsss', $a, $b, $c, $d, $e, $manufactureDate, $expireDate, $h, $i, $j, $k, $l, $m);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script>alert('RECORD ADDED SUCCESSFULLY');</script>";
                    } else {
                        $error_message = mysqli_stmt_error($stmt);
                        echo "<script>alert('Error in query execution: " . $error_message . "');</script>";
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "<script>alert('Error in query preparation: " . $error_message . "');</script>";
                }
            }

            mysqli_close($link);
        }
        ?>
    </div>
</body>
</html>