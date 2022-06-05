<?php
require_once "../config/db.php";

// session_start();

class Caja
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect($_SESSION['dbname']); //$_SESSION['dbname']
  }

  public function listarGastos()
  {
    $fechaActual = date('Y-m-d');
    $idSucursal = $_SESSION['identity']->{'idSucursal'};
    $idUsuario = $_SESSION['identity']->{'idUsuario'};
    // * Obtener el ID de caja abierta actualmente
    $sql_cajaAbierta = "SELECT * FROM `cajas` WHERE idUsuario = '$idUsuario' AND idSucursal = '$idSucursal' AND estado = 'abierto';";
    $cajaAbierta = $this->db->query($sql_cajaAbierta);
    $caja = $cajaAbierta->fetch_all(MYSQLI_ASSOC);
    $idCaja = $caja[0]['idCaja'];
    $sql_ingresos = "SELECT montoMovimiento as 'monto', descripcionMovimiento as 'descripcion' FROM `caja_movimiento` WHERE tipo = 'gasto' AND fechaMovimiento LIKE '%$fechaActual%' AND idCaja = '$idCaja';";
    $cons_ingresos = $this->db->query($sql_ingresos);
    $ingresos = $cons_ingresos->fetch_all(MYSQLI_ASSOC);
    return $ingresos;
  }
}
