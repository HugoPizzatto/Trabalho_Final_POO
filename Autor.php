<?php
require_once 'Pessoa.php';

class Autor extends Pessoa {
    private $obras;

    public function __construct($nome, $idade) {
        parent::__construct($nome, $idade);
        $this->obras = [];
    }

    public function adicionarObra($obra) {
        $this->obras[] = $obra;
    }

    public function listarObras() {
        return $this->obras;
    }
}
?>
