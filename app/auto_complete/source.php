<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'Moha4422med';
$dbName = '_OJ';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
if(isset($_GET['term']))
{
	$searchTerm = $_GET['term'];
	//get matched data from skills table
	$query = $db->query("SELECT DISTINCT source FROM problem WHERE source LIKE '%".$searchTerm."%' ORDER BY source ASC LIMIT 10");
	while ($row = $query->fetch_assoc()) {
		$data[] = $row['source'];
	}
	//return json data
	echo json_encode($data);
}
?>