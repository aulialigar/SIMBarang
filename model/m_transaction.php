<?php
class Transaction {
    private $mysqli;

    function __construct($conn){
        $this->mysqli = $conn;
    }

    public function tampil($id = null){
        $db = $this->mysqli->conn;
        //$sql = "SELECT * FROM transaksi";
        $sql = "SELECT * FROM transaksi, barang, pembeli where transaksi.kd_brg=barang.kd_brg and transaksi.kd_pembeli=pembeli.kd_pembeli order by kd_trx desc";
        
        // $sql = "SELECT transaksi.*, pembeli.nm_pembeli, pembeli.kota, barang.nm_barang, barang.merk, barang.type, barang.harga
        //         FROM transaksi, pembeli, barang
        //         WHERE transaksi.kd_pembeli = pembeli.kd_pembeli
        //         AND transaksi.kd_brg = barang.kd_brg
        //         ORDER BY kd_trx DESC";
        
         if($id != null){
             $sql .= " WHERE kd_trx = $id";
         }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }
}
