<?php
include_once('../model/classes/Postagem.php');
require_once("../config/conexao.php");

session_start();
extract($_REQUEST, EXTR_SKIP);
if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php"); // Redirecionar para a página de login
    exit();
}

if ($acao == "IncluirPost") {
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
                $nomeVendedora = htmlspecialchars($nomeVendedora);
                $titulo = htmlspecialchars($titulo);
                $texto = htmlspecialchars($texto);
                $dataPost = date('Y-m-d H:i:s');

                // Crie uma nova postagem
                $postagem = new Postagem(null, $nomeVendedora, $titulo, $dataPost, $imagem, $texto);

                // Crie uma instância do PostagemDao
                $postagemDao = new PostagemDao();

                if ($postagemDao->incluirPostagem($postagem)) {
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



if ($acao == "AlterarPost") {
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
                if (isset($_POST['postagem']) && isset($_POST['nomeVendedora']) && isset($_POST['titulo']) && isset($_POST['texto'])) {
                    $idPostagem = intval($_POST['postagem']);
                    $nomeVendedora = htmlspecialchars($_POST['nomeVendedora']);
                    $titulo = htmlspecialchars($_POST['titulo']);
                    $texto = htmlspecialchars($_POST['texto']);
            
                    $dataPost = date('Y-m-d H:i:s');
            
                    // Crie uma nova postagem
                    $postagem = new Postagem($idPostagem, $nomeVendedora, $titulo, $dataPost, $imagem, $texto);
            
                    // Crie uma instância do PostagemDao
                    $postagemDao = new PostagemDao();
            
                    if ($postagemDao->AlterarPostagem($postagem)) {
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

if ($acao == "DeletarPost") {
    if (isset($_POST['postagem'])) {
        $idPostagem = intval($_POST['postagem']); // Certifique-se de converter para inteiro

        // Crie uma instância do PostagemDao
        $postagemDao = new PostagemDao();

        if ($postagemDao->DeletarPost($idPostagem)) {
            $_SESSION['msg'] = "Postagem deletada com sucesso!";
        } else {
            $_SESSION['msg'] = "Falha na exclusão! Mensagem de erro: ";
        }
    } else {
        $_SESSION['msg'] = "Selecione uma postagem para deletar.";
    }
    
    // Redirecione de volta para a página anterior
    $path = $_SERVER['HTTP_REFERER'];
    header("Location: $path");
    exit(); // Certifique-se de sair para evitar execução adicional do código
}
