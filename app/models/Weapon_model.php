<?php

class Weapon_model {
    private $table = 'weapon';
    private $db ;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllWeapon(){
        $query = "SELECT * FROM $this->table;";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }
}