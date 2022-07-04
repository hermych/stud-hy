<?php
session_start();
require_once "../models/consulta.php";
//require_once "../helpers/utils.php";

class ConsultasController
{
  /**Vistas */
  // Vistas de gestion
  public function consultasGView()
  {
    require_once "../views/facturacion/consultasG.php";
  }
  /**Metodos */
  public function consultasGSave()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $univ = isset($_POST['univ']) ? $_POST['univ'] : false;
      $prosp = isset($_POST['prosp']) ? $_POST['prosp'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($nombre && $univ && $prosp) {
        $facuObj = new Consultas();
        $registrar = $facuObj->consultasGSave($nombre, $univ, $prosp);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Consultas registrada correctamente'
          ];
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error en la consulta a la base de datos'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'Faltan enviar datos, por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al enviar los datos al servidor'
      ];
    }
    return json_encode($respuesta);
  }
  public function consultasGList($recibo)
  {
    $respuesta = [];
    if ($recibo) {
      $indice = 1;
      $facuObj = new Consultas();
      $consultases = $facuObj->consultasGList($recibo);
      if (count($consultases) == 0) {
        $respuesta = [
          'indice' => '-',
          'id_consultas' => '',
          'nombre' => 'No hay datos',
          'descripcion' => 'No hay datos',
        ];
      } else {
        foreach ($consultases as $key => $value) {
          $json['data'][$key] = $value;
        }
        for ($i = 0; $i < count($json['data']); $i++) {
          $json['data'][$i]['indice'] = $indice;
          $indice++;
        }
        // $respuesta = [
        //   'estado' => 'ok',
        //   'contenido' => $json
        // ];
        $respuesta = $json;
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'No se esta recibiendo los datos necesarios.'
      ];
    }
    return json_encode($respuesta);
  }
  public function consultasGEdit()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $iduniv = isset($_POST['univ']) ? $_POST['univ'] : false;
      $idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($idcurso && $nombre && $iduniv) {
        $univObj = new Consultas();
        $registrar = $univObj->consultasGEdit($iduniv, $idcurso, $nombre);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se editaron los datos correctamente'
          ];
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error en la consulta a la base de datos'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'Faltan enviar datos, por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al enviar los datos al servidor'
      ];
    }
    return json_encode($respuesta);
  }
  public function consultasGInhabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;
      if ($idcurso) {
        $univObj = new Consultas();
        $registrar = $univObj->consultasGDelete($idcurso);
        if ($registrar) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Inahbilitacion realizada correctamente'
          ];
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error en la consulta a la base de datos'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'Faltan enviar datos, por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al enviar los datos al servidor'
      ];
    }
    return json_encode($respuesta);
  }
  public function consultasGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;
      if ($idcurso) {
        $univObj = new Consultas();
        $registrar = $univObj->consultasGHabilitar($idcurso);
        if ($registrar == '1') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se habilito la consultas correctamente'
          ];
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error en la consulta a la base de datos'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'Faltan enviar datos, por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al enviar los datos al servidor'
      ];
    }
    return json_encode($respuesta);
  }
  public function cursoProspList()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $idpros = isset($_POST['idpros']) ? $_POST['idpros'] : false;
      if ($idpros) {
        $prospObj = new Consultas();
        $prospectos = $prospObj->cursoProspList($idpros);
        if ($prospectos) {
          $respuesta = $prospectos;
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error al realizar la consulta a la bd'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'No se estan recibiendo los datos'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error de comunicacion con el servidor'
      ];
    }
    return json_encode($respuesta);
  }
}

$consultas = new ConsultasController();

if ($_GET['method'] == 'consultasView') {
} elseif ($_GET['method'] == 'consultasGView') {
  echo ($consultas->consultasGView());
} elseif ($_GET['method'] == 'consultasGSave') {
  echo ($consultas->consultasGSave());
} elseif ($_GET['method'] == 'consultasGEdit') {
  echo ($consultas->consultasGEdit());
} elseif ($_GET['method'] == 'consultasGInhabilitar') {
  echo ($consultas->consultasGInhabilitar());
} elseif ($_GET['method'] == 'consultasGHabilitar') {
  echo ($consultas->consultasGHabilitar());
} elseif ($_GET['method'] == 'consultasGList') {
  $recibo = $_GET['recibo'];
  echo ($consultas->consultasGList($recibo));
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/