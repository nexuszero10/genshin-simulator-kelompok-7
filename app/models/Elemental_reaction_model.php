<?php

class Elemental_reaction_model {
    private $table = 'elemental_reaction';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getSpesificReaction($elemental_id_1, $elemental_id_2) {
        $query = "SELECT reaction, elemental_id_1, elemental_id_2 
                  FROM $this->table 
                  WHERE (elemental_id_1 = :elemental_id_1 AND elemental_id_2 = :elemental_id_2) 
                     OR (elemental_id_1 = :elemental_id_2 AND elemental_id_2 = :elemental_id_1);";

        $this->db->query($query);
        $this->db->bind(':elemental_id_1', $elemental_id_1);
        $this->db->bind(':elemental_id_2', $elemental_id_2);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return $this->db->resultSet();
        } else {
            return null;
        }
    }

    public function getAllReactions() {
        $query = "SELECT reaction, elemental_id_1, elemental_id_2 FROM $this->table";

        $this->db->query($query);
        $this->db->execute();

        return $this->db->resultSet();
    }
}
