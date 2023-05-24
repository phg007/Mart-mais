<?php
include "../base/conexao_martdb.php";
$codfam = $_GET['codfam'];

$sql="select A.FAMILIA FROM MAP_FAMILIA A
WHERE A.SEQFAMILIA=$codfam";

$parse=ociparse($oracle,$sql);
oci_execute($parse);

while (($row= oci_fetch_assoc($parse))!=false) {
$array_valor = array();
$array_valor['desc']= $row['FAMILIA'];

    echo json_encode($array_valor);	

}
?>