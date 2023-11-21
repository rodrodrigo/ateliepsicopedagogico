<?php


include_once ('../model/classes/Produtos.php');

class ProdutosDao {
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

    public function IncluirProduto($produtos) {
        $sql = "INSERT INTO produtos (idProduto, nome, descricao, preco, imagem)
                VALUES (null, :nome, :descricao, :preco, :imagem)";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }

            $nome = $produtos->getNome();
            $descricao = $produtos->getdescricao();
            $preco = $produtos->getPreco();
            $imagem = $produtos->getImagem(); // Adicione o método getImagem() se não existir.

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':preco', $preco); 
            $stmt->bindParam(':imagem', $imagem);

            $stmt->execute();
            echo "\nExecução bem sucedida no INSERT";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha no INSERT! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }
    
    public function AlterarProdutos($produtos) {
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE idProduto = :idProduto";
    
        try {
            $stmt = $this->connection->prepare($sql);
    
            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }
    
            $idProduto = $produtos->getIdprodutos();
            $nome = $produtos->getNome();
            $descricao = $produtos->getDescricao();
            $preco = $produtos->getPreco();
            $imagem = $produtos->getImagem();

    
            $stmt->bindParam(':idProduto', $idProduto);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':imagem', $imagem);
            
            $stmt->execute();
            echo "\nExecução bem-sucedida na atualização";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha na atualização! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }




    public function DeletarProd($idprodutos) {
        $sql = "DELETE FROM produtos WHERE idProduto = :idProdutos";
    
        try {
            $stmt = $this->connection->prepare($sql);
    
            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }
    
            $stmt->bindParam(':idProdutos', $idprodutos, PDO::PARAM_INT);
    
            $stmt->execute();
            echo "\nExecução bem-sucedida na exclusão";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha na exclusão! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }
    
}
