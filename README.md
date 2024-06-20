# Sistema de Biblioteca

## Descrição

Este projeto implementa um sistema simples de biblioteca utilizando PHP e Programação Orientada a Objetos (POO). Ele permite gerenciar livros, autores, usuários e empréstimos de livros. O sistema é composto por várias classes que representam os diferentes elementos do domínio da biblioteca.

## Classes

### Pessoa

- **Atributos:**
  - `nome`: string
  - `idade`: int

- **Métodos:**
  - `__construct($nome, $idade)`: Construtor para inicializar uma pessoa com nome e idade.
  - `getNome()`: Retorna o nome da pessoa.
  - `getIdade()`: Retorna a idade da pessoa.

### Autor (herda de Pessoa)

- **Atributos:**
  - `obras`: array

- **Métodos:**
  - `adicionarObra($obra)`: Adiciona uma obra ao array de obras do autor.
  - `listarObras()`: Retorna um array com as obras do autor.

### Usuario (herda de Pessoa)

- **Atributos:**
  - `livrosEmprestados`: array

- **Métodos:**
  - `pegarLivro($livro)`: Adiciona um livro ao array de livros emprestados pelo usuário e imprime uma mensagem.
  - `devolverLivro($livro)`: Remove um livro do array de livros emprestados pelo usuário e imprime uma mensagem.
  - `listarLivrosEmprestados()`: Retorna um array com os livros emprestados pelo usuário.

### Livro

- **Atributos:**
  - `titulo`: string
  - `autor`: Autor

- **Métodos:**
  - `__construct($titulo, $autor)`: Construtor para inicializar um livro com título e autor.
  - `getTitulo()`: Retorna o título do livro.
  - `getAutor()`: Retorna o autor do livro.

### Biblioteca

- **Atributos:**
  - `livros`: array

- **Métodos:**
  - `adicionarLivro($livro)`: Adiciona um livro ao array de livros da biblioteca.
  - `listarLivros()`: Retorna um array com os livros disponíveis na biblioteca.

## Requisitos

- PHP 7.4 ou superior
- Servidor web (recomendado: XAMPP)

