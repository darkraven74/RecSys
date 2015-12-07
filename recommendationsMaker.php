<?php
include("filmLoader.php");
if ($_POST["film_ids"] && $_POST["ratings"]) {
    $config = parse_ini_file("recommender/properties.py");

    $command = "cd " . $config["recommender_dir"] . " && " . $config["python_bin"] . " recommender.py "
        . $_POST["film_ids"] . " " . $_POST["ratings"];
    exec($command, $out, $status);

    foreach ($out as $value) {
        $parts = explode(",", $value);
        $recommendations[$i] = $movies[$parts[0]] . ". Rating: " . $parts[1];
    }
    echo json_encode($recommendations);
}
?>