<?php
include "../base/conexao_martdb.php";
$query="update GE_SEQUENCIA
SET SEQUENCIA = SEQUENCIA + 1
WHERE NOMETABELA = 'MFL_REGRAINCENTIVO'";
$parse1=ociparse($oracle,$query);
oci_execute($parse1);

$sql="select Z.SEQUENCIA
FROM GE_SEQUENCIA Z
WHERE Z.NOMETABELA = 'MFL_REGRAINCENTIVO'";

$parse=ociparse($oracle,$sql);
oci_execute($parse);

while (($row= oci_fetch_assoc($parse))!=false) {
$array_valor = array();
$array_valor['seqregra']= $row['SEQUENCIA'];

    echo json_encode($array_valor);	

}
