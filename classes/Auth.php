<?php

class Auth
{
    /**
     * Intenta autenticar al usuario.
     * Si tiene éxito, retorna true.
     * De lo contrario, retorna false.
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        // Buscamos el usuario por su email.
        $user = new Usuario;
        $user = $user->getByEmail($email);

        // Verificamos si hay un usuario.
        if($user !== null) {
            // Comparamos los passwords.
            if(password_verify($password, $user->getPassword())) {
                $this->setAsAuthenticated($user);
                return true;
            }
        
        }
        return false;
    }

    /**
     * Marca el $user como autenticado.
     *
     * @param Usuario $user
     */
    public function setAsAuthenticated(Usuario $user): void
    {
        $_SESSION['id'] = $user->getId();
    }

    /**
     * Desautentica al usuario.
     */
    public function logout(): void
    {
        unset($_SESSION['id']);
    }

    /**
     * Retorna si el usuario está autenticado o no.
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return isset($_SESSION['id']);
    }

    /**
     * Retorna el usuario autenticado.
     * Si no está autenticado, retorna null.
     *
     * @return Usuario|null
     */
    public function getUser()
    {
        if(!$this->isAuthenticated()) {
            return null;
        }

        $usuario = new Usuario;
        return $usuario->getByPk($_SESSION['id']);
    }
}
