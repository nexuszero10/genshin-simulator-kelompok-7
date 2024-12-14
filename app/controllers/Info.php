<?php

class Info extends Controller {
    public function index(){
        $data['title'] = 'Info - Genshin Impact';
        $this->view('info/index', $data);
    }

    public function infoKarakter(){
        $data['title'] = 'Karakter - Genshin Impact';
        $data['data-karakter'] = $this->model('Karakter_model')->getAllKarakter();
        $this->view('info/info-karakter', $data);
    }

    public function infoElemental(){
        $data['title'] = 'Elemental - Genshin Impact';
        $data['data-elemental'] = $this->model('Elemental_model')->getAllElemental();
        $this->view('info/info-elemental', $data);
    }

    public function infoWeapon(){
        $data['title'] = 'Weapon - Genshin Impact';
        $data['data-weapon'] = $this->model('Weapon_model')->getAllWeapon();
        $this->view('info/info-weapon', $data);
    }

    public function infoArtifact(){
        $data['title'] = 'Artifact - Genshin Impact';
        $data['data-artifact'] = $this->model('Artifact_model')->getAllArtifact();
        $this->view('info/info-artifact', $data);
    }
}