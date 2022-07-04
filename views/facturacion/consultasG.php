<?php require_once('../views/layout/header.php'); ?>

<div class="card">
	<div class="card-header">
		<h2 class="mt-2 fw-bolder">MODULO DE CONSULTA</h2>
	</div>
	<div class="card-body">
		<div class="col-auto float-end ms-2">
			<button class="btn btn-primary fs-5" id="btnRural">RURAL</button>
		</div>
		<div class="col-auto float-end ms-1">
			<button id="btnSubirExcelModal" class="btn btn-success fs-5" id="btnRural"><i class="fas fa-upload"><i class="ms-2 fas fa-file-csv fs-5"></i></i></button>
		</div>
		<div class="col-auto float-end">
			<button id="btnBuscarRecibo" type="submit" class="btn btn-primary mb-3 fs-5"><i class="fas fa-search"></i></button>
		</div>
		<div class="col-auto  float-end d-flex">
			<div class="col-auto pe-2">
				<label for="nroRecibo" class="col-form-label fw-bolder fs-5">N° RECIBO</label>
			</div>
			<div class="col-auto pe-1">
				<input type="text" id="nroRecibo" name="nroRecibo" class="form-control fs-5" placeholder="25749233">
			</div>
		</div>



		<h2>Consumo de energia</h2>
		<!--  Tabla de datos -->
		<table id="table" class="display table table-hover text-center mb-4 table-responsive" style="width: 100%;">
			<thead style="text-align-last: center;">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Cuenta</th>
					<th scope="col">Importe</th>
					<th scope="col">II</th>
					<th scope="col">Div.</th>
					<th scope="col">CeCo</th>
					<th scope="col">Orden</th>
					<th scope="col">Soci</th>
					<!-- <th scope="col">Opciones</th> -->
			</thead>
			<tbody id="tbody">

			</tbody>
		</table>
	</div>
	<div class="card-footer text-muted text-end">
		<?php echo "<b>" . date("d") . " de " . date("M") . " de " . date("Y"); ?>
	</div>
</div>

<!-- Modal para subir excel -->
<div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Subir data (.csv)</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="file" class="form form-control">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
				<button id="btnUpload" type="button" class="btn btn-success">Subir</button>
			</div>
		</div>
	</div>
</div>
<?php require_once('../views/layout/footer.php'); ?>