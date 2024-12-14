<?php

class Admin_model {
    private $tableKarakter = 'karakter';
    private $tableWeapon = 'weapon';
    private $tableArtifact = 'artifact';
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Insert Karakter
    public function insertNewKarakter($nama_karakter, $image_karakter, $elemental_id_karakter){
        $query = "INSERT INTO $this->tableKarakter (nama_karakter, image, elemental_id) 
                  VALUES (:nama_karakter, :image_karakter, :elemental_id_karakter)";
        
        $this->db->query($query);
        $this->db->bind(':nama_karakter', $nama_karakter);
        $this->db->bind(':image_karakter', $image_karakter);
        $this->db->bind(':elemental_id_karakter', $elemental_id_karakter);
        
        return $this->db->execute();
    }

    // Insert Weapon
    public function insertNewWeapon($weapon_name, $deskripsi_efek_weapon, $image){
        $query = "INSERT INTO $this->tableWeapon (weapon_name, deskripsi_efek_weapon, image) 
                  VALUES (:weapon_name, :deskripsi_efek_weapon, :image)";
        
        $this->db->query($query);
        $this->db->bind(':weapon_name', $weapon_name);
        $this->db->bind(':deskripsi_efek_weapon', $deskripsi_efek_weapon);
        $this->db->bind(':image', $image);
        
        return $this->db->execute();
    }

    // Insert Artifact
    public function insertNewArtifact($artifact_name, $deskripsi_efek_artifact, $image){
        $query = "INSERT INTO $this->tableArtifact (artifact_name, deskripsi_efek_artifact, image) 
                  VALUES (:artifact_name, :deskripsi_efek_artifact, :image)";
        
        $this->db->query($query);
        $this->db->bind(':artifact_name', $artifact_name);
        $this->db->bind(':deskripsi_efek_artifact', $deskripsi_efek_artifact);
        $this->db->bind(':image', $image);
        
        return $this->db->execute();
    }

    // Update Karakter
    public function updateKarakter($karakter_id, $nama_karakter, $image_karakter, $elemental_id_karakter){
        $query = "UPDATE $this->tableKarakter 
                  SET nama_karakter = :nama_karakter, image = :image_karakter, elemental_id = :elemental_id_karakter 
                  WHERE karakter_id = :karakter_id";
        
        $this->db->query($query);
        $this->db->bind(':nama_karakter', $nama_karakter);
        $this->db->bind(':image_karakter', $image_karakter);
        $this->db->bind(':elemental_id_karakter', $elemental_id_karakter);
        $this->db->bind(':karakter_id', $karakter_id);
        
        return $this->db->execute();
    }

    // Update Weapon
    public function updateWeapon($weapon_id, $weapon_name, $deskripsi_efek_weapon, $image){
        $query = "UPDATE $this->tableWeapon 
                  SET weapon_name = :weapon_name, deskripsi_efek_weapon = :deskripsi_efek_weapon, image = :image 
                  WHERE weapon_id = :weapon_id";
        
        $this->db->query($query);
        $this->db->bind(':weapon_name', $weapon_name);
        $this->db->bind(':deskripsi_efek_weapon', $deskripsi_efek_weapon);
        $this->db->bind(':image', $image);
        $this->db->bind(':weapon_id', $weapon_id);
        
        return $this->db->execute();
    }

    // Update Artifact
    public function updateArtifact($artifact_id, $artifact_name, $deskripsi_efek_artifact, $image){
        $query = "UPDATE $this->tableArtifact 
                  SET artifact_name = :artifact_name, deskripsi_efek_artifact = :deskripsi_efek_artifact, image = :image 
                  WHERE artifact_id = :artifact_id";
        
        $this->db->query($query);
        $this->db->bind(':artifact_name', $artifact_name);
        $this->db->bind(':deskripsi_efek_artifact', $deskripsi_efek_artifact);
        $this->db->bind(':image', $image);
        $this->db->bind(':artifact_id', $artifact_id);
        
        return $this->db->execute();
    }

    // Delete Karakter
    public function deleteKarakter($karakter_id){
        $query = "DELETE FROM $this->tableKarakter WHERE karakter_id = :karakter_id";
        
        $this->db->query($query);
        $this->db->bind(':karakter_id', $karakter_id);
        
        return $this->db->execute();
    }

    // Delete Weapon
    public function deleteWeapon($weapon_id){
        $query = "DELETE FROM $this->tableWeapon WHERE weapon_id = :weapon_id";
        
        $this->db->query($query);
        $this->db->bind(':weapon_id', $weapon_id);
        
        return $this->db->execute();
    }

    // Delete Artifact
    public function deleteArtifact($artifact_id){
        $query = "DELETE FROM $this->tableArtifact WHERE artifact_id = :artifact_id";
        
        $this->db->query($query);
        $this->db->bind(':artifact_id', $artifact_id);
        
        return $this->db->execute();
    }
}

?>
