<?php

class Simulate extends Controller {

    public function index() {
        $data['title'] = "Simulasi - Genshin Impact";
        $data['data-karakter'] = $this->model('Karakter_model')->getAllKarakter();
        $this->view('simulate/simulate', $data);
    }

    public function hasilSimulasi() {
        $id_karakter_pertama = $_POST['id_karakter_pertama'];
        $id_karakter_kedua = $_POST['id_karakter_kedua'];

        $data['data_karakter_pertama'] = $this->model('Karakter_model')->getKarakterAndElemental($id_karakter_pertama);
        $data['data_karakter_kedua'] = $this->model('Karakter_model')->getKarakterAndElemental($id_karakter_kedua);

        $reaction = $this->model('Elemental_reaction_model')->getSpesificReaction(
            $data['data_karakter_pertama']['elemental_id'], 
            $data['data_karakter_kedua']['elemental_id']
        );

        if ($reaction) {
            $data['title'] = 'Hasil - Genshin Impact';
            $data['elemental_reaction'] = $reaction[0]; 
            $data['rekomendasi_weapon'] = $this->model('Weapon_recomendation_model')->getWeaponRecomendation(
                $data['data_karakter_pertama']['elemental_id'], 
                $data['data_karakter_kedua']['elemental_id']
            );

            $data['rekomendasi_artifact'] = $this->model('Artifact_recomendation_model')->getArtifactRecomendation(
                $data['data_karakter_pertama']['elemental_id'], 
                $data['data_karakter_kedua']['elemental_id']
            );

            $this->view('simulate/result', $data);
        } else {
            $data['title'] = 'Hasil - Genshin Impact';
            $data['data_karakter_pertama'] = $this->model('Karakter_model')->getKarakterAndElemental($id_karakter_pertama);
            $data['data_karakter_kedua'] = $this->model('Karakter_model')->getKarakterAndElemental($id_karakter_kedua);

            $data['elemental_reaction'] = "Tidak ada reaksi elemental karena karakter punya base elemen yang sama.";
            $data['rekomendasi_weapon'] = "Tidak ada rekomendasi weapon.";
            $data['rekomendasi_artifact'] = "Tidak ada rekomendasi artifact.";

            $this->view('simulate/result', $data);
        }
    }
}
?>
