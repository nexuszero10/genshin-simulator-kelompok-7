<?php

class Home extends Controller {

    public function index(){        

        $data['title'] = "Beranda - Genshin Impact";
        $this->view('home/index', $data);
    }
}