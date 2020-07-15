<?php

namespace app\traits;

trait Validations {

    private $errors = [];

    protected function required($field) {
        if(empty($_POST[$field])) {
            $this->errors[$field][] = flash($field, error('Esse campo é obrigatório'));
        }
    }

    protected function email($field) {
      if(!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
        $this->errors[$field][] = flash($field, error('Esse campo tem que ter um e-mail válido'));
      }
    }

    protected function phone($field) {
        if(!preg_match("/[0-9]{5}\-[0-9]{4}/", $_POST[$field])){
            $this->errors[$field][] = flash($field, error('Esse formato é inválido, por favor utilize o formato xxxxx-xxxx'));
        }
    }

    protected function unique($field, $model) {
        
        $model = "app\\models\\" . ucfirst($model);

        $model = new $model();

        $find = $model->find($field, $_POST[$field]);

        if($find and !empty($_POST[$field])) {
            $this->error[$field][] = flash($field, error('Esse valor ja esta cadastrado no banco de dados'));
        }
    }

    protected function max($field, $max) {
        if(strlen($_POST[$ield]) > $max) {
            $this->error[$field][] = flash($field, error("O número de caracteres para ese campo não pode ser maior do que {$max}"));
        }
    }

    public function hasErrors() {
        return !empty($this->errors);
    }

    public function erros() {
        dd($this->errors);
    }
}