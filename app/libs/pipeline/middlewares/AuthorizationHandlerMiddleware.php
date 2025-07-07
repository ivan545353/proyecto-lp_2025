<?php

namespace app\libs\pipeline\middlewares;

use app\libs\pipeline\middlewares\base\BaseMiddleware;
use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;

final class AuthorizationHandlerMiddleware extends BaseMiddleware implements InterfaceMiddleware {

    public function __construct(){
        parent::__construct();
    }

    public function handler(Request $request, Response $response): void {
        $perfil = $_SESSION["perfil"] ?? null;
        $controller = $request->getController();
        $action = $request->getAction();

        // Permitir acceso a estas acciones para cualquier perfil
        $accionesPermitidas = ["myAccount", "getCurrent", "changePassword"];

        if ($controller === "user" && $perfil !== "Administrador" && !in_array($action, $accionesPermitidas)) {
            $_SESSION["flash_error"] = "Acceso no autorizado.";
            header("Location: " . APP_URL . "home/index");
            exit;
        }

        $this->handlerNext($request, $response);
    }


}
