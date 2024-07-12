<!DOCTYPE HTML>
<html>
<head><title>Customer</title>
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
    <h1 class="heading"><a class="back-button" href="main.php">Back</a><CENTER>CUSTOMER</CENTER></h1>
    <center><H4>-Your life Is Our Priority</H4></center>
    <hr><br>
    <div class="form"><br><br>
    <b><center><h2>UPDATE CUSTOMER INFORMATION!!!</h2></b></center>
    
    <form id="updateCustomerForm" method="POST" action="" onsubmit="return validateForm()">
        Enter Customer ID to Update:<br>
        <input type="number" name="cus_id_input" required value="<?php echo isset($_POST['cus_id_input']) ? $_POST['cus_id_input'] : ''; ?>"><br><br>
        <label for="attribute_to_update">Select Attribute to Update:</label>
        <select name="attribute_to_update" id="attribute_to_update" required>
            <option value="cus_name">Customer Name</option>
            <option value="cus_age">Customer Age</option>
            <option value="cus_gender">Customer Gender</option>
            <option value="cus_phoneno">Customer Phone Number</option>
            <option value="cus_dob">Customer Date of Birth</option>
            <option value="membership_type">Membership Type</option>
            <option value="cus_mail">Customer Email</option>
            <option value="cus_address">Customer Address</option>
             <option value="doc_id">Doc id</option>
            <!-- Add more options as needed for other attributes -->
        </select><br><br>
        <input type="text" name="updated_value" placeholder="Updated Value" required><br><br>
        <input type="submit" name="submit" class="button" value="UPDATE">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $cus_id = $_POST["cus_id_input"];
    $attribute_to_update = $_POST["attribute_to_update"];
    $updated_value = $_POST["updated_value"];

    $link = mysqli_connect("localhost", "root", "", "dbms");

    if ($link === FALSE) {
        echo "<script>alert('ERROR - Could not connect: " . mysqli_connect_error() . "');</script>";
    } else {
        try {
            // Check if cus_id exists
            $check_query = "SELECT * FROM customer WHERE cus_id = ?";
            $check_stmt = mysqli_prepare($link, $check_query);
            mysqli_stmt_bind_param($check_stmt, 'i', $cus_id);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);

            if (mysqli_stmt_num_rows($check_stmt) == 0) {
                echo "<script>alert('CUSTOMER ID NOT FOUND! Please enter a valid customer ID.');</script>";
            } else {
                if ($attribute_to_update === "doc_id") {
                    // Check if the provided doc_id exists in the doctor table
                    $check_doctor_query = "SELECT * FROM doctor WHERE doc_id = ?";
                    $check_doctor_stmt = mysqli_prepare($link, $check_doctor_query);
                    mysqli_stmt_bind_param($check_doctor_stmt, 'i', $updated_value);
                    mysqli_stmt_execute($check_doctor_stmt);
                    mysqli_stmt_store_result($check_doctor_stmt);

                    if (mysqli_stmt_num_rows($check_doctor_stmt) == 0) {
                        echo "<script>alert('Doctor ID NOT FOUND! Please enter a valid doctor ID.');</script>";
                    } else {
                        // Update doc_id in the customer table
                        $sqli = "UPDATE customer 
                                SET doc_id=?
                                WHERE cus_id=?";

                        $stmt = mysqli_prepare($link, $sqli);

                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, 'ii', $updated_value, $cus_id);

                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script>alert('CUSTOMER $attribute_to_update UPDATED SUCCESSFULLY');</script>";
                            } else {
                                $error_message = mysqli_stmt_error($stmt);
                                echo "<script>alert('Error in query execution: " . $error_message . "');</script>";
                            }

                            mysqli_stmt_close($stmt);
                        } else {
                            $error_message = mysqli_error($link);
                            echo "<script>alert('Error in query preparation: " . $error_message . "');</script>";
                        }
                    }

                    mysqli_stmt_close($check_doctor_stmt);
                } else {
                    // Handle other attribute updates as before
                    switch ($attribute_to_update) {
   case "cus_name":
    case "cus_age":
    case "cus_gender":
    case "cus_phoneno":
    case "cus_dob":
    case "membership_type":
    case "cus_mail":
    case "cus_address":
    case "doc_id": // Adding support for updating doc_id
        // Use a separate case for updating the customer name
        if ($attribute_to_update === "cus_name") {
            $sqli = "UPDATE customer 
                    SET cus_name=?
                    WHERE cus_id=?";
        } else {
            $sqli = "UPDATE customer 
                    SET $attribute_to_update=?
                    WHERE cus_id=?";
        }

        $stmt = mysqli_prepare($link, $sqli);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'si', $updated_value, $cus_id);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('CUSTOMER $attribute_to_update UPDATED SUCCESSFULLY');</script>";
            } else {
                $error_message = mysqli_stmt_error($stmt);
                echo "<script>alert('Error in query execution: " . $error_message . "');</script>";
            }

            mysqli_stmt_close($stmt);
        } else {
            $error_message = mysqli_error($link);
            echo "<script>alert('Error in query preparation: " . $error_message . "');</script>";
        }
        break;

    default:
        echo "<script>alert('ERROR - Invalid attribute to update');</script>";
}
                        
                    
                }
            }
        } catch (Exception $e) {
            echo "<script>alert('An unexpected error occurred: " . $e->getMessage() . "');</script>";
        } finally {
            mysqli_close($link);
        }
    }
}
?>



    <script>
        function validateForm() {
            var cusId = document.getElementById("cus_id_input").value;

            if (cusId < 1) {
                alert("Customer ID must be greater than 0");
                return false;
            }

            

            return true;
        }
    </script>
</div>

</body>
</html>