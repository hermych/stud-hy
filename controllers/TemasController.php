<?php
session_start();
require_once "../models/temas.php";
//require_once "../helpers/utils.php";

class TemasController
{
  /**Vistas */
  // Vistas de gestion
  public function temasGView()
  {
    require_once "../views/temas/temasG.php";
  }
  /**Metodos */
  public function temasGSave()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $univ = isset($_POST['univ']) ? $_POST['univ'] : false;
      $prosp = isset($_POST['prosp']) ? $_POST['prosp'] : false;
      $curso = isset($_POST['curso']) ? $_POST['curso'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($nombre && $univ && $prosp && $curso) {
        $facuObj = new Temas();
        $registrar = $facuObj->temasGSave($nombre, $univ, $prosp, $curso);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Temas registrada correctamente'
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
  public function temasGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Temas();
    $temases = $facuObj->temasGList();
    if (count($temases) == 0) {
      $respuesta = [
        'indice' => '-',
        'id_temas' => '',
        'nombre' => 'No hay datos',
        'descripcion' => 'No hay datos',
      ];
    } else {
      foreach ($temases as $key => $value) {
        $json['data'][$key] = $value;
      }
      for ($i = 0; $i < count($json['data']); $i++) {
        $json['data'][$i]['indice'] = $indice;
        $indice++;
      }
      $respuesta = $json;
    }
    return json_encode($respuesta);
  }
  public function temasGEdit()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $idtema = isset($_POST['idtema']) ? $_POST['idtema'] : false;
      $iduniv = isset($_POST['univ']) ? $_POST['univ'] : false;
      $idpros = isset($_POST['prosp']) ? $_POST['prosp'] : false;
      $idcurso = isset($_POST['curso']) ? $_POST['curso'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($idcurso && $nombre && $iduniv) {
        $univObj = new Temas();
        $registrar = $univObj->temasGEdit($idtema, $iduniv, $idpros, $idcurso, $nombre);
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
  public function temasGInhabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idtema = isset($_POST['idtema']) ? $_POST['idtema'] : false;
      if ($idtema) {
        $univObj = new Temas();
        $registrar = $univObj->temasGDelete($idtema);
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
  public function temasGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idtema = isset($_POST['idtema']) ? $_POST['idtema'] : false;
      if ($idtema) {
        $univObj = new Temas();
        $registrar = $univObj->temasGHabilitar($idtema);
        if ($registrar == '1') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se habilito la temas correctamente'
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
  public function temaCursoList()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $iduniv = isset($_POST['iduniv']) ? $_POST['iduniv'] : false;
      $idpros = isset($_POST['idpros']) ? $_POST['idpros'] : false;
      $idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;
      if ($iduniv && $idpros && $idcurso) {
        $prospObj = new Temas();
        $prospectos = $prospObj->temaCursoList($iduniv, $idpros, $idcurso);
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

$temas = new TemasController();

if ($_GET['method'] == 'temasView') {
  // if (isset($_GET['id'])) {
  //   $id = $_GET['id'];
  //   echo ($temas->facuEspecifico($id));
  // } else {
  //   echo ($temas->temasView());
  // }
} elseif ($_GET['method'] == 'temasGView') {
  echo ($temas->temasGView());
} elseif ($_GET['method'] == 'temasGList') {
  echo ($temas->temasGList());
} elseif ($_GET['method'] == 'temasGSave') {
  echo ($temas->temasGSave());
} elseif ($_GET['method'] == 'temasGEdit') {
  echo ($temas->temasGEdit());
} elseif ($_GET['method'] == 'temasGInhabilitar') {
  echo ($temas->temasGInhabilitar());
} elseif ($_GET['method'] == 'temasGHabilitar') {
  echo ($temas->temasGHabilitar());
} elseif ($_GET['method'] == 'temaCursoList') {
  echo ($temas->temaCursoList());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/