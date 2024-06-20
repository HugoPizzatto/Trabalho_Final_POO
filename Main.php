<?php
require_once 'Autor.php';
require_once 'Usuario.php';
require_once 'Livro.php';
require_once 'Biblioteca.php';

// Exemplo de uso
$autor1 = new Autor("J.K. Rowling", 55);
$autor2 = new Autor("J.R.R. Tolkien", 127);

$livro1 = new Livro("Harry Potter e a Pedra Filosofal", $autor1);
$livro2 = new Livro("O Senhor dos Anéis", $autor2);

$usuario1 = new Usuario("João", 25);
$usuario2 = new Usuario("Maria", 30);

$biblioteca = new Biblioteca();
$biblioteca->adicionarLivro($livro1);
$biblioteca->adicionarLivro($livro2);

$usuario1->pegarLivro($livro1);
$usuario1->pegarLivro($livro2);
$usuario1->devolverLivro($livro1);

echo "Livros na biblioteca:<br>";
foreach ($biblioteca->listarLivros() as $livro) {
    echo "- " . $livro->getTitulo() . " por " . $livro->getAutor()->getNome() . "<br>";
}

echo "Livros emprestados por João:<br>";
foreach ($usuario1->listarLivrosEmprestados() as $livro) {
    echo "- " . $livro->getTitulo() . "<br>";
}
?>

<!-- <?php
require_once 'Autor.php';
require_once 'Usuario.php';
require_once 'Livro.php';
require_once 'Biblioteca.php';

// Buffer de saída
ob_start();

// Exemplo de uso
$autor1 = new Autor("J.K. Rowling", 55);
$autor2 = new Autor("J.R.R. Tolkien", 127);

$livro1 = new Livro("Harry Potter e a Pedra Filosofal", $autor1);
$livro2 = new Livro("O Senhor dos Anéis", $autor2);

$usuario1 = new Usuario("João", 25);
$usuario2 = new Usuario("Maria", 30);

$biblioteca = new Biblioteca();
$biblioteca->adicionarLivro($livro1);
$biblioteca->adicionarLivro($livro2);

$usuario1->pegarLivro($livro1);
$usuario1->pegarLivro($livro2);
$usuario1->devolverLivro($livro1);

// Capturar a saída em buffer
$conteudo = ob_get_clean();

