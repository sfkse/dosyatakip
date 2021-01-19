<?php

require_once "connectdb.php";
ini_set('session.cookie_httponly', 1);
session_start();
ob_start();

class crud
{


  private $db;
  private $dbname = DBNAME;
  private $dbhost = DBHOST;
  private $dbuser = DBUSER;
  private $dbpassword = DBPASS;



  function __construct()
  {
    try {
      header('Content-type: text/html; charset=utf-8');

      $this->db = new PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname . ";charset=utf8", $this->dbuser, $this->dbpassword);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  /*==== User işlemleri =====*/


  function userlogin($mail, $password)
  {



    $query = $this->db->prepare("SELECT * FROM user where user_mail=? and user_password=? and user_status=?");
    $query->execute([$mail, sha1(md5(sha1($password))), 1]);

    $getuser = $query->fetch(PDO::FETCH_ASSOC);
    if ($getuser) {

      session_regenerate_id(true);
      $_SESSION["user"] = [
        "user_mail" => $mail,
        "user_name" => $getuser["user_name"],
        "user_role" => $getuser["user_role"],
        "user_id" => $getuser["user_id"],
        "user_status" => $getuser["user_status"]
      ];


      /*COOKIE İŞLEMLERİ YAPILACAK -BENİ HATRILA-*/

      /* if ($remember) {

        setcookie("remember",)
      }*/
      header("Location:../index?login=success");
      exit();
    } else {
      header("Location:../login?login=no");
      exit();
    }
  }



  /*===Genel insert metodu===*/

  function formatquery($values)
  {

    $deger = implode(",", array_map(function ($args) {

      return $son = $args . "=?";
    }, array_keys($values)));
    return $deger;
  }


  function usercreate($table, $values)
  {



    unset($values["user_password_1"], $values["usercreate"]);
    $values["user_password"] = sha1(md5(sha1(htmlspecialchars($values["user_password"]))));

    $values["user_name"] = htmlspecialchars(strip_tags($values["user_name"]));
    $values["user_mail"] = htmlspecialchars(strip_tags($values["user_mail"]));





    $query = $this->db->prepare("SELECT * FROM user where user_mail=? ");
    $query->execute([$values["user_mail"]]);
    $row = $query->rowCount();

    if ($row) {

      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:$url?user=same");
      exit();
    } else {

      $query = $this->db->prepare("INSERT INTO $table SET {$this->formatquery($values)}");

      $query->execute(array_values($values));
      $count = $query->rowCount();

      if ($count) {

        $id = $this->db->lastInsertId();


        $url = htmlspecialchars($_SERVER['PHP_SELF']);
        header("Location:..$url?register=ok&id=$id");
      } else {

        $url = htmlspecialchars($_SERVER['PHP_SELF']);
        header("Location:..$url?register=no");
      }
    }
  }
  function delete($table, $id, $dosya_id = null)
  {


    $col_name = $table . "_id";

    $query = $this->db->prepare("DELETE FROM $table where $col_name=$id ");
    $query->execute();

    $count = $query->rowCount();

    if ($count) {


      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?del=ok&id=$dosya_id");
    } else {

      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?del=no");
    }
  }

  function deletedetails($table, $id)
  {



    $del = array_map(function ($table, $id) {

      $query = $this->db->prepare("DELETE FROM $table where dosya_id=$id ");
      $query->execute();

      return $query;
    }, array_values($table), array_values($id));



    if ($del) {


      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?del=ok&id=$id");
    } else {

      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?del=no");
    }
  }

  /*=== Kullanıcı güncellerken bölge tablosunu burası günceller ===*/
  /*
function bolge($table,$values=[]){


  /*sürekli şehir eklemesini önkemek için hepsini silip sonra günceller*/

  /*
  $query = $this->db->prepare("DELETE FROM bolge where user_id=? ");
  $query->execute([$values[1]]);


  foreach ($values[0] as $key => $value) {

   $query = $this->db->prepare("SELECT iller_ad FROM iller where iller_id=? ");
   $query->execute([$value]);
   $iller_ad=$query->fetch(PDO::FETCH_ASSOC);


   $query=$this->db->prepare("INSERT INTO $table SET

    iller_id=:iller_id,
    iller_ad=:iller_ad,
    user_id=:user_id
    ");

   $query->execute(array(

    'iller_id'=>$value,
    'iller_ad'=>$iller_ad["iller_ad"],
    'user_id'=>$values[1]

  )); 
 }

 $count=$query->rowCount();


 if ($count) {

  $id=$this->db->lastInsertId();



  header("Location:../usercreate?register=ok&id=$id");

}else{

  header("Location:../usercreate?register=no");

}

}


function bolgelistele($table,$user_id){


  $get=$this->db->prepare("SELECT * FROM $table where user_id=?");
  $get->execute([$user_id]);
  $get->rowCount();

  return $get;


}*/


  function userupdate($table, $values, $id)
  {

    $id = $values["user_id"];


    if ($values["user_password"]) {

      if ($values["user_password"] != $values["user_password_1"] || $values["user_password"] == "" || $values["user_password_1"] == "") {



        $url = htmlspecialchars($_SERVER['PHP_SELF']);
        header("Location:..$url?pass=same&id=$id");
        exit();
      } else {

        unset($values["user_password_1"], $values["updateuser"], $values["user_id"]);

        $values["user_password"] = sha1(md5(sha1($values["user_password"])));


        $query = $this->db->prepare("UPDATE $table SET {$this->formatquery($values)} where user_id=$id");
        $query->execute(array_values($values));

        $count = $query->rowCount();


        if ($count) {

          $url = htmlspecialchars($_SERVER['PHP_SELF']);
          header("Location:..$url?update=ok&pass=ok&id=$id");
          exit();
        } else {

          $url = htmlspecialchars($_SERVER['PHP_SELF']);
          header("Location:..$url?update=no&id=$id");
          exit();
        }
      }
    } else {

      unset($values["user_password"], $values["user_password_1"], $values["updateuser"], $values["user_id"], $values["iller"]);

      $col_name = $table . "_id";


      $query = $this->db->prepare("UPDATE $table SET {$this->formatquery($values)} where user_id=$id");
      $query->execute(array_values($values));

      $query->rowCount();



      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?update=ok&pass=no&id=$id");
      exit();
    }
  }



  /*===Kaydın son halini göster===*/
  function registerlist($table, $id, $cols = "*")
  {


    $col_name = $table . "_id";

    $get = $this->db->prepare("SELECT $cols FROM $table where $col_name=?");
    $get->execute([$id]);

    return $get;
  }



  /*===Kayıtarı listeler===*/
  function tablelist($table, $cols = ["*"], $options = [])
  {

    // echo $table;
    // print_r($cols);
    // print_r($options);
    // echo $extra;
    // exit();
    $deger = implode(",", array_map(function ($args) {

      return $son = $args;
    }, array_values($cols)));


    $detail = implode(" and ", array_map(function ($args) {

      return $son = $args . "=?";
    }, array_keys($options)));



    $son = "where " . $detail;


    if ($options != null) {




      $query = $this->db->prepare("SELECT $deger FROM $table $son");
      $query->execute(array_values($options));


      return $query;
    } else {



      $query = $this->db->prepare("SELECT $deger FROM $table ");
      $query->execute();



      return $query;
    }
  }




  /*===== Dosya İşlemleri =====*/

  function dosyaekle($table, $values)
  {
    // print_r($values);
    // exit();
    /* dosya detay bilgilerini farklı tablolara yazdıracağız. ilgili bilgileri ayıklıyoruz */



    $dosyadetay = [$values["gelisme_detay"], $values["adlitip_detay"], $values["ceza_detay"], $values["manevi_detay"], $values["hatirlattahkim_detay"], $values["hatirlatitiraz_detay"], $values["hatirlattemyiz_detay"], $values["hatirlaticra_detay"]];


    $eksikevrak_id = serialize($values["evrak_id"]);





    $tahsilat_tarih = $values["tahsilatlar_tarih"];
    $tahsilat_tip = $values["tahsilatlar_tip"];
    $tahsilat_tutar = $values["tahsilatlar_tutar"];
    $tahsilat = $values["tahsilatlar_detay"];




    $hatirlatmadetay = [$values["hatirlatdiger_detay"], $values["hatirlatadli_detay"]];
    $tarih = [$values["hatirlatdiger_tarih"], $values["hatirlatadli_tarih"]];


    unset($values["dosyaekle"], $values["gelisme_detay"], $values["adlitip_detay"], $values["ceza_detay"], $values["manevi_detay"], $values["evrak_id"], $values["tahsilatlar_tarih"], $values["tahsilatlar_tip"], $values["tahsilatlar_tutar"], $values["tahsilatlar_detay"], $values["tahsilatlar_detay"], $values["hatirlattahkim_detay"], $values["hatirlatitiraz_detay"], $values["hatirlattemyiz_detay"], $values["hatirlaticra_detay"], $values["hatirlatadli_detay"], $values["hatirlatdiger_detay"], $values["hatirlatdiger_tarih"], $values["hatirlatadli_tarih"]);



    $query = $this->db->prepare("INSERT INTO $table SET {$this->formatquery($values)}");

    $query->execute(array_values($values));
    $count = $query->rowCount();


    if ($count) {

      $id = $this->db->lastInsertId();


      /* detay detaylarını başka tabloya aktarıyoruz */


      $id_son = [$id, $id, $id, $id, $id, $id, $id, $id];
      $detay_table = ["gelisme", "adlitip", "ceza", "manevi", "hatirlattahkim", "hatirlatitiraz", "hatirlattemyiz", "hatirlaticra"];


      $hatirlatmatablo = ["hatirlatdiger", "hatirlatadli"];

      $hatirlatmazaman = ["hatirlatdiger_tarih" => $tarih[0], "hatirlatadli_tarih" => $tarih[1]];

      $hatirlatma_id = [$id, $id];
      $user_id = $_SESSION["user"]["user_id"];

      if ($dosyadetay != null) {

        $muvekkil = [$values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"]];

        $user = [$user_id, $user_id, $user_id, $user_id, $user_id, $user_id, $user_id, $user_id];

        $this->dosyadetayekle($detay_table, $dosyadetay, $id_son, $user, $muvekkil);
      }

      /*eksik evrak bölümünü burada ekleyeeğiz*/

      if ($eksikevrak_id != "N;") {

        $this->eksikevrakekle($eksikevrak_id, $id, $user_id);
      }


      /*tahsilatlar bölümünü burada ekleyeceğiz*/
      if ($tahsilat != null) {

        $this->tahsilatekle($tahsilat, $tahsilat_tarih, $tahsilat_tip, $tahsilat_tutar, $id, $user_id);
      }


      /*hatırlatmalar adli ve diğer bölümünü burada ekleyeceğiz*/


      if (count($hatirlatmadetay) != 0) {

        $muvekkil = [$values["dosya_muvekkil"], $values["dosya_muvekkil"]];

        $user = [$user_id, $user_id];

        $this->hatirlatdigerekle($hatirlatmatablo, $hatirlatmadetay, $hatirlatma_id, $hatirlatmazaman, $user, $muvekkil);
      }

      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?register=ok&id=$id");
      exit;
    } else {
      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?register=no");

      exit;
    }
  }



  function dosyadetayekle($table, $values, $dosya_id, $user, $muvekkil)
  {


    /*boş gelen değerleri ayıklıyoruz*/

    foreach ($values as $key => $val) {

      if ($val != "") {

        $tableson[] = $table[$key];
        $valueson[] = $values[$key];
      }
    }





    $detay = array_map(function ($args) {


      $detay_son = $args . "_detay";

      return $detay_son;
    }, array_values($tableson));



    $sonuc = array_map(function ($table, $cols, $values, $id, $user, $muvekkil) {



      $query = $this->db->prepare("INSERT INTO $table SET 


      $cols=:$cols,
      dosya_id=:dosya_id,
      user_id=:user_id,
      dosya_muvekkil=:dosya_muvekkil
      ");

      $query->execute(array(

        "$cols" => $values,
        'dosya_id' => $id,
        'user_id' => $user,
        'dosya_muvekkil' => $muvekkil

      ));

      return  $query;
    }, array_values($tableson), array_values($detay), array_values($valueson), array_values($dosya_id), array_values($user), array_values($muvekkil));
  }

  function dosyadetayguncelle($table, $id, $description)
  {


    $detay = $table . "_detay";
    $table_id = $table . "_id";

    $query = $this->db->prepare("UPDATE $table SET $detay=:$detay where $table_id=$id");
    $query->execute(array(

      "$detay" => $description

    ));
    return $query;
  }


  function eksikevrakguncelle($evrak_id, $eksikevrak_id)
  {

    $query = $this->db->prepare("UPDATE eksikevrak SET evrak_id=:evrak_id where eksikevrak_id=$eksikevrak_id");
    $query->execute(array(

      "evrak_id" => $evrak_id

    ));
    return $query;
  }

  function eksikevrakekle($evrak_id, $dosya_id, $user_id)
  {




    $query = $this->db->prepare("INSERT INTO eksikevrak SET 


    evrak_id=:evrak_id,
    dosya_id=:dosya_id,
    user_id=:user_id

    ");

    $query->execute(array(

      "evrak_id" => $evrak_id,
      'dosya_id' => $dosya_id,
      'user_id' => $user_id

    ));
    $count = $query->rowCount();




    if ($count) {

      return $query;
    } else {
      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?eksikevrak=basarisiz");
      exit();
    }
  }
  function tahsilatekle($values, $tarih, $tip, $tutar, $dosya_id, $user_id)
  {

    if ($values != null) {
      $query = $this->db->prepare("INSERT INTO tahsilatlar SET 


      tahsilatlar_tip=:tahsilatlar_tip,
      tahsilatlar_tutar=:tahsilatlar_tutar,
      tahsilatlar_tarih=:tahsilatlar_tarih,
      tahsilatlar_detay=:tahsilatlar_detay,
      dosya_id=:dosya_id,
      user_id=:user_id

      ");

      $query->execute(array(

        "tahsilatlar_tip" => $tip,
        "tahsilatlar_tutar" => $tutar,
        "tahsilatlar_tarih" => $tarih,
        "tahsilatlar_detay" => $values,
        'dosya_id' => $dosya_id,
        'user_id' => $user_id

      ));
      $count = $query->rowCount();

      if ($count) {

        return $query;
      } else {
        $url = htmlspecialchars($_SERVER['PHP_SELF']);
        header("Location:..$url?tahsilatlar=basarisiz");
        exit();
      }
    }
  }

  function hatirlatdigerekle($table, $values, $dosya_id, $tarih, $user, $muvekkil)
  {



    /*boş gelen değerleri ayıklıyoruz*/

    foreach ($values as $key => $val) {

      $tarihad = array_keys($tarih);
      $tarihdeger = array_values($tarih);

      if ($val != "") {

        $tableson[] = $table[$key];
        $valueson[] = $values[$key];
        $tarihsonad[] = $tarihad[$key];
        $tarihsondeger[] = $tarihdeger[$key];;
      }
    }

    $detay = array_map(function ($args) {

      $detay_son = $args . "_detay";

      return $detay_son;
    }, array_values($tableson));



    $sonuc = array_map(function ($table, $cols, $values, $col_time, $zaman, $id, $user, $muvekkil) {


      $query = $this->db->prepare("INSERT INTO $table SET 


      $cols=:$cols,
      $col_time=:$col_time,
      dosya_id=:dosya_id,
      user_id=:user_id,
      dosya_muvekkil=:dosya_muvekkil

      ");

      $query->execute(array(

        "$cols" => $values,
        "$col_time" => $zaman,
        'dosya_id' => $id,
        'user_id' => $user,
        'dosya_muvekkil' => $muvekkil

      ));
      return $query;
    }, array_values($tableson), array_values($detay), array_values($valueson), array_values($tarihsonad), array_values($tarihsondeger), array_values($dosya_id), array_values($user), array_values($muvekkil));

    return $sonuc;
  }


  function dosyaguncelle($table, $values)
  {

    $dosya_id = $values["dosya_id"];


    /* dosya detay bilgilerini farklı tablolara yazdıracağız. ilgili bilgileri ayıklıyoruz */

    $dosyadetay = [$values["gelisme_detay"], $values["adlitip_detay"], $values["ceza_detay"], $values["manevi_detay"], $values["hatirlattahkim_detay"], $values["hatirlatitiraz_detay"], $values["hatirlattemyiz_detay"], $values["hatirlaticra_detay"]];



    $eksikevrak_id = serialize($values["evrak_id"]);

    $eksikevrak_id2 = serialize($values["evrak_id2"]);



    $tahsilat_tarih = $values["tahsilatlar_tarih"];
    $tahsilat_tip = $values["tahsilatlar_tip"];
    $tahsilat_tutar = $values["tahsilatlar_tutar"];
    $tahsilat = $values["tahsilatlar_detay"];




    $hatirlatmadetay = [$values["hatirlatdiger_detay"], $values["hatirlatadli_detay"]];
    $tarih = [$values["hatirlatdiger_tarih"], $values["hatirlatadli_tarih"]];


    unset($values["dosyaguncelle"], $values["gelisme_detay"], $values["adlitip_detay"], $values["ceza_detay"], $values["manevi_detay"], $values["evrak_id"], $values["evrak_id2"], $values["tahsilatlar_tarih"], $values["tahsilatlar_tip"], $values["tahsilatlar_tutar"], $values["tahsilatlar_detay"], $values["tahsilatlar_detay"], $values["hatirlattahkim_detay"], $values["hatirlatitiraz_detay"], $values["hatirlattemyiz_detay"], $values["hatirlaticra_detay"], $values["hatirlatadli_detay"], $values["hatirlatdiger_detay"], $values["hatirlatdiger_tarih"], $values["hatirlatadli_tarih"]);


    $query = $this->db->prepare("UPDATE $table SET {$this->formatquery($values)} where dosya_id=$dosya_id");

    $count = $query->execute(array_values($values));



    if ($count) {

      $user_id = $_SESSION["user"]["user_id"];

      $id_son = [$dosya_id, $dosya_id, $dosya_id, $dosya_id, $dosya_id, $dosya_id, $dosya_id, $dosya_id];



      $detay_table = ["gelisme", "adlitip", "ceza", "manevi", "hatirlattahkim", "hatirlatitiraz", "hatirlattemyiz", "hatirlaticra"];


      /*hatırlatmaları burada ekleyeceğiz*/
      $hatirlatmatablo = ["hatirlatdiger", "hatirlatadli"];

      $hatirlatmazaman = ["hatirlatdiger_tarih" => $tarih[0], "hatirlatadli_tarih" => $tarih[1]];

      $hatirlatma_id = [$dosya_id, $dosya_id];




      if ($dosyadetay != null) {

        $muvekkil = [$values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"], $values["dosya_muvekkil"]];

        $user = [$user_id, $user_id, $user_id, $user_id, $user_id, $user_id, $user_id, $user_id];

        $this->dosyadetayekle($detay_table, $dosyadetay, $id_son, $user, $muvekkil);
      }

      /*eksik evrak bölümünü burada ekleyeeğiz*/



      if ($eksikevrak_id != "N;") {

        $this->eksikevrakekle($eksikevrak_id, $dosya_id, $user_id);
      }

      /*tahsilatlar bölümünü burada ekleyeceğiz*/

      if ($tahsilat != null) {

        $this->tahsilatekle($tahsilat, $tahsilat_tarih, $tahsilat_tip, $tahsilat_tutar, $dosya_id, $user_id);
      }
      /*hatırlatmalar adli ve diğer bölümünü burada ekleyeceğiz*/

      if (count($hatirlatmadetay) != 0) {



        $user = [$user_id, $user_id];

        $muvekkil = [$values["dosya_muvekkil"], $values["dosya_muvekkil"]];

        $this->hatirlatdigerekle($hatirlatmatablo, $hatirlatmadetay, $hatirlatma_id, $hatirlatmazaman, $user, $muvekkil);
      }
      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?update=ok&id=$dosya_id");
      exit;
    } else {
      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:..$url?update=no&id=$dosya_id");

      exit;
    }
  }



  function dosyadetaygoster($table, $id, $cols)
  {

    $zaman = $table . "_zaman";

    $get = $this->db->prepare("SELECT $cols FROM $table where dosya_id=? order by $zaman desc");
    $get->execute([$id]);

    return $get;
  }

  function alert($table, $id, $id_value, $due, $dosya_id = [])
  {
    // print_r($table);
    // print_r($id);
    // print_r($id_value);
    // print_r($dosya_id);
    // exit;
    echo '<form method="post" id="update-form">';
    for ($i = 0; $i < count($table); $i++) {

      $detay = $table[$i] . "_detay";
      $status = $table[$i] . "_status";


      $kategori = ucwords_tr(substr($detay, 8));
      $kategori = strstr($kategori, "_", true);


      if ($dosya_id != null) {

        $deger = implode(",", array_map(function ($args) {

          return $son = $args;
        }, array_values($dosya_id)));


        $get = $this->db->prepare("SELECT * FROM $table[$i] where $id[$i]=? and $status=? and dosya_id IN($deger)");
        $get->execute([$id_value[$i], 0]);
        $count = $get->rowCount();

        if ($count) {


          $getir = $get->fetch(PDO::FETCH_ASSOC);


          $time = date("d-m-Y", $due[$i]);

          if (strlen($getir[$detay]) > 50) {

            $str = ucwords_tr(substr($getir[$detay], 0, 50)) . "...";
          } else {

            $str = ucwords_tr($getir[$detay]);
          }

          if (time() > $due[$i] + 60 * 60 * 24) {
            echo '
          <p>
          <button class="reset-timer" type="button" id="' . $id_value[$i] . '" data-table="' . $table[$i] . '"><i style="color:red" class="fas fa-times"></i> </button>&nbsp;
          <span style="background:#e8eaed">Miat: ' . $time . '</span>
          <a class="hatirlatma-link" href="dosyaduzenle?id=' . $getir["dosya_id"] . '"> ' . $kategori . '--' . ucwords_tr($getir["dosya_muvekkil"]) . '----<span class="hatirlat-detay">' .  $str . '</a> 
          </p>
          ';
          } else {


            echo '
          <p>
          <button class="update-status" type="button" id="' . $id_value[$i] . '" data-table="' . $table[$i] . '"><i style="color:green" class="fas fa-check"></i> </button>&nbsp;
          <span style="background:#e8eaed">Miat: ' . $time . '</span>
          <a href="dosyaduzenle?id=' . $getir["dosya_id"] . '"> ' . $kategori . '--' . ucwords_tr($getir["dosya_muvekkil"]) . '--' .  $str . '</span></a> 
          </p>
          ';
          }
        }
      } else {

        $get = $this->db->prepare("SELECT * FROM $table[$i] where $id[$i]=? and $status=?");
        $get->execute([$id_value[$i], 0]);




        $count = $get->rowCount();

        if ($count) {


          $getir = $get->fetch(PDO::FETCH_ASSOC);

          if (strlen($getir[$detay]) > 50) {

            $str = ucwords_tr(substr($getir[$detay], 0, 50)) . "...";
          } else {

            $str = ucwords_tr($getir[$detay]);
          }




          $time = date("d-m-Y", $due[$i]);

          if (time() > $due[$i] + 60 * 60 * 24) {

            echo '
          <p>
          <button class="reset-timer" type="button" id="' . $id_value[$i] . '" data-table="' . $table[$i] . '"><i style="color:red" class="fas fa-times"></i> </button>&nbsp;
          <span style="background:#e8eaed">Miad: ' . $time . '</span>
          <a class="hatirlatma-link" href="dosyaduzenle?id=' . $getir["dosya_id"] . '"> ' . $kategori . '--' . ucwords_tr($getir["dosya_muvekkil"]) . '--<span class="hatirlat-detay">' . $str . '</span></a> 
          </p>

          ';
          } else {


            echo '
          <p>
          <button class="update-status" type="button" id="' . $id_value[$i] . '" data-table="' . $table[$i] . '"><i style="color:green" class="fas fa-check"></i> </button>&nbsp;
          <span style="background:#e8eaed">Miad: ' . $time . '</span>
          <a href="dosyaduzenle?id=' . $getir["dosya_id"] . '"> ' . $kategori . '--' . ucwords_tr($getir["dosya_muvekkil"]) . '--' . $str . '</a> 
          </p>
          ';
          }
        }
      }
    }
    echo '</form>';
  }

  function updatestatus($table, $id, $dosya_update = null)
  {

    $status = $table . "_status";
    $table_id = $table . "_id";

    if ($dosya_update != null) {

      $date = new DateTime();

      $query = $this->db->prepare("UPDATE dosya SET dosya_update=:dosya_update where dosya_id=$dosya_update");
      $query->execute(array(

        "dosya_update" => $date->getTimestamp()

      ));
    } else {

      $query = $this->db->prepare("UPDATE $table SET $status=:$status where $table_id=$id");
      $query->execute(array(

        "$status" => 1

      ));
    }
  }

  function durumlar($id)
  {


    $query = $this->db->prepare("SELECT durum_id FROM dosya where durum_id=?");
    $query->execute([$id]);
    return $query->rowCount();
  }

  function hatirlatmaertele($table, $id, $value, $description)
  {



    if ($value != "") {


      $tarih = $table . "_tarih";
      $table_id = $table . "_id";
      $detay = $table . "_detay";

      $query = $this->db->prepare("UPDATE $table SET 

      $tarih=:$tarih,
      $detay=:$detay  

      where $table_id=$id");

      $query->execute(array(

        "$tarih" => $value,
        "$detay" => $description

      ));
      $count = $query->rowCount();
      if ($count) {

        $url = htmlspecialchars($_SERVER['PHP_SELF']);
        header("Location:$url?hatirlat=ok");
        exit();
      } else {

        $url = htmlspecialchars($_SERVER['PHP_SELF']);
        header("Location:$url?hatirlat=error");
      }
    } else {
      $url = htmlspecialchars($_SERVER['PHP_SELF']);
      header("Location:$url?hatirlat=null&detail=$description");
    }
  }
}