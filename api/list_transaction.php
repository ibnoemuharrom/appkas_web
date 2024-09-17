<?php

include "../core/helper.php";

if (!isset($queryParam["user_id"])) {
	json_response(400, "user ID tidak boleh kosong.");
}

// filter user id
$user_id = $queryParam["user_id"];

// filter type
$appendWhere = "";
if (isset($queryParam["type"])) {
	$type = strtoupper($queryParam["type"]);
	$appendWhere .= " AND transactions.type = '$type'";
} else {
	$appendWhere .= "AND transactions.type IN ('IN', 'OUT')";
}

// filter range date
if (isset($queryParam["start_date"]) && isset($queryParam["end_date"])) {
	$startDate = $queryParam["start_date"];
	$endDate = $queryParam["end_date"];
	$appendWhere .= " AND transactions.date >= '$startDate' AND transactions.date <= '$endDate'";
}

$sql = "SELECT transactions.id, categories.name as category, transactions.description, transactions.amount, transactions.type, transactions.date FROM transactions JOIN categories ON categories.id = transactions.category_id
	WHERE transactions.user_id = '$user_id' $appendWhere ORDER BY transactions.date DESC";

$query = mysqli_query($conn, $sql);

$totalIN = 0;
$totalOut = 0;
$balance = 0;
$data = [];
if ($query) {
	while($row = mysqli_fetch_assoc($query)) {
		$data[] = [
			"id" => $row["id"],
			"category" => $row["category"],
			"description" => $row["description"],
			"amount" => (double) $row["amount"],
			"type" => $row["type"],
			"date" => $row["date"]
		];

		if ($row["type"] == "IN") {
			$totalIN += (double) $row["amount"];
		} else if ($row["type"] == "OUT") {
			$totalOut += (double) $row["amount"];
		}

		$balance = $totalIN - $totalOut;
		$options = [
			"total_in" => (double) $totalIN,
			"total_out" => (double) $totalOut,
			"balance" => (double) $balance
		];
	}

	json_response(200, "OK", $data, $options);

} else {
	json_response(422, mysqli_error($conn));
}