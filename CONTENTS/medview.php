<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Medicine</title>
    <link rel="icon" href="administrator.png">

    <style>
        body {
            background-image: url("https://us.123rf.com/450wm/jardelbassi/jardelbassi2304/jardelbassi230401147/203506317-pharmacy-and-drugstore-blur-background-with-bokeh-image.jpg?ver=6");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            background-color: white;
            padding: 10px;
            margin-bottom: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-button {
            display: inline-block;
            padding: 5px 2px;
            text-decoration: none;
            font-size: 20px;
            background-color: white;
            color: black;
            border: 1px solid #2980b9;
            border-radius: 5px;
            transition: background-color 0.3s;
            float: left;
        }

        .back-button:hover {
            background-color: #a2e1de;
        }
    </style>

    <link rel="icon" href="administrator.png">
</head>

<body>

    <h1><a class="back-button" href="main.php">Back</a>Medicine Records</h1>

    <table>
        <tr>
            <th>Medicine ID</th>
            <th>Medicine Name</th>
            <th>Medicine Class</th>
            <th>Quantity Sold</th>
            <th>Quantity Left</th>
            <th>Manufacture Date</th>
            <th>Expiry Date</th>
            <th>MRP</th>
            <th>Supplier ID</th>
            <th>Cost Price</th>
            <th>Scientific Name</th>
            <th>Medicine Type</th>
            <th>Branch ID</th>
        </tr>

        <?php
        $link = mysqli_connect("localhost", "root", "", "dbms");

        if ($link === FALSE) {
            die("ERROR - Could not connect: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM medicine";
        $result = mysqli_query($link, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['med_id']}</td>";
                echo "<td>{$row['med_name']}</td>";
                echo "<td>{$row['med_class']}</td>";
                echo "<td>{$row['med_quan_sold']}</td>";
                echo "<td>{$row['med_quan_left']}</td>";
                echo "<td>{$row['med_mfg']}</td>";
                echo "<td>{$row['med_exp']}</td>";
                echo "<td>Rs.{$row['med_mrp']}</td>";
                echo "<td>{$row['sup_id']}</td>";
                echo "<td>Rs.{$row['med_costprice']}</td>";
                echo "<td>{$row['sci_name']}</td>";
                echo "<td>{$row['med_type']}</td>";
                echo "<td>{$row['branch_id']}</td>";
                echo "</tr>";
            }
        } else {
            echo "Error in query execution: " . mysqli_error($link);
        }

        mysqli_close($link);
        ?>
    </table>

</body>

</html>
