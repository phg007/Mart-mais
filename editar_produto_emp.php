<?php
include "../base/Conexao_martdb.php";
$codpromo = $_GET['codpromo'];


?>
<html>
    <head>
     
    </head>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link ProdPDV" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Produto PDV
                </button>
                <button class="btn btn-link collapsed empresa" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Empresa
                <button   type="button" class="promo btn"style="background-color:#00a550;color:white">Add Produto</button>
            </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                   
                    <table class="table table-bordered  table-striped text-center  table_man_dados" id="table_man_dados" >
                        <thead>
                            <tr> 
                                <th class="text-center">SEQPRODUTO</th>
                                <th class="text-center">DESCCOMPLETA</th>
                                <th class="text-center">QTDEMBALAGEM</th>  
                                <th class="text-center">PRECOINCENTIVOEMB</th> 
                                <th class="text-center">STATUS</th>
                                <th class="text-center">EXCLUIR</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query="select A.SEQPRODUTO, B.DESCCOMPLETA, A.QTDEMBALAGEM, A.PRECOINCENTIVOEMB,A.STATUS
                            FROM MFL_REGRAPRODUTOPDV A, MAP_PRODUTO B
                           WHERE A.SEQPRODUTO = B.SEQPRODUTO
                             AND A.SEQREGRA = $codpromo
                            
                        ";
                            $parse=ociparse($oracle,$query);
                            oci_execute($parse);
                            while (($row= oci_fetch_assoc($parse))!=false) {  
                                
                        ?>
                            <tr class="trteste tr">
                               
                                <td  class="SEQPRODUTO"><?=$row['SEQPRODUTO']?></td>
                                <td  class="CODCRITICA"><?=$row['DESCCOMPLETA']?></td>
                                <td class="QTDEMBALAGEM"><?=$row['QTDEMBALAGEM']?></td>
                                <td contenteditable="true" class="PRECOINCENTIVOEMB"><?=number_format($row['PRECOINCENTIVOEMB'], 2, '.', ' ')?></td>
                                <td class="STATUS"><?=$row['STATUS']?></td>
                                <td>
                                <a href="#!" style="font-size:15px; color:red" class="EXCLUIR"><i class="far fa-trash-alt"></i></a></td>
                            </tr>  
                            <?php  
                                }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <!-- CARD 2===================-->
        <div class="card" style="margin-top: -20px;">
            
            <div id="collapseTwo" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">

            <table class="table table-bordered  table-striped text-center  table_man_dados" id="table_man_dados" >
                        <thead>
                            <tr> 
                                <th class="text-center">selecionar <br>
                                    <input type="checkbox" class="atrrcheck" value="">
                                </th>
                                <th class="text-center">SEQREGRA</th>
                                <th class="text-center">NROEMPRESA</th>
                                <th class="text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query="select A.SEQREGRA,
                            A.NROEMPRESA,
                            A.STATUS,
                            DECODE(A.STATUS,
                            'A',
                            'A') AS STATUSS
                             FROM MAD_REGRAEMPRESA A
                            WHERE A.SEQREGRA = $codpromo 
                            ";
                            $parse=ociparse($oracle,$query);
                            oci_execute($parse);
                            while (($row= oci_fetch_assoc($parse))!=false) {
                                
                            ?>
                            <tr class="trteste tr">
                            <?php

                                if($row['STATUS']=='A'){?>
                                 <td class="text-center">
                                    <input  type="checkbox" checked class="checkbox1" name="checkbox" id="checkbox1" value=""> 
                                </td> 
                                <?php   
                                }if($row['STATUS']=='I'){?>
                                     <td class="text-center">
                                    <input  type="checkbox" class="checkbox1" name="checkbox" id="checkbox1" value=""> 
                                </td> 
                                
                                <?php
                                }
                                ?>
                               
                                <td  class="SEQPRODUTO"><?=$row['SEQREGRA']?></td>
                                <td  class="NROEMPRESA"><?=$row['NROEMPRESA']?></td>
                                <td class="SEQREGRA"><?=$row['STATUS']?></td>
                            </tr>  
                            <?php  
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <section class="bodyy1"></section>
</html>

<style>    

    th{
        font-size: 12px ! important;

    }
    td{

        padding: 0.2rem ! important;
        font-size: 10px ! important;
        color: black ! important;
        font-weight: bold  ! important;
     
        }
    .inp{
        max-width: 55px;

    }
        /**Cor quando selecionado**/
    .table1 tr.selecionado td{
    background-color: #aff7ff;
    }
    .pesquisar{
        border-radius: 50% ! important;
        margin-left: 20px ! important;
        padding:5px;
        padding-left: 10px;
        padding-right: 10px;
        background-color: #00a550;
        float: right;
        color: white ! important;
        margin-top: 19px;
        font-size: 20px !important ;
    }  
    .select1{
                                    
    margin-right: 62px ! important;
    }.pesquisa{
        display: inline ! important;
    }
    .no-close .ui-dialog-titlebar-close {
    display: none ! important;
    }
    #table_man_dados tr.selecionado td{
    background-color: #aff7ff;
    }
    .teste{

        font-weight: bolder !important;
        color: #00a550 !important;

    }
</style>

<script>
$('.promo').on('click',function(a){
    var codpromo =$('.codpromo').val();


    $.ajax({
   url: "adicionar_produto.php",
   method:'get',
    data:'codpromo='+codpromo,
   success: function(promocao) {
    
      $('.bodyy1').empty().html(promocao);
      
       $('#centralModalDanger').modal();
   
   }
});
   
});

$('.prodPDV').on('click',function(a){
    
    $('.prodPDV').addClass('teste');
    $('.empresa').removeClass('teste');
});

$('.empresa').on('click',function(a){
    
    $('.prodPDV').removeClass('teste');
    $('.empresa').addClass('teste');
    
});
$('.EXCLUIR').on('click',function(a){

    var QTDEMBALAGEM = $(this).parent().parent().find(".QTDEMBALAGEM").closest(".QTDEMBALAGEM").text();
     
    var SEQPRODUTO = $(this).parent().parent().find(".SEQPRODUTO").closest(".SEQPRODUTO").text();

    var codpromo =$('.codpromo').val();

    $.ajax({
   url: "excluir_prod.php",
   method:'get',
    data:'QTDEMBALAGEM='+QTDEMBALAGEM+'&SEQPRODUTO='+SEQPRODUTO+'&codpromo='+codpromo,
   success: function(promocao) {
    
       

        $.ajax({
        url: "editar_produto_emp.php",
    method:'get',
    data:'codpromo='+codpromo,
    success: function(editar_produto_emp) {
    $('.section').empty().html(editar_produto_emp);
    $('.bodyy1').empty().html(promocao);
    }
            
    })
   
   }
});


});
</script>