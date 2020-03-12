<?php
include "Ra_Vao.php";
$vao_sang = "07:55";
$ra_sang = "11:55";
$vao_chieu = "13:04";
$ra_chieu= "16:55";
$chamcong = new Ra_Vao();
echo $chamcong->checkRaChieu($ra_chieu);
?>