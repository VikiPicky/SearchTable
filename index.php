<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

  <title>Home</title>
<link rel="stylesheet" href="style.css" type="text/css">

</head>

<body onload="hideList()">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <div class="navbar">

  <a class="active" href="index.html"><i class="fa fa-fw fa-home"></i> Home</a>

    <div class="dropdown">
      <button class="dropbtn">Products
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="currency.php">Currency Exchange</a>
        <a href="#">Sevice 2</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropbtn">Contact Us
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="contact.html">Contactez-nous <img src="France.png" alt="french flag" width="20" height="10"></a>
        <a href="contact.html">Связаться с нами <img src="Russia.png" alt="russian flag" width="20" height="10"> </a>
      </div>
    </div>

  <a href="aboutme.html"><i class="fa fa-fw fa-user"></i>About</a>

  </div>

    
  <label id="Greeting"></label>

  <div class=note>
    <p>Dear User, please explore our website to learn more about us.</p>
    <p>To find out more about our products visit Products page.</p>
  </div>

  <h2>My Phonebook</h2>

  <input type="text" id="myInput" onkeyup="Search()" placeholder="Search for names.." title="Type in a 
name" onload="">

<script>

    function hideList() {
      tr = document.getElementById("myTable").getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        tr[i].style.display = "none";
      }
    }

    function Search() {
      var input, filter, table, tr, td, i, j, txtValue, tableRowFitsSearchFilter;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      if (filter == "") {
        for (i = 0; i < tr.length; i++) { 
            tr[i].style.display = "none";
        }
        return;
      } 

      for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        tableRowFitsSearchFilter = false;

        for (j = 0; j < td.length; j++) {
            txtValue = td[j].textContent || td[j].innerText;
            tableRowFitsSearchFilter = txtValue.toUpperCase().indexOf(filter) > -1;
            if (tableRowFitsSearchFilter == true) {
                break
            };
        }   

        if (tableRowFitsSearchFilter == true) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
      }
    }

    var myDate = new Date();
    var hrs = myDate.getHours();
    var greet;

    if (hrs >= 0 && hrs <= 5)
      greet = 'Good morning, you must be an early bird!';
    else if (hrs >= 6 && hrs <= 11)
      greet = 'Good Morning';
    else if (hrs >= 12 && hrs <= 17)
      greet = 'Good Afternoon';
    else if (hrs >= 18 && hrs <= 23)
      greet = 'Good Evening';

    document.getElementById('Greeting').innerHTML =
      '<b>' + greet + '</b>!';

  </script>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID, Name, Type, Make, Model, Brand FROM Items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  echo "<table id='myTable'><tr><th>ID</th><th>Name</th><th>Type</th><th>Make</th><th>Model</th><th>Brand</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["ID"]."</td><td>".$row["Name"]." </td><td>".$row["Type"]."</td><td>".$row["Make"]."</td><td>".$row["Model"]."</td><td>".$row["Brand"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();

?>
</body>
</html>