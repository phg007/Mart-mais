<?php
include "../base/conexao_martdb.php";
//ini_set('display_errors', 0 );
//error_reporting(0);

$descricao = $_GET['descricao'];
$dtainicio = $_GET['dtainicio'];
$dtafinal = $_GET['dtafinal'];
$promocao = $_GET['promocao'];
$cluster = $_GET['cluster'];
$usuario = $_GET['usuario'];

$dtainicio = implode("/", array_reverse(explode("-", $dtainicio)));
$partes1 = explode("/", $dtainicio);
$jd1 = gregoriantojd($partes1[1], $partes1[1], $partes1[1]);
$td1 = jdmonthname($jd1, 0);
$dtainicio = $partes1[0] . $td1 . $partes1[2];

$dtafinal = implode("/", array_reverse(explode("-", $dtafinal)));
$partes = explode("/", $dtafinal);
$jd = gregoriantojd($partes[1], $partes[1], $partes[1]);
$td = jdmonthname($jd, 0);
$dtafinal = $partes[0] . $td . $partes[2];

$checked = $_GET['checked'];
$codfam = $_GET['codfam'];
$codproduto = $_GET['codproduto'];
$valoruni = $_GET['valoruni'];
$acordopfv = $_GET['acordopfv'];

//$valoruni1 = $_GET['valoruni'];
//$valoruni=   str_replace([','],'.', $valoruni1);
$checkedemb = $_GET['checkedemb'];

$sql = "declare

begin
spm_geraregrainicio(VNDESCRICAO => '$descricao',
seqregra => $promocao,
VNDTAINICIO => '$dtainicio',
VNDTAFIM => '$dtafinal',
VNUSUARIO => '$usuario',
vnDTAALT => trunc(sysdate),
PNCONTROLAVERBA => $acordopfv
);
FOR EMPPORT IN (
select A.NROEMPRESA
from max_empresa a
where a.status = 'A'
AND A.RAZAOSOCIAL LIKE '%MART MINAS%'
AND A.NROEMPRESA NOT IN (7)
and a.nroempresa in ($cluster)

)
LOOP

UPDATE mad_regraempresa F SET F.STATUS = 'A'
WHERE F.NROEMPRESA = EMPPORT.NROEMPRESA
and f.seqregra = $promocao;

END LOOP; 
end;";


//echo $sql;
$parse = oci_parse($oracle, $sql);

if (oci_execute($parse)) {
  //echo 'cabeçalho sucesso';


  $checkedarray = explode(",", $checked);
  $codprodutoarray = explode(",", $codproduto);
  $valoruniarray = explode(",", $valoruni);

  $acordopdv = $_GET['acordopdv'];
  $acordopdvarray = explode(",", $acordopdv);

  $checkedembarray = explode(",", $checkedemb);

  $i = 0;
  $idsArray = explode(",", $codfam);

  foreach ($idsArray as $codfam) {

    $i + 1;

    //$query .= "($seqvalidade,$nprecoArray[$i]),";

    $query = "begin
 spm_addprodutosregra(PESEQREGRA     => $promocao,
                       PESEQFAIMLIA   => '$idsArray[$i]',
                       PESEQPRODUTO   => '$codprodutoarray[$i]' ,
                       pvlracordo     =>  '$acordopdvarray[$i]'   , -- variavel da nova coluna tipo number (10,2)
                       PEPARAMETROFAM => '$checkedarray[$i]',
                       PEPARAMETROUNI => '$checkedembarray[$i]',
                       PEVLRPRECO     => ('$valoruniarray[$i]') ); end;";

    $parse = oci_parse($oracle, $query);
    oci_execute($parse);

    $r = oci_commit($oracle);
    // echo  $query;             
    $i++;
  }




  if (!$r) {
    $erro = oci_error($oracle);
    echo 'Promoção itens falha';
  } else {

    $sql = "select distinct a.seqproduto, a.codcritica, A.SEQREGRA
    from mm_criticamartmais a
  where a.statuscritica = 'BLOQUEADO'
  and a.seqregra=$promocao
  and fmm_statuscom(pnNroempresa => a.nroempresa,
  pnSeqproduto => a.seqproduto) = 'A'
  
  ";

    $parse = ociparse($oracle, $sql);
    oci_execute($parse);
    $row = oci_fetch_assoc($parse);

    if (oci_num_rows($parse) >= 1) {

      $critica = 1;
    }
    if (oci_num_rows($parse) < 1) {

      $critica = 0;
    }



?>
    <script>
      $(function() {
        $("#dialog").dialog();
      });
    </script>


    <?php
    //echo $critica;
    if ($critica == 1) { ?>
      <div id="dialog" title="Alerta">
        <img src="img/martinho.png" style="height: 65px" class="brand_logo" alt="Logo">
        <P style="color:green;display: inline">Promoção</P>
        <p style="color: RED;display: inline"><?= " " . $promocao . " " ?></P>
        <p style="display: inline;color:green"> criada com sucesso</p>
        <br>
        <P style="color:red;display: inline; font-weight: bold;">!!!Promoção Possui critica requer liberação</P>

      </div>
    <?php
    }
    if ($critica == 0) { ?>
      <div id="dialog" title="Alerta">
        <img src="img/martinho.png" style="height: 65px" class="brand_logo" alt="Logo">
        <P style="color:green;display: inline">Promoção</P>
        <p style="color: RED;display: inline"><?= " " . $promocao . " " ?></P>
        <p style="display: inline;color:green"> criada com sucesso</p>
      </div>

    <?php
    }
    ?>


  <?php
  }
} else { ?>
  <div id="dialog" title="Alerta">
    <img src="img/martinho.png" style="height: 65px" class="brand_logo" alt="Logo">
    <P style="color:green;display: inline">Sucesso</P>
    <p style="color: RED;display: inline"><?= " " . $promocao . " " ?></P>
    <p style="display: inline;color:green"> criada com sucesso</p>
  </div>

<?php
}
?>