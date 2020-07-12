<?php

namespace app\Controllers;

class CadastroController extends Controller {

    public function create() 
    {
        $this->view('cadastro', [
            'title' => 'Cadastro'
        ]);
    }

    public function store() 
    {
        $validate = new Validate;

        $data = $validate->validate([
            'name' =>  'required:max@30',
            'email' =>  'required:email:unique@posts',
            'phone' =>  'required:phone',
        ]);

        if($validate->hasErrors()) {
            return back();
        }
    }

}