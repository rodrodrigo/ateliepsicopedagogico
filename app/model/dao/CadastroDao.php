<?php
// Vendedora 
include_once('../model/classes/Vendedora.php');



class VendedoraDao{
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


// Inserir:
public function incluirVendedora($Vendedora) {
    $sql = "INSERT INTO vendedora (idVendedora, nome, cpf, cep, logradouro, bairro, cidade, uf, telefone, email, senha, perguntarec)
            VALUES (null, :nome, :cpf, :cep, :logradouro, :bairro, :cidade, :uf, :telefone, :email, :senha, :perguntarec)";

    try {
        $stmt = $this->connection->prepare($sql);

        if (!$stmt) {
            throw new Exception("Falha na preparação da consulta.");
        }

        $nome = $Vendedora->getNome();
        $cpf = $Vendedora->getCpf();
        $cep = $Vendedora->getCep();
        $logradouro = $Vendedora->getLogradouro();
        $bairro = $Vendedora->getBairro();
        $cidade = $Vendedora->getCidade();
        $uf = $Vendedora->getUf();
        $telefone = $Vendedora->getTelefone();
        $email = $Vendedora->getEmail();
        $senha = $Vendedora->getSenha();
        $perguntarec = $Vendedora->getPerguntarec();


        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':cep', $cep);

        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        
        $stmt->bindParam(':uf', $uf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':perguntarec', $perguntarec);

 
        $stmt->execute();
        echo "\nExecução bem sucedida no INSERT";
        return true;
    } catch (PDOException $e) {
        echo "\nFalha no INSERT! Mensagem de erro: " . $e->getMessage();
        return false;
    }
}

public function RecuperarSenha($email, $novaSenha) {
    $sql = "UPDATE vendedora SET senha = :senha WHERE email = :email";

    try {
        $stmt = $this->connection->prepare($sql);

        if (!$stmt) {
            throw new Exception("Falha na preparação da consulta.");
        }

        $stmt->bindParam(':senha', $novaSenha);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "\nSenha atualizada com sucesso!";
            return true;
        } else {
            echo "\nFalha na atualização da senha!";
            return false;
        }
    } catch (PDOException $e) {
        echo "\nErro ao atualizar a senha! Mensagem de erro: " . $e->getMessage();
        return false;
    }
}


}
