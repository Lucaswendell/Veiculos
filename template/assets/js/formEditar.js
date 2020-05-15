let btnEditar = $("#btn-editar")[0];

btnEditar.addEventListener("click", validar);

function validar(evt) {
  evt.preventDefault();

  let modelo = $("#modelo").val();
  let placa = $("#placa").val();
  let marca = $("#marca").val();
  let id = $("#id").val();

  if (modelo === "") {
    $("#modeloHelp").html("Campo obrigatorio");
    $("#modeloHelp").fadeOut(10000);
  }

  if (modelo === "") {
    $("#modeloHelp").html("Campo obrigatorio");
    $("#modeloHelp").fadeOut(10000);
  }

  if (marca === "") {
    $("#marcaHelp").html("Campo obrigatorio");
    $("#marcaHelp").fadeOut(10000);
  }

  if (placa === "") {
    $("#placaHelp").html("Campo obrigatorio");
    $("#placaHelp").fadeOut(10000);
  }

  if (placa.length < 8) {
    $("#placaHelp").html("Placa ivalida.");
    $("#placaHelp").fadeOut(10000);
  }

  if (marca !== "" && placa !== "" && modelo !== "") {
    editar(marca, placa, modelo, id);
  }
}

function editar(marca, placa, modelo, id) {
  $.ajax({
    url: id,
    method: "POST",
    dataType: "json",
    data: {
      id,
      placa,
      marca,
      modelo,
    },
    beforeSend: function () {
      $("#btn-editar")
        .val("")
        .toggleClass("btn btn-outline-primary spinner-border text-primary");
    },
    success: function () {
      $("#alert")
        .removeClass("alert-danger")
        .addClass("alert-success")
        .fadeIn(1000)
        .fadeOut(5000)
        .html("Veiculo editado com sucesso.");
    },
    complete: function () {
      $("#btn-editar")
        .val("Editar veiculo")
        .toggleClass("btn btn-outline-primary spinner-border text-primary");
    },
    error: function (response) {
      let { veiculo } = JSON.parse(response.responseText);

      $("#alert")
        .removeClass("alert-success")
        .addClass("alert-danger")
        .fadeIn(1000)
        .fadeOut(5000)
        .html(veiculo.error);
    },
  });
}
