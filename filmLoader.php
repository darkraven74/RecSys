<?php
session_start();
$config = parse_ini_file("recommender/properties.py");
//print_r($config);
$db_host = $config["db_host"];
$db_user = $config["db_user"];
$db_password = $config["db_passwd"];
$db_name = $config["db_name"];
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$sql = "SELECT * FROM " . $config["db_table_name"];
$result = $connection->query($sql);
$i = 0;
$movie_titles = array();
while ($row = $result->fetch_assoc() and $i < 100) {
    $i++;
    $movies[$row[$config["item_id_header"]]] = $row[$config["db_table_header_title"]];
    array_push($movie_titles, $row[$config["db_table_header_title"]]);
}
$_SESSION['movie_titles'] = $movie_titles;
$_SESSION['movies'] = $movies;
//echo json_encode($movie_titles);
$connection->close();
?>
