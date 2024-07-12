<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pharmacy Management System</title>
  <link rel="icon" href="administrator.png">
  <link rel="stylesheet" href="dbms_pro1.css">
  <style>
  .dropbtn {
  background-color: #45a049;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
</head>
<body>

  <header>
    <div class="container">
      <h1>Pharmacy Management System</h1>
    </div>
  </header><marquee>Hi Admin Welcome Back! Explore and manage the following tables for the Pharmacy Management System</marquee>
  
	<nav>
    <div class="container">
        
        <div class="dropdown">
        <button class="dropbtn">@Pharmacy</button>
        <div class="dropdown-content">
        <a href="pharmview.php">View data</a>
        <a href="pharmins.php">Insert data</a>
        <a href="pharmupd.php">Update data</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=pharmacy&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Supplier</button>
        <div class="dropdown-content">
        <a href="supview.php">View data</a>
        <a href="supins.php">Insert data</a>
        <a href="supupd.php">Update data</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=suppliers&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Employee</button>
        <div class="dropdown-content">
        <a href="empview.php">View data</a>
        <a href="empins.php">Insert data</a>
        <a href="empupd.php">Update data</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=employee&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Doctor</button>
        <div class="dropdown-content">
        <a href="docview.php">View data</a>
        <a href="docins.php">Insert data</a>
        <a href="docupd.php">Update data</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=doctor&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Customer</button>
        <div class="dropdown-content">
        <a href="cusview.php">View data</a>
        <a href="cusins.php">Insert data</a>
        <a href="cusupd.php">Update data</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=customer&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Disease</button>
        <div class="dropdown-content">
        <a href="disview.php">View data</a>
        <a href="disins.php">Insert data</a>
        <a href="disupd.php">Update data</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=disease&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Medicine</button>
        <div class="dropdown-content">
        <a href="medview.php">View data</a>
        <a href="medins.php">Insert data</a>
        <a href="medupd.php">Update data</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=medicine&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Prescription</button>
        <div class="dropdown-content">
        <a href="presdoc.php">-By Doctor</a>
        <a href="presnodoc.php">-No Prescription</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=prescription&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Bill</button>
        <div class="dropdown-content">
        <a href="billsup.php">-Suppliers</a>
        <a href="billcus.php">-Customers</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=bill&pos=0">Database</a>
        </div>
        </div>

        <div class="dropdown">
        <button class="dropbtn">@Transaction</button>
        <div class="dropdown-content">
        <a href="transup.php">-Suppliers</a>
        <a href="trancus.php">-Customers</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=dbms&table=transaction&pos=0">Database</a>
        </div>
        </div>

      </div>
      </nav>

  <section class="main-content">
    <div class="container">
      <h2>Pharmacy Management System</h2>
      
      <!-- Pharmacy Section with Image -->
      <div class="section pharmacy-section">
        <img src="images.jpg" alt="Pharmacy Image">
        <p>Explore our state-of-the-art pharmacy for all your healthcare needs.</p>
      </div>

      <!-- Your content goes here -->
    </div>
  </section>

  <footer>
    <div class="container">
      <p>&copy;2023datasquad</p>
    </div>
  </footer>

</body>
</html>