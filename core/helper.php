<?php

include "../db/database.php";

if (!function_exists("json_response")) {
	function json_response(int $status, string $message, array $data = [], array $option = []) {
		$status_code = [
			200 => "OK",
			201 => "Created",
			202 => "Accepted",
			400 => "Bad Request",
			422 => "Unprocessable Entity",
			500 => "Internal Server Error",
			502 => "Bad Gateway",
			503 => "Service Unvailable",
			504 => "Gateway Timeout",
		];

		header_remove();
		http_response_code($status);
		header("Cache-controll, no-transform, max-age=300, s-maxage=900");
		header("Content-type: application/json; charset=utf8");
		header("HTTP/1.1".$status." ".$status_code[$status]);

		$response = [
			"status" => $status,
			"message" => $message,
			"data" => $data
		];

		if (!empty($option)) {
			foreach($option as $opt => $val) {
				$response[$opt] = $val;
			}
		}


		$results = json_encode($response);
		echo $results;

	}

}


if (empty($_POST)) {
	$_POST = json_decode(file_get_contents("php://input", true)) ? : [];
	$_POST = (array) $_POST;
}


if (!empty($_SERVER["QUERY_STRING"])) {
	$queryParam = array();
	parse_str($_SERVER["QUERY_STRING"], $queryParam);
}


