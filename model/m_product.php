<?php
class Product {
    private $mysqli;

    function __construct($conn){
        $this->mysqli = $conn;
    }

    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM barang";
        if($id != null){
            $sql .= " WHERE kd_brg = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah($nm_brg, $merk, $type, $harga, $stok)
    {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO barang VALUES ('', '$nm_brg', '$merk', '$type', '$harga', '$stok')") or die ($db->error);
    }

    //public function edit($nm_brg, $merk, $type, $harga, $stok)
    //{
    //    $db = $this->mysqli->conn;
    //    $db->query("UPDATE barang SET nm_brg = '$nm_brg', merk = '$merk', type = '$type', harga = '$harga', stok = '$stok' ") or die ($db->error);
    //}

    public function edit($sql)
    {
        $db = $this->mysqli->conn;
        $db->query($sql) or die ($db->error);
    }
}
?>