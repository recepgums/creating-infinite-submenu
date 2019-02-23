<?php
$baglan=mysqli_connect("localhost","root","","menu_tasarimi");
$adi=$_POST['adi'];
$atasi=$_POST['atasi'];
$menu_id=$_POST['menu_id'];
$link=$_POST['link'];
if($link==null){
    $kategori=1;
}else{$kategori=0;}
$secim=$_POST['secim'];
echo $adi,$atasi.'<br><br>'.$secim.'<br>';
echo "kategori : ".$kategori;
if($secim==1) {
    $ekle = mysqli_query($baglan, "INSERT INTO tablo(menu_id,adi, atasi,kategori_mi,link) VALUES ('$menu_id','$adi','$atasi','$kategori','$link')");
    if ($ekle) {
        echo "Kaydedildi";
    } else   echo "olmadı be güzel kardeşim";
}else{
    $sil=mysqli_query($baglan,"select id from tablo where adi='$adi'");
    $al=mysqli_fetch_array($sil);
    $silinecek_id=$al['id'];
    echo $silinecek_id;
    function sil($silinecek_id,$b){

            $silme_islemi=mysqli_query($b,"delete from tablo where atasi='$silinecek_id'");
           // mysqli_query($b,"delete from tablo where atasi not in (select id from tablo)");
            sil($silinecek_id,$b);
            if ($silme_islemi){echo "silme başarılı"; }else{ echo "silmede hata var"; }
    }
    sil($silinecek_id,$baglan);
}
?>