<?php require_once('../views/layout/header.php'); ?>

	<div class="card">
	  <div class="card-header">
	    <h2 class="mt-2">Recibos</h2>
	  </div>
	  <div class="card-body">
	    
	    <!-- Tabla de datos -->
	    <table id="table" class="display table table-hover text-center mb-4 table-responsive" style="width: 100%;">
		      <thead style="text-align-last: center;">
		        <tr>
		          <th scope="col">#</th>
		          <th scope="col">Universidad</th>
		          <th scope="col">Prospecto</th>
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
<!--

	<div class="modal fade" id="modalRegistrarCurso" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Registrar Curso</h5>
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
	              <label for="nombre">Nombre</label>
	              <input type="email" class="form-control border border-danger" id="nombre" name="nombre">
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="btnCerrarModalCurso" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
	        <button type="button" id="btnGuardarCurso" class="btn btn-success" disabled>Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
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
	              <input type="hidden" id="idcurso" name="idcurso">
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
	        <button type="button" id="btnEditarCurso" class="btn btn-success" disabled>Editar</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<div class="modal fade" id="modalInhabilitarCurso" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Inhabilitar Curso</h5>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <h6>¿Estas por inhabilitar a: <p class="d-inline fw-bolder" id="nombreCursoInhabilitar"></p>?
	            </h6>
	            <input type="hidden" id="idCursoInhabilitar">
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
	<!
	<div class="modal fade" id="modalHabilitarCurso" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Habilitar Facultad</h5>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <h6>¿Estas por habilitar a: <p class="d-inline fw-bolder" id="nombreCursoHabilitar"></p>?
	            </h6>
	            <input type="hidden" id="idCursoHabilitar">
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
-->
<?php require_once('../views/layout/footer.php'); ?>