<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create database
$sql = "CREATE DATABASE assignment8";

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();

?>

<?php
$link = mysqli_connect("localhost", "root", "", "assignment8");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Create table
$sql_table = 
"CREATE TABLE Items (
ID      INT(6)      UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
Name VARCHAR(40) NOT NULL, 
Type VARCHAR(40) NOT NULL, 
Make VARCHAR(40) NOT NULL, 
Model VARCHAR(40) NOT NULL, 
Brand VARCHAR(40) NOT NULL)";

if(mysqli_query($link, $sql_table)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql_table. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'assignment8');
if($mysqli === false){
    die("ERROR: Could not connect for insert. " . mysqli_connect_error());
}

$stmt = $mysqli->prepare("INSERT INTO Items (Name, Type, Make, Model, Brand) VALUES (?, ?, ?, ?, ?)");
 
$path = 'input.csv';
 
if(!file_exists($path))
	die('No file!');
 
$h = fopen($path, "r");
 
//Counter to skip first row, Only needed if CSV includes headers on first row
$c = -1;
 
while ($data = fgetcsv($h, 1000, ",")) { $c++;
 
	if($c == 0)
    continue;
 
	if(current($data)) {
		$Name = $data[0];
		$Type = $data[1];
		$Make = $data[2];
		$Model = $data[3];
        $Brand = $data[4];
       
		$stmt->bind_param('sssss', $Name, $Type, $Make, $Model, $Brand);
		$stmt->execute();
	}
}

$stmt->close();
$mysqli->close();

?>
