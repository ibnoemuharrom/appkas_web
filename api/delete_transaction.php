<?php

include "../core/helper.php";

if (!isset($queryParam["id"])) {
	json_response(400, "ID tidak boleh kosong.");
}

// filter user id
$id = $queryParam["id"];

$sql = "DELETE FROM transactions WHERE id = '$id'";
$query = mysqli_query($conn, $sql);
if ($query) {
	json_response(200, "Berhasil Hapus Data.");
} else {
	json_response(422, mysqli_error($conn));
}