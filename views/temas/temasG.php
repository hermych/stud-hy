<?php require_once('../views/layout/header.php'); ?>

<!--TABLA -->
<div class="card">
  <div class="card-header">
    <h2 class="mt-2">Temas</h2>
  </div>
  <div class="card-body">
    <button type="button" id="btnModalRegistrarTema" class="btn btn-primary float-end mb-4" data-toggle="modal" data-target="#modalRegistrarTema">
      Registrar
    </button>
    <!-- Tabla de datos -->
    <table id="table" class="display table table-hover text-center mb-4 table-responsive" style="width: 100%;">
      <thead style="text-align-last: center;">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Universidad</th>
          <th scope="col">Prospecto</th>
          <th scope="col">Tema</th>
          <th scope="col">Nombre</th>
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
<!-- Modal Agregar Tema-->
<div class="modal fade" id="modalRegistrarTema" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registrar Tema</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="univ">Universidad</label>
              <select class="form-select border border-danger" id="univ" name="univ">
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="prospecto">Prospecto</label>
              <select class="form-select border border-danger" id="prospecto" name="prospecto" disabled>
                <option value="0">--- Seleccione Prospecto ---</option>
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="curso">Curso</label>
              <select class="form-select border border-danger" id="curso" name="curso" disabled>
                <option value="0">--- Seleccione Curso ---</option>
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="nombre">Nombre del Tema</label>
              <input type="email" class="form-control border border-danger" id="nombre" name="nombre">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCerrarModalTema" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnGuardarTema" class="btn btn-success" disabled>Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Editar Prospecto-->
<div class="modal fade" id="modalEditarTema" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Prospecto</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="univ_edit">Universidad</label>
              <select class="form-select border border-danger" id="univ_edit" name="univ_edit" disabled>
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="prospectoEdit">Prospecto</label>
              <select class="form-select border border-danger" id="prospectoEdit" name="prospectoEdit" disabled>
                <option value="0">--- Seleccione Prospecto ---</option>
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="cursoEdit">Curso</label>
              <select class="form-select border border-danger" id="cursoEdit" name="cursoEdit">
                <option value="0">--- Seleccione Curso ---</option>
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="nombre_edit">Nombre</label>
              <input type="text" class="form-control border border-danger" id="nombre_edit" name="nombre_edit">
              <input type="hidden" id="idtema" name="idtema">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEditarTema" class="btn btn-success" disabled>Editar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Inhabilitar Prospecto -->
<div class="modal fade" id="modalInhabilitarTema" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inhabilitar Tema</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>??Estas por inhabilitar a: <p class="d-inline fw-bolder" id="nombreTemaInhabilitar"></p>?
            </h6>
            <input type="hidden" id="idTemaInhabilitar">
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
<!-- Modal habilitad Prospecto -->
<div class="modal fade" id="modalHabilitarTema" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Habilitar Facultad</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>??Habilitar el tema de: <p class="d-inline fw-bolder" id="nombreTemaHabilitar"></p>?
            </h6>
            <input type="hidden" id="idTemaHabilitar">
          </div>
        </form>
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnHabilitar" class="btn btn-success">Confirmar</button>
      </div>
    </div>
  </div>
</div>


<?php require_once('../views/layout/footer.php'); ?>