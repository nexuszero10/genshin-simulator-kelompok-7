<?php

class Elemental_model {
    private $table = 'elemental';
    private $db ;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllElemental(){
        $query = "SELECT * FROM $this->table;";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }
}