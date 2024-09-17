<?php

include "../core/helper.php";

if ( !isset($_POST["category_id"]) || !isset($_POST["user_id"]) || !isset($_POST["description"]) || !isset($_POST["amount"]) || !isset($_POST["type"]) ) {
	json_response(400, "category ID, user ID, description, amount dan type tidak boleh kosong.");
}

$category_id = $_POST["category_id"];
$user_id = $_POST["user_id"];
$description = $_POST["description"];
$amount = $_POST["amount"];
$type = strtoupper($_POST["type"]);
$date = date("Y-m-d");

$sql = "INSERT INTO transactions (category_id,user_id,description,amount,type,date)
VALUES ('$category_id', '$user_id', '$description', $amount, '$type', '$date')";

$query = mysqli_query($conn, $sql);
if ($query) {
	json_response(201, "Data Transaksi Berhasil Diinput.");
} else {
	json_response(422, mysqli_error($conn));
}