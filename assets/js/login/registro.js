$('#btnRegistrarUsuario').click(function (e) {
  let formData = new FormData();
  formData.append("nombres", ($('#nombre').val()).toLowerCase());
  formData.append("apellidos", ($('#apellidos').val()).toLowerCase());
  formData.append("direccion", $('#direccion').val());
  formData.append("email", $('#email').val());
  formData.append("celular", $('#celular').val());
  formData.append("usuario", $('#usuario').val());
  formData.append("contrasena", $('#contrasena').val());
  formData.append("departamento", $('#departamento').val());
  formData.append("provincia", $('#provincia').val());
  formData.append("distrito", $('#distrito').val());
  formData.append("egresado", $('#egresado').val());
  formData.append("anio_egreso", $('#anio_egreso').val());
  formData.append("contrasena2", $('#contrasena2').val());
  window.$.ajax({
    type: "post",
    url: "?method=registrarUsuario",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
    },
  });
});
