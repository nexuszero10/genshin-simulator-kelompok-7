<?php

class Artifact_model {
    private $table = 'artifact';
    private $db ;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllArtifact(){
        $query = "SELECT * FROM $this->table;";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }
}