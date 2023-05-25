const inpuntCodPromocao = document.getElementById("codpromo");
const inpuntButtonSalvar = document.getElementById("buttonpesq");
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
};

const SalvarAlteracao = ()=>{
  console.log("In");
  let nome = document.getElementsByClassName("nome").value;
  let descricao = document.getElementsByClassName("descricao");
  let dtaini = document.getElementById("dtaini");
  let dtafin = document.getElementsByClassName("dtafin");
  let codpromo = document.getElementsByClassName("codpromo");

    var checkbox1 = $(".checkbox1")
    .parent()
    .parent()
    .find(".checkbox1")
    .closest(".checkbox1")
    .toArray()
    .map(function (checkbox1) {
      return $(checkbox1).is(":checked");
    });
}

inpuntCodPromocao.addEventListener("change", () => {
  pesquisarPromocao();
});

inpuntButtonSalvar.addEventListener("click", () => {
  console.log("In");
});

// $(".buttonpesq").click(function () {
//   var nome = $(".nome").val();
//   var status1 = $(".status1").val();
//   var dtaini = $(".dtaini").val();
//   var dtafin = $(".dtafin").val();
//   var codpromo = $(".codpromo").val();

//   var checkbox1 = $(".checkbox1")
//     .parent()
//     .parent()
//     .find(".checkbox1")
//     .closest(".checkbox1")
//     .toArray()
//     .map(function (checkbox1) {
//       return $(checkbox1).is(":checked");
//     });

//   var NROEMPRESA = $(".NROEMPRESA")
//     .parent()
//     .parent()
//     .find(".NROEMPRESA")
//     .closest(".NROEMPRESA")
//     .toArray()
//     .map(function (NROEMPRESA) {
//       return $(NROEMPRESA).text();
//     });

//   var PRECOINCENTIVOEMB = $(".PRECOINCENTIVOEMB")
//     .parent()
//     .parent()
//     .find(".PRECOINCENTIVOEMB")
//     .closest(".PRECOINCENTIVOEMB")
//     .toArray()
//     .map(function (PRECOINCENTIVOEMB) {
//       return $(PRECOINCENTIVOEMB).text();
//     });

//   var QTDEMBALAGEM = $(".QTDEMBALAGEM")
//     .parent()
//     .parent()
//     .find(".QTDEMBALAGEM")
//     .closest(".QTDEMBALAGEM")
//     .toArray()
//     .map(function (QTDEMBALAGEM) {
//       return $(QTDEMBALAGEM).text();
//     });

//   //alert(dtaini)

//   $.ajax({
//     url: "data.php",
//     method: "get",
//     data: "dtaini=" + dtaini + "&dtafin=" + dtafin,
//     success: function (data) {
//       if (data > 0) {
//         alert("data invalida");
//       } else {
//         $.ajax({
//           url: "update_editar_promo.php",
//           method: "get",
//           data:
//             "checkbox1=" +
//             checkbox1 +
//             "&PRECOINCENTIVOEMB=" +
//             PRECOINCENTIVOEMB +
//             "&dtaini=" +
//             dtaini +
//             "&dtafin=" +
//             dtafin +
//             "&codpromo=" +
//             codpromo +
//             "&nome=" +
//             nome +
//             "&QTDEMBALAGEM=" +
//             QTDEMBALAGEM +
//             "&status=" +
//             status1 +
//             "&checkbox1=" +
//             checkbox1 +
//             "&NROEMPRESA=" +
//             NROEMPRESA,
//           success: function (editar_produto_emp) {
//             $(".section1").empty().html(editar_produto_emp);
//           },
//         });
//       }
//     },
//   });
// });
