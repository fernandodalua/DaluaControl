<html>
<head>
  	<meta http-equiv="refresh" content="30">
	<script type="text/javascript"  src="gauge.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="gauge">
  <canvas style="width: 100% !important; height: auto !important;" id="canvas-preview"></canvas>
</div>



<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
$temperatura = 0;

$servername = "localhost";
$username = "root";
$password = "dalua33##((";
$database = "termometro";
$count = 0;

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT value, status FROM dados order by id DESC LIMIT 1";
$result = $conn->query($sql);
echo "<div class='alert alert-success' role='alert'>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h1 class='alert-heading text-center'>Temperatura: " . $row["value"]. "</h1> <hr>";
	$temperatura = (double)$row["value"];
		echo "<h2 class='alert-heading text-center'>Bomba: " . $row["status"]. "</h2>";
    }
} else {
    echo "Temperatura: Erro";
}
echo "</div>";
$conn->close();

?>
<script type="text/javascript">
	var opts = {
		lines: 1,
		angle: -0.2,
		lineWidth: 0.2,		
		pointer: {
			length: 0.4,
		   	strokeWidth: 0.03,
		    color: '#000'
		},
		limitMax: 'false', 
		percentColors: [[0.30, "#5ACF40" ], [0.34, "#EBEB3A"], [0.35, "#FF4B57"]],
		strokeColor: '#E0E0E0',
		generateGradient: false,
		//colorStart: '#2DA3DC', // Colors
		//colorStop: '#C0C0DB', // just experiment with them	  	  
		
	};
	var target = document.getElementById('canvas-preview'); // your canvas element
	var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
	gauge.maxValue = 100; // set max gauge value
	gauge.animationSpeed = 32; // set animation speed (32 is default value)
	gauge.set(<?php echo (double)$temperatura; ?>); // set actual value
	//document.getElementById("preview-textfield").innerHTML = <?php echo (double)$temperatura; ?>;
	//gauge.setTextField(document.getElementById("preview-textfield"));
</script>

