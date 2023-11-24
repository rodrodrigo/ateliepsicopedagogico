<?php


include_once('../model/classes/Postagem.php');

class PostagemDao
{
    private $connection; // conexão banco

    public function __construct()
    {
        $host = "144.217.39.54";
        $user = "hostdeprojetos";
        $pass = "ifspgru@2022";
        $dbname = "hostdeprojetos_dbatelie";

        try {
            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }

    public function incluirPostagem($postagem)
    {
        $sql = "INSERT INTO postagem (idPostagem, nomeVendedora, titulo, dataPost, imagem, texto)
                VALUES (null, :nomeVendedora, :titulo, NOW(), :imagem, :texto)";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }

            $nomeVendedora = $postagem->getNomeVendedora();
            $titulo = $postagem->getTitulo();
            $texto = $postagem->getTexto();
            $imagem = $postagem->getImagem(); // Adicione o método getImagem() se não existir.

            $stmt->bindParam(':nomeVendedora', $nomeVendedora);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':imagem', $imagem); // Bind do caminho da imagem
            $stmt->bindParam(':texto', $texto);

            $stmt->execute();
            echo "\nExecução bem sucedida no INSERT";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha no INSERT! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }

    public function AlterarPostagem($postagem)
    {
        $sql = "UPDATE postagem SET nomeVendedora = :nomeVendedora, titulo = :titulo, texto = :texto, imagem = :imagem WHERE idPostagem = :idPostagem";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }

            $idPostagem = $postagem->getIdPostagem();
            $nomeVendedora = $postagem->getNomeVendedora();
            $titulo = $postagem->getTitulo();
            $texto = $postagem->getTexto();
            $imagem = $postagem->getImagem();


            $stmt->bindParam(':idPostagem', $idPostagem);
            $stmt->bindParam(':nomeVendedora', $nomeVendedora);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':texto', $texto);
            $stmt->bindParam(':imagem', $imagem);


            $stmt->execute();
            echo "\nExecução bem-sucedida na atualização";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha na atualização! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }



    public function DeletarPost($idPostagem)
    {
        $sql = "DELETE FROM postagem WHERE idPostagem = :idPostagem";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                throw new Exception("Falha na preparação da consulta.");
            }

            $stmt->bindParam(':idPostagem', $idPostagem, PDO::PARAM_INT);

            $stmt->execute();
            echo "\nExecução bem-sucedida na exclusão";
            return true;
        } catch (PDOException $e) {
            echo "\nFalha na exclusão! Mensagem de erro: " . $e->getMessage();
            return false;
        }
    }
}
