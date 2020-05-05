<?php
require_once('../config/config.php');
require_once('../model/database.php');
include "../model/m_customer.php";
$connection = new Database($host, $user, $pass, $database);
$ctm = new Customer($connection);

$kd_pembeli = $_POST['kd_pembeli'];
$nm_pembeli = $connection->conn->real_escape_string($_POST['nm_pembeli']);
$jk = $connection->conn->real_escape_string($_POST['jk']);
$alamat = $connection->conn->real_escape_string($_POST['alamat']);
$kota = $connection->conn->real_escape_string($_POST['kota']);

$ctm->edit("UPDATE pembeli SET nm_pembeli = '$nm_pembeli', jk = '$jk', alamat = '$alamat', kota = '$kota' WHERE kd_pembeli = '$kd_pembeli'");
echo "<script>window.location='?page=customer';</script>";
?>