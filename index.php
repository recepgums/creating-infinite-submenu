<?php
$baglan=mysqli_connect("localhost","root","","menu_tasarimi");

function yazdir($id=1,$b){
    $sorgu_menu=mysqli_query($b,"select * from menuler order by adi asc");
    $isim="a";
     while ($row =mysqli_fetch_array($sorgu_menu)){
         echo "<span>".$row['id']."-)".$row['adi']."</span>";
         $isim=$row['id']."b";
         oku($id,$b,$row['id'],$isim);
         echo "<br><hr>";
     }
}
function oku($id=0,$b,$menu_id=1,$isim)
{
    $sorgu = mysqli_query($b, "select * from tablo where atasi=$id and menu_id='$menu_id' order by sirasi asc");
    if (mysqli_num_rows($sorgu) > 0){?>
          <ul>
                    <?php while ($row = mysqli_fetch_array($sorgu)) { ?>
            <li><?php
                //id
                echo "<b>".$row['id']."</b> ";

                if ($row['kategori_mi']==0){
                    $kategori_mi_radio="checked";
                    $link_mi="";
                    echo '<a href="'.$row['link'].'">'.$row['adi'].'</a>';
                }else{
                    $link_mi="checked";
                    $kategori_mi_radio="";
                    echo  $row['adi'];
                   echo '<script>$("#baglanti").css("display","none");</script>';
                }?><?php
                echo ' =>  Atasi : <input name="'.$isim.'" id="atasi" type="text" style="width:20px"; value="'.$row['atasi'].'">';//Atası
                echo '   Sirasi : <input id="sirasi"  type="text" style="width:20px";  value="'.$row['sirasi'].'">';//sirasi
                echo ' Kategori mi : Evet <input type="radio" name="'.$isim.'" '.$kategori_mi_radio.'>';
                echo 'Hayır <input type="radio" name="'.$isim.'" '.$link_mi.'>';
                echo '<span id="baglanti" style="display:block;"> Link : <a href="'.$row['link'].'">'.$row['link'].'</a></span>';
                $isim=$isim.$row['id'];
                echo '<button onclick="guncelle('.$row['menu_id'].','.$row['id'].','.$row['atasi'].','.$row['sirasi'].')">Güncelle</button>';
                    ?> <?php  oku($row['id'],$b,$menu_id,$isim);?> </li>
        <?php } ?>
              <script>

                  function guncelle(menu_id,id,atasii,sirasii) {
                      $.ajax({
                          url: "guncelle.php",
                          type: "post",
                          data: {gelen:id,menu:menu_id,atasi:atasii, sirasi: sirasii},
                          success: function (result) {
                              $("#goster").html(result);
                          }
                      })
                  }
              </script>
          </ul>
             <?php }
            }
        ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<?php
yazdir(0,$baglan);
?>
Ana menü ekle <br><br>Silmek için adını veya idsinden birini yazmak yeterli <br> <br>
Adı
<input type="text" id="metin"><br> <br> Atası
<input type="text" id="ikinci_txt"><br>
Menu id <input type="text" id="menu_txt"><br>
Link <input type="text" placeholder="link yoksa boş bırakın...  " id="link_txt"><br>
<button onclick='ajax("ekle")'>Ekle</button> <button onclick='ajax("sil")'>Sil</button>
<div id="goster"></div>
<script>
    function  ajax(secim) {
        if (secim=="ekle") {
            $.ajax({
                url: "ajax_islemi.php",
                type: "post",
                data: {adi: $("#metin").val(), atasi: $("#ikinci_txt").val(),secim:1,menu_id:$("#menu_txt").val(),link:$("#link_txt").val()},
                success: function (result) {
                    $("#goster").html(result);
                }
            })
        }
        else{
            $.ajax({
                url: "ajax_islemi.php",
                type: "post",
                data: {adi: $("#metin").val(), atasi: $("#ikinci_txt").val(),secim:0},
                success: function (result) {
                    $("#goster").html(result);
                }
            })
        }
    }
</script>
</body>
</html>