<?php

namespace app\core\controllers;

use app\libs\http\Request;
use app\libs\http\Response;
use app\core\controllers\base\BaseController;
use app\core\controllers\base\InterfaceController;
use app\core\services\CategoryService;
use app\core\models\dto\CategoryDto;

final class CategoryController extends BaseController implements InterfaceController{

    public function index(Request $request, Response $response): void{
        //HAGO UN PUSH DE LOS SCRIPTS QUE TIENE QUE CARGAR LA PLANTILLA
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }


    public function load(Request $request, Response $response): void{
        $service = new CategoryService();
        $dto = $service->load((int) $request->getId());
        $response->setResult($dto->toArray());
        $response->send();
    }

    public function create(Request $request, Response $response):void{
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");
        
        $response->setMessage("<p>Redirigiendo a Category/create.</p>");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function save(Request $request, Response $response): void{
        $dto = new CategoryDto($request->getDataFromInput());
        $service = new CategoryService();
        $service->save($dto);
    
        $response->setMessage("<p>Se agregó una nueva categoría al sistema</p>");
        $response->send();
    }

    public function edit(Request $request, Response $response): void {
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");

        $response->setMessage("<p>Redirigiendo a Category/edit.</p>");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }


    public function update(Request $request, Response $response): void{
        $dto = new CategoryDto($request->getDataFromInput());
        $service = new CategoryService();
        $service->update($dto);

        $response->setMessage("<p>Se modificó la categoría correctamente</p>");
        $response->send();
    }


    public function delete(Request $request, Response $response): void{
        $service = new CategoryService();
        $dto = $service->load($request->getId());
        $service->delete($dto);

        $response->setMessage("<p>Se eliminó la categoría correctamente</p>");
        $response->send();
    }


    public function list(Request $request, Response $response): void{
        $filters = [
            "estado" => $request->getParameterValue("estado", null),
            "limit"  => $request->getParameterValue("limit", null)
        ];

        $service = new CategoryService();
        $categorias = $service->list($filters);

        $response->setResult($categorias);
        $response->send();
    }

}