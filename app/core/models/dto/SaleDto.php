<?php

namespace app\core\models\dto;

use app\core\models\dto\base\InterfaceDto;

/**
 * DTO de Venta. Es un DTO COMPUESTO: la cabecera (ventas) más sus
 * líneas (detalle_ventas), que viajan en el arreglo $detalles.
 *
 * @author Daniel Ivan Reales
 */
final class SaleDto implements InterfaceDto {

    private $id, $numero, $usuarioId, $cliente, $fecha, $estado,
            $subtotal, $descuento, $total, $observaciones, $vendedor;

    /**
     * Cada elemento de $detalles es un arreglo:
     * ["productoId" => int, "cantidad" => int, "precioUnit" => float,
     *  "subtotal" => float, "producto" => string|null]
     */
    private array $detalles = [];

    private const ESTADOS = ['presupuesto', 'confirmada', 'cobrada', 'anulada'];

    public function __construct(array $data = []) {
        $this->setId($data["id"] ?? 0);
        $this->setNumero($data["numero"] ?? 0);
        $this->setUsuarioId($data["usuario_id"] ?? 0);
        $this->setCliente($data["cliente"] ?? "");
        $this->setFecha($data["fecha"] ?? "");
        $this->setEstado($data["estado"] ?? "presupuesto");
        $this->setSubtotal($data["subtotal"] ?? 0);
        $this->setDescuento($data["descuento"] ?? 0);
        $this->setTotal($data["total"] ?? 0);
        $this->setObservaciones($data["observaciones"] ?? "");
        $this->setVendedor($data["vendedor"] ?? "");
        $this->setDetalles($data["detalles"] ?? []);
    }

    /******************** GETTERS ********************/
    public function getId(): int            { return $this->id; }
    public function getNumero(): int        { return $this->numero; }
    public function getUsuarioId(): int     { return $this->usuarioId; }
    public function getCliente(): string    { return $this->cliente; }
    public function getFecha(): string      { return $this->fecha; }
    public function getEstado(): string     { return $this->estado; }
    public function getSubtotal(): float    { return $this->subtotal; }
    public function getDescuento(): float   { return $this->descuento; }
    public function getTotal(): float       { return $this->total; }
    public function getObservaciones(): string { return $this->observaciones; }
    public function getVendedor(): string   { return $this->vendedor; }
    public function getDetalles(): array    { return $this->detalles; }

    /******************** SETTERS ********************/
    public function setId(int $id): void          { $this->id = $id > 0 ? $id : 0; }
    public function setNumero(int $numero): void  { $this->numero = $numero > 0 ? $numero : 0; }
    public function setUsuarioId(int $id): void   { $this->usuarioId = $id > 0 ? $id : 0; }
    public function setCliente(string $c): void   { $this->cliente = trim($c); }
    public function setFecha(string $f): void     { $this->fecha = $f; }
    public function setEstado(string $e): void {
        $e = strtolower(trim($e));
        $this->estado = in_array($e, self::ESTADOS) ? $e : "presupuesto";
    }
    public function setSubtotal(float $v): void   { $this->subtotal = $v >= 0 ? $v : 0; }
    public function setDescuento(float $v): void  { $this->descuento = $v >= 0 ? $v : 0; }
    public function setTotal(float $v): void      { $this->total = $v >= 0 ? $v : 0; }
    public function setObservaciones(string $o): void { $this->observaciones = trim($o); }
    public function setVendedor(string $v): void  { $this->vendedor = trim($v); }

    public function setDetalles(array $detalles): void {
        $this->detalles = [];
        foreach ($detalles as $d) {
            $this->detalles[] = [
                "productoId" => (int) ($d["productoId"] ?? 0),
                "cantidad"   => (int) ($d["cantidad"] ?? 0),
                "precioUnit" => (float) ($d["precioUnit"] ?? 0),
                "subtotal"   => (float) ($d["subtotal"] ?? 0),
                "producto"   => $d["producto"] ?? null
            ];
        }
    }

    public function toArray(): array {
        return [
            "id"            => $this->getId(),
            "numero"        => $this->getNumero(),
            "usuario_id"    => $this->getUsuarioId(),
            "cliente"       => $this->getCliente(),
            "fecha"         => $this->getFecha(),
            "estado"        => $this->getEstado(),
            "subtotal"      => $this->getSubtotal(),
            "descuento"     => $this->getDescuento(),
            "total"         => $this->getTotal(),
            "observaciones" => $this->getObservaciones(),
            "vendedor"      => $this->getVendedor(),
            "detalles"      => $this->getDetalles()
        ];
    }
}