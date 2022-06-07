<?php require_once('../views/layout/header.php'); ?>

<!-- Button trigger modal -->
<div class="card">
  <div class="card-header">
    <h2 class="mt-2">Carreras</h2>
  </div>
  <div class="card-body">
    <button type="button" id="btnModalRegistrarFacu" class="btn btn-primary float-end mb-4" data-toggle="modal" data-target="#modalRegistrarCarrera">
      Registrar
    </button>
    <!-- Tabla de datos -->
    <table id="table" class="display table table-hover text-center mb-4 table-responsive" style="width: 100%;">
      <thead style="text-align-last: center;">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Grado</th>
          <th scope="col">Titulo</th>
          <th scope="col">Duracion</th>
          <th scope="col">Perfil</th>
          <th scope="col">Plan Estudios</th>
          <th scope="col">Opciones</th>
      </thead>
      <tbody id="tbody">

      </tbody>
    </table>
  </div>
  <div class="card-footer text-muted text-end">
    <?php echo "<b>" . date("d") . " de " . date("M") . " de " . date("Y"); ?>
  </div>
</div>
<!-- Modal Agregar Carrera-->
<div class="modal fade" id="modalRegistrarCarrera" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registrar Carrera</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="row mb-2">
            <div class="col-8">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="email" class="form-control" id="nombre" name="nombre" placeholder="Ejem: Investigación Operativa">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="duracion">Duracion</label>
                <input type="email" class="form-control" id="duracion" name="duracion" placeholder="Ejem: 5" onkeypress="return validarInputSoloNumeros(event);">
              </div>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="grado">Grado</label>
              <input type="email" class="form-control" id="grado" name="grado" placeholder="Ejm: Bachiller en Investigación Operativa">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="titulo">Titulo</label>
              <input type="email" class="form-control" id="titulo" name="titulo" placeholder="Ejm: Licenciado en Investigación Operativa">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="descripcion">Descripcion</label>
              <textarea class="form-control" id="descripcion" name="descripcion" rows="5" placeholder="La Escuela Profesional de Investigación Operativa forma profesionales con la capacidad de analizar los problemas de gestión....."></textarea>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="perfil">Perfil del Egresado</label>
              <textarea class="form-control" id="perfil" name="perfil" rows="5" placeholder="El egresado en Investigación Operativa cuenta con visión global, perfil internacional y...."></textarea>
            </div>
          </div>
          <div class="col-12 mt-2 mb-2">
            <div class="form-group">
              <label for="planEstudio">Plan de Estudio</label>
              <input type="file" class="form-control-file" id="planEstudio" value="planEstudio">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCerrarModalFacu" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnGuardar" class="btn btn-success" disabled>Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Editar Carrera-->
<div class="modal fade" id="modalEditarCarrera" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Facultad</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="row mb-2">
            <div class="col-8">
              <div class="form-group">
                <label for="nombreEdit">Nombre</label>
                <input type="text" class="form-control" id="nombreEdit" name="nombreEdit" placeholder="Ejem: Investigación Operativa">
                <input type="hidden" class="form-control" id="id_carrera" name="id_carrera" placeholder="Ejem: Investigación Operativa">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="duracionEdit">Duracion</label>
                <input type="text" class="form-control" id="duracionEdit" name="duracionEdit" placeholder="Ejem: 5" onkeypress="return validarInputSoloNumeros(event);">
              </div>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="gradoEdit">Grado</label>
              <input type="text" class="form-control" id="gradoEdit" name="gradoEdit" placeholder="Ejm: Bachiller en Investigación Operativa">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="tituloEdit">Titulo</label>
              <input type="text" class="form-control" id="tituloEdit" name="tituloEdit" placeholder="Ejm: Licenciado en Investigación Operativa">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="descripcionEdit">Descripcion</label>
              <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" rows="5" placeholder="La Escuela Profesional de Investigación Operativa forma profesionales con la capacidad de analizar los problemas de gestión....."></textarea>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="perfilEdit">Perfil del Egresado</label>
              <textarea class="form-control" id="perfilEdit" name="perfilEdit" rows="5" placeholder="El egresado en Investigación Operativa cuenta con visión global, perfil internacional y...."></textarea>
            </div>
          </div>
          <div class="col-12 mt-2 mb-2">
            <div class="form-group">
              <label for="planEstudioEdit">Plan de Estudio</label>
              <input type="file" class="form-control-file" id="planEstudioEdit" value="planEstudioEdit">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCerrarModalEditar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEditar" class="btn btn-success" disabled>Editar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Inhabilitar Carrera -->
<div class="modal fade" id="modalInhabilitarCarrera" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inhabilitar Universidad</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>¿Estas por inhabilitar a: <p class="d-inline fw-bolder" id="nombreCarreraInhabilitar"></p>?
            </h6>
            <input type="hidden" id="idCarreraInhabilitar">
          </div>
        </form>
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnInhabilitar" class="btn btn-success">Confirmar</button>
      </div>
    </div>
  </div>
</div>


<?php require_once('../views/layout/footer.php'); ?>