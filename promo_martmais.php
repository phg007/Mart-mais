<?php


include "../base/conexao_martdb.php";
include "../MobileNav/docs/index_menucomlogin.php";

// include "../base/jsGeral.js";

$_SESSION['nome'];
//echo $_SESSION['date'];
$hoje = date('Y-m-d');


if (isset($_SESSION['nome'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Martmais</title>


        <link rel="icon" type="image/png" href="img/martband.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link href="../base/mdb/css/bootstrap.css" rel="stylesheet">
        <link href="../base/jquery_ui/jquery/jquery-ui.css" rel="stylesheet">

        <link rel="stylesheet" href="../base/dist/sidenav.css" type="text/css">
        <link rel="stylesheet" href="css/gerarPromocao.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel='stylesheet' href='http://fonts.googleapis.com/icon?family=Material+Icons' type='text/css'>

    </head>

    <body id="body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card my-4">
                        <h6 style="background-color: #00a550;color:white" class="card-header text-center font-weight-bold text-uppercase ">CONSULTA Margem</h6>
                        <div class="card-body">
                            <Form id="salvar" class="salvar">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Loja: </label>
                                            <input autocomplete="false" required name="" type="text" class="form-control " value="" id="loja"></input>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Cód produto: </label>
                                            <input autocomplete="false" required name="" type="number" class="form-control " value="" id="codprod"></input>

                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label> Preço: </label>
                                            <input required autocomplete="false" name="" type="text" class="form-control  " value="" id="preco"></input>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label style="visibility: hidden;">Pesquisar </label>
                                            <a type="button" class=" btn-lg  pesquisar" id="consultarmargem"><i class="fas fa-search especial"></i></a>

                                            <!-- <button class= "pesquisar" style="background-color: green; border-radius: 50%; width: 50px; height: 50px; border: none; display: flex; justify-content: center; align-items: center;">
                                                <i class="fa fa-search" style="color: white;"></i>
                                            </button> -->
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Retorno custo: </label>
                                            <input readonly autocomplete="false" name="descricao" type="text" class="form-control  " value="" id="retcusto"></input>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Retorno margem: </label>
                                            <input readonly autocomplete="false" name="descricao" type="text" class="form-control  " value="" id="retmargem"></input>
                                        </div>
                                    </div>

                                </div>

                            </Form>
                        </div>
                    </div>
                </div>
                <section style="display: none;" id="msg4"></section>

                <div class="col-lg-8">
                    <div class="card my-4">
                        <h6 style="background-color: #00a550;color:white" class="card-header text-center font-weight-bold text-uppercase ">Gerar Promoção Martmais</h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="">Código Promocional</label>

                                    <div class="input-group ">

                                        <button id="buttongerar" style="border-radius: 0%;background-color:#00a550;color:white" class="btn  btn-md m-0  py-0 z-depth-0 gerar " type="button">Gerar</button>
                                        <input type="text" readonly class="form-control promocao" name="promocao" aria-label="Text input   button">
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Descrição: </label>
                                        <input autocomplete="false" name="descricao" type="text" class="form-control descricao" value="">
                                        <input autocomplete="false" required name="" type="hidden" class="form-control " value="<?= $_SESSION['nome'] ?>" id="usuario"></input>

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>LOJA:</label>
                                        <select class="form-control loja_ger selectpicker" required id="loja_ger" multiple data-actions-box="true" title="Selecione a loja">
                                            <!-- <option disabled selected value="">Selecione a loja...</option> -->
                                            <?php
                                            $query = "select *
                                            FROM consinco.max_empresa
                                            WHERE STATUS = 'A'
                                                AND NROEMPRESA not in (7,203,204,208)
                                            ORDER BY NROEMPRESA ASC";
                                            $parse = oci_parse($oracle, $query);
                                            oci_execute($parse);
                                            while (($row = oci_fetch_assoc($parse)) != false) {
                                                echo "<option value='" . $row['NROEMPRESA'] . "'>
                                            " . $row['NROEMPRESA'] . "
                                            </option>";
                                            }
                                            ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label> Data início:</label>
                                        <input autocomplete="false" name="dtainicio" type="date" min="2020-01-01" class="form-control dtainicio" value="<?= $hoje ?>">
                                        <!-- <input style="font-size:100px" type="checkbox" class="mt-3 acordopfv">
                                                <label style="color: black;">Gerar acordo PDV</label> -->
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label> Data final:</label>
                                        <input autocomplete="false" value="<?= $hoje ?>" min="2020-01-01" name="dtafinal" type="date" class="form-control dtafinal">


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="msg4"></section>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-8">
                    <div class="card ">
                        <div class="card-body">

                            <div id="table" class="table-editable" style="margin-top: -15px;">
                                <span class="table-add float-right mb-3 mr-2"><a href="#!" style="color: #00a550;"><i class="fas fa-plus fa-2x " aria-hidden="true"></i></a></span>

                                <table class="table table-bordered  table-striped text-center" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">MENOR EMB</th>
                                            <th class="text-center">FAMÍLIA</th>
                                            <th class="text-center">CÓDIGO FAMÍLIA</th>
                                            <th class="text-center">CODIGO PRODUTO</th>
                                            <th class="text-center">VALOR UNI</th>
                                            <th class="text-center">DESCRIÇÃO</th>
                                            <th class="text-center">VALOR DE ACORDO </th>
                                            <th class="text-center">REMOVER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="pt-3-half" contenteditable="false"><input type="checkbox" class="form-control checkedemb" name="checkedemb" value="" style="max-height: 15px;"> </td>
                                            <td class="pt-3-half" contenteditable="false"><input type="checkbox" class="form-control checked" name="checked" value="" style="max-height: 15px;"> </td>
                                            <td class="pt-3-half " contenteditable="false"><input readonly autocomplete="false" name="codfamilia" type="number" class="form-control codfam " value=""></td>
                                            <td class="pt-3-half" contenteditable="false"><input autocomplete="false" name="codproduto" type="number" class="form-control codproduto " value=""></td>
                                            <td class="pt-3-half" contenteditable="false"><input autocomplete="false" name="valoruni" type="number" class="form-control valoruni " value=""></td>
                                            <td class="pt-3-half" contenteditable="false"><input readonly autocomplete="false" name="desc" type="text" class="form-control desc " value=""></td>
                                            <td class="pt-3-half" contenteditable="false"><input autocomplete="false" name="acordopdv" type="number" class="form-control acordopdv " value=""></td>
                                            <td>
                                                <a href="#!" style="font-size:15px; color:red" class="table-remove"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>


                                    </tbody>


                                </table>
                            </div>
                            <div class="col-12 text-center">
                                <input type="button" value="salvar" class="btn  btn-rounded " id="gerarPromocao" style="background-color:#00a550;color:white;margin-top:5px;">

                            </div>
                        </div>




                    </div>


                    <section id="msg4"></section>
                </div>
            </div>

            <script src="js/gerarprmocao.js" type="module"></script>
            <!-- <script type="module" src="../base/jsGeral.js"></script> -->

    </body>

    </html>
<?php
} else { ?>
    <script>
        window.location.href = "http://martminasweb.grupomartminas.local/";
    </script>
<?php
}
?>


<!-- <script type="text/javascript" src="mdb/js/jquery.min.js"></script>
    <script type="text/javascript" src="jquery_ui/jquery/jquery-ui.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script type="text/javascript" src="../base/mdb/js/bootstrap.min.js"></script>
<!-- <script type="module"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>





<script>
    var $tableID = $('#table');
    var $BTN = $('#export-btn');
    var $EXPORT = $('#export');

    var newTr = `
                        <tr class="hide">
                        <td class="pt-3-half" contenteditable="false"><input  type="checkbox" class="form-control checkedemb" name="checkedemb" value="" style="max-height: 15px;"> </td>
                        <td class="pt-3-half" contenteditable="false"><input type="checkbox" class="form-control checked" name="checked"  value="" style="max-height: 15px;"></td>
                        <td class="pt-3-half " contenteditable="false"><input readonly autocomplete="false" name="codfamilia" type="number"  class="form-control codfam " value=""></td>
                        <td class="pt-3-half" contenteditable="false"><input  autocomplete="false" name="codproduto" type="number"  class="form-control codproduto " value=""></td>
                        <td class="pt-3-half" contenteditable="false"><input   autocomplete="false" name="valoruni" type="number"  class="form-control valoruni " value=""></td>
                        <td class="pt-3-half" contenteditable="false"><input readonly  autocomplete="false" name="desc" type="text"  class="form-control desc " value=""></td>
                        <td class="pt-3-half" contenteditable="false"><input autocomplete="false" name="acordopdv" type="number" class="form-control acordopdv " value=""></td>

                        <td>
                        <a href="#!" style="font-size:15px; color:red" class="table-remove"><i class="far fa-trash-alt"></i></a></td>
                        </tr>`;



    $tableID.on('click', '.checked', function() {

        //$(this).parents('tr').detach();
        var checked = $(this).closest('.checked').is(':checked');



        if (checked == true) {

            $(this).parent().parent().find(".codfam").closest(".codfam").removeAttr('readonly').addClass('codfam1');
            $(this).parent().parent().find(".codproduto").closest(".codproduto").attr('readonly', 'readonly');
            $(this).parent().parent().find(".codproduto").closest(".codproduto").val('');
            $(this).parent().parent().find(".desc").closest(".desc").val('');

        } else if (checked == false) {

            $(this).parent().parent().find(".codfam").closest(".codfam").attr('readonly', 'readonly').removeClass('codfam1');
            $(this).parent().parent().find(".codproduto").closest(".codproduto").removeAttr('readonly');
            $(this).parent().parent().find(".codfam").closest(".codfam").val('');
            $(this).parent().parent().find(".desc").closest(".desc").val('');
        }


    });

    $tableID.on('click', '.table-remove', function() {

        $(this).parents('tr').detach();
    });

    $tableID.on('click', '.table-up', function() {

        const $row = $(this).parents('tr');

        if ($row.index() === 0) {
            return;
        }

        $row.prev().before($row.get(0));
    });

    $tableID.on('click', '.table-down', function() {

        const $row = $(this).parents('tr');
        $row.next().after($row.get(0));
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTN.on('click', () => {

        const $rows = $tableID.find('tr:not(:hidden)');
        const headers = [];
        const data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function() {

            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function() {
            const $td = $(this).find('td');
            const h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach((header, i) => {

                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORT.text(JSON.stringify(data));
    });
</script>