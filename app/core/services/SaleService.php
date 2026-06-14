<?php

namespace app\core\services;

use app\core\models\dao\SaleDao;
use app\core\models\dao\ItemDao;
use app\core\models\dto\SaleDto;
use app\core\models\dto\base\InterfaceDto;
use app\core\services\base\InterfaceService;
use app\libs\database\Connection;
use app\core\exceptions\ValidationException;

/**
 * Servicio de Ventas. Toda la aritmética (precios y totales) se calcula
 * acá, en el servidor: NUNCA se confía en los importes que manda el cliente.
 *
 * @author Daniel Ivan Reales
 */
final class SaleService implements InterfaceService {

    private const ESTADOS_VALIDOS = ['presupuesto', 'confirmada', 'cobrada', 'anulada'];

    public function load(int $id): InterfaceDto {
        $dao = new SaleDao(Connection::get());
        return new SaleDto($dao->load($id));
    }

    public function save(InterfaceDto $dto): void {
        $this->validate($dto);

        // Recalcula precios y totales del lado del servidor
        $data = $this->resolverPreciosYTotales($dto);
        unset($data["id"]);
        $data["fecha"]  = date("Y-m-d H:i:s");
        // Por defecto una venta nace como presupuesto
        $data["estado"] = "presupuesto";

        $dao = new SaleDao(Connection::get());
        $dao->save($data);

        // Devolver id y número generados (útil para el frontend)
        $dto->setId($dao->getLastInsertId());
    }

    public function update(InterfaceDto $dto): void {
        if ($dto->getId() <= 0) {
            throw new ValidationException("El id de la venta es obligatorio para actualizar.");
        }
        $this->validate($dto);

        $data = $this->resolverPreciosYTotales($dto);

        $dao = new SaleDao(Connection::get());
        $dao->update($data);
    }

    public function delete(InterfaceDto $dto): void {
        if ($dto->getId() <= 0) {
            throw new ValidationException("El id de la venta es obligatorio para eliminar.");
        }
        $dao = new SaleDao(Connection::get());
        $venta = $dao->load($dto->getId()); // valida existencia

        // Regla de negocio: no borrar ventas que ya movieron stock o se cobraron
        if (in_array($venta["estado"], ["confirmada", "cobrada"])) {
            throw new ValidationException("No se puede eliminar una venta confirmada o cobrada. Anulala en su lugar.");
        }

        $dao->delete($dto->getId());
    }

    public function list(array $filters): array {
        $dao = new SaleDao(Connection::get());
        return $dao->list($filters);
    }

    /**
     * Cambia el estado de una venta (confirmar, cobrar, anular).
     */
    public function updateEstado(int $id, string $nuevoEstado): void {
        $nuevoEstado = strtolower(trim($nuevoEstado));
        if (!in_array($nuevoEstado, self::ESTADOS_VALIDOS)) {
            throw new ValidationException("Estado inválido.");
        }

        $dao = new SaleDao(Connection::get());
        $dao->load($id); // valida existencia
        $dao->updateEstado($id, $nuevoEstado);
    }

    /******************** Privados ********************/

    private function validate(SaleDto $dto): void {
        if ($dto->getUsuarioId() <= 0) {
            throw new ValidationException("No se pudo identificar al vendedor.");
        }
        if (count($dto->getDetalles()) === 0) {
            throw new ValidationException("La venta debe tener al menos un producto.");
        }
        foreach ($dto->getDetalles() as $linea) {
            if ($linea["productoId"] <= 0) {
                throw new ValidationException("Hay una línea sin producto válido.");
            }
            if ($linea["cantidad"] <= 0) {
                throw new ValidationException("Las cantidades deben ser mayores a cero.");
            }
        }
    }

    /**
     * Toma el precio ACTUAL de cada producto desde la base (snapshot),
     * calcula el subtotal de cada línea y los totales de la venta.
     * Devuelve el arreglo listo para el DAO.
     */
    private function resolverPreciosYTotales(SaleDto $dto): array {
        $itemDao = new ItemDao(Connection::get());

        $detalles = [];
        $subtotalVenta = 0.0;

        foreach ($dto->getDetalles() as $linea) {
            // load() lanza excepción si el producto no existe
            $producto = $itemDao->load($linea["productoId"]);

            $precioUnit = (float) $producto["precio"];
            $cantidad   = (int) $linea["cantidad"];
            $subtotal   = round($precioUnit * $cantidad, 2);

            $detalles[] = [
                "productoId" => (int) $linea["productoId"],
                "cantidad"   => $cantidad,
                "precioUnit" => $precioUnit,
                "subtotal"   => $subtotal
            ];
            $subtotalVenta += $subtotal;
        }

        $descuento = $dto->getDescuento();
        $total = round($subtotalVenta - $descuento, 2);
        if ($total < 0) {
            throw new ValidationException("El descuento no puede ser mayor al subtotal.");
        }

        $data = $dto->toArray();
        $data["subtotal"]  = round($subtotalVenta, 2);
        $data["total"]     = $total;
        $data["detalles"]  = $detalles;
        return $data;
    }
}