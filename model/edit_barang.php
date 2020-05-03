<?php
require_once('../config/config.php');
require_once('../model/database.php');
include "../model/m_product.php";
$connection = new Database($host, $user, $pass, $database);
$pdc = new Product($connection);

$kd_brg = $_POST['kd_brg'];
$nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
$merk = $connection->conn->real_escape_string($_POST['merk']);
$type = $connection->conn->real_escape_string($_POST['type']);
$harga = $connection->conn->real_escape_string($_POST['harga']);
$stok = $connection->conn->real_escape_string($_POST['stok']);

$pdc->edit("UPDATE barang SET nm_brg = '$nm_brg', merk = '$merk', type = '$type', harga = '$harga', stok = '$stok' WHERE kd_brg = '$kd_brg'");
echo "<script>window.location='?page=product';</script>";
?>