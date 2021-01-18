<?php



include "class.crud.php";

$data = new crud();

if (isset($_POST["update"])) {

	$get = $data->updatestatus($_POST["table"], $_POST["update"]);
}

if (isset($_POST["delete"])) {

	$data->delete($_POST["table"], $_POST["delete"]);
}

if (isset($_POST["detay-id"])) {


	$data->dosyadetayguncelle($_POST["table"], $_POST["detay-id"], $_POST["detay"]);
}
if (isset($_POST["selected"])) {

$selected=serialize($_POST["selected"]);
	$data->eksikevrakguncelle($selected,$_POST["data-id"]);
}
if (isset($_POST["del"])) {


	$detail_table = json_decode($_POST["detail_table"]);
	$detail_id = json_decode($_POST["detail_ids"]);

	$data->deletedetails($detail_table, $detail_id);

	$data->delete($_POST["table"], $_POST["del"]);
}

if (isset($_POST["delete-table"])) {

	$data->delete($_POST["delete-table"], $_POST["detay-id"]);
}