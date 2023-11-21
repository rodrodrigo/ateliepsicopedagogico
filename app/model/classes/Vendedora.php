<?php


include_once('../model/dao/CadastroDao.php');

class Vendedora
{

    private $idVendedora;
    private $nome;
    private $cpf;
    private $cep;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $uf;
    private $telefone;
    private $email;
    private $senha;
    private $perguntarec;

    public function __construct($idVendedora, $nome, $cpf, $cep, $logradouro, $bairro, $cidade, $uf, $telefone, $email, $senha,  $perguntarec)
    {
        $this->setIdVendedora($idVendedora);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setCep($cep);
        $this->setLogradouro($logradouro);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setUf($uf);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setPerguntarec($perguntarec);
    }
    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $cpf_cnpj
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getIdVendedora()
    {
        return $this->idVendedora;
    }

    public function setIdVendedora($idVendedora)
    {
        $this->idVendedora = $idVendedora;
    }




    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
    // Inserir:
    public function incluirVendedora()
    {
        $VendedoraDao = new VendedoraDao();
        if ($VendedoraDao->incluirVendedora($this)) {
            return true;
        } else {
            return false;
        }
    }
    public function RecuperarSenha($email, $novaSenha)
    {
        $VendedoraDao = new VendedoraDao();
        if ($VendedoraDao->RecuperarSenha($email, $novaSenha)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Get the value of perguntarec
     */
    public function getPerguntarec()
    {
        return $this->perguntarec;
    }

    /**
     * Set the value of perguntarec
     *
     * @return  self
     */
    public function setPerguntarec($perguntarec)
    {
        $this->perguntarec = $perguntarec;

        return $this;
    }
}
