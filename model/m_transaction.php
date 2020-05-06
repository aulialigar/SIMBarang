<?php
class Transaction {
    private $mysqli;

    function __construct($conn){
        $this->mysqli = $conn;
    }

    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM transaksi, barang, pembeli where transaksi.kd_brg=barang.kd_brg and transaksi.kd_pembeli=pembeli.kd_pembeli order by kd_trx desc";
        
         if($id != null){
             $sql .= " WHERE kd_trx = $id";
         }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah($kd_brg, $kd_pembeli, $tgl_beli)
    {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO transaksi VALUES ('', '$kd_brg', '$kd_pembeli', '$tgl_beli')") or die ($db->error);
    }
}
