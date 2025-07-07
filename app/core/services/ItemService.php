<?php

namespace app\core\services;

use app\core\models\dao\ItemDao;
use app\core\models\dto\ItemDto;
use app\core\models\dto\base\InterfaceDto;
use app\core\services\base\InterfaceService;
use app\libs\database\Connection;

final class ItemService implements InterfaceService {

    public function load(int $id): InterfaceDto {
        $dao = new ItemDao(Connection::get());
        $data = $dao->load($id);
        return new ItemDto($data);
    }

    public function save(InterfaceDto $dto): void {
        $this->validate($dto);
        $data = $dto->toArray();
        unset($data["id"]);
        $dao = new ItemDao(Connection::get());
        $dao->save($data);
    }

    public function update(InterfaceDto $dto): void {
        $this->validate($dto);
        $data = $dto->toArray();
        $dao = new ItemDao(Connection::get());

        //Validación de existencia utilizando el load del dao que ya valida si existe o no
        $dao->load($dto->getId());

        $dao->update($data);
    }

    public function delete(InterfaceDto $dto): void {
        $dao = new ItemDao(Connection::get());

        //Validación de existencia utilizando el load del dao que ya valida si existe o no
        $dao->load($dto->getId());

        $dao->delete($dto->getId());
    }

    public function list(array $filters): array {
        $dao = new ItemDao(Connection::get());
        return $dao->list($filters);
    }

    private function validate(ItemDto $dto): void {
        if ($dto->getNombre() === "") {
            throw new \Exception("<p>El <strong>nombre</strong> del producto es obligatorio.</p>");
        }
        if ($dto->getPrecio() <= 0) {
            throw new \Exception("<p>El <strong>precio</strong> debe ser mayor a 0.</p>");
        }
        if ($dto->getStock() < 0) {
            throw new \Exception("<p>El <strong>stock</strong> no puede ser negativo.</p>");
        }
    }
}
