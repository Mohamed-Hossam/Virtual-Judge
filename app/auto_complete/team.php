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
	$query = $db->query("SELECT team_name FROM team WHERE team_name LIKE '%".$searchTerm."%' ORDER BY team_name ASC LIMIT 10");
	while ($row = $query->fetch_assoc()) {
		$data[] = $row['team_name'];
	}
	//return json data
	echo json_encode($data);
}
?>