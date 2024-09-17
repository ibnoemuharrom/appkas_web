<?php

include "../core/helper.php";

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
	json_response(400, "Email dan Password tidak boleh kosong.");
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$query = mysqli_query($conn, $sql);
$cek = mysqli_num_rows($query);
$user = mysqli_fetch_assoc($query);

if ($cek >= 1) {
	if(password_verify($password, $user['password'])) {
		$data = [
			"id" => $user["id"],
			"name" => $user["name"],
			"email" => $user["email"],
			"date" => $user["date"]
		];

		json_response(200, "OK", $data);
	} else {
		json_response(400, "Password salah.");
	}

} else {
	json_response(400, "Email tidak terdaftar.");
}