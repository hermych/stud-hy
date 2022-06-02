$('#btnRegistrarUsuario').click(function (e) {
  let formData = new FormData();
  formData.append("nombres", ($('#nombre').val()).toLowerCase());
  formData.append("apellidos", ($('#apellidos').val()).toLowerCase());
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
