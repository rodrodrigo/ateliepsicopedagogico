<?php
include_once('../model/dao/PostagemDao.php');

class Postagem{

    private $idPostagem;
    private $nomeVendedora;
    private $titulo;
    private $dataPost;
    private $imagem;
    private $texto;


    
    public function __construct($idPostagem, $nomeVendedora, $titulo, $dataPost, $imagem, $texto)
    {
            $this->setIdPostagem($idPostagem);
            $this->setNomeVendedora($nomeVendedora);
            $this->setTitulo($titulo);
            $this->setDataPost($dataPost);
            $this->setImagem($imagem);
            $this->setTexto($texto);
            
    }

    /**
     * Get the value of idPostagem
     */ 
    public function getIdPostagem()
    {
        return $this->idPostagem;
    }

    /**
     * Set the value of idPostagem
     *
     * @return  self
     */ 
    public function setIdPostagem($idPostagem)
    {
        $this->idPostagem = $idPostagem;

        return $this;
    }

    /**
     * Get the value of nomeVendedora
     */ 
    public function getNomeVendedora()
    {
        return $this->nomeVendedora;
    }

    /**
     * Set the value of nomeVendedora
     *
     * @return  self
     */ 
    public function setNomeVendedora($nomeVendedora)
    {
        $this->nomeVendedora = $nomeVendedora;

        return $this;
    }

    /**
     * Get the value of dataPost
     */ 
    public function getDataPost()
    {
        return $this->dataPost;
    }

    /**
     * Set the value of dataPost
     *
     * @return  self
     */ 
    public function setDataPost($dataPost)
    {
        $this->dataPost = $dataPost;

        return $this;
    }

    /**
     * Get the value of dataMod
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of dataMod
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

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

    /**
     * Set the value of texto
     *
     * @return  self
     */ 
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get the value of texto
     */ 
    public function getTexto()
    {
        return $this->texto;
    }
    public function incluirPostagem(){
        $postagemDao= new PostagemDao();
        if($postagemDao->incluirPostagem($this)){
            return true;
        } else{
            return false;
        }
    }
   
}
