<?php

require_once "../config/db.php";

class Preguntas
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function preguntasGSave($univ, $prosp, $curso, $tema, $pregunta, $respuesta, $rptaf_1, $rptaf_2, $rptaf_3, $rptaf_4, $imagen)
  {
    $result = false;
    $sql = "INSERT INTO `preguntas`(`id_univ`, `id_prosp`, `id_curso`, `id_tema`, `descripcion`, `img_ref`) VALUES ('$univ','$prosp','$curso','$tema','$pregunta', '$imagen')";
    $save = $this->db->query($sql);
    if ($save) {
      $last_pregunta = "SELECT id_pregunta FROM preguntas WHERE id_univ = '$univ' AND id_prosp = '$prosp' AND id_curso = '$curso' AND id_tema = '$tema' ORDER BY `preguntas`.`id_pregunta` DESC LIMIT 1;";
      $lisLastPreg = $this->db->query($last_pregunta);
      $pregunta = $lisLastPreg->fetch_all(MYSQLI_ASSOC)[0];
      $id_preg = $pregunta['id_pregunta'];
      if ($id_preg != '') {
        $sql_save_1 = "INSERT INTO `respuestas`(`id_preg`, `respuesta`, `valor`, `estado`) VALUES ('$id_preg','$respuesta','correcta','activo')";
        $sql_save_2 = "INSERT INTO `respuestas`(`id_preg`, `respuesta`, `valor`, `estado`) VALUES ('$id_preg','$rptaf_1','error','activo')";
        $sql_save_3 = "INSERT INTO `respuestas`(`id_preg`, `respuesta`, `valor`, `estado`) VALUES ('$id_preg','$rptaf_2','error','activo')";
        $sql_save_4 = "INSERT INTO `respuestas`(`id_preg`, `respuesta`, `valor`, `estado`) VALUES ('$id_preg','$rptaf_3','error','activo')";
        $sql_save_5 = "INSERT INTO `respuestas`(`id_preg`, `respuesta`, `valor`, `estado`) VALUES ('$id_preg','$rptaf_4','error','activo')";
        $save_1 = $this->db->query($sql_save_1);
        $save_2 = $this->db->query($sql_save_2);
        $save_3 = $this->db->query($sql_save_3);
        $save_4 = $this->db->query($sql_save_4);
        $save_5 = $this->db->query($sql_save_5);
        if ($save_1 && $save_2 && $save_3 && $save_4 && $save_5) {
          $result = true;
        }
      }
    }
    return $result;
  }
  public function preguntasGList()
  {
    $sql_facu = "SELECT t.*, u.nombre as 'universidad', p.nombre as 'prospecto', c.nombre as 'curso' FROM preguntas as t, universidades as u, prospectos as p, preguntas as c WHERE t.id_univ = u.id_universidad AND t.id_prosp = p.id_prospecto AND t.id_curso = c.id_curso;";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function preguntasGEdit($idtema, $iduniv, $idpros, $idcurso, $nombre)
  {
    $sql_edit = "UPDATE `preguntas` SET `id_univ`='$iduniv',`id_prosp`='$idpros',`id_curso` = $idcurso,`nombre`='$nombre' WHERE `id_tema`='$idtema'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function preguntasGDelete($idtema)
  {
    /* Verificar si la facultad pertenece a algun registro */
    $respuesta = false;
    $consulta = "UPDATE `preguntas` SET `estado` = 'inactivo' WHERE id_tema = $idtema;";
    $query = $this->db->query($consulta);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function preguntasGHabilitar($idtema)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `preguntas` SET `estado` = 'activo' WHERE id_tema = $idtema;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  /*
  public function preguntasGListEspecifico($iduniv)
  {
    $sql_facu = "SELECT id_facultad, nombre from  facultades WHERE id_univ = $iduniv";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  */
}
