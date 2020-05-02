<?php
class Transaction {
    private $mysqli;

    function __construct($conn){
        $this->mysqli = $conn;
    }

    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM transaksi";
        if($id != null){
            $sql .= " WHERE kd_trx = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;

        //return $this->db->select('*, pembeli.kd_pembeli')
		//								->from('transaksi')
		//								->join('pembeli', 'pembeli.kd_pembeli = transaksi.id_pembeli', 'inner')
		//								->get()->result();
    }
}
