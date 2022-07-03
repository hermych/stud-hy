<?php
session_start();
require_once "../models/preguntas.php";
//require_once "../helpers/utils.php";

class PreguntasController
{
  /**Vistas */
  // Vistas de gestion
  public function preguntasGView()
  {
    require_once "../views/preguntas/preguntasG.php";
  }
  /**Metodos */
  public function preguntasGSave()
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
      if (!is_dir("../assets/image/fotosPreg")) {
        mkdir("../assets/image/fotosPreg", 0777);
      }
      // mover archivo a upload
      $rename = substr(sha1(rand(1, 999)), 0, -30) . "_" . $filename;
      $rutaLogo = "../assets/image/fotosPreg/" . $rename;
      move_uploaded_file($file['tmp_name'], $rutaLogo);
    }
    // proceso de guardar datos
    if (isset($_POST)) {
      $univ = isset($_POST['univ']) ? $_POST['univ'] : false;
      $prosp = isset($_POST['prosp']) ? $_POST['prosp'] : false;
      $curso = isset($_POST['curso']) ? $_POST['curso'] : false;
      $tema = isset($_POST['tema']) ? $_POST['tema'] : false;
      $pregunta = isset($_POST['pregunta']) ? $_POST['pregunta'] : false;
      $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : false;
      $rptaf_1 = isset($_POST['rptaf_1']) ? $_POST['rptaf_1'] : false;
      $rptaf_2 = isset($_POST['rptaf_2']) ? $_POST['rptaf_2'] : false;
      $rptaf_3 = isset($_POST['rptaf_3']) ? $_POST['rptaf_3'] : false;
      $rptaf_4 = isset($_POST['rptaf_4']) ? $_POST['rptaf_4'] : false;
      if ($univ && $prosp && $curso && $tema && $pregunta && $respuesta && $rptaf_1 && $rptaf_2 && $rptaf_3 && $rptaf_4) {
        $pregObj = new Preguntas();
        $registrar = $pregObj->preguntasGSave($univ, $prosp, $curso, $tema, $pregunta, $respuesta, $rptaf_1, $rptaf_2, $rptaf_3, $rptaf_4);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Preguntas registrada correctamente'
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
  public function preguntasGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Preguntas();
    $preguntases = $facuObj->preguntasGList();
    if (count($preguntases) == 0) {
      $respuesta = [
        'indice' => '-',
        'id_preguntas' => '',
        'nombre' => 'No hay datos',
        'descripcion' => 'No hay datos',
      ];
    } else {
      foreach ($preguntases as $key => $value) {
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
  public function preguntasGEdit()
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
        $univObj = new Preguntas();
        $registrar = $univObj->preguntasGEdit($idtema, $iduniv, $idpros, $idcurso, $nombre);
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
  public function preguntasGInhabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idtema = isset($_POST['idtema']) ? $_POST['idtema'] : false;
      if ($idtema) {
        $univObj = new Preguntas();
        $registrar = $univObj->preguntasGDelete($idtema);
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
  public function preguntasGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idtema = isset($_POST['idtema']) ? $_POST['idtema'] : false;
      if ($idtema) {
        $univObj = new Preguntas();
        $registrar = $univObj->preguntasGHabilitar($idtema);
        if ($registrar == '1') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se habilito la preguntas correctamente'
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

$preguntas = new PreguntasController();

if ($_GET['method'] == 'preguntasView') {
  // if (isset($_GET['id'])) {
  //   $id = $_GET['id'];
  //   echo ($preguntas->facuEspecifico($id));
  // } else {
  //   echo ($preguntas->preguntasView());
  // }
} elseif ($_GET['method'] == 'preguntasGView') {
  echo ($preguntas->preguntasGView());
} elseif ($_GET['method'] == 'preguntasGList') {
  echo ($preguntas->preguntasGList());
} elseif ($_GET['method'] == 'preguntasGSave') {
  echo ($preguntas->preguntasGSave());
} elseif ($_GET['method'] == 'preguntasGEdit') {
  echo ($preguntas->preguntasGEdit());
} elseif ($_GET['method'] == 'preguntasGInhabilitar') {
  echo ($preguntas->preguntasGInhabilitar());
} elseif ($_GET['method'] == 'preguntasGHabilitar') {
  echo ($preguntas->preguntasGHabilitar());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/