<?php
$data_array=array("table01"=>array("attr01", "attr02", "attr03"), "table02"=>array("attr01", "attr02"), "table03"=>array("attr01"));

$file=fopen("data.json", 'w');
fwrite($file, json_encode($data_array));
?>