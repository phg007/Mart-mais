<?php
include "../base/conexao_martdb.php";
$codproduto = $_GET['codproduto'];

$sql="select A.DESCCOMPLETA FROM MAP_PRODUTO A
WHERE A.SEQPRODUTO =$codproduto";


$parse=ociparse($oracle,$sql);
oci_execute($parse);


    while (($row= oci_fetch_assoc($parse))!=false) {
        $array_valor = array();
        $array_valor['desc']= $row['DESCCOMPLETA'];
        
        echo json_encode($array_valor);	
        
    }
