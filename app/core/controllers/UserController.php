<?php

namespace app\core\controllers;

use app\libs\http\Request;
use app\libs\http\Response;
use app\core\controllers\base\BaseController;
use app\core\controllers\base\InterfaceController;
use app\core\services\UserService;
use app\core\models\dto\UserDto;

final class UserController extends BaseController implements InterfaceController {

  

    public function load(Request $request, Response $response): void {
        $service = new UserService();
        $dto = $service->load((int) $request->getId());
        $response->setResult($dto->toArray());
        $response->send();
    }

   

    public function save(Request $request, Response $response): void {
        $dto = new UserDto($request->getDataFromInput());
        $service = new UserService();
        $service->save($dto);

        $response->setMessage("Se agregó un nuevo usuario al sistema");
        $response->send();
    }

   


    public function update(Request $request, Response $response): void {
        $dto = new UserDto($request->getDataFromInput());
        $service = new UserService();
        $service->update($dto);

        $response->setMessage("Se modificó el usuario correctamente");
        $response->send();
    }

    public function delete(Request $request, Response $response): void {
        $service = new UserService();
        $dto = $service->load($request->getId());
        $service->delete($dto);

        $response->setMessage("Se eliminó el usuario correctamente");
        $response->send();
    }


    public function list(Request $request, Response $response): void {
        $filters = [
            "nombres" => $request->getParameterValue("nombres", null),
            "limit"   => $request->getParameterValue("limit", null)
        ];

        $service = new UserService();
        $usuarios = $service->list($filters);

        $response->setResult($usuarios);
        $response->send();
    }

    public function enable(Request $request, Response $response): void {
        $id = (int) $request->getId();
        $service = new UserService();
        $service->enable($id);
        $response->setMessage("El usuario fue habilitado.");
        $response->send();
    }

    public function disable(Request $request, Response $response): void {
        $id = (int) $request->getId();
        $service = new UserService();
        $service->disable($id);
        $response->setMessage("El usuario fue deshabilitado.");
        $response->send();
    }

    public function reset(Request $request, Response $response): void {
        $id = (int) $request->getId();
        $service = new UserService();
        $service->reset($id);
        $response->setMessage("La contraseña fue restablecida.");
        $response->send();
    }

    public function changePassword(Request $request, Response $response): void {
        $response->setController("user");
        $response->setAction("changePassword");

        $data = $request->getDataFromInput();

        if (!$data) {
            $response->setError("No se enviaron datos");
            $response->send();
            return;
        }
        // TODO Fase 4: reemplazar $_SESSION por $request->getAuthUser()
        // En lugar de:  $userId = $_SESSION["usuarioID"] ?? null;
        $userId = $request->getAuthUser()->usuarioID ?? null;
        $currentPassword = $data["currentPassword"] ?? null;
        $newPassword = $data["newPassword"] ?? null;
        $confirmPassword = $data["confirmPassword"] ?? null;

        if (!$userId || !$currentPassword || !$newPassword || !$confirmPassword) {
            $response->setError("Datos incompletos");
            $response->send();
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $response->setError("Las contraseñas no coinciden");
            $response->send();
            return;
        }

        $service = new UserService();
        $success = $service->changePassword($userId, $currentPassword, $newPassword);

        if ($success) {
            $response->setMessage("Contraseña actualizada correctamente");
        } else {
            $response->setError("La contraseña actual es incorrecta");
        }

        $response->send();
    }

    public function getCurrent(Request $request, Response $response): void {
        // En lugar de:  $userId = $_SESSION["usuarioID"] ?? null;
        $userId = $request->getAuthUser()->usuarioID ?? null;

        if (!$userId) {
            $response->setController("user");
            $response->setAction("getCurrent");
            $response->setError("Sesión no iniciada o usuario no válido");
            $response->send();
            return;
        }

        $service = new UserService();
        $usuario = $service->load($userId);

        if (!$usuario) {
            $response->setError("Usuario no encontrado");
        } else {
            $response->setResult($usuario->toArray());
        }

        $response->send();
    }

    public function perfiles(Request $request, Response $response): void {
        $service = new UserService();
        $response->setResult($service->listProfiles());
        $response->send();
    }
}
