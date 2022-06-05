<?php require_once('../views/layout/header.php'); ?>

<form id="formLogin">
  <div class="form-group">
    <label for="email">Usuario</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="contrasena">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena">
  </div>
  <button class="btn btn-primary" id="iniciarSesion">Inciar</button>
</form>

