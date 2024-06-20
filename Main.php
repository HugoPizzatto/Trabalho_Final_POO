<?php
require_once 'Autor.php';
require_once 'Usuario.php';
require_once 'Livro.php';
require_once 'Biblioteca.php';

// Buffer de saída
ob_start();

session_start();

if (!isset($_SESSION['biblioteca'])) {
    $biblioteca = new Biblioteca();
    $autor1 = new Autor("J.K. Rowling", 55);
    $autor2 = new Autor("J.R.R. Tolkien", 127);

    $livro1 = new Livro("Harry Potter e a Pedra Filosofal", $autor1);
    $livro2 = new Livro("O Senhor dos Anéis", $autor2);

    $biblioteca->adicionarLivro($livro1);
    $biblioteca->adicionarLivro($livro2);

    $_SESSION['biblioteca'] = $biblioteca;
    $_SESSION['usuario1'] = new Usuario("João", 25);
}

$biblioteca = $_SESSION['biblioteca'];
$usuario1 = $_SESSION['usuario1'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'adicionarLivro':
                $titulo = $_POST['titulo'];
                $nomeAutor = $_POST['nomeAutor'];
                $idadeAutor = $_POST['idadeAutor'];

                $autor = new Autor($nomeAutor, $idadeAutor);
                $livro = new Livro($titulo, $autor);
                $biblioteca->adicionarLivro($livro);
                break;
            case 'pegarLivro':
                $titulo = $_POST['titulo'];
                foreach ($biblioteca->listarLivros() as $livro) {
                    if ($livro->getTitulo() === $titulo) {
                        $usuario1->pegarLivro($livro);
                        break;
                    }
                }
                break;
            case 'devolverLivro':
                $titulo = $_POST['titulo'];
                foreach ($usuario1->listarLivrosEmprestados() as $livro) {
                    if ($livro->getTitulo() === $titulo) {
                        $usuario1->devolverLivro($livro);
                        break;
                    }
                }
                break;
        }
    }
    $_SESSION['biblioteca'] = $biblioteca;
    $_SESSION['usuario1'] = $usuario1;
}

$conteudo = ob_get_clean();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Biblioteca</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 800px;
            width: 100%;
            margin: 20px;
            padding: 20px;
            text-align: center;
        }
        h1 {
            background-color: #4CAF50;
            color: #ffffff;
            margin: -20px -20px 20px -20px;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            font-size: 2em;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.5em;
        }
        .section {
            margin-bottom: 20px;
            text-align: left;
        }
        .section p {
            margin: 5px 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
        }
        li {
            background: #f9f9f9;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            transition: background 0.3s ease;
        }
        li:hover {
            background: #e6ffe6;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 0.9em;
        }
        form {
            margin-bottom: 20px;
        }
        input, button {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestão de Biblioteca</h1>
        <div class="section">
            <h2>Ações dos Usuários</h2>
            <p><?php echo nl2br($conteudo); ?></p>
        </div>
        <div class="section">
            <h2>Adicionar Livro</h2>
            <form method="post">
                <input type="hidden" name="acao" value="adicionarLivro">
                <input type="text" name="titulo" placeholder="Título do Livro" required>
                <input type="text" name="nomeAutor" placeholder="Nome do Autor" required>
                <input type="number" name="idadeAutor" placeholder="Idade do Autor" required>
                <button type="submit">Adicionar Livro</button>
            </form>
        </div>
        <div class="section">
            <h2>Reservar Livro</h2>
            <form method="post">
                <input type="hidden" name="acao" value="pegarLivro">
                <input type="text" name="titulo" placeholder="Título do Livro" required>
                <button type="submit">Pegar Livro</button>
            </form>
        </div>
        <div class="section">
            <h2>Devolver Livro</h2>
            <form method="post">
                <input type="hidden" name="acao" value="devolverLivro">
                <input type="text" name="titulo" placeholder="Título do Livro" required>
                <button type="submit">Devolver Livro</button>
            </form>
        </div>
        <div class="section">
            <h2>Livros na Biblioteca</h2>
            <ul>
                <?php
                foreach ($biblioteca->listarLivros() as $livro) {
                    echo "<li><strong>" . $livro->getTitulo() . "</strong> por " . $livro->getAutor()->getNome() . "</li>";
                }
                ?>
            </ul>
        </div>
        <div class="section">
            <h2>Livros Reservados por João</h2>
            <ul>
                <?php
                foreach ($usuario1->listarLivrosEmprestados() as $livro) {
                    echo "<li><strong>" . $livro->getTitulo() . "</strong></li>";
                }
                ?>
            </ul>
        </div>
        <div class="footer">
            &copy; <?php echo date('Y'); ?> Gestão de Biblioteca. Todos os direitos reservados.
        </div>
    </div>
</body>
</html>
