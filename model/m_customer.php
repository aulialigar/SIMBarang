<?php
class Customer {
    private $mysqli;

    function __construct($conn){
        $this->mysqli = $conn;
    }

    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM pembeli";
        if($id != null){
            $sql .= " WHERE kd_pembeli = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah($nm_pembeli, $jk, $alamat, $kota)
    {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO pembeli VALUES ('', '$nm_pembeli', '$jk', '$alamat', '$kota')") or die ($db->error);
    }

    public function edit($sql)
    {
        $db = $this->mysqli->conn;
        $db->query($sql) or die ($db->error);
    }

    public function hapus($kd_pembeli)
    {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM pembeli WHERE kd_pembeli = '$kd_pembeli'") or die ($db->error);
    }

    function __destruct()
    {
        $db = $this->mysqli->conn;
        $db->close();
    }
}
?>