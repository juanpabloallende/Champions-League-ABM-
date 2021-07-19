<?php

class Usuario
{
    private $id;
    private $usuario;
    private $password;
    private $email;

    /**
     * Retorna el usuario al que pertenece el $email.
     * Si no existe, retorna null.
     *
     * @param string $email
     * @return Usuario|null
     */
    public function getByEmail(string $email)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM usuarios
                    WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        // Si no podemos obtener la fila, retornamos null.
        if(!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }

        $usuario = new Usuario;
        $usuario->id = $fila['id'];
        $usuario->usuario = $fila['usuario'];
        $usuario->password = $fila['password'];
        $usuario->email = $fila['email'];

        return $usuario;
    }

    /**
     * Retorna el usuario al que pertenece la $pk.
     * De no existir, retorna null.
     *
     * @param int $pk
     * @return Usuario|null
     */
    public function getByPk(int $pk)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM usuarios
                    WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$pk]);

        // Si no podemos obtener la fila, retornamos null.
        if(!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }

        $usuario = new Usuario;
        $usuario->id = $fila['id'];
        $usuario->usuario = $fila['usuario'];
        $usuario->password = $fila['password'];
        $usuario->email = $fila['email'];

        return $usuario;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
}
