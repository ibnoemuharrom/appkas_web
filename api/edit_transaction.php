<?php

include "../core/helper.php";

if ( !isset($_POST["id"]) || !isset($_POST["category_id"]) || !isset($_POST["user_id"]) || !isset($_POST["description"]) || !isset($_POST["amount"]) || !isset($_POST["type"]) || !isset($_POST["date"]) ) {
	json_response(400, "id, category ID, user ID, description, amount, type dan date tidak boleh kosong.");
}

$id = $_POST["id"];
$category_id = $_POST["category_id"];
$user_id = $_POST["user_id"];
$description = $_POST["description"];
$amount = $_POST["amount"];
$type = strtoupper($_POST["type"]);
$date = $_POST["date"];


$sql = "UPDATE transactions SET category_id = '$category_id', user_id = '$user_id', description = '$description', amount = '$amount', type = '$type', date = '$date' WHERE id = '$id' ";

$query = mysqli_query($conn, $sql);

if ($query) {
	json_response(200, "Berhasil Update Data");
} else {
	json_response(422, mysqli_error($conn));
}