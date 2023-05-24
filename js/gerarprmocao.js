//import alertar  from "../../BASE/jsGeral";

import { Toasty } from "../../base/jsGeral.js";
const buttongerar = document.getElementById("buttongerar");
const butttongerarPromocao = document.getElementById("gerarPromocao");
const buttonConsultarmargem = document.getElementById("consultarmargem");
const inputprodutomargem = document.getElementById("codprod");
const table = document.getElementById("table");

function carregando() {
  $(".receber_loading4").addClass("loading4");
  $(".carregando4").text("Carregando...");
}
function descarregando() {
  $(".receber_loading4").removeClass("loading4");
  $(".carregando4").text("");
}

function gerarCodigoPromocional() {
  var promo = $(".promocao");
  Toasty("Atenção", "Campo em vermelhos obrigatórios", "#E20914");
  $.getJSON("seqregra.php").done(function (seqregra) {
    //console.log(retorno);

    promo.val(seqregra.seqregra);
  });
}

function gerarPromocao() {
  let descricao = $(".descricao").val();
  let dtainicio = $(".dtainicio").val();
  let dtafinal = $(".dtafinal").val();
  let promocao = $(".promocao").val();
  let cluster = $(".cluster").val();
  let usuario = $("#usuario").val();
  let acordopfv = $(".acordopfv").is(":checked") ? "'S'" : "null";
  let descricao1 = $(".descricao");
  let dtainicio1 = $(".dtainicio");
  let dtafinal1 = $(".dtafinal");
  let promocao1 = $(".promocao");
  let cluster1 = $(".cluster");

  const checked = $(".checked")
    .toArray()
    .map(function (checked) {
      return $(checked).is(":checked");
    });

  const codfam = $(".codfam")
    .toArray()
    .map(function (codfam) {
      return $(codfam).val();
    });

  const codfam1 = $(".codfam1")
    .toArray()
    .map(function (codfam1) {
      return $(codfam1).val();
    });

  const codproduto = $(".codproduto")
    .toArray()
    .map(function (codproduto) {
      return $(codproduto).val();
    });

  const valoruni = $(".valoruni")
    .toArray()
    .map(function (valoruni) {
      return $(valoruni).val();
    });

  const checkedemb = $(".checkedemb")
    .toArray()
    .map(function (checkedemb) {
      return $(checkedemb).is(":checked");
    });

  const acordopdv = $(".acordopdv")
    .toArray()
    .map(function (acordopdv) {
      return $(acordopdv).val();
    });

  if (dtainicio > dtafinal) {
    Toasty("Atenção", "Data não pode ser maior que a data final", "#E20914");
  } else {
    function hasDuplicates(array) {
      return new Set(array).size !== array.length;
    }

    if (hasDuplicates(codfam1) == true) {
      Toasty("Atenção", "familia duplicada", "#E20914");
    } else {
      for (var i = 0, l = valoruni.length; i < l; i++) {
        console.log(valoruni[i]);
        if (valoruni[i] == "") {
          var vazio = valoruni[i];
        }
      }

      if (
        descricao == "" ||
        dtainicio == "" ||
        dtafinal == "" ||
        promocao == "" ||
        cluster == "" ||
        vazio == ""
      ) {
        Toasty("Atenção", "Preencha todos os campos", "#E20914");
      } else {
        $.ajax({
          url: "salvar_promocao_nome.php",
          method: "get",
          data:
            "descricao=" +
            descricao +
            "&dtainicio=" +
            dtainicio +
            "&dtafinal=" +
            dtafinal +
            "&promocao=" +
            promocao +
            "&cluster=" +
            cluster +
            "&usuario=" +
            usuario +
            "&checked=" +
            checked +
            "&codfam=" +
            codfam +
            "&codproduto=" +
            codproduto +
            "&valoruni=" +
            valoruni +
            "&checkedemb=" +
            checkedemb +
            "&acordopfv=" +
            acordopfv +
            "&acordopdv=" +
            acordopdv,
          success: function (msg) {
            // $('.salvar')[0].reset();
            descricao1.val("");
            dtainicio1.val("");
            dtafinal1.val("");
            promocao1.val("");

            $("#msg4").empty().html(msg);
          },
        });
      }
    }
  }
}

function consultarMargem() {
  let preco = $("#preco").val();
  let codprod = $("#codprod").val();
  let loja = $("#loja").val();

  if (preco == "" || codprod == "" || loja == "") {
    Toasty("Atenção", "Preencha todos os campos", "#E20914");
  }

  let $retcusto = $("#retcusto");
  let $retmargem = $("#retmargem");

  $.getJSON("consultamargem.php", {
    preco,
    codprod,
    loja,
  }).done(function (retorno) {
    //console.log(retorno);

    $retcusto.val(retorno.retcusto);
    $retmargem.val(retorno.retmargem);
  });
}

function verificarProduto() {
  let codproduto1 = $("#codprod").val();
  let codproduto2 = $("#codprod");

  $.ajax({
    url: "verificar_produto1.php",
    method: "get",
    data: "codproduto1=" + codproduto1,
    success: function (verificar) {
      if (verificar == 0) {
        Toasty("Atenção", "Produto Inválido", "#E20914");
        codproduto2.val("");
      }
    },
  });
}

