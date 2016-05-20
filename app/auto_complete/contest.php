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
	$query = $db->query("SELECT name  FROM contest WHERE name  LIKE '%".$searchTerm."%' ORDER BY contest_id DESC LIMIT 10");
	while ($row = $query->fetch_assoc()) {
		$data[] = $row['name'];
	}
	//return json data
	echo json_encode($data);
}
?>