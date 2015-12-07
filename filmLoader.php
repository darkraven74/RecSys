<?php
if (!isset($movies)) {
    $config = parse_ini_file("recommender/properties.py");
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
    while ($row = $result->fetch_assoc()) {
        $movies[$row[$config["item_id_header"]]] = $row[$config["db_table_header_title"]];
    }
    $connection->close();
}
?>
