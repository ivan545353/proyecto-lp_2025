<?php

namespace app\libs\pipeline\middlewares;

use app\libs\pipeline\middlewares\base\BaseMiddleware;
use app\libs\pipeline\middlewares\base\InterfaceMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;

final class AuthenticationHandlerMiddleware extends BaseMiddleware implements InterfaceMiddleware {

    public function __construct() {
        parent::__construct();
    }

    public function Handler(Request $request, Response $response): void {
        session_start();

        $isApiCall = isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json');

        if ($isApiCall) {
            $this->handlerNext($request, $response);
            return;
        }

        $tokenActivo = isset($_SESSION["token"]) && $_SESSION["token"] === APP_TOKEN;
        $controller = $request->getController();
        $action = $request->getAction();

        // Si ya hay sesión y se intenta ir al login, redirigir a home
        if ($tokenActivo && $controller === APP_AUTHENTICATION_CONTROLLER && $action === APP_LOGIN_ACTION) {
            $request->setController("home");
            $request->setAction("index");
        }

        // Si no hay sesión y no está en login, redirigir al login
        if (!$tokenActivo && !($controller === APP_AUTHENTICATION_CONTROLLER && $action === APP_LOGIN_ACTION)) {
            $request->setController(APP_AUTHENTICATION_CONTROLLER);
            $request->setAction(APP_LOGIN_ACTION);
        }

        $this->handlerNext($request, $response);
    }


}
