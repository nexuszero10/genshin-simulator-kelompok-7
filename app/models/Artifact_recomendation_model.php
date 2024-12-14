<?php

class Artifact_recomendation_model {
    private $table = 'artifact_recomendation';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getArtifactRecomendation($elemental_id_1, $elemental_id_2) {
        $query = "SELECT 
                      ar.recommendation_artifact_id,
                      ar.elemental_id_1,
                      ar.elemental_id_2,
                      a.artifact_id,
                      a.artifact_name,
                      a.deskripsi_efek_artifact,
                      a.image
                  FROM $this->table ar
                  JOIN artifact a ON ar.artifact_id = a.artifact_id
                  WHERE (ar.elemental_id_1 = :elemental_id_1 AND ar.elemental_id_2 = :elemental_id_2)
                     OR (ar.elemental_id_1 = :elemental_id_2 AND ar.elemental_id_2 = :elemental_id_1)";
            
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
