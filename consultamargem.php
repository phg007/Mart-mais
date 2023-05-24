<?php
include "../base/conexao_martdb.php";
//$preco = filter_input(INPUT_GET,'preco',FILTER_SANITIZE_STRING);

//$codprod = filter_input(INPUT_GET,'codprod',FILTER_SANITIZE_STRING);
//$loja=filter_input(INPUT_GET,'loja',FILTER_SANITIZE_STRING);


$preco1= $_GET['preco'];
$preco=   str_replace([','],'.', $preco1);
$codprod= $_GET['codprod'];

$loja= $_GET['loja'];



$sql="select fc5_custoliquido2(pSeqProduto => $codprod, pNroEmpresa => $loja) AS custoliquido,
       fmm_margempre(pnPreco      => '$preco',
                     pnSeqProduto => $codprod,
                     pnNroEmpresa => $loja) AS MARGEM
  FROM DUAL";

$parse=ociparse($oracle,$sql);
oci_execute($parse);

while (($row= oci_fetch_assoc($parse))!=false) {
$array_valor = array();
$array_valor['retcusto']= $row['CUSTOLIQUIDO'];
$array_valor['retmargem']= $row['MARGEM'];

    echo json_encode($array_valor);	

}
