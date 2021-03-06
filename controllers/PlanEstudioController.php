<?php
session_start();
require_once "../models/plan_estudio.php";
//require_once "../helpers/utils.php";

class ProspectoController
{
  /**Vistas */
  public function prospectoView()
  {
    require_once "../views/prospecto/index.php";
  }
  // public function facuEspecifico($id)
  // {
  // }
  // Vistas de gestion
  public function prospectoGView()
  {
    require_once "../views/plan_estudio/plan_estudio.php";
  }
  /**Metodos */
  public function prospectoGSave()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $univ = isset($_POST['univ']) ? $_POST['univ'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($nombre && $univ) {
        $facuObj = new Prospecto();
        $registrar = $facuObj->prospectoGSave($nombre, $univ);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Prospecto registrada correctamente'
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
  public function prospectoGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Prospecto();
    $prospectoes = $facuObj->prospectoGList();
    if (count($prospectoes) == 0) {
      $respuesta = [
        'indice' => '-',
        'id_prospecto' => '',
        'nombre' => 'No hay datos',
        'descripcion' => 'No hay datos',
      ];
    } else {
      foreach ($prospectoes as $key => $value) {
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
  public function prospectoUnivList()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $iduniv = isset($_POST['iduniv']) ? $_POST['iduniv'] : false;
      if ($iduniv) {
        $prospObj = new Prospecto();
        $prospectos = $prospObj->prospectoUnivList($iduniv);
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
  public function prospectoGEdit()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $iduniv = isset($_POST['univ']) ? $_POST['univ'] : false;
      $idpros = isset($_POST['idpros']) ? $_POST['idpros'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      if ($idpros && $nombre && $iduniv) {
        $univObj = new Prospecto();
        $registrar = $univObj->prospectoGEdit($iduniv, $idpros, $nombre);
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
  public function prospectoGInhabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idpros = isset($_POST['idpros']) ? $_POST['idpros'] : false;
      if ($idpros) {
        $univObj = new Prospecto();
        $registrar = $univObj->prospectoGDelete($idpros);
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
  public function prospectoGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idpros = isset($_POST['idpros']) ? $_POST['idpros'] : false;
      if ($idpros) {
        $univObj = new Prospecto();
        $registrar = $univObj->prospectoGHabilitar($idpros);
        if ($registrar == '1') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se habilito la prospecto correctamente'
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
  public function prospectoGListEspecifico()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $id_univ = isset($_POST['id_univ']) ? $_POST['id_univ'] : false;
      if ($id_univ) {
        $facuObj = new Prospecto();
        $prospectoes = $facuObj->prospectoGListEspecifico($id_univ);
        if (count($prospectoes) > 0) {
          $respuesta = $prospectoes;
        } else {
          $respuesta = [
            0 => [
              'id_prospecto' => '0',
              'nombre' => 'No hay prospectoes para esta universidad'
            ]
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'No se esta enviando los datos necesarios'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Erro al intentar conectar con el controlador'
      ];
    }
    return json_encode($respuesta);
  }
}

$prospecto = new ProspectoController();

if ($_GET['method'] == 'prospectoView') {
  // if (isset($_GET['id'])) {
  //   $id = $_GET['id'];
  //   echo ($prospecto->facuEspecifico($id));
  // } else {
  //   echo ($prospecto->prospectoView());
  // }
} elseif ($_GET['method'] == 'plan_estudioView') {
  echo ($prospecto->prospectoGView());
} elseif ($_GET['method'] == 'prospectoGList') {
  echo ($prospecto->prospectoGList());
} elseif ($_GET['method'] == 'prospectoGSave') {
  echo ($prospecto->prospectoGSave());
} elseif ($_GET['method'] == 'prospectoGEdit') {
  echo ($prospecto->prospectoGEdit());
} elseif ($_GET['method'] == 'prospectoGInhabilitar') {
  echo ($prospecto->prospectoGInhabilitar());
} elseif ($_GET['method'] == 'prospectoGHabilitar') {
  echo ($prospecto->prospectoGHabilitar());
} elseif ($_GET['method'] == 'prospectoGListEspecifico') {
  echo ($prospecto->prospectoGListEspecifico());
} elseif ($_GET['method'] == 'prospectoUnivList') {
  echo ($prospecto->prospectoUnivList());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/