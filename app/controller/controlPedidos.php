<?php
// Inclua o arquivo correto de classe Pedidos e a classe PedidosDao
include_once('../model/classes/Pedidos.php');
include_once('../model/dao/PedidosDao.php'); // Certifique-se de fornecer o caminho correto para o arquivo

session_start();
extract($_REQUEST, EXTR_SKIP);

if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php"); // Redirecionar para a página de login
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === "novopedido") {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $dataPedido = $_POST['dataPedido'] ?? '';
        $modoPagamento = $_POST['modoPagamento'] ?? '';
        $cep = $_POST['cep'] ?? '';
        $logradouro = $_POST['logradouro'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $numeroEndereco = $_POST['numeroEndereco'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $uf = $_POST['uf'] ?? '';
        $produto = $_POST['produto'] ?? '';
        $preco = $_POST['preco'] ?? '';

        // Verificação de empty e htmlspecialchars
        if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($dataPedido) && !empty($modoPagamento) && !empty($cep) && !empty($logradouro) && !empty($bairro) && !empty($numeroEndereco) && !empty($cidade) && !empty($uf) && !empty($produto) && !empty($preco)) {
            // Use htmlspecialchars em todas as variáveis necessárias
            $nome = htmlspecialchars($nome);
            $email = htmlspecialchars($email);
            $telefone = htmlspecialchars($telefone);
            $dataFormatada = date('Y-m-d', strtotime($dataPedido)); // Formate a data
            $modoPagamento = htmlspecialchars($modoPagamento);
            $cep = htmlspecialchars($cep);
            $logradouro = htmlspecialchars($logradouro);
            $bairro = htmlspecialchars($bairro);
            $numeroEndereco = htmlspecialchars($numeroEndereco);
            $cidade = htmlspecialchars($cidade);
            $uf = htmlspecialchars($uf);
            $produto = htmlspecialchars($produto);
            $preco = htmlspecialchars($preco); // Ajuste aqui se necessário

            // Crie um objeto Pedido com os parâmetros fornecidos
            $pedido = new Pedidos(null, $nome, $email, $telefone, $dataFormatada, $modoPagamento, $cep, $logradouro, $numeroEndereco, $bairro, $cidade, $uf, $produto, $preco);
            $pedidoDao = new PedidosDao(); // Certifique-se de ter o caminho correto para a classe PedidosDao

            if ($pedidoDao->incluirPedido($pedido)) {
                $_SESSION['mensagem'] = "Novo registro incluído com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Falha no INSERT! Mensagem de erro: "; // Adicione a mensagem de erro aqui
            }

            // Redirecione de volta para a página anterior após a execução do código
            $path = $_SERVER['HTTP_REFERER'];
            header("Location: $path");
            exit(); // Certifique-se de sair para evitar execução adicional do código
        } else {
            $_SESSION['mensagem'] = "Parâmetros informados são inválidos!";
            // Redirecione de volta para a página anterior após a execução do código
            $path = $_SERVER['HTTP_REFERER'];
            header("Location: $path");
            exit(); // Certifique-se de sair para evitar execução adicional do código
        }
    }
}



if ($acao == "DeletarPedido") {
    if (isset($_POST['pedido'])) {
        $idPedido = intval($_POST['pedido']); // Certifique-se de converter para inteiro

        // Crie uma instância do ProdutoDao
        $pedidosDao = new PedidosDao();

        if ($pedidosDao->DeletarPedido($idPedido)) {
            $_SESSION['msg'] = "Pedido deletado com sucesso!";
        } else {
            $_SESSION['msg'] = "Falha na exclusão! Mensagem de erro: ";
        }
    } else {
        $_SESSION['msg'] = "Selecione uma Pedido para deletar.";
    }

    // Redirecione de volta para a página anterior
    $path = $_SERVER['HTTP_REFERER'];
    header("Location: $path");
    exit(); // Certifique-se de sair para evitar execução adicional do código
}


if ($acao == "alterarpedido") {
    if (isset($_POST['idPedido']) && 
    isset($_POST['nomeUsuario']) && 
    isset($_POST['emailUsuario']) 
    && isset($_POST['telefoneUsuario']) 
    && isset($_POST['dtPedido']) 
    && isset($_POST['metPag']) && 
    isset($_POST['entregaCEP']) &&
     isset($_POST['entregaEndereco'])
    && isset($_POST['entregaNumero'])
     && isset($_POST['entregaBairro']) 
    && isset($_POST['entregaCidade']) 
    && isset($_POST['entregaUF']) 
    && isset($_POST['nomeProduto']) 
    && isset($_POST['valorTotal']) 
    ) {
        $idPedido = intval($_POST['idPedido']);
        $nomeUsuario = htmlspecialchars($_POST['nomeUsuario']);
        $emailUsuario = htmlspecialchars($_POST['emailUsuario']);
        $telefoneUsuario = htmlspecialchars($_POST['telefoneUsuario']);
        $dtPedido = htmlspecialchars($_POST['dtPedido']);
        $dataFormatada = date('Y-m-d', strtotime($dtPedido)); // Formate a data
        $metPag = htmlspecialchars($_POST['metPag']);
        $entregaCEP = htmlspecialchars($_POST['entregaCEP']);
        $entregaEndereco = htmlspecialchars($_POST['entregaEndereco']);
        $entregaNumero = htmlspecialchars($_POST['entregaNumero']);
        $entregaBairro = htmlspecialchars($_POST['entregaBairro']);
        $entregaCidade = htmlspecialchars($_POST['entregaCidade']);
        $entregaUF = htmlspecialchars($_POST['entregaUF']);
        $nomeProduto = htmlspecialchars($_POST['nomeProduto']);
        $valorTotal = htmlspecialchars($_POST['valorTotal']);
    
      


        $pedidos = new Pedidos($idPedido, $nomeUsuario, $emailUsuario, $telefoneUsuario, $dataFormatada, $metPag, $entregaCEP, $entregaEndereco, 
        $entregaNumero, $entregaBairro, $entregaCidade, $entregaUF, $nomeProduto, $valorTotal);

        // Crie uma instância do PostagemDao
        $pedidosDao = new PedidosDao();

        if ($pedidosDao->alterarpedido($pedidos)) {
            $_SESSION['msg'] = "Registro alterado com sucesso!";
        } else {
            $_SESSION['msg'] = "Falha na atualização! Mensagem de erro: ";
        }
    } else {
        $_SESSION['msg'] = "Parâmetros informados são inválidos!";
    }

    // Redirecione de volta para a página anterior
    $path = $_SERVER['HTTP_REFERER'];
    header("Location: $path");
    exit(); // Certifique-se de sair para evitar execução adicional do código
}
