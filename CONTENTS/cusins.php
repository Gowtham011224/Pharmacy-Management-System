<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Customer</title>
  <link rel="icon" href="administrator.png">
    <style>
        body {
            background-image: url("medbg1.jpg");
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
        <h1>CUSTOMER</h1>
        <h4>Your life is our priority</h4>

        <div class="form">
            <b>ADD CUSTOMER</b>
            <form id="customerForm" method="POST">
                <hr>
                Enter Customer ID:<br>
                <input type="number" name="cus_id" min="1" required><br>

                <?php
                $error_message = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $cus_id = $_POST["cus_id"];
                    $link = mysqli_connect("localhost", "root", "", "dbms");

                    if ($link === FALSE) {
                        die("ERROR - Could not connect: " . mysqli_connect_error());
                    }

                    $check_query = "SELECT * FROM customer WHERE cus_id = ?";
                    $check_stmt = mysqli_prepare($link, $check_query);
                    mysqli_stmt_bind_param($check_stmt, 'i', $cus_id);
                    mysqli_stmt_execute($check_stmt);
                    mysqli_stmt_store_result($check_stmt);

                    if (mysqli_stmt_num_rows($check_stmt) > 0) {
                        echo "<script>alert('CUSTOMER ID ALREADY EXIST! Please enter a different ID.');</script>";
                    }

                    mysqli_stmt_close($check_stmt);

                    $doc_id = $_POST["doc_id"];
                    $check_doc_query = "SELECT * FROM doctor WHERE doc_id = ?";
                    $check_doc_stmt = mysqli_prepare($link, $check_doc_query);
                    mysqli_stmt_bind_param($check_doc_stmt, 'i', $doc_id);
                    mysqli_stmt_execute($check_doc_stmt);
                    mysqli_stmt_store_result($check_doc_stmt);

                    if (mysqli_stmt_num_rows($check_doc_stmt) == 0) {
                        echo "<script>alert('DOCTOR ID NOT FOUND! Please enter a valid doctor ID.');</script>";
                    }

                    mysqli_stmt_close($check_doc_stmt);
                    mysqli_close($link);
                }

                if (!empty($error_message)) {
                    echo "<span style='color:red;'><b><br>$error_message</b></span><br><br>";
                }
                ?>

                Customer Name:<br>
                <input type="text" name="cus_name" required><br>
                Customer Age:<br>
                <input type="number" name="cus_age" min="1" required><br>
                Customer Gender:<br>
                <input type="text" name="cus_gender" required><br>
                Customer Phone Number:<br>
                <input type="text" name="cus_phoneno" maxlength="10" required><br>
                Customer Email:<br>
                <input type="email" name="cus_mail" required><br>
                Customer Address:<br>
                <input type="text" name="cus_address" required><br>
                Membership Type:<br>
                <input type="text" name="membership_type" required><br>
                Doctor ID:<br>
                <input type="number" name="doc_id" min="1" required><br>
                Customer dob:<br>
                <input type="date" name="cus_dob" required><br>
                <input type="submit" class="button" value="INSERT"><br>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error_message)) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $cus_id = $_POST["cus_id"];
            $cus_name = $_POST["cus_name"];
            $cus_age = $_POST["cus_age"];
            $cus_gender = $_POST["cus_gender"];
            $cus_phoneno = $_POST["cus_phoneno"];
            $doc_id = $_POST["doc_id"];
            $cus_dob_input = $_POST["cus_dob"];
            $cus_dob = date("Y-m-d", strtotime($cus_dob_input));
            $membership_type = $_POST["membership_type"];
            $cus_mail = $_POST["cus_mail"];
            $cus_address = $_POST["cus_address"];

            $link = mysqli_connect("localhost", "root", "", "dbms");

            if ($link === FALSE) {
                die("ERROR - Could not connect: " . mysqli_connect_error());
            }

            $check_query = "SELECT * FROM customer WHERE cus_id = ?";
            $check_stmt = mysqli_prepare($link, $check_query);
            mysqli_stmt_bind_param($check_stmt, 'i', $cus_id);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);

            if (mysqli_stmt_num_rows($check_stmt) > 0) {
                echo "<script>alert('CUSTOMER ID ALREADY EXISTS! Please choose a different ID.');</script>";
            } else {
                $check_doc_query = "SELECT * FROM doctor WHERE doc_id = ?";
                $check_doc_stmt = mysqli_prepare($link, $check_doc_query);
                mysqli_stmt_bind_param($check_doc_stmt, 'i', $doc_id);
                mysqli_stmt_execute($check_doc_stmt);
                mysqli_stmt_store_result($check_doc_stmt);

                if (mysqli_stmt_num_rows($check_doc_stmt) == 0) {
                    echo "<script>alert('DOCTOR ID NOT FOUND! Please enter a valid doctor ID.');</script>";
                } else {
                    $sqli = "INSERT INTO customer (cus_id, cus_name, cus_age, cus_gender, cus_phoneno, doc_id, cus_dob, membership_type, cus_mail, cus_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($link, $sqli);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'isississss', $cus_id, $cus_name, $cus_age, $cus_gender, $cus_phoneno, $doc_id, $cus_dob, $membership_type, $cus_mail, $cus_address);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('RECORD ADDED SUCCESSFULLY');</script>";
                        } else {
                            $error_message = mysqli_stmt_error($stmt);
                            echo "<script>alert('Error in query execution: " . $error_message . "');</script>";
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "<script>alert('Error in query preparation: " . mysqli_error($link) . "');</script>";
                    }

                    mysqli_stmt_close($check_doc_stmt);
                }
            }

            mysqli_stmt_close($check_stmt);
            mysqli_close($link);
        }
        ?>

        <br><br>

        <script>
            function toggleTable() {
                var table = document.getElementById("customerTable");
                table.style.display = table.style.display === "none" ? "block" : "none";
            }
        </script>
    </div>
</body>

</html>
