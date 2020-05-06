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

    public function edit($sql)
    {
        $db = $this->mysqli->conn;
        $db->query($sql) or die ($db->error);
    }

    public function hapus($kd_brg)
    {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM barang WHERE kd_brg = '$kd_brg'") or die ($db->error);
    }

    function __destruct()
    {
        $db = $this->mysqli->conn;
        $db->close();
    }

    function cari($keyword)
    {
        $db = $this->mysqli->conn;
        $db->query("SELECT * FROM barang WHERE nm_brg LIKE '%$keyword%'") or die ($db->error);
        return $db;
    }
}
?>