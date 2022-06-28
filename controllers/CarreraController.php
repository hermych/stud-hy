<?php
session_start();
require_once "../models/carrera.php";
//require_once "../helpers/utils.php";

class FacultadController
{
  /**Vistas */
  public function facultadView()
  {
    require_once "../views/universidad/index.php";
  }
  public function facuEspecifico($id)
  {
  }
  public function carreraGView()
  {
    require_once "../views/carrera/indexG.php";
  }
  /**Metodos */
  public function carreraGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Carrera();
    $facultades = $facuObj->carreraGList();
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
  public function carreraGSave()
  {
    $respuesta = [];
    // Subir plan de estudio
    if (isset($_FILES['planEstudio'])) {
      $file = $_FILES['planEstudio'];
      $filename = $file['name'];
      $mimetype = $file['type'];

      $allowed_type = array("gif", "jpeg", "jpg", "png", "pdf");
      $temp = explode(".", $_FILES["planEstudio"]["name"]);
      $extension = end($temp);
      if ($_FILES["planEstudio"]["type"] == "application/pdf") {
        // crear directorio upload
        if (!is_dir("../assets/plan_estudios_pdf")) {
          mkdir("../assets/plan_estudios_pdf", 0777);
        }
        // mover archivo a upload
        $name = $filename;
        $rutaPlan = "../assets/plan_estudios_pdf/" . $name;
        move_uploaded_file($file['tmp_name'], $rutaPlan);
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'por favor, selecciona un archivo pdf'
        ];
        return json_encode($respuesta);
      }
    }
    // proceso de guardar datos
    if (isset($_POST)) {
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $univ = isset($_POST['univ']) ? $_POST['univ'] : false;
      $facu = isset($_POST['facu']) ? $_POST['facu'] : false;
      $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
      $grado = isset($_POST['grado']) ? $_POST['grado'] : false;
      $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
      $plan_estudio = isset($name) ? $name : '';
      if ($nombre && $descripcion) {
        $facuObj = new Carrera();
        $registrar = $facuObj->carreraGSave($univ, $facu, $nombre, $duracion, $grado, $titulo, $descripcion, $perfil, $plan_estudio);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Carrera registrada correctamente'
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
  public function carreraGEdit()
  {
    $respuesta = [];
    // Subir plan de estudio
    if (isset($_FILES['planEstudio'])) {
      $file = $_FILES['planEstudio'];
      $filename = $file['name'];
      $mimetype = $file['type'];

      $allowed_type = array("gif", "jpeg", "jpg", "png", "pdf");
      $temp = explode(".", $_FILES["planEstudio"]["name"]);
      $extension = end($temp);
      if ($_FILES["planEstudio"]["type"] == "application/pdf") {
        // crear directorio upload
        if (!is_dir("../assets/plan_estudios_pdf")) {
          mkdir("../assets/plan_estudios_pdf", 0777);
        }
        // mover archivo a upload
        $name = $filename;
        $rutaPlan = "../assets/plan_estudios_pdf/" . $name;
        move_uploaded_file($file['tmp_name'], $rutaPlan);
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'por favor, selecciona un archivo pdf'
        ];
        return json_encode($respuesta);
      }
    }
    // proceso de guardar datos
    if (isset($_POST)) {
      $id_carrera = isset($_POST['id_carrera']) ? $_POST['id_carrera'] : false;
      $id_univ = isset($_POST['id_univ']) ? $_POST['id_univ'] : false;
      $id_facu = isset($_POST['id_facu']) ? $_POST['id_facu'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
      $grado = isset($_POST['grado']) ? $_POST['grado'] : false;
      $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
      $plan_estudio = isset($name) ? $name : '';
      if ($id_carrera && $nombre && $duracion && $grado && $titulo && $descripcion && $perfil) {
        $carreraObj = new Carrera();
        $editar = $carreraObj->carreraGEdit($id_carrera, $nombre, $duracion, $grado, $titulo, $descripcion, $perfil, $plan_estudio, $id_univ, $id_facu);
        if ($editar == 1) {
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
  public function carreraGInhabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $id_carrera = isset($_POST['id_carrera']) ? $_POST['id_carrera'] : false;
      if ($id_carrera) {
        $univObj = new Carrera();
        $carrera = $univObj->carreraGInhabilitar($id_carrera);
        if ($carrera == '1') {
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
  public function carreraGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $id_carrera = isset($_POST['id_carrera']) ? $_POST['id_carrera'] : false;
      if ($id_carrera) {
        $univObj = new Carrera();
        $carrera = $univObj->carreraGHabilitar($id_carrera);
        if ($carrera == '1') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se habilito la carrera correctamente'
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
}

$facultad = new FacultadController();

if ($_GET['method'] == 'universidadView') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo ($facultad->facuEspecifico($id));
  } else {
    echo ($facultad->facultadView());
  }
} elseif ($_GET['method'] == 'carreraGView') {
  echo ($facultad->carreraGView());
} elseif ($_GET['method'] == 'carreraGList') {
  echo ($facultad->carreraGList());
} elseif ($_GET['method'] == 'carreraGSave') {
  echo ($facultad->carreraGSave());
} elseif ($_GET['method'] == 'carreraGEdit') {
  echo ($facultad->carreraGEdit());
} elseif ($_GET['method'] == 'carreraGInhabilitar') {
  echo ($facultad->carreraGInhabilitar());
} elseif ($_GET['method'] == 'carreraGHabilitar') {
  echo ($facultad->carreraGHabilitar());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/