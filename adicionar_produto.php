<?php
include "conexao_mart.php";
session_start(); 
$codpromo = $_GET['codpromo'];
?>

<head>
  <title>Gerar promoção Embalagem</title>

  
</head>    
<!-- MODAL-->

<div class="modal" id="centralModalDanger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" >
    <div class="modal-fluid" role="document">
    <!--Content-->
        <div class="modal-content modal1" style="background-color: transparent;">
        <!--Header-->
            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <div class="card">
                    <!-- Tabela -->
                        <div class="card-body">
                            <div id="table" class="table-editable">
                            <input  type="hidden" class="seqregraaa" value="<?=$codpromo?>">

                            <p class="p"></p>
                          
                                <div class="overflow-auto" style="height: 350px;">
                                <span class="table-add float-right mb-3 mr-2"><a href="#!" style="color: #00a550;"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>             
      <table class=" table table-bordered table-responsive table-striped text-center">
        <thead>
          <tr class="trr">
        
            <th class="text-center">Codigo Produto</th>
            <th class="text-center">Embalagem</th>
            <th class="text-center">valor uni</th>
            <th class="text-center">DESCRIÇÃO</th>
            <th class="text-center">Remover</th>
          </tr>
        </thead>
        <tbody class="tbody">
          <tr class="trr">
       
            <td class="pt-3-half seqprod" contenteditable="false"><input  autocomplete="false" name="codproduto" type="number"  class="form-control codproduto " value=""></td>
            <td class="pt-3-half secemb" id="secemb" contenteditable="false"><input  autocomplete="false"  type="number"  class="form-control ttt "  value=""></td>
            <td class="pt-3-half" contenteditable="false"><input   autocomplete="false" name="valoruni" type="number"  class="form-control valoruni " value=""></td>
            <td class="pt-3-half" contenteditable="false"><input  readonly autocomplete="false" name="desc" type="text"  class="form-control desc " value=""></td>
            <td>
            <a href="#!" style="font-size:15px; color:red" class="table-remove"><i class="far fa-trash-alt"></i></a></td>
          </tr>
        
        
        </tbody>


      </table>
         </div>
         <p class="texto" style="color: red;font-weight:bolder"></p>
      <div class="col-12 text-center">
      <input  type="button"  value="adicionar" class="btn  btn-rounded add" id="pesqger" style="background-color:#00a550;color:white;margin-top:5px;">                  
      <button  type="button" class="btn btn-danger" id="fecha" data-dismiss="modal">Fechar</button>

      </div>
                                    
                                 </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .totalgeral{
                    border: 2px solid black ! important;
                    color:black;
                    font-weight: bold;
                }
            </style>
           
        </div>
    </div>
    
</div>

 <script src="js/adicionar_produto.js" type="module"></script>
<script type="text/javascript" src="jquery_ui/jquery/jquery-ui.js"></script> 
<script>
            var $tableID = $('#table');
            var $BTN = $('#export-btn');
            var $EXPORT = $('#export');

            var newTr = `
<tr class="hide trr">
  <td class="pt-3-half" contenteditable="false"><input  type="checkbox" class="form-control checkedemb" name="checkedemb" value="" style="max-height: 15px;"> </td>
  <td class="pt-3-half secemb" id="secemb" contenteditable="false"><input  autocomplete="false"  type="number"  class="form-control  "  value=""></td>                            <td class="pt-3-half " contenteditable="false"><input readonly autocomplete="false" name="codfamilia" type="number"  class="form-control codfam " value=""></td>
  <td class="pt-3-half" contenteditable="false"><input  autocomplete="false" name="codproduto" type="number"  class="form-control codproduto " value=""></td>
  <td class="pt-3-half" contenteditable="false"><input   autocomplete="false" name="valoruni" type="number"  class="form-control valoruni " value=""></td>
  <td class="pt-3-half" contenteditable="false"><input readonly  autocomplete="false" name="desc" type="text"  class="form-control desc " value=""></td>
  <td>
   <a href="#!" style="font-size:15px; color:red" class="table-remove"><i class="far fa-trash-alt"></i></a></td>
  </tr>`;

 $('.table-add').on('click', 'i', () => {

   const $clone = $tableID.find('.tbody .trr').last().clone(true).removeClass('hide table-line');

   if ($tableID.find('.tbody .trr').length === 0) {

     $('.tbody').append(newTr);
   }

   $tableID.find('table').append($clone);
 });


 $tableID.on('click', '.checked', function () {

   //$(this).parents('tr').detach();
   var checked = $(this).closest('.checked').is(':checked');



    if(checked==true){

        $(this).parent().parent().find(".codfam").closest(".codfam").removeAttr('readonly');
        $(this).parent().parent().find(".codproduto").closest(".codproduto").attr('readonly', 'readonly');
        $(this).parent().parent().find(".codproduto").closest(".codproduto").val('');
        $(this).parent().parent().find(".desc").closest(".desc").val('');

    }else if(checked==false){
       
        $(this).parent().parent().find(".codfam").closest(".codfam").attr('readonly', 'readonly');
        $(this).parent().parent().find(".codproduto").closest(".codproduto").removeAttr('readonly');
        $(this).parent().parent().find(".codfam").closest(".codfam").val('');
        $(this).parent().parent().find(".desc").closest(".desc").val('');
    }

   
 });

 $tableID.on('click', '.table-remove', function () {

$(this).parents('tr').detach();
});
 
 $tableID.on('click', '.table-up', function () {

   const $row = $(this).parents('tr');

   if ($row.index() === 0) {
     return;
   }

   $row.prev().before($row.get(0));
 });

 $tableID.on('click', '.table-down', function () {

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
   $($rows.shift()).find('th:not(:empty)').each(function () {

     headers.push($(this).text().toLowerCase());
   });

   // Turn all existing rows into a loopable array
   $rows.each(function () {
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

 
 $('#table').on('change','.codproduto',function(t){
    //alert('teste');
    var codproduto=$(this).parent().parent().find(".codproduto").closest(".codproduto").val();
    var codproduto1=$(this).parent().parent().find(".codproduto").closest(".codproduto").val();
    var codproduto2=$(this).parent().parent().find(".codproduto").closest(".codproduto");
    var desc = $(this).parent().parent().find(".desc").closest(".desc");
    var desc1 = $(this).parent().parent().find(".desc").closest(".desc");
    var teste = $(this); 
    var codfam = $('.codfam').toArray().map(function(codfam) { 
    return $(codfam).val().replace('','0'); 
    });
    $('.texto').empty().html('');

    $.ajax({
        url:"embalagem.php",
        method:'get',
        data:'codproduto='+codproduto,
        success: function(embalagem){
            
        //   $('.secemb').html(embalagem);
        teste.parent().parent().find(".secemb").closest(".secemb").html(embalagem);
       //alert(teste)
       //  $('.codproduto').parent().parent().find(".codproduto").closest(".codproduto").html('1');
        }
        
    }); 
    
    $.ajax({
        url: "verificar_prod_aditar_promo.php",
        method:'get',
        data:'codproduto1='+codproduto1,
        success: function(verificar) {
        // $('#msg5').empty().html(msg);
        
            if(verificar==0){
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
            
        }if(verificar==3){
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

        }
        
        else if(verificar==1){
        $.getJSON('pesquisar_produto.php', {codproduto})
        .done(function(retorno){
    
        //console.log(retorno);

        desc.val(retorno.desc);

    }); 
    }  //FECHA O ELSE IF      
        }// SUCCESS DO AJAX
        }); // FECHA AJAX

});

$('.add').on('click',function(){
    var seqregraaa = $('.seqregraaa').val();
    var codproduto = $(".codproduto").parent().parent().find(".codproduto").closest(".codproduto").toArray().map(function(codproduto) { 
    return $(codproduto).val();
    });

    var valoruni = $(".valoruni").parent().parent().find(".valoruni").closest(".valoruni").toArray().map(function(valoruni) { 
    return $(valoruni).val();
    });
   
    var embselec = $(".embselec").parent().parent().find(".embselec").closest(".embselec").toArray().map(function(embselec) { 
    return $(embselec).val();
    });

    $.ajax({
        url: "verificar_produto_add.php",
    method:'get',
    data:'codproduto='+codproduto
    +'&embselec='+embselec+'&seqregra='+seqregraaa,
    success: function(verificar_produto_add) {

        if(verificar_produto_add==1){
          
            $('.texto').empty().html('Produto com a qtd embalagem duplicada');

        }else if(verificar_produto_add==0){


    $.ajax({
        url: "add_prod_banco.php",
    method:'get',
    data:'codproduto='+codproduto+'&valoruni='+valoruni
    +'&embselec='+embselec+'&seqregra='+seqregraaa,
    success: function(add_prod_banco) {
    
        $('.modal-backdrop').remove(); 

        $.ajax({
        url: "editar_produto_emp.php",
    method:'get',
    data:'codpromo='+seqregraaa,
    success: function(editar_produto_emp) {
    $('.section').empty().html(editar_produto_emp);
    $('.section1').empty().html(add_prod_banco);
    }
            
    });

   
    }
            
    });


}
}
});
});

</script>
 <style>
    .inp{
        max-width: 50px;
    
    }
    .p1
    {
      color:red;
       display: inline;
       background-color: #CAE1FF; 
       padding: 10px;
       border-radius: 10%;
    }
    </style>


<style>
th{

position: sticky;

top: 0;
background-color: white;
font-weight: bold;

}
</style>
