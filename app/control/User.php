<?php
    class User
    {
        private $idConta;
        private $nick;
        private $senha;
        private $email;
        private $genero;

    // Construtor
    public function __construct($idConta, $nick, $senha, $email, $genero)
    {
        $this->idConta = $idConta;
        $this->nick = $nick;
        $this->senha = $senha;
        $this->email = $email;
        $this->genero = $genero;
    }

    // Métodos Get
    public function getIdConta()
    {
        return $this->idConta;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    // Métodos Set
    public function setIdConta($idConta)
    {
        $this->idConta = $idConta;
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }
    }