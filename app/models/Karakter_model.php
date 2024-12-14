<?php

class Karakter_model {
    private $table = 'karakter'; 
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllKarakter(){
        $query = "SELECT 
                    k.karakter_id,
                    k.nama_karakter, 
                    k.image AS image_karakter, 
                    e.elemental_id,
                    e.nama AS nama_elemental
                  FROM $this->table k
                  JOIN elemental e ON k.elemental_id = e.elemental_id";
        
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getKarakterAndElemental($karakter_id) {
        $query = "SELECT 
                    k.karakter_id,
                    k.nama_karakter,
                    k.image AS image_karakter,
                    e.elemental_id,
                    e.nama AS elemental_nama,
                    e.deskripsi AS elemental_deskripsi,
                    e.image AS elemental_image
                  FROM $this->table k
                  JOIN elemental e ON k.elemental_id = e.elemental_id
                  WHERE k.karakter_id = :karakter_id";
        
        $this->db->query($query);
        $this->db->bind(':karakter_id', $karakter_id);
        $this->db->execute();
        return $this->db->single();
    }        
}
