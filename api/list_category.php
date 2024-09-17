<?php
include "../core/helper.php";

$query = "SELECT * FROM categories";

$results = mysqli_query($conn, $query);

$data = [];
if ($results) {
	while($row = mysqli_fetch_assoc($results)) {
		$data[] = [
			"id" => $row["id"],
			"name" => $row["name"]
		];
	}

	json_response(200, "OK", $data);

} else {
	json_response(422, mysql_error($conn));
}