<?php
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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Biblioteca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h2 {
            color: #333;
        }
        .section {
            margin-bottom: 20px;
        }
        .section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Gestão de Biblioteca</h1>
    <div class="section">
        <h2>Ações dos Usuários</h2>
        <p><?php echo nl2br($conteudo); ?></p>
    </div>
    <div class="section">
        <h2>Livros na Biblioteca</h2>
        <ul>
            <?php
            foreach ($biblioteca->listarLivros() as $livro) {
                echo "<li>" . $livro->getTitulo() . " por " . $livro->getAutor()->getNome() . "</li>";
            }
            ?>
        </ul>
    </div>
    <div class="section">
        <h2>Livros Emprestados por João</h2>
        <ul>
            <?php
            foreach ($usuario1->listarLivrosEmprestados() as $livro) {
                echo "<li>" . $livro->getTitulo() . "</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
