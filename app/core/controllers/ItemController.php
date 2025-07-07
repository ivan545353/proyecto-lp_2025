<?php

namespace app\core\controllers;

use app\libs\http\Request;
use app\libs\http\Response;
use app\core\controllers\base\BaseController;
use app\core\controllers\base\InterfaceController;
use app\core\services\ItemService;
use app\core\models\dto\ItemDto;

final class ItemController extends BaseController implements InterfaceController {

    public function index(Request $request, Response $response): void {
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");
        
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function load(Request $request, Response $response): void {
        $service = new ItemService();
        $dto = $service->load((int) $request->getId());
        $response->setResult($dto->toArray());
        $response->send();
    }

    public function create(Request $request, Response $response): void {
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");
        
        $response->setMessage("<p>Redirigiendo a Item/create.</p>");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function save(Request $request, Response $response): void {
        $dto = new ItemDto($request->getDataFromInput());
        $service = new ItemService();
        $service->save($dto);

        $response->setMessage("Se agregó un nuevo producto al sistema");
        $response->send();
    }

    public function edit(Request $request, Response $response): void {
        array_push($this->scripts, "app/js/{$request->getController()}/{$request->getAction()}.js");
        array_push($this->styles, "app/css/{$request->getController()}/{$request->getAction()}.css");
        
        $response->setMessage("<p>Redirigiendo a item/edit.</p>");
        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function update(Request $request, Response $response): void {
        $dto = new ItemDto($request->getDataFromInput());
        $service = new ItemService();
        $service->update($dto);

        $response->setMessage("Se modificó el producto correctamente");
        $response->send();
    }

    public function delete(Request $request, Response $response): void {
        $service = new ItemService();
        $dto = $service->load($request->getId());
        $service->delete($dto);

        $response->setMessage("Se eliminó el producto correctamente");
        $response->send();
    }

    public function list(Request $request, Response $response): void {
        // Leer el body JSON
        $filters = $request->getDataFromInput();  // ← ahora viene desde el POST

        $service = new ItemService();
        $productos = $service->list($filters ?? []);

        $response->setResult($productos);
        $response->send();
    }
}
