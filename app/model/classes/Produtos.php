<?php
include_once('../model/dao/ProdutosDao.php');


class Produtos
{

    private $idProdutos;
    private $nome;
    private $descricao;
    private $preco;
    private $imagem;

    public function __construct($idProdutos, $nome, $descricao, $preco, $imagem)
    {
        $this->setIdProdutos($idProdutos);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setPreco($preco);
        $this->setImagem($imagem);
    }
    /**
     * Get the value of idProduto
     */
    public function getIdProdutos()
    {
        return $this->idProdutos;
    }

    /**
     * Set the value of idProduto
     *
     * @return  self
     */
    public function setIdProdutos($idProdutos)
    {
        $this->idProdutos = $idProdutos;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of preco
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of imagem
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }
    public function IncluirProduto()
    {
        $produtosDao = new ProdutosDao();
        if ($produtosDao->IncluirProduto($this)) {
            return true;
        } else {
            return false;
        }
    }
}
