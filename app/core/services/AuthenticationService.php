<?php

namespace app\core\services;

use app\core\models\dao\UserDao;
use app\core\models\dto\UserDto;
use app\libs\database\Connection;
use app\core\models\dto\LoginDto;

final class AuthenticationService {

    private UserDao $dao;

    public function __construct() {
        $this->dao = new UserDao(Connection::get());
    }

    public function login(LoginDto $login): void {
       $conn = Connection::get();

       //AUTENTICACIÓN DEL USUARIO
       $usuarioDao = new UserDao($conn);
       $usuario = $usuarioDao->login($login->getUserName());

       if(!password_verify($login->getPassword(), $usuario["clave"])){
        throw new \Exception("El usuario o la clave es incorrecta.");
       }

       if($usuario["estado"] !== 1){
        throw new \Exception("Su cuenta está inactiva.");
       }

       if($usuario["resetPass"] !== 0){
        throw new \Exception("Su clave ha caducado.");
       }

       //SE REGISTRAN LAS VARIABLES DE SESIÓN
       $_SESSION["token"] = APP_TOKEN;
       $_SESSION["usuarioID"] =(int) $usuario["id"];
       $_SESSION["usuario"] = $usuario["cuenta"];
       $_SESSION["perfil"] = $usuario["perfil"];
       $_SESSION["correo"] = $usuario["correo"];
    }


    /**
     * Cierra la sesión actual.
     */
    public function logout(): void {
        session_unset();

        if (ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"],
            $params["domain"], $params["secure"], $params["httponly"]);
        }

        session_destroy();
    }

}
