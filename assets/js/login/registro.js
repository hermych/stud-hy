function listarDepartamentos() {
  window.$.ajax({
    type: "post",
    url: "DepartamentoController.php?method=listarDepartamentos",
    beforeSend: function () {},
    success: function (response) {
      let data = JSON.parse(response);
      let selectDepa = document.getElementById("departamento");
      contenido = "<option value='0'>Departamentos</option>";
      data.forEach((depa) => {
        contenido += `<option value=${depa.id_departamento}>${depa.nombre}</option>`;
      });
      selectDepa.innerHTML = contenido;
    },
  });
}
function listarProvincias() {
  /**Capturando valores */
  let formData = new FormData();
  formData.append("iddep", $("#departamento").val());
  /**Enviando valores al servidor */
  window.$.ajax({
    type: "post",
    url: "ProvinciaController.php?method=listarProvincias",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#btnRegistrarUsuario").prop("disabled", true);
    },
    success: function (response) {
      let data = JSON.parse(response);
      let selectProv = document.getElementById("provincia");
      contenido = "<option value='0'>Provincia</option>";
      data.forEach((depa) => {
        contenido += `<option value=${depa.id_provincia}>${depa.nombre}</option>`;
      });
      selectProv.innerHTML = contenido;
    },
  });
}
function listarDistritos() {
  /**Capturando valores */
  let formData = new FormData();
  formData.append("iddep", $("#departamento").val());
  formData.append("idprov", $("#provincia").val());
  /**Enviando valores al servidor */
  window.$.ajax({
    type: "post",
    url: "DistritoController.php?method=listarDistritos",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#btnRegistrarUsuario").prop("disabled", true);
    },
    success: function (response) {
      let data = JSON.parse(response);
      console.log(data);
      let selectDist = document.getElementById("distrito");
      contenido = "<option value='0'>Distrito</option>";
      data.forEach((depa) => {
        contenido += `<option value=${depa.id_provincia}>${depa.nombre}</option>`;
      });
      selectDist.innerHTML = contenido;
    },
  });
}
$("#btnRegistrarUsuario").click(function (e) {
  /**Capturando valores */
  let formData = new FormData();
  formData.append("nombres", $("#nombre").val().toUpperCase());
  formData.append("apellidos", $("#apellidos").val().toLowerCase());
  formData.append("direccion", $("#direccion").val());
  formData.append("email", $("#email").val());
  formData.append("celular", $("#celular").val());
  formData.append("usuario", $("#usuario").val());
  formData.append("contrasena", $("#contrasena").val());
  formData.append("departamento", $("#departamento").val());
  formData.append("provincia", $("#provincia").val());
  formData.append("distrito", $("#distrito").val());
  formData.append("egresado", $("#egresado").val());
  formData.append("anio_egreso", $("#anio_egreso").val());
  formData.append("contrasena2", $("#contrasena2").val());
  /**Enviando valores al servidor */
  window.$.ajax({
    type: "post",
    url: "?method=registrarUsuario",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#btnRegistrarUsuario").prop("disabled", true);
    },
    success: function (response) {
      data = JSON.parse(response);
      if (data.estado == "ok") {
        console.log("listo");
        $("#btnRegistrarUsuario").prop("disabled", false);
      } else {
        console.log(data.mensaje);
      }
    },
  });
});
$(function () {
  listarDepartamentos();
});
$("#departamento").change(function () {
  listarProvincias();
});
$("#provincia").change(function () {
  listarDistritos();
});
