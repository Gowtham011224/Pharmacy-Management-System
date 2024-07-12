<!DOCTYPE HTML>
<html lang="en">

<head><title>Medicine</title>
  <link rel="icon" href="administrator.png">
    <style>
        a {
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
            border: 3px solid gray;
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
    </style>
</head>

<body>
<a href="main.php">Back</a>
<div class="content">
    
    <h1>MEDICINE</h1>
    <h4>Your Life Is Our Priority</h4>
    <hr><br><div class="form">
        <b><h2 style="text-align: center;">UPDATE MEDICINE INFORMATION!!!</h2></b>
        <form id="updateMedicineForm" method="POST" action="" onsubmit="return validateForm()">
            Enter Medicine ID to Update:<br>
            <input type="number" name="med_id_input" required value="<?php echo isset($_POST['med_id_input']) ? $_POST['med_id_input'] : ''; ?>"><br>
            <label for="attribute_to_update">Select Attribute to Update:</label><br>
            <select name="attribute_to_update" id="attribute_to_update" required>
                <option value="med_name">Medicine Name</option>
                <option value="med_quan_sold">Quantity Sold</option>
                <option value="med_quan_left">Quantity Left</option>
                <option value="med_mfg">Manufacture Date</option>
                <option value="med_exp">Expire Date</option>
                <option value="med_mrp">MRP</option>
                <option value="med_costprice">Cost Price</option>
                <option value="sci_name">Scientific Name</option>
                <option value="med_type">Medicine Type</option>
                <option value="med_class">Medicine Class</option>
                <option value="sup_id">Supplier ID</option>
            </select><br><br><br>
            <input type="text" name="updated_value" placeholder="Updated Value" required><br><br>
            <input type="submit" name="submit" class="button" value="UPDATE">
        </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $med_id = $_POST["med_id_input"];
    $attribute_to_update = $_POST["attribute_to_update"];
    $updated_value = $_POST["updated_value"];

    // Format the date if the attribute is related to date fields
    if ($attribute_to_update == "med_mfg" || $attribute_to_update == "med_exp") {
        $updated_value = date("Y-m-d", strtotime($updated_value));
    }

    $link = mysqli_connect("localhost", "root", "", "dbms");

    if ($link === FALSE) {
        die("ERROR - Could not connect: " . mysqli_connect_error());
    }

    // Check if med_id exists
    $check_query = "SELECT * FROM medicine WHERE med_id = ?";
    $check_stmt = mysqli_prepare($link, $check_query);
    mysqli_stmt_bind_param($check_stmt, 'i', $med_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) == 0) {
        echo "<script>alert('MEDICINE ID NOT FOUND! Please enter a valid medicine ID.');</script>";
    } else {
        // Use a switch statement to dynamically build the SQL query based on the attribute
        switch ($attribute_to_update) {
            case "med_name":
            case "med_quan_sold":
            case "med_quan_left":
            case "med_mfg":
            case "med_exp":
            case "med_mrp":
            case "med_costprice":
            case "sci_name":
            case "med_type":
            case "med_class":
            case "sup_id":
                // Add more cases as needed for other attributes
                $sqli = "UPDATE medicine 
                        SET $attribute_to_update=?
                        WHERE med_id=?";

                $stmt = mysqli_prepare($link, $sqli);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'si', $updated_value, $med_id);

                    try {
                        mysqli_stmt_execute($stmt);
                        echo "<script>alert('MEDICINE $attribute_to_update UPDATED SUCCESSFULLY');</script>";
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1452) {
                            echo "<script>alert('Error: Foreign key constraint violation for Supplier ID. Please provide a valid Supplier ID.');</script>";
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

    mysqli_close($link);
}
?>

    </div>
</div>
</body>
</html>