<?php
include "../base/conexao_martdb.php";
$codpromo = $_GET['codpromo'];

$sql = "select a.descricao, seqregra, to_char(a.dtainicio,'dd/mm/yyyy') dtainicio, 
to_char(a.dtafim,'dd/mm/yyyy') dtafim, a.status
FROM MFL_REGRAINCENTIVO A
WHERE A.SEQREGRA = $codpromo";

$parse = ociparse($oracle, $sql);
oci_execute($parse);

while (($row = oci_fetch_assoc($parse)) != false) {
    $array_valor = array();
    $array_valor['DESCRICAO'] = $row['DESCRICAO'];
    $array_valor['DTAINICIO'] = $row['DTAINICIO'];
    $array_valor['DTAFIM'] = $row['DTAFIM'];
    $array_valor['STATUS'] = $row['STATUS'];

    echo json_encode($array_valor);
}
