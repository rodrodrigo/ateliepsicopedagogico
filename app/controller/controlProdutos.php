<?php
include_once('../model/classes/Produtos.php');
require_once("../config/conexao.php");

session_start();
extract($_REQUEST, EXTR_SKIP);

if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php"); // Redirecionar para a página de login
    exit();
}

if ($acao == "IncluirProduto") {
    if ($_FILES["fileFoto"]["error"] > 0) {
        echo "Erro ao fazer upload da foto: " . $_FILES["fileFoto"]["error"];
    } else {
        $extensao = pathinfo($_FILES["fileFoto"]["name"], PATHINFO_EXTENSION);
        $extensoes_permitidas = array("jpg", "jpeg", "png", "gif");

        if (in_array(strtolower($extensao), $extensoes_permitidas)) {
            $nomeArquivo = date("YmdHis") . rand(100, 999) . "." . $extensao;
            $imagem = "uploads/" . $nomeArquivo;

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($_FILES["fileFoto"]["tmp_name"], $imagem)) {
                // O upload da imagem foi bem-sucedido
                // Continue com o processamento do restante dos dados
                $nome = htmlspecialchars($nome);
                $descricao = htmlspecialchars($descricao);
                $preco = htmlspecialchars($preco);


                // Crie uma nova postagem
                $produtos = new Produtos(null, $nome, $descricao, $preco, $imagem);

                // Crie uma instância do PostagemDao
                $produtosDao = new ProdutosDao();

                if ($produtosDao->IncluirProduto($produtos)) {
                    $_SESSION['msg'] = "Novo registro incluído com sucesso!";
                } else {
                    $_SESSION['msg'] = "Falha no INSERT! Mensagem de erro: ";
                }
            } else {
                echo "Erro ao mover o arquivo temporário.";
            }
        } else {
            echo "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        }
    }

    // Redirecione de volta para a página anterior
    $path = $_SERVER['HTTP_REFERER'];
    header("Location: $path");
    exit(); // Certifique-se de sair para evitar execução adicional do código
}


if ($acao == "DeletarProd") {
    if (isset($_POST['produtos'])) {
        $idProduto = intval($_POST['produtos']); // Certifique-se de converter para inteiro

        // Crie uma instância do ProdutoDao
        $produtosDao = new ProdutosDao();

        if ($produtosDao->DeletarProd($idProduto)) {
            $_SESSION['msg'] = "Produto deletado com sucesso!";
        } else {
            $_SESSION['msg'] = "Falha na exclusão! Mensagem de erro: ";
        }
    } else {
        $_SESSION['msg'] = "Selecione uma produto para deletar.";
    }

    // Redirecione de volta para a página anterior
    $path = $_SERVER['HTTP_REFERER'];
    header("Location: $path");
    exit(); // Certifique-se de sair para evitar execução adicional do código
}

if ($acao == "AlterarProd") {
    if ($_FILES["fileFoto"]["error"] > 0) {
        echo "Erro ao fazer upload da foto: " . $_FILES["fileFoto"]["error"];
    } else {
        $extensao = pathinfo($_FILES["fileFoto"]["name"], PATHINFO_EXTENSION);
        $extensoes_permitidas = array("jpg", "jpeg", "png", "gif");

        if (in_array(strtolower($extensao), $extensoes_permitidas)) {
            $nomeArquivo = date("YmdHis") . rand(100, 999) . "." . $extensao;
            $imagem = "uploads/" . $nomeArquivo;

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($_FILES["fileFoto"]["tmp_name"], $imagem)) {
                if (isset($_POST['produtos']) && isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco'])) {
                    $idProduto = intval($_POST['produtos']);
                    $nome = htmlspecialchars($_POST['nome']);
                    $descricao = htmlspecialchars($_POST['descricao']);
                    $preco = htmlspecialchars($_POST['preco']);


                    // Crie uma nova postagem
                    $produtos = new Produtos($idProduto, $nome, $descricao, $preco, $imagem);

                    // Crie uma instância do PostagemDao
                    $produtosDao = new ProdutosDao();

                    if ($produtosDao->AlterarProdutos($produtos)) {
                        $_SESSION['msg'] = "Registro alterado com sucesso!";
                    } else {
                        $_SESSION['msg'] = "Falha na atualização! Mensagem de erro: ";
                    }
                } else {
                    $_SESSION['msg'] = "Parâmetros informados são inválidos!";
                }
            } else {
                echo "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
            }
        }
    }

    // Redirecione de volta para a página anterior
    $path = $_SERVER['HTTP_REFERER'];
    header("Location: $path");
    exit(); // Certifique-se de sair para evitar execução adicional do código
}
