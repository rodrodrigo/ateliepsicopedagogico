<?php
include_once('../model/dao/PedidosDao.php');

class Pedidos{

    private $idPedido;
    private $nomeUsuario;
    private $emailUsuario;
    private $telefoneUsuario;
    private $dtPedido;
    private $metPag;
    private $entregaCEP;
    private $entregaEndereco;
    private $entregaNumero;
    private $entregaBairro;
    private $entregaCidade;
    private $entregaUF;
    private $nomeProduto;
    private $valorTotal;

    
    public function __construct($idPedido,
    $nomeUsuario,
    $emailUsuario,
    $telefoneUsuario,
    $dtPedido,
    $metPag,
    $entregaCEP,
    $entregaEndereco,
    $entregaNumero,
    $entregaBairro,
    $entregaCidade,
    $entregaUF,
    $nomeProduto,
    $valorTotal
)
    {
        $this->setIdPedido($idPedido);
        $this->setnomeUsuario($nomeUsuario);
        $this->setEmailUsuario($emailUsuario);
        $this->setTelefoneUsuario($telefoneUsuario);

        $this->setDtPedido($dtPedido);
        $this->setMetPag($metPag);
        $this->setEntregaCEP($entregaCEP);
        $this->setEntregaEndereco($entregaEndereco);
        $this->setEntregaNumero($entregaNumero);
        $this->setEntregaBairro($entregaBairro);
        $this->setEntregaCidade($entregaCidade);
        $this->setEntregaUF($entregaUF);
        $this->setNomeProduto($nomeProduto);
        $this->setValorTotal($valorTotal);
        

    }

 

    /**
     * Get the value of idPedido
     */ 
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set the value of idPedido
     *
     * @return  self
     */ 
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    /**
     * Get the value of nomeUsuario
     */ 
    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    /**
     * Set the value of nomeUsuario
     *
     * @return  self
     */ 
    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;

        return $this;
    }

    /**
     * Get the value of emailUsuario
     */ 
    public function getEmailUsuario()
    {
        return $this->emailUsuario;
    }

    /**
     * Set the value of emailUsuario
     *
     * @return  self
     */ 
    public function setEmailUsuario($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;

        return $this;
    }

    /**
     * Get the value of telefoneUsuario
     */ 
    public function getTelefoneUsuario()
    {
        return $this->telefoneUsuario;
    }

    /**
     * Set the value of telefoneUsuario
     *
     * @return  self
     */ 
    public function setTelefoneUsuario($telefoneUsuario)
    {
        $this->telefoneUsuario = $telefoneUsuario;

        return $this;
    }

    /**
     * Get the value of dtPedido
     */ 
    public function getDtPedido()
    {
        return $this->dtPedido;
    }

    /**
     * Set the value of dtPedido
     *
     * @return  self
     */ 
    public function setDtPedido($dtPedido)
    {
        $this->dtPedido = $dtPedido;

        return $this;
    }

    /**
     * Get the value of metPag
     */ 
    public function getMetPag()
    {
        return $this->metPag;
    }

    /**
     * Set the value of metPag
     *
     * @return  self
     */ 
    public function setMetPag($metPag)
    {
        $this->metPag = $metPag;

        return $this;
    }

    /**
     * Get the value of entregaCEP
     */ 
    public function getEntregaCEP()
    {
        return $this->entregaCEP;
    }

    /**
     * Set the value of entregaCEP
     *
     * @return  self
     */ 
    public function setEntregaCEP($entregaCEP)
    {
        $this->entregaCEP = $entregaCEP;

        return $this;
    }

    /**
     * Get the value of entregaEndereco
     */ 
    public function getEntregaEndereco()
    {
        return $this->entregaEndereco;
    }

    /**
     * Set the value of entregaEndereco
     *
     * @return  self
     */ 
    public function setEntregaEndereco($entregaEndereco)
    {
        $this->entregaEndereco = $entregaEndereco;

        return $this;
    }

    /**
     * Get the value of entregaNumero
     */ 
    public function getEntregaNumero()
    {
        return $this->entregaNumero;
    }

    /**
     * Set the value of entregaNumero
     *
     * @return  self
     */ 
    public function setEntregaNumero($entregaNumero)
    {
        $this->entregaNumero = $entregaNumero;

        return $this;
    }

    /**
     * Get the value of entregaBairro
     */ 
    public function getEntregaBairro()
    {
        return $this->entregaBairro;
    }

    /**
     * Set the value of entregaBairro
     *
     * @return  self
     */ 
    public function setEntregaBairro($entregaBairro)
    {
        $this->entregaBairro = $entregaBairro;

        return $this;
    }

    /**
     * Get the value of entregaCidade
     */ 
    public function getEntregaCidade()
    {
        return $this->entregaCidade;
    }

    /**
     * Set the value of entregaCidade
     *
     * @return  self
     */ 
    public function setEntregaCidade($entregaCidade)
    {
        $this->entregaCidade = $entregaCidade;

        return $this;
    }

    /**
     * Get the value of entregaUF
     */ 
    public function getEntregaUF()
    {
        return $this->entregaUF;
    }

    /**
     * Set the value of entregaUF
     *
     * @return  self
     */ 
    public function setEntregaUF($entregaUF)
    {
        $this->entregaUF = $entregaUF;

        return $this;
    }

    /**
     * Get the value of nomeProduto
     */ 
    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    /**
     * Set the value of nomeProduto
     *
     * @return  self
     */ 
    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;

        return $this;
    }

    /**
     * Get the value of valorTotal
     */ 
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Set the value of valorTotal
     *
     * @return  self
     */ 
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }
    public function incluirPedido() {
        $pedidoDao = new PedidosDao();
        if ($pedidoDao->incluirPedido($this)) {
            return true;
        } else {
            return false;
        }
    }
}
