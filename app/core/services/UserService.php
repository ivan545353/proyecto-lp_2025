<?php

namespace app\core\services;

use app\core\models\dao\UserDao;
use app\core\models\dto\UserDto;
use app\core\models\dto\base\InterfaceDto;
use app\core\services\base\InterfaceService;
use app\libs\database\Connection;

final class UserService implements InterfaceService {

    public function load(int $id): InterfaceDto {
        $dao = new UserDao(Connection::get());
        $data = $dao->load($id);
        return new UserDto($data);
    }

    public function save(InterfaceDto $dto): void {
        $this->validate($dto);
        $data = $dto->toArray();
        unset($data["id"]);
        // Hashear la clave si está definida
        if (!empty($data["clave"])) {
            $data["clave"] = password_hash($data["clave"], PASSWORD_DEFAULT);
        }

        $dao = new UserDao(Connection::get());
        $dao->save($data);
    }

    public function update(InterfaceDto $dto): void {
        $this->validateUpdate($dto); // Nueva validación específica para update

        $dao = new UserDao(Connection::get());

        // Validación de existencia
        $usuarioExistente = $dao->load($dto->getId());

        $data = $dto->toArray();

        // Si se envió una nueva clave, hashearla
        if (!empty($data["clave"])) {
            $data["clave"] = password_hash($data["clave"], PASSWORD_DEFAULT);
        } else {
            // Si no se envió clave nueva, mantener la original
            $data["clave"] = $usuarioExistente["clave"];
        }

        $dao->update($data);
    }

    public function delete(InterfaceDto $dto): void {
        $dao = new UserDao(Connection::get());
        //Validación de existencia utilizando el load del dao que ya valida si existe o no
        $dao->load($dto->getId());
        $dao->delete($dto->getId());
    }

    public function list(array $filters): array {
        $dao = new UserDao(Connection::get());
        return $dao->list($filters);
    }

    private function validate(UserDto $dto): void {
        if ($dto->getNombres() === "") {
            throw new \Exception("<p>El <strong>nombre</strong> es obligatorio.</p>");
        }
        if ($dto->getCuenta() === "") {
            throw new \Exception("<p>El <strong>usuario</strong> es obligatorio.</p>");
        }
        if ($dto->getClave() === "") {
            throw new \Exception("<p>La <strong>clave</strong> es obligatoria.</p>");
        }

        
    }

    // Métodos adicionales del servicio de Usuario

    public function enable(int $id): void {
        $dao = new UserDao(Connection::get());
        // Validación
        $dao->load($id);

        $dao->enable($id);
    }

    public function disable(int $id): void {
        $dao = new UserDao(Connection::get());

        // Validación
        $dao->load($id);

        $dao->disable($id);
    }

    public function reset(int $id): void {
        $dao = new UserDao(Connection::get());

        // Validación
        $dao->load($id);

        $dao->reset($id);
    }

    private function validateUpdate(UserDto $dto): void {
        if ($dto->getNombres() === "") {
            throw new \Exception("<p>El <strong>nombre</strong> es obligatorio.</p>");
        }
        if ($dto->getCuenta() === "") {
            throw new \Exception("<p>El <strong>usuario</strong> es obligatorio.</p>");
        }
        // Nota: no se valida que la clave esté vacía en update (porque puede no cambiar)
    }

    public function changePassword(int $userId, string $currentPassword, string $newPassword): bool {
        $dao = new UserDao(Connection::get());

        $usuario = $dao->load($userId);
        if (!$usuario) return false;

        // Verificación de contraseña actual
        if (!password_verify($currentPassword, $usuario["clave"])) {
            return false;
        }

        // Generar nueva clave hasheada
        $nuevaClaveHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Actualizar la clave usando un método del dao (puede ser update parcial o uno dedicado)
        return $dao->updatePassword($userId, $nuevaClaveHash);
    }


}
