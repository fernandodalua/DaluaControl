<html>
<head>
 <meta http-equiv="refresh" content="60">
<script type="text/javascript"  src="dygraph.js"></script>
<link rel="stylesheet" src="dygraph.css" />
</head>
<body>
<form action="search.php">
	  Inicio: <input type="text" name="dtinicio" value="<?php echo date('Y-m-d H:i:s', strtotime('-3 hour')); ?>"><br>
	  Fim: <input type="text" name="dtfim" value="<?php echo date('Y-m-d H:i:s', strtotime('-2 hour')); ?>"><br>
  <input type="submit" value="Consultar">
</form>

<?php
//ini_set('display_errors',1);
//ini_set('display_startup_erros',1);
//error_reporting(E_ALL);

$dtinicio = $_GET['dtinicio'];
$dtfim = $_GET['dtfim'];

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

if($dtinicio != "" && $dtfim != ""){
	$sql = "SELECT value, time FROM dados where time > '".$dtinicio."' and time < '".$dtfim."'";
}else{
	$sql = "SELECT value, time FROM dados where time > '".date('Y-m-d H:i:s', strtotime('-4 hour'))."' and time < '".date('Y-m-d H:i:s', strtotime('-3 hour'))."'";
}
$result = $conn->query($sql);
$dados = "";



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $dados .= '"' .$row["time"]. ', ' . $row["value"]. '\n" + ';
    }
} else {
    echo "0 results";
}
$conn->close();

?>

<?php 
$dados = substr($dados,0,-2);
?>

<div id="graphdiv"  style="width:800px; height:300px;"></div>
<script type="text/javascript">
  g = new Dygraph(

    // containing div
    document.getElementById("graphdiv"),

    // CSV or path to a CSV file.
    "Date,Temperature\n" + <?php echo $dados; ?>

  );
</script>
</body>
</html>