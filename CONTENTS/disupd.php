<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Disease</title>
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
        }
        .back-button {
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
            <b>UPDATE DISEASE INFORMATION!!!</b>
            <h1></h1>
            <form id="updateDiseaseForm" method="POST" action="" onsubmit="return validateForm()">
                Enter Disease ID to Update:<br>
                <input type="number" name="dis_id_input" required value="<?php echo isset($_POST['dis_id_input']) ? $_POST['dis_id_input'] : ''; ?>"><br><br>
                <label for="attribute_to_update">Select Attribute to Update:</label>
                <select name="attribute_to_update" id="attribute_to_update" required>
                    <option value="dis_name">Disease Name</option>
                    <option value="dis_class">Disease Class</option>
                    <option value="med_id">Medicine ID</option>
                    <!-- Add more options as needed for other attributes -->
                </select><br><br>
                <input type="text" name="updated_value" placeholder="Updated Value" required><br><br>
                <input type="submit" name="submit" class="button" value="UPDATE">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                $dis_id = $_POST["dis_id_input"];
                $attribute_to_update = $_POST["attribute_to_update"];
                $updated_value = $_POST["updated_value"];

                try {
                    $link = mysqli_connect("localhost", "root", "", "dbms");

                    if ($link === FALSE) {
                        throw new Exception("ERROR - Could not connect: " . mysqli_connect_error());
                    }

                    // Check if dis_id exists
                    $check_query = "SELECT * FROM disease WHERE dis_id = ?";
                    $check_stmt = mysqli_prepare($link, $check_query);
                    mysqli_stmt_bind_param($check_stmt, 'i', $dis_id);
                    mysqli_stmt_execute($check_stmt);
                    mysqli_stmt_store_result($check_stmt);

                    if (mysqli_stmt_num_rows($check_stmt) == 0) {
                        throw new Exception("DISEASE ID NOT FOUND! Please enter a valid disease ID");
                    }

                    // Perform foreign key checks
                    if ($attribute_to_update == "med_id") {
                        $check_med_query = "SELECT COUNT(*) FROM medicine WHERE med_id = ?";
                        $check_med_stmt = mysqli_prepare($link, $check_med_query);
                        mysqli_stmt_bind_param($check_med_stmt, 'i', $updated_value);
                        mysqli_stmt_execute($check_med_stmt);
                        mysqli_stmt_bind_result($check_med_stmt, $med_count);
                        mysqli_stmt_fetch($check_med_stmt);
                        mysqli_stmt_close($check_med_stmt);

                        if ($med_count == 0) {
                            throw new Exception("Error: Medicine ID does not exist");
                        }
                    }

                    $sqli = "UPDATE disease 
                            SET $attribute_to_update=?
                            WHERE dis_id=?";

                    $stmt = mysqli_prepare($link, $sqli);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'si', $updated_value, $dis_id);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "<b><br><center>DISEASE $attribute_to_update UPDATED SUCCESSFULLY";
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
                    var disId = document.getElementById("dis_id_input").value;

                    if (disId < 1) {
                        alert("Disease ID must be greater than 0");
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