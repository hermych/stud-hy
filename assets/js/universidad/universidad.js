function listarUniversidades() {
  window.$.ajax({
    type: "post",
    url: "UniversidadController.php?method=universidadGList",
    beforeSend: function () {},
    success: function (response) {
      let data = JSON.parse(response);
      let universidades = data.data;
      console.log(universidades[0]);
      let contenido = "";
      universidades.forEach((univ) => {
        contenido += ` <div class="col-sm-4">
                          <div class="card" style="width: 18rem;">
                          <img src="../assets/image/fotosUniv/${univ.imagen}" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">${univ.nombre}</h5>
                            <a href="../controllers/UniversidadController.php?method=universidadView&id=${univ.id_universidad}" class="btn btn-primary">Go somewhere</a>
                          </div>
                        </div>
                      </div>`;
      });
      $("#univContainer").html(contenido);
    },
  });
}
$(document).ready(function () {
  listarUniversidades();
});
