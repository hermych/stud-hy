<?php
session_start();
require_once "../models/cursos.php";
//require_once "../helpers/utils.php";

class CursosController
{
  /**Vistas */
  // Vistas de gestion
  public function cursosGView()
  {
    require_once "../views/cursos/cursosG.php";
  }
  /**Metodos */
  public function cursosGSave()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $univ = isset($_POST['univ']) ? $_POST['univ'] : false;
      $prosp = isset($_POST['prosp']) ? $_POST['prosp'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($nombre && $univ && $prosp) {
        $facuObj = new Cursos();
        $registrar = $facuObj->cursosGSave($nombre, $univ, $prosp);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Cursos registrada correctamente'
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
  public function cursosGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Cursos();
    $cursoses = $facuObj->cursosGList();
    if (count($cursoses) == 0) {
      $respuesta = [
        'indice' => '-',
        'id_cursos' => '',
        'nombre' => 'No hay datos',
        'descripcion' => 'No hay datos',
      ];
    } else {
      foreach ($cursoses as $key => $value) {
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
  public function cursosGEdit()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $iduniv = isset($_POST['univ']) ? $_POST['univ'] : false;
      $idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($idcurso && $nombre && $iduniv) {
        $univObj = new Cursos();
        $registrar = $univObj->cursosGEdit($iduniv, $idcurso, $nombre);
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
  public function cursosGInhabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;
      if ($idcurso) {
        $univObj = new Cursos();
        $registrar = $univObj->cursosGDelete($idcurso);
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
  public function cursosGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;
      if ($idcurso) {
        $univObj = new Cursos();
        $registrar = $univObj->cursosGHabilitar($idcurso);
        if ($registrar == '1') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se habilito la cursos correctamente'
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
        $prospObj = new Cursos();
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

$cursos = new CursosController();

if ($_GET['method'] == 'cursosView') {
  // if (isset($_GET['id'])) {
  //   $id = $_GET['id'];
  //   echo ($cursos->facuEspecifico($id));
  // } else {
  //   echo ($cursos->cursosView());
  // }
} elseif ($_GET['method'] == 'cursosGView') {
  echo ($cursos->cursosGView());
} elseif ($_GET['method'] == 'cursosGList') {
  echo ($cursos->cursosGList());
} elseif ($_GET['method'] == 'cursosGSave') {
  echo ($cursos->cursosGSave());
} elseif ($_GET['method'] == 'cursosGEdit') {
  echo ($cursos->cursosGEdit());
} elseif ($_GET['method'] == 'cursosGInhabilitar') {
  echo ($cursos->cursosGInhabilitar());
} elseif ($_GET['method'] == 'cursosGHabilitar') {
  echo ($cursos->cursosGHabilitar());
} elseif ($_GET['method'] == 'cursoProspList') {
  echo ($cursos->cursoProspList());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/