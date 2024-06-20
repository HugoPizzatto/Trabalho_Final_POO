<?php
require_once 'Livro.php';

class Biblioteca {
    private $livros;

    public function __construct() {
        $this->livros = [];
    }

    public function adicionarLivro(Livro $livro) {
        $this->livros[] = $livro;
    }

    public function listarLivros() {
        return $this->livros;
    }
}
?>