buttongerar.addEventListener("click", () => {
  gerarCodigoPromocional();
});

butttongerarPromocao.addEventListener("click", () => {
  gerarPromocao();
});

buttonConsultarmargem.addEventListener("click", () => {
  consultarMargem();
});

inputprodutomargem.addEventListener("change", () => {
  verificarProduto();
});

// table.addEventListener("change", (event) => {
//   const target = event.target;
//   if (target.classList.contains("codproduto")) {
//     var codproduto = $(this)
//       .parent()
//       .parent()
//       .find(".codproduto")
//       .closest(".codproduto")
//       .val();
//     alert(codproduto);
//   }
// });

// table.addEventListener("change", (event) => {
//   const target = event.target;

//   if (target.classList.contains("codproduto")) {
//     const codproduto = target.closest("tr").querySelector(".codproduto").value;
//     const codproduto1 = target.closest("tr").querySelector(".codproduto").value;
//     const codproduto2 = target.closest("tr").querySelector(".codproduto").value;
//     const desc = target.closest("tr").querySelector(".desc").value;
//     const desc1 = target.closest("tr").querySelector(".desc").value;
//     const codfam = Array.from(document.querySelectorAll(".codfam")).map(
//       function (codfam) {
//         return codfam.value.replace("", "0");
//       }
//     );
//     console.log(codfam);
//   }
// });

$('#table').on('change', '.codproduto', function(t) {
  //alert('teste');
  var codproduto = $(this).parent().parent().find(".codproduto").closest(".codproduto").val();
  var codproduto1 = $(this).parent().parent().find(".codproduto").closest(".codproduto").val();
  var codproduto2 = $(this).parent().parent().find(".codproduto").closest(".codproduto");
  var desc = $(this).parent().parent().find(".desc").closest(".desc");
  var desc1 = $(this).parent().parent().find(".desc").closest(".desc");

  var codfam = $('.codfam').toArray().map(function(codfam) {
      return $(codfam).val().replace('', '0');
  });

  $.ajax({
      url: "verificar_produto.php",
      method: 'get',
      data: 'codproduto1=' + codproduto1 + '&codfam=' + codfam,
      success: function(verificar) {
          // $('#msg5').empty().html(msg);

          if (verificar == 0) {
              codproduto2.val('');
              desc1.val('');
              $.ajax({
                  url: "msg.php",
                  //method:'get',
                  //data:'codproduto1='+codproduto1,
                  success: function(msg) {
                      $('#msg4').empty().html(msg);

                  }

              });

          }
          if (verificar == 3) {
              codproduto2.val('');
              desc1.val('');
              $.ajax({
                  url: "msg3.php",
                  //method:'get',
                  //data:'codproduto1='+codproduto1,
                  success: function(msg1) {
                      $('#msg4').empty().html(msg1);

                  }

              });

          } else if (verificar == 1) {
              $.getJSON('pesquisar_produto.php', {
                      codproduto
                  })
                  .done(function(retorno) {

                      //console.log(retorno);

                      desc.val(retorno.desc);

                  });
          } //FECHA O ELSE IF
      } // SUCCESS DO AJAX
  }); // FECHA AJAX

});

// DESCRIÇÃO FAMILIA
$("#table").on("change", ".codfam", function (t) {
  //alert('teste');
  var codfam = $(this)
    .parent()
    .parent()
    .find(".codfam")
    .closest(".codfam")
    .val();
  var codfam1 = $(this)
    .parent()
    .parent()
    .find(".codfam")
    .closest(".codfam")
    .val();
  var codfam2 = $(this).parent().parent().find(".codfam").closest(".codfam");
  var desc = $(this).parent().parent().find(".desc").closest(".desc");
  var desc1 = $(this).parent().parent().find(".desc").closest(".desc");

  var codproduto = $(".codproduto")
    .toArray()
    .map(function (codproduto) {
      return $(codproduto).val().replace("", "0");
    });

  $.ajax({
    url: "verificar_familia.php",
    method: "get",
    data: "codfam1=" + codfam1 + "&codproduto=" + codproduto,
    success: function (verificar) {
      // $('#msg5').empty().html(msg);

      if (verificar == 0) {
        codfam2.val("");
        desc1.val("");
        $.ajax({
          url: "msg1.php",
          //method:'get',
          //data:'codproduto1='+codproduto1,
          success: function (msg1) {
            $("#msg4").empty().html(msg1);
          },
        });
      }
      if (verificar == 3) {
        codfam2.val("");
        desc1.val("");
        $.ajax({
          url: "msg3.php",
          //method:'get',
          //data:'codproduto1='+codproduto1,
          success: function (msg1) {
            $("#msg4").empty().html(msg1);
          },
        });
      } else if (verificar == 1) {
        $.getJSON("pesquisar_familia.php", {
          codfam,
        }).done(function (retorno) {
          //console.log(retorno);

          desc.val(retorno.desc);
        });
      } //FECHA O ELSE IF
    }, // SUCCESS DO AJAX
  }); // FECHA AJAX
});
