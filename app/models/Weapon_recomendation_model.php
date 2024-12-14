<?php

class Weapon_recomendation_model {
    private $table = 'weapon_recomendation';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getWeaponRecomendation($elemental_id_1, $elemental_id_2) {
        $query = "SELECT 
                      wr.recommendation_weapon_id,
                      wr.elemental_id_1,
                      wr.elemental_id_2,
                      w.weapon_id,
                      w.weapon_name,
                      w.deskripsi_efek_weapon,
                      w.image
                  FROM $this->table wr
                  JOIN weapon w ON wr.weapon_id = w.weapon_id
                  WHERE (wr.elemental_id_1 = :elemental_id_1 AND wr.elemental_id_2 = :elemental_id_2)
                     OR (wr.elemental_id_1 = :elemental_id_2 AND wr.elemental_id_2 = :elemental_id_1)";
        
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
}
