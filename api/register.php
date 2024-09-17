<?php

include "../core/helper.php";

if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["password"])) {
	json_response(400, "Nama, Email dan Password tidak boleh kosong.");
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$date = date('Y-m-d');
$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO users (name,email,password,date) VALUES ('$name','$email','$passwordHash','$date')";

if (mysqli_query($conn, $query)) {
	json_response(201, "Berhasil Registrasi");
} else {
	json_response(422, mysqli_error($conn));
}