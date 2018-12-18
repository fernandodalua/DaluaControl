<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


$value = $_GET['value'];
$status = $_GET['status'];

$servername = "repp.gq";
$username = "root";
$password = "dalua33##((";
$database = "termometro";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "INSERT INTO dados (value, status,time) VALUES (".$value.", ".$status.",now())";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

/* Select queries return a resultset */
if ($result = $conn->query("SELECT value FROM dados LIMIT 10")) {
    printf("Select returned %d rows.\n", $result->num_rows);

    /* free result set */
    $result->close();
}

$conn->close();

echo $value . " " . $status; 
?>