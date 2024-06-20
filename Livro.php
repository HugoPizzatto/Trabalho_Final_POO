<?php
require_once 'Autor.php';

class Livro {
    private $titulo;
    private $autor;

    public function __construct($titulo, Autor $autor) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $autor->adicionarObra($this);
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }
}
?>
