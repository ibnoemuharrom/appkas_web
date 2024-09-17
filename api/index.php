<?php

$results = [
	"status" => 200,
	"message" => "OK",
	"data" => [
		"author" => "Nurul Ibnu Al Muharom",
		"Project" => "Skripsi"
	]
];

header("HTTP/1.1 200 OK");
header("Content-type: application/json; charset=utf8");

$json_response = json_encode($results);

echo $json_response;