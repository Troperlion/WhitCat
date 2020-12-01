<?php

class Index_Controllers extends Controllers{

    function index() {

        $this->loadModel('Index');
        $d['index'] = $this->Index->Find([]);

        $this->Set($d);

        $this->Render();
    }

    function edit() {
        
        $this->Set([
            "title" => "Edition"
        ]);
        $this->Render();
    }

    function editdelected($id) {
    }

};