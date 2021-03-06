<?php require_once('../views/layout/header.php'); ?>

<!--TABLA -->
<div class="card">
  <div class="card-header">
    <h2 class="mt-2">Prospectos de Admision</h2>
  </div>
  <div class="card-body">
    <button type="button" id="btnModalRegistrarProspecto" class="btn btn-primary float-end mb-4" data-toggle="modal" data-target="#modalRegistrarProspecto">
      Registrar
    </button>
    <!-- Tabla de datos -->
    <table id="table" class="display table table-hover text-center mb-4 table-responsive" style="width: 100%;">
      <thead style="text-align-last: center;">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Universidad</th>
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
<!-- Modal Agregar Prospecto-->
<div class="modal fade" id="modalRegistrarProspecto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registrar Prospecto</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="univ">Universidad</label>
              <select class="form-select border border-danger" id="univ" name="univ">
                <option value="1">Universidad Nacional Mayor de San Marcos</option>
                <option value="2">Universidad Catolica del Peru</option>
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="email" class="form-control border border-danger" id="nombre" name="nombre">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCerrarModalFacu" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnGuardarProspecto" class="btn btn-success" disabled>Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Editar Prospecto-->
<div class="modal fade" id="modalEditarProspecto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
              <label for="nombre_edit">Nombre</label>
              <input type="text" class="form-control border border-danger" id="nombre_edit" name="nombre_edit">
              <input type="hidden" id="idpros" name="idpros">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEditarProspecto" class="btn btn-success" disabled>Editar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Inhabilitar Prospecto -->
<div class="modal fade" id="modalInhabilitarProspecto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inhabilitar Prospecto</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>??Estas por inhabilitar a: <p class="d-inline fw-bolder" id="nombreProspectoInhabilitar"></p>?
            </h6>
            <input type="hidden" id="idProspectoInhabilitar">
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
<div class="modal fade" id="modalHabilitarProspecto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Habilitar Facultad</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>??Estas por habilitar a: <p class="d-inline fw-bolder" id="nombreProspectoHabilitar"></p>?
            </h6>
            <input type="hidden" id="idProspectoHabilitar">
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