<!DOCTYPE HTML>
<html lang="en">

<head>
<title>Prescription</title>
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
        width: 80%;
        margin: 20px auto;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
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

<h1><a class="back-button" href="main.php">Back</a>Prescription Records With Doctor Reference</h1>

<table>
    <tr>
        <th>Prescription ID</th>
        <th>Prescription Date</th>
        <th>Medicine Name</th>
        <th>Quantity</th>
        <th>Medicine ID</th>
        <th>Disease ID</th>
        <th>Customer ID</th>
        <th>Doctor ID</th>
        <th>Hospital Name</th>
    </tr>

    <?php
    $link = mysqli_connect("localhost", "root", "", "dbms");

    if ($link === FALSE) {
        die("ERROR - Could not connect: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM prescription WHERE doc_id IS NOT NULL";
    $result = mysqli_query($link, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['pre_id']}</td>";
            echo "<td>{$row['pre_date']}</td>";
            echo "<td>{$row['medicine_name']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "<td>{$row['med_id']}</td>";
            echo "<td>{$row['dis_id']}</td>";
            echo "<td>{$row['cus_id']}</td>";
            echo "<td>{$row['doc_id']}</td>";
            echo "<td>{$row['hospital_name']}</td>";
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