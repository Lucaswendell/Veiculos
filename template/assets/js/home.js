let btnPesquisar = $("#btn-pesquisar")[0];

btnPesquisar.addEventListener("click", pesquisar);

$(".excluir").each(function () {
  $(this)[0].addEventListener("click", excluir);
});

function excluir(evt) {
  evt.preventDefault();
  let id = this.getAttribute("id");

  swal({
    title: "Você tem certeza?",
    text: "Uma vez deletado, você não poderá recuperar!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "excluir/" + id,
        method: "DELETE",
        dataType: "JSON",
        success: function () {
          $("#tr-" + id).fadeOut(500);
        },
        error: function ({ responseText }) {
          let {
            veiculo: { error },
          } = JSON.parse(responseText);
          swal({
            title: error,
            icon: "error",
          });
        },
      });
    }
  });
}

function pesquisar(evt) {
  evt.preventDefault();
  let pesquisa = $("#pesquisa").val();
  let modoPlaca = $("#placa")[0];
  let modoMarca = $("#marcaModelo")[0];

  if (pesquisa === "") {
    return;
  }

  if (modoPlaca.checked) {
    $(".btn-resetar")[0].style.display = "inline-block"

    $.ajax({
      url: "" + pesquisa + "/placa",
      method: "GET",
      dataType: "JSON",
      success: function ({ veiculo }) {
        let { id, placa, modelo, marca, dataCadastro } = veiculo;
        $("#table-body").html(`
        <tr id="tr-${id}">
          <td>${modelo}</td>
          <td>${marca}</td>
          <td>${placa}</td>
          <td>${dataCadastro}</td>
          <td><a  class="table-link" href="editar/${id}"><i class="icon-pencil2"></i></a></td>
          <td><a href="" class="excluir table-link" id="${id}"><i class="icon-bin"></i></a></td>
        </tr>`);
        let linkTr = $(`#${id}`)[0];
        linkTr.addEventListener("click", excluir);
      },
      error: function ({ responseText }) {
        let {
          veiculo: { error },
        } = JSON.parse(responseText);

        swal({
          title: error,
          icon: "error",
        });
      },
    });
  } else if (modoMarca.checked) {
    $(".btn-resetar")[0].style.display = "inline-block"

    $.ajax({
      url: "" + pesquisa + "/marca",
      method: "GET",
      dataType: "JSON",
      success: function ({ veiculos }) {
        let tr = "";
        veiculos.forEach((veiculo) => {
          let { id, placa, modelo, marca, dataCadastro } = veiculo;
          tr += `
          <tr id="tr-${id}">
            <td>${modelo}</td>
            <td>${marca}</td>
            <td>${placa}</td>
            <td>${dataCadastro}</td>
            <td><a  class="table-link" href="editar/${id}"><i class="icon-pencil2"></i></a></td>
            <td><a href="" class="excluir table-link" id="${id}"><i class="icon-bin"></i></a></td>
          </tr>`;
        });
        $("#table-body").html(tr);
        veiculos.forEach(({ id }) => {
          let linkTr = $(`#${id}`)[0];
          linkTr.addEventListener("click", excluir);
        });
      },
      error: function ({ responseText }) {
        let {
          veiculo: { error },
        } = JSON.parse(responseText);

        swal({
          title: error,
          icon: "error",
        });
      },
    });
  }else{
    swal({
      title: "Escolha o modo de pesquisa.",
      icon: "error",
    });
  }
}
