<?php require_once('../views/layout/header.php'); ?>

<!-- Button trigger modal -->
<div class="card">
  <div class="card-header">
    <h2 class="mt-2">Universidades</h2>
  </div>
  <div class="card-body">
    <button type="button" id="btnModalRegistrarFacu" class="btn btn-primary float-end mb-4" data-toggle="modal" data-target="#modalRegistrarFacultad">
      Registrar
    </button>
    <!-- Tabla de datos -->
    <table id="table" class="display table table-hover text-center mb-4 table-responsive" style="width: 100%;">
      <thead style="text-align-last: center;">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripcion</th>
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
<!-- Modal Agregar Facultad-->
<div class="modal fade" id="modalRegistrarFacultad" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registrar Facultad</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="email" class="form-control" id="nombre" name="nombre">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="descripcion">Descripcion</label>
              <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCerrarModalFacu" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnGuardarFacultad" class="btn btn-success" disabled>Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Editar Facultad-->
<div class="modal fade" id="modalEditarFacultad" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Facultad</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="nombreEdit">Nombre</label>
              <input type="email" class="form-control" id="nombreEdit" name="nombreEdit">
              <input type="hidden" class="form-control" id="idfacu" Edit name="idfacu" Edit>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="descripcionEdit">Descripcion</label>
              <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" rows="3"></textarea>
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
<!-- Modal Inhabilitar Facultad -->
<div class="modal fade" id="modalInhabilitarFacu" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inhabilitar Universidad</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>¿Estas por inhabilitar a: <p class="d-inline fw-bolder" id="nombreFacuInhabilitar"></p>?
            </h6>
            <input type="hidden" id="idFacuInhabilitar">
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