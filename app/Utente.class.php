<?php
class Utente {
    protected $id;
    protected $ruolo;
    protected $nome;
    protected $email;
    protected $password;
    protected $path_img;
    protected $token;
    protected $scadenza;
    // Costruttore
    public function __construct($id, $ruolo, $nome, $email, $password, $path_img = "/app/assets/profile.jpg") {
        $this->id = $id;
        $this->ruolo = $ruolo;
        $this->nome = $nome;
        $this->email = $email;
        $this->password = $password;
        $this->path_img = $path_img;
    }

    // Metodi getter
    public function getId() {
        return $this->id;
    }

    public function getRuolo() {
        return $this->ruolo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }
    


    public function getPassword() {
        return $this->password;
    }

    public function getPath_img() {
        return $this->path_img;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setScadenza($scadenza) {
        $this->scadenza = $scadenza;
    }

    public function getToken() {
        return $this->token;
    }

    public function getScadenza() {
        return $this->scadenza;
    }
}

class User extends Utente {
    public function __construct($id, $ruolo, $nome, $email, $password, $path_img = "/app/assets/profile.jpg") {
        parent::__construct($id, $ruolo, $nome, $email, $password, $path_img = "/app/assets/profile.jpg");
    }
}

class Trainer extends Utente {
    public function __construct($id, $ruolo, $nome, $email, $password, $path_img = "/app/assets/profile.jpg") {
        parent::__construct($id, $ruolo, $nome, $email, $password, $path_img = "/app/assets/profile.jpg");
    }
}

class Admin extends Utente {
    public function __construct($id, $ruolo, $nome, $email, $password, $path_img = "/app/assets/profile.jpg") {
        parent::__construct($id, $ruolo, $nome, $email, $password, $path_img = "/app/assets/profile.jpg");
    }
}
?>