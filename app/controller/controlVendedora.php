<?php
include_once('../model/classes/Vendedora.php');
require_once("../config/conexao.php");

session_start();
extract($_REQUEST, EXTR_SKIP);

if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php"); // Redirecionar para a página de login
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === "IncluirVendedora") {
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $cep = $_POST['cep'] ?? '';
        $logradouro = $_POST['logradouro'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $uf = $_POST['uf'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $perguntarec = $_POST['perguntarec'] ?? '';
        if (strlen($senha) < 8) {
            $_SESSION['mensagem'] = "A senha deve ter pelo menos 8 caracteres.";
            $path = $_SERVER['HTTP_REFERER'];
            header("Location: $path");
            exit(); // Certifique-se de incluir este comando para evitar que o script continue sendo executado
        } else {
            if (!empty($nome) && !empty($cpf) && !empty($cep) && !empty($logradouro) && !empty($bairro) && !empty($cidade) && !empty($uf) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($perguntarec)) {
                $nome = htmlspecialchars($nome);
                $cpf = htmlspecialchars($cpf);
                $cep = htmlspecialchars($cep);
                $logradouro = htmlspecialchars($logradouro);
                $bairro = htmlspecialchars($bairro);
                $cidade = htmlspecialchars($cidade);
                $uf = htmlspecialchars($uf);
                $telefone = htmlspecialchars($telefone);
                $email = htmlspecialchars($email);
                $senha = htmlspecialchars($senha);
                $perguntarec = htmlspecialchars($perguntarec);

                $stmt = $pdoConnection->prepare("SELECT * FROM vendedora WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $quantidadeEmail = $stmt->rowCount();

                if ($quantidadeEmail > 0) {
                    $_SESSION['mensagem'] = "O e-mail informado já existe. Por favor, use um e-mail diferente.";
                } else {
                    $stmtCpf = $pdoConnection->prepare("SELECT * FROM vendedora WHERE cpf = :cpf");
                    $stmtCpf->bindParam(':cpf', $cpf);
                    $stmtCpf->execute();
                    $quantidadeCpf = $stmtCpf->rowCount();

                    if ($quantidadeCpf > 0) {
                        $_SESSION['mensagem'] = "O CPF informado já está em uso. Por favor, use um CPF diferente.";
                    } else {
                        $Vendedora = new Vendedora(null, $nome, $cpf, $cep, $logradouro, $bairro, $cidade, $uf, $telefone, $email, $senha, $perguntarec);
                        $VendedoraDao = new VendedoraDao();

                        if ($VendedoraDao->incluirVendedora($Vendedora)) {
                            $_SESSION['mensagem'] = "Novo registro incluído com sucesso!";
                        } else {
                            $_SESSION['mensagem'] = "Falha no INSERT! Mensagem de erro: ";
                        }
                    }
                }
            } else {
                $_SESSION['mensagem'] = "Parâmetros informados são inválidos!";
            }

            $path = $_SERVER['HTTP_REFERER'];
            header("Location: $path");
            exit(); // Certifique-se de incluir este comando para evitar que o script continue sendo executado
        }
    }

    if ($acao === "RecuperarSenha") {
        $email = $_POST['email'] ?? '';
        $senha = trim($_POST['novaSenha']) ?? ''; // Usando 'novaSenha' em vez de 'senha'
        if (strlen($senha) < 8) {
            $_SESSION['mensagem'] = "A senha deve ter pelo menos 8 caracteres.";
        } else {

            if (!empty($email) && !empty($senha)) {
                $email = htmlspecialchars($email);
                $senha = htmlspecialchars($senha);

                $stmt = $pdoConnection->prepare("UPDATE vendedora SET senha = :senha WHERE email = :email");
                $stmt->bindParam(':senha', $senha);
                $stmt->bindParam(':email', $email);

                if ($stmt->execute()) {
                    $_SESSION['mensagem'] = "Senha atualizada com sucesso!";
                } else {
                    $_SESSION['mensagem'] = "Falha na atualização da senha!";
                }
            } else {
                $_SESSION['mensagem'] = "As senhas não coincidem. Por favor, insira senhas iguais nos dois campos.";
            }
        }
        $path = $_SERVER['HTTP_REFERER'];
        header("Location: ../../logindani.php");
        exit(); // Certifique-se de incluir este comando para evitar que o script continue sendo executado
    }
}
