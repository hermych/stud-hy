<?php
session_start();
require_once "../models/facultad.php";
//require_once "../helpers/utils.php";

class FacultadController
{
  /**Vistas */
  public function facultadView()
  {
    require_once "../views/facultad/index.php";
  }
  public function facuEspecifico($id)
  {
  }
  public function plan_estudioView()
  {
    require_once "../views/plan_estudio/plan_estudio.php";
  }
  /**Metodos */
  public function facultadGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Facultad();
    $facultades = $facuObj->facultadGList();
    if (count($facultades) == 0) {
      $respuesta = [
        'indice' => '-',
        'id_facultad' => '',
        'nombre' => 'No hay datos',
        'descripcion' => 'No hay datos',
      ];
    } else {
      foreach ($facultades as $key => $value) {
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
  public function facultadGSave()
  {
    $respuesta = [];
    // proceso de guardar imagenes
    if (isset($_FILES['imagen'])) {
      $file = $_FILES['imagen'];
      $filename = $file['name'];
      $mimetype = $file['type'];
      $allowed_type = array("image/jpg", "image/jpeg", "image/png");

      if (!in_array($mimetype, $allowed_type)) {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'por favor, selecciona una imagen'
        ];
        return json_encode($respuesta);
      }
      // crear directorio upload
      if (!is_dir("../assets/image/fotosFacu")) {
        mkdir("../assets/image/fotosFacu", 0777);
      }
      // mover archivo a upload
      $rename = substr(sha1(rand(1, 999)), 0, -30) . "_" . $filename;
      $rutaLogo = "../assets/image/fotosFacu/" . $rename;
      move_uploaded_file($file['tmp_name'], $rutaLogo);
    }
    // proceso de guardar datos
    if (isset($_POST)) {
      $univ = isset($_POST['univ']) ? $_POST['univ'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $decano = isset($_POST['decano']) ? $_POST['decano'] : false;
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      if ($nombre && $descripcion && $univ) {
        $facuObj = new Facultad();
        $registrar = $facuObj->facultadGSave($nombre, $descripcion, $univ, $decano, $rename);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Facultad registrada correctamente'
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
  public function facultadGEdit()
  {
    $respuesta = [];
    // proceso de guardar imagenes
    if (isset($_FILES['imagen'])) {
      $file = $_FILES['imagen'];
      $filename = $file['name'];
      $mimetype = $file['type'];
      $allowed_type = array("image/jpg", "image/jpeg", "image/png");

      if (!in_array($mimetype, $allowed_type)) {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'por favor, selecciona una imagen'
        ];
        return json_encode($respuesta);
      }
      // crear directorio upload
      if (!is_dir("../assets/image/fotosFacu")) {
        mkdir("../assets/image/fotosFacu", 0777);
      }
      // mover archivo a upload
      $rename = substr(sha1(rand(1, 999)), 0, -30) . "_" . $filename;
      $rutaLogo = "../assets/image/fotosFacu/" . $rename;
      move_uploaded_file($file['tmp_name'], $rutaLogo);
    }
    // proceso de guardar datos
    if (isset($_POST)) {
      $iduniv = isset($_POST['univ']) ? $_POST['univ'] : false;
      $idfacu = isset($_POST['idfacu']) ? $_POST['idfacu'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $decano = isset($_POST['decano']) ? $_POST['decano'] : 'Decano Pendiente';
      $rename = isset($rename) ? $rename : '';
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      if ($idfacu && $nombre && $descripcion && $idfacu && $iduniv) {
        $univObj = new Facultad();
        $registrar = $univObj->facultadGEdit($iduniv, $idfacu, $nombre, $decano, $descripcion, $rename);
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
  public function facultadGDelete()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idfacu = isset($_POST['idfacu']) ? $_POST['idfacu'] : false;
      if ($idfacu) {
        $univObj = new Facultad();
        $registrar = $univObj->facultadGDelete($idfacu);
        if ($registrar['estado'] == 'ok') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Inahbilitacion realizada correctamente'
          ];
        } elseif ($registrar['estado'] == 'failed') {
          $mensaje = $registrar['mensaje'];
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => "$mensaje"
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
  public function facultadGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idfacu = isset($_POST['idfacu']) ? $_POST['idfacu'] : false;
      if ($idfacu) {
        $univObj = new Facultad();
        $registrar = $univObj->facultadGHabilitar($idfacu);
        if ($registrar == '1') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se habilito la facultad correctamente'
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
  public function facultadGListEspecifico()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $id_univ = isset($_POST['id_univ']) ? $_POST['id_univ'] : false;
      if ($id_univ) {
        $facuObj = new Facultad();
        $facultades = $facuObj->facultadGListEspecifico($id_univ);
        if (count($facultades) > 0) {
          $respuesta = $facultades;
        } else {
          $respuesta = [
            0 => [
              'id_facultad' => '0',
              'nombre' => 'No hay facultades para esta universidad'
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

$facultad = new FacultadController();

if ($_GET['method'] == 'facultadView') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo ($facultad->facuEspecifico($id));
  } else {
    echo ($facultad->facultadView());
  }
} elseif ($_GET['method'] == 'plan_estudioView') {
  echo ($facultad->plan_estudioView());
} elseif ($_GET['method'] == 'facultadGList') {
  echo ($facultad->facultadGList());
} elseif ($_GET['method'] == 'facultadGSave') {
  echo ($facultad->facultadGSave());
} elseif ($_GET['method'] == 'facultadGEdit') {
  echo ($facultad->facultadGEdit());
} elseif ($_GET['method'] == 'facultadGDelete') {
  echo ($facultad->facultadGDelete());
} elseif ($_GET['method'] == 'facultadGHabilitar') {
  echo ($facultad->facultadGHabilitar());
} elseif ($_GET['method'] == 'facultadGListEspecifico') {
  echo ($facultad->facultadGListEspecifico());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/