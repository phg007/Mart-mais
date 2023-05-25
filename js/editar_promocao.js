const inpuntcodpromocao = document.getElementById("codpromo");

const pesquisarPromocao = () => {

  console.log("Entrou na função");

  let codpromo = document.getElementById("codpromo").value;
  let descricao = document.getElementById("descricao");
  let dtaini = document.getElementById("dtaini");
  let dtafin = document.getElementById("dtafin");
  let status = document.getElementById("status");

  $.getJSON("pesquisar_promocao.php", {
    codpromo,
  }).done(function (retorno) {
    descricao.value = retorno.DESCRICAO;
    dtaini.value = retorno.DTAINICIO;
    dtafin.value = retorno.DTAFIM;
    status.value = retorno.STATUS;
    const status1 = $(".status").value;

    if (status1 == "I") {
      $(".ultimo").show();
      $(".primeiro").hide();
    }
    if (status1 == "A") {
      $(".ultimo").hide();
      $(".primeiro").show();
    }

    $.ajax({
      url: "editar_produto_emp.php",
      method: "get",
      data: "codpromo=" + codpromo,
      success: function (editar_produto_emp) {
        $(".section").empty().html(editar_produto_emp);
      },
    });
  });

}

inpuntcodpromocao.addEventListener("change", () => {
  pesquisarPromocao(); 
});

