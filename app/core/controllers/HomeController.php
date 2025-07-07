<?php

namespace app\core\controllers;

use app\core\controllers\base\BaseController;
use app\libs\http\Request;
use app\libs\http\Response;
use app\core\services\UserService;
use app\core\services\ItemService;
use app\core\services\CategoryService;

final class HomeController extends BaseController{

    private UserService $userService;
    private ItemService $itemService;
    private CategoryService $categoryService;

    public function __construct(){
        parent::__construct([], []);

        $this->userService = new UserService();
        $this->itemService = new ItemService();
        $this->categoryService = new CategoryService();
    }

    public function index(Request $request, Response $response): void {
        // obtener listas completas con filtro vacío
        $users = $this->userService->list([]);
        $items = $this->itemService->list([]);
        $categories = $this->categoryService->list([]);

        // contar los elementos para estadísticas
        $userCount = count($users);
        $itemCount = count($items);
        $categoryCount = count($categories);

        // pasar los datos a la vista (puede ser $_REQUEST, $_SESSION o propiedades del controlador)
        $_REQUEST["userCount"] = $userCount;
        $_REQUEST["itemCount"] = $itemCount;
        $_REQUEST["categoryCount"] = $categoryCount;

        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");

        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }
}