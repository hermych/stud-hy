<?php require_once('../views/layout/header.php'); ?>

<!--TABLA -->
<div class="card">
  <div class="card-header">
    <h2 class="mt-2">Planes de Estudio</h2>
  </div>
  <div class="card-body">
    <button type="button" id="btnModalRegistrarFacu" class="btn btn-primary float-end mb-4" data-toggle="modal" data-target="#modalRegistrarProspecto">
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
<!-- Modal Agregar Facultad-->
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
              <label for="univ_edit">Universidad</label>
              <select class="form-select border border-danger" id="univ_edit" name="univ_edit">
              </select>
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="nombre_edit">Nombre</label>
              <input type="text" class="form-control border border-danger" id="nombre_edit" name="nombre_edit">
              <input type="hidden" id="idfacu" name="idfacu">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="imagen_edit" id="imagen_title">Imagen</label>
              <input type="file" class="form-control border border-danger" id="imagen_edit" name="imagen_edit">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="decano_edit">Decano</label>
              <input type="text" class="form-control border border-warning" id="decano_edit" name="decano_edit">
            </div>
          </div>
          <div class="col-12 mb-2">
            <div class="form-group">
              <label for="descripcion_edit">Descripcion</label>
              <textarea class="form-control border border-danger" id="descripcion_edit" name="descripcion_edit" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEditarFacultad" class="btn btn-success" disabled>Editar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Inhabilitar Facultad -->
<div class="modal fade" id="modalInhabilitarFacu" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inhabilitar Facultad</h5>
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
<!-- Modal habilitad Facultad -->
<div class="modal fade" id="modalHabilitarFacu" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Habilitar Facultad</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h6>¿Estas por habilitar a: <p class="d-inline fw-bolder" id="nombreFacuHabilitar"></p>?
            </h6>
            <input type="hidden" id="idFacuHabilitar">
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
<!-- Modal Ver descripcion Facultad -->
<div class="modal fade" id="modalDescripcion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Descripcion</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <div type="text" id="leer_descripcion" style="text-align: justify;"></div>
          </div>
        </form>
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<?php require_once('../views/layout/footer.php'); ?>