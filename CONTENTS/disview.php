<!DOCTYPE HTML>
<html lang="en">

<head><link rel="icon" href="administrator.png">
  <title>Disease</title>
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
        }.back-button {
      display: inline-block;
      padding: 5px 2px;
      text-decoration: none;
      font-size:20px;
      background-color: #3498db;
      color: #fff;
      border: 1px solid #2980b9;
      border-radius: 5px;
      transition: background-color 0.3s;
      float:left;
    }

    .back-button:hover {
      background-color: #2980b9;}
    </style>
</head>

<body>

<h1><a class="back-button" href="main.php">Back</a>Disease Records</h1>

    <table>
        <tr>
            <th>Disease ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Medicine ID</th>
        </tr>

        <?php
        $link = mysqli_connect("localhost", "root", "", "dbms");

        if ($link === FALSE) {
            die("ERROR - Could not connect: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM disease";
        $result = mysqli_query($link, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['dis_id']}</td>";
                echo "<td>{$row['dis_name']}</td>";
                echo "<td>{$row['dis_class']}</td>";
                echo "<td>{$row['med_id']}</td>";
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