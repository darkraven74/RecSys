<?php
include("filmLoader.php");
if($_POST["film_ids"] && $_POST["ratings"]) {
    $config = parse_ini_file("recommender/properties.py");

    $command = "cd " . $config["recommender_dir"] . " && " . $config["python_bin"] . " recommender.py "
    . $_POST["film_ids"] . " " . $_POST["ratings"];
    exec($command, $out, $status);

//    echo $command . "\n";

    $i=0;
    foreach ($out as $value) {
        $parts = explode(",", $value);
        $recommendations[$i] = $movies[$parts[0]] . ". Rating: " . $parts[1];
        $i++;
    }
    echo json_encode($recommendations);
}
?>