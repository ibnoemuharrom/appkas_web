<?php

function format_indo($tanggal) {
	$bulan = [
		"01" => "Januari",
		"02" => "Februari",
		"03" => "Maret",
		"04" => "April",
		"05" => "Mei",
		"06" => "Juni",
		"07" => "Juli",
		"08" => "Agustus",
		"09" => "September",
		"10" => "Oktober",
		"11" => "November",
		"12" => "Desember"
	];

	$data = explode("-", $tanggal);

	return $data[2]." ".$bulan[$data[1]]." ".$data[0];
}