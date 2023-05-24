<?php
include "../base/conexao_martdb.php";
$codproduto1 = $_GET['codproduto1'];
$codfam = $_GET['codfam'];

$sql1="select distinct b.seqproduto from map_familia a,map_produto b
where a.seqfamilia = b.seqfamilia
and a.seqfamilia in ($codfam) 
and b.seqproduto = $codproduto1";

$parse1=ociparse($oracle,$sql1);
oci_execute($parse1);

$row1= oci_fetch_assoc($parse1);
	 		
	
if (oci_num_rows($parse1)>=1){

    echo 3;

}if (oci_num_rows($parse1)<1){



$sql="select A.DESCCOMPLETA FROM MAP_PRODUTO A
WHERE A.SEQPRODUTO =$codproduto1";

$parse=ociparse($oracle,$sql);
oci_execute($parse);

$row= oci_fetch_assoc($parse);
	 		
	
if (oci_num_rows($parse)>=1){

    echo 1;

}if (oci_num_rows($parse)<1){

    echo 0;
}    
}
