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
}
?>