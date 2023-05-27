<?php
include "../base/conexao_martdb.php";
include "../MobileNav/docs/index_menucomlogin.php";
$_SESSION['nome'];
//echo $_SESSION['date'];
?>


<!DOCTYPE html>
<html>

<head>
    <title>Martmais</title>
    <link rel="icon" type="image/png" href="img/martband.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- <link href="mdb/css/mdb.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="../base/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../base/Buttons/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="../base/datetimepicker/jquery.datetimepicker.min.css" />
    <link href="../base/mdb/css/bootstrap.css" rel="stylesheet">
    <link href="../base/jquery_ui/jquery/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="../base/dist/sidenav.css" type="text/css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/icon?family=Material+Icons' type='text/css'>


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card my-4">
                    <h6 class="card-header text-center font-weight-bold text-uppercase" style="background-color: #00a550;color:white">EDITAR PROMOÇÃO</h6>
                    <div class="card-body">
                        <Form id="salvar" class="salvar">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Cod promo: </label>
                                        <input autocomplete="false" name="" type="text" class="form-control codpromo" id="codpromo" value=""></input>
                                        <input type="hidden" class="form-control nome" value="<?= $_SESSION['nome'] ?>"></input>

                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Descrição: </label>
                                        <input readonly autocomplete="false" required name="" type="text" class="form-control descricao" id="descricao" value=""></input>

                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Data inicio: </label>
                                        <input required autocomplete="false" name="" type="text" class="form-control  dtaini" id="dtaini" value=""></input>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Data fim: </label>
                                        <input required autocomplete="false" name="" type="text" class="form-control dtafin" id="dtafin" value=""></input>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label> status: </label>

                                        <select required name="" class="form-control status1 primeiro">
                                            <option value="A">Ativo</option>
                                            <option value="I">Inativo</option>
                                        </select>

                                        <select required name="" class="form-control status1 ultimo">
                                            <option value="A">Inativo</option>
                                            <option value="I">Ativo</option>

                                        </select>


                                        <input name="" type="hidden" class="form-control status" value="" id="status"></input>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label> </label>
                                        <input type="button" value="Salvar" class="btn  btn-rounded buttonpesq pesquisa" id="buttonpesq" style="background-color:#00a550">

                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">


                <section class="section"></section>
                <section style="display: none;" class="section1"></section>

            </div>
        </div>

    </div>

    <script type="text/javascript" src="../base/mdb/js/jquery.min.js"></script>
    <script src="js/editar_promocao.js" type="module"></script>
    <script type="text/javascript" src="../base/mdb/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../base/jquery_ui/jquery/jquery-ui.js"></script>
    <script type="text/javascript" src="../base/datetimepicker/jquery.datetimepicker.full.min.js"></script>
</body>

</html>
<script>
    $('.ultimo').hide();

    

    $('.dtaini,.dtafin').datetimepicker({
        timepicker: false,
        datepicker: true,
        format: 'd/m/Y',
        weeks: true


    });
</script>

<style>
    .buttonpesq {
        /* font-size: 8px !important; */
        font-size: 1rem;
        margin-top: 1.8rem;
        color: white ! important;

    }
</style>