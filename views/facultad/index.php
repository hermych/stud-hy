<?php require_once('../views/layout/header.php'); ?>

<!-- Button trigger modal -->
<div class="card">
  <div class="card-header">
    <h2 class="mt-2">Facultades</h2>
  </div>
  <div class="card-body">
    <button type="button" id="btnModalRegistrarUniv" class="btn btn-primary float-end mb-4" data-toggle="modal" data-target="#modalRegistrarFacultad">
      Registrar
    </button>
    <table id="universidadTable" class="display table table-hover text-center mb-4 table-responsive" style="width: 100%;">
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
<!-- Modal Agregar Universidad-->
<div class="modal fade" id="modalRegistrarFacultad" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalRegistrarFacultadLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegistrarFacultadLabel">Registrar Facultad</h5>
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
<!-- Modal Editar Universidad-->
<div class="modal fade" id="modalEditarUniversidad" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Universidad</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-2">
            <img id="fotoPortada" width="100%" alt="imagen de portada">
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="nombreEdit">Nombre</label>
              <input type="email" class="form-control" id="nombreEdit" name="nombreEdit">
              <input type="hidden" class="form-control" id="iduniv" Edit name="iduniv" Edit>
            </div>
          </div>
          <div class="col-6 mb-2">
            <div class="form-group">
              <label for="departamentoEdit">Departamento</label>
              <select class="form-control" id="departamentoEdit" name="departamentoEdit">
                <option value="0">Seleccione departamento</option>
              </select>
            </div>
          </div>
          <div class="col-6 mb-2">
            <div class="form-group">
              <label for="provinciaEdit">Provincia</label>
              <select class="form-control" id="provinciaEdit" name="provinciaEdit">
                <option value="0">Seleccione provincia</option>
              </select>
            </div>
          </div>
          <div class="col-6 mb-2">
            <div class="form-group">
              <label for="distritoEdit">Distrito</label>
              <select class="form-control" id="distritoEdit" name="distritoEdit">
                <option value="0">Seleccione distrito</option>
              </select>
            </div>
          </div>
          <div class="col-12 mt-2 mb-2">
            <div class="form-group">
              <label for="imagenEdit">Imagen</label>
              <input type="file" class="form-control-file" id="imagenEdit" value="imagenEdit">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="descripcionEdit">Descripcion</label>
              <textarea class="form-control" id="descripcionEdit" name="descripcionEdit" rows="5"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCerrarModalEditUniv" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEditarUniversidad" class="btn btn-success" disabled>Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Inhabilitar Universidad -->
<div class="modal fade" id="modalInhabilitarUniv" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inhabilitar Universidad</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>¿Estas por inhabilitar a: <p class="d-inline fw-bolder" id="nombreUnivInhabilitar"></p>?
            </h6>
            <input type="hidden" id="idUnivInhabilitar">
          </div>
        </form>
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnInhabilitarUniv" class="btn btn-success">Confirmar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para ver la foto -->
<div class="modal fade" id="modalVerFoto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Foto de portada</h5>
      </div>
      <div class="modal-body">
        <img id="fotoPortadaVista" src="" alt="foto de portada de universidad" style="width: 100%; height: 150%;">
      </div>
    </div>
  </div>
</div>


<?php require_once('../views/layout/footer.php'); ?>