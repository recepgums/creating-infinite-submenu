<?php
include "baglanti.php";
$menu_id=$_POST['menu'];
$id=$_POST['gelen'];
$sirasi=$_POST['sirasi'];
$atasi=$_POST["atasi"];
echo $atasi."-".$id."-".$sirasi."-".$menu_id;
/*
$sorgu=mysqli_query($baglan,"update tablo set atasi=$atasi where menu_id=$menu_id and id=$id");
$sorgu1=mysqli_query($baglan,"update tablo set sirasi=$sirasi where menu_id=$menu_id and id=$id");
/*$sorgu2=mysqli_query($baglan,"update tablo set sirasi=$sirasi where menuid=$menu_id and id=$id");*/

if ($sorgu)echo "güncellendi";else echo "olmadı güzel karşim";
?>