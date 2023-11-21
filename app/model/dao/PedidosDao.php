<?php
include_once('../model/classes/Pedidos.php');

class PedidosDao {
    private $connection; // conexão banco

    public function __construct() {
        $host = "144.217.39.54";
        $user = "hostdeprojetos";
        $pass = "ifspgru@2022";
        $dbname = "hostdeprojetos_dbatelie";

        try {
            $this->connection = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }

    public function incluirPedido($pedido) {
        $sql = "INSERT INTO  pedidos (idPedido, nomeUsuario, emailUsuario, telefoneUsuario, dtPedido, metPag,
         entregaCEP, entregaEndereco, entregaNumero, entregaBairro, entregaCidade, entregaUF, nomeProduto,
          valorTotal) 
        VALUES (null, :nome, :email, :telefone, :dataFormatada, :modoPagamento, :cep, :logradouro,
        :numeroEndereco, :bairro, :cidade, :uf, :produto, :preco)";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }

            $nome = $pedido->getNomeUsuario();
            $email = $pedido->getEmailUsuario();
            $telefone = $pedido->getTelefoneUsuario();
            $dataFormatada = $pedido->getDtPedido();
            $modoPagamento = $pedido->getMetPag();
            $cep = $pedido->getEntregaCEP();
            $logradouro = $pedido->getEntregaEndereco();
            $numeroEndereco = $pedido->getEntregaNumero();
            $bairro = $pedido->getEntregaBairro();
            $cidade = $pedido->getEntregaCidade();
            $uf = $pedido->getEntregaUF();
            $produto = $pedido->getNomeProduto();
            $preco = $pedido->getValorTotal();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':dataFormatada', $dataFormatada);
            $stmt->bindParam(':modoPagamento', $modoPagamento);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':logradouro', $logradouro);
            $stmt->bindParam(':numeroEndereco', $numeroEndereco);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':uf', $uf);
            $stmt->bindParam(':produto', $produto);
            $stmt->bindParam(':preco', $preco);

            $stmt->execute();
            echo "\nExecução bem-sucedida no INSERT";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha no INSERT! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }



    public function DeletarPedido($idPedido)
    {
        $sql = "DELETE FROM pedidos WHERE idPedido = :idPedido";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }

            $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);

            $stmt->execute();
            echo "\nExecução bem-sucedida na exclusão";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha na exclusão! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }

    public function alterarpedido($pedidos)
    {
        $sql = "UPDATE pedidos SET 
        nomeUsuario = :nomeUsuario,
        emailUsuario = :emailUsuario,
        telefoneUsuario = :telefoneUsuario,
        dtPedido = :dtPedido,
        metPag = :metPag,
        entregaCEP = :entregaCEP,
        entregaEndereco = :entregaEndereco,
        entregaNumero = :entregaNumero,
        entregaBairro = :entregaBairro,
        entregaCidade = :entregaCidade,
        entregaUF = :entregaUF,
        nomeProduto = :nomeProduto,
        valorTotal = :valorTotal
        WHERE idPedido = :idPedido";
        try {
            $stmt = $this->connection->prepare($sql);
    
            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }
    
            $nomeUsuario = $pedidos->getNomeUsuario();
            $emailUsuario = $pedidos->getEmailUsuario();
            $telefoneUsuario = $pedidos->getTelefoneUsuario();
            $dataFormatada = $pedidos->getDtPedido();
            $metPag = $pedidos->getMetPag();
            $entregaCEP = $pedidos->getEntregaCEP();
            $entregaEndereco = $pedidos->getEntregaEndereco();
            $entregaNumero = $pedidos->getEntregaNumero();
            $entregaBairro = $pedidos->getEntregaBairro();
            $entregaCidade = $pedidos->getEntregaCidade();
            $entregaUF = $pedidos->getEntregaUF();
            $nomeProduto = $pedidos->getNomeProduto();
            $valorTotal = $pedidos->getValorTotal();
    
    
            $stmt->bindParam(':nomeUsuario', $nomeUsuario);
            $stmt->bindParam(':emailUsuario', $emailUsuario);
            $stmt->bindParam(':telefoneUsuario', $telefoneUsuario);
            $stmt->bindParam(':dtPedido', $dataFormatada); // corrigido para :dtPedido
            $stmt->bindParam(':metPag', $metPag);
            $stmt->bindParam(':entregaCEP', $entregaCEP);
            $stmt->bindParam(':entregaEndereco', $entregaEndereco);
            $stmt->bindParam(':entregaNumero', $entregaNumero);
            $stmt->bindParam(':entregaBairro', $entregaBairro);
            $stmt->bindParam(':entregaCidade', $entregaCidade);
            $stmt->bindParam(':entregaUF', $entregaUF);
            $stmt->bindParam(':nomeProduto', $nomeProduto);
            $stmt->bindParam(':valorTotal', $valorTotal);
            $stmt->bindParam(':idPedido', $pedidos->getIdPedido()); // Certifique-se de obter o idPedido corretamente
    
            $stmt->execute();
            echo "\nExecução bem-sucedida na atualização";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha na atualização! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }
    




}
?>
