<?php require_once('../views/layout/header.php'); ?>
<div class="formRegistro row">
  <div class="col-6">
    <div class="form-group">
      <label for="nombre">Nombres</label>
      <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
    <div class="form-group">
      <label for="apellidos">Apellidos</label>
      <input type="text" class="form-control" id="apellidos" name="apellidos">
    </div>
    <div class="form-group">
      <label for="direccion">Direccion</label>
      <input type="text" class="form-control" id="direccion" name="direccion">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
      <label for="celular">Celular</label>
      <input type="text" class="form-control" id="celular" name="celular">
    </div>
    <div class="form-group">
      <label for="usuario">Usuario</label>
      <input type="text" class="form-control" id="usuario" name="usuario">
    </div>
    <div class="form-group">
      <label for="contrasena">Contraseña</label>
      <input type="password" class="form-control" id="contrasena" name="contrasena">
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label for="departamento">Departamento</label>
      <input type="text" class="form-control" id="departamento" name="departamento">
    </div>
    <div class="form-group">
      <label for="provincia">Provincia</label>
      <input type="text" class="form-control" id="provincia" name="provincia">
    </div>
    <div class="form-group">
      <label for="distrito">Distrito</label>
      <input type="text" class="form-control" id="distrito" name="distrito">
    </div>
    <div class="form-group">
      <label for="egresado">¿Es egresado?</label>
      <input type="text" class="form-control" id="egresado" name="egresado">
    </div>
    <div class="form-group">
      <label for="anio_egreso">Año de egreso</label>
      <input type="text" class="form-control" id="anio_egreso" name="anio_egreso">
    </div>
    <div class="form-group">
      <label for="contrasena2">Repetir contraseña</label>
      <input type="text" class="form-control" id="contrasena2" name="contrasena2">
    </div>
  </div>
  <button class="btn btn-primary" id="btnRegistrarUsuario">Inciar</button>
</div>



</form>

<?php require_once('../views/layout/footer.php'); ?>