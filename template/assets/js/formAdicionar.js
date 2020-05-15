let btnAdicionar = $("#btn-adicionar")[0];

btnAdicionar.addEventListener("click", validar);

function validar(evt) {
  evt.preventDefault();

  let modelo = $("#modelo").val();
  let placa = $("#placa").val();
  let marca = $("#marca").val();

  if (modelo === "") {
    $("#modeloHelp").html("Campo obrigatorio");
    $("#modeloHelp").fadeIn(500).fadeOut(1000);
  }

  if (marca === "") {
    $("#marcaHelp").html("Campo obrigatorio");
    $("#marcaHelp").fadeIn(500).fadeOut(1000);
  }

  if (placa === "") {
    $("#placaHelp").html("Campo obrigatorio");
    $("#placaHelp").fadeIn(500).fadeOut(1000);
  }

  if(placa.length < 8 && placa !== ""){
    $("#placaHelp").html("Placa inválida.");
    $("#placaHelp").fadeIn(500).fadeOut(1000);
  }

  if (marca !== "" && placa !== "" && modelo !== "") {
    adicionar(marca, placa, modelo);
  }
}

function adicionar(marca, placa, modelo) {
  $.ajax({
    url: "adicionar",
    method: "POST",
    dataType: "json",
    data: {
      placa,
      marca,
      modelo,
    },
    beforeSend: function () {
      $("#btn-adicionar")
        .val("")
        .toggleClass("btn btn-outline-primary spinner-border text-primary");
    },
    success: function () {
      $("#alert")
        .removeClass("alert-danger")
        .addClass("alert-success")
        .fadeIn(1000)
        .fadeOut(5000)
        .html("Veiculo cadastrado com sucesso.");
        $
        $("#marca").val("");
        $("#placa").val("");
        $("#modelo").val("");
    },
    complete: function () {
      $("#btn-adicionar")
        .val("Cadastrar novo veiculo")
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
