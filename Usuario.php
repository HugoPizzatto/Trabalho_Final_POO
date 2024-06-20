<?php
require_once 'Pessoa.php';

class Usuario extends Pessoa {
    private $livrosEmprestados;

    public function __construct($nome, $idade) {
        parent::__construct($nome, $idade);
        $this->livrosEmprestados = [];
    }

    public function pegarLivro($livro) {
        if (count($this->livrosEmprestados) < 3) {
            $this->livrosEmprestados[] = $livro;
            echo "{$this->getNome()} pegou o livro: {$livro->getTitulo()}<br>";
        } else {
            echo "{$this->getNome()} já tem o número máximo de livros emprestados.<br>";
        }
    }

    public function devolverLivro($livro) {
        if (($key = array_search($livro, $this->livrosEmprestados)) !== false) {
            unset($this->livrosEmprestados[$key]);
            echo "{$this->getNome()} devolveu o livro: {$livro->getTitulo()}<br>";
        }
    }

    public function listarLivrosEmprestados() {
        return $this->livrosEmprestados;
    }
}
?>
