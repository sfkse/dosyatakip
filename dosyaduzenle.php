<?php

require_once "header.php";
require_once "navbar.php";



$id = $_GET["id"];
$dosya = $set->registerlist("dosya", $id);
$dosyagetir = $dosya->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["dosyaguncelle"])) {

    $set->dosyaguncelle("dosya", $_POST);
}
if (isset($_GET["del_id"]) && isset($_GET["tablo"])) {

    $set->delete($_GET["tablo"], $_GET["del_id"], $_GET["dosya_id"]);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 px-3" style="display: flex;justify-content:space-between;">
                    <h1>Dosya Düzenle</h1><br>
                    <a href="dosya" class="btn btn-outline-primary mr-2 float-right">Geri</a>
                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>

    <section class="content dosya-inputs-content">
        <div class="row dosya-inputs-row">
            <div class="dosya-inputs-wrap">
                <div class="dosya-inputs">
                    <form action="dosyaduzenle" method="post">
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Dosya Durumu</label>



                                <select name="durum_id" id="dosyadurum" class='form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                                    echo "allow-all";
                                } ?> '>
                                <option>Durum seçiniz</option>
                                <?php

                                $get = $set->tablelist("durum");

                                while ($durum = $get->fetch(PDO::FETCH_ASSOC)) { ?>

                                    <option value="<?php echo $durum["durum_id"] ?>" <?php if ($durum["durum_id"] == $dosyagetir["durum_id"]) {
                                        echo 'selected=""';
                                    } ?>>
                                    <?php echo $durum["durum_ad"] ?></option>

                                <?php } ?>


                            </select>




                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div style="display: block;" class="form-group dosyadurum-secondary">

                        <div class="input-group">
                            <label>Diğer Durumlar </label>
                            <input type="text" name="dosya_durumdiger"
                            class="form-control dosyadurum-secondary-input <?php if ($_SESSION["user"]["user_role"] == 1) {
                                echo "allow-all";
                            } ?>"
                            value="<?php echo htmlspecialchars($dosyagetir["dosya_durumdiger"]) ?>">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->


                    <div class="form-group ">

                        <div class="input-group">
                            <label>Dosya No </label>
                            <input type="text" name="dosya_no" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                                echo "allow-all";
                            } ?>"
                            value="<?php echo htmlspecialchars($dosyagetir["dosya_no"]) ?>">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group ">

                        <div class="input-group">
                            <label>Dava No </label>
                            <input type="text" name="dosya_davano" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                                echo "allow-all";
                            } ?>"
                            value="<?php echo htmlspecialchars($dosyagetir["dosya_davano"]) ?>">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group ">

                        <div class="input-group">
                            <label>Müvekkil</label>
                            <input type="text" name="dosya_muvekkil" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                                echo "allow-all";
                            } ?>"
                            value="<?php echo htmlspecialchars($dosyagetir["dosya_muvekkil"]) ?>">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group ">

                        <div class="input-group">
                            <label>Davalı </label>

                            <select name="sigorta_id" id="davali" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                                echo "allow-all";
                            } ?>">
                            <option>Sigorta seçiniz</option>
                            <?php

                            $get = $set->tablelist("sigorta");

                            while ($sigorta = $get->fetch(PDO::FETCH_ASSOC)) { ?>

                                <option value="<?php echo $sigorta["sigorta_id"] ?>" <?php if ($sigorta["sigorta_id"] == $dosyagetir["sigorta_id"]) {
                                    echo 'selected=""';
                                } ?>>
                                <?php echo $sigorta["sigorta_ad"] ?></option>

                            <?php } ?>


                        </select>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div style="display: block;" class="form-group davali-secondary">

                    <div class="input-group">
                        <label>Diğer Sigorta </label>
                        <input type="text" name="dosya_sgrtdiger"
                        class="form-control davali-secondary-input <?php if ($_SESSION["user"]["user_role"] == 1) {
                            echo "allow-all";
                        } ?>"
                        value="<?php echo htmlspecialchars($dosyagetir["dosya_sgrtdiger"]) ?>">
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group ">

                    <div class="input-group">
                        <label>İlgili Avukat</label>
                        <select class="form-control mb-2 <?php if ($_SESSION["user"]["user_role"] == 1) {
                            echo "allow-all";
                        } ?>" " name=" user_id">

                        <option>Avukat seçiniz</option>

                        <?php



                        $sorumlu = ["user_role" => 1, "user_status" => 1];
                        $column = ["*"];
                        $user = $set->tablelist("user", $column, $sorumlu);
                        while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) { ?>


                            <option value="<?php echo $getuser["user_id"] ?>" <?php

                            if ($getuser["user_id"] == $dosyagetir["user_id"]) {

                                echo "selected=''";
                            }


                            ?>>
                            <?php echo ucwords_tr($getuser["user_name"]); ?></option>


                        <?php } ?>
                    </select>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group ">

                <div class="input-group">
                    <label>Bölge Sorumlusu </label>
                    <select class="form-control mb-2 <?php if ($_SESSION["user"]["user_role"] == 1) {
                        echo "allow-all";
                    } ?>" name=" user_id2">

                    <option>Sorumlu seçiniz</option>

                    <?php


                    $sorumlu = ["user_role" => 4, "user_status" => 1];
                    $column = ["*"];
                    $user = $set->tablelist("user", $column, $sorumlu);

                    while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) { ?>


                        <option value="<?php echo $getuser["user_id"] ?>" <?php

                        if ($getuser["user_id"] == $dosyagetir["user_id2"]) {

                            echo "selected=''";
                        }


                        ?>>
                        <?php echo ucwords_tr($getuser["user_name"]); ?></option>


                    <?php } ?>
                </select>
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->

        <div class="form-group ">

            <div class="input-group">
                <label>İl</label>
                <select class="form-control mb-2 <?php if ($_SESSION["user"]["user_role"] == 1) {
                    echo "allow-all";
                } ?>" name=" iller_id">

                <option>İl seçiniz</option>

                <?php


                $user = $set->tablelist("iller");
                while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) { ?>


                    <option value="<?php echo $getuser["iller_id"] ?>" <?php

                    if ($getuser["iller_id"] == $dosyagetir["iller_id"]) {

                        echo "selected=''";
                    }



                    ?>>
                    <?php echo $getuser["iller_ad"]; ?></option>


                <?php } ?>
            </select>
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->



</div>
<!-- /.col-md-6 -->
</div>
</div>
<!-- /.row -->
<div class="row dosya-inputs-row">
    <div class="dosya-inputs-wrap">
        <div class="dosya-inputs">
            <div class="form-group ">

                <div class="input-group">
                    <label>Mağdurun Konumu</label>
                    <select name="magdur_id" id="magdur" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                        echo "allow-all";
                    } ?>">
                    <option>Seçiniz</option>
                    <?php

                    $get = $set->tablelist("magdur");

                    while ($magdur = $get->fetch(PDO::FETCH_ASSOC)) { ?>

                        <option value="<?php echo $magdur["magdur_id"] ?>" <?php if ($magdur["magdur_id"] == $dosyagetir["magdur_id"]) {
                            echo 'selected=""';
                        } ?>>
                        <?php echo $magdur["magdur_konum"] ?></option>

                    <?php } ?>


                </select>

            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->

        <div style="display: block;" class="form-group magdur-secondary">

            <div class="input-group">
                <label>Diğer </label>
                <input type="text" name="dosya_konumdiger"
                class="form-control magdur-secondary-input <?php if ($_SESSION["user"]["user_role"] == 1) {
                    echo "allow-all";
                } ?>"
                value="<?php echo htmlspecialchars($dosyagetir["dosya_konumdiger"]) ?>">
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
        <div class="form-group ">

            <div class="input-group">
                <label>Tazminat Türü </label>
                <select name="tazminat_id" id="tazminat" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                    echo "allow-all";
                } ?>">
                <option>Seçiniz</option>
                <?php

                $get = $set->tablelist("tazminat");

                while ($tazminat = $get->fetch(PDO::FETCH_ASSOC)) { ?>

                    <option value="<?php echo $tazminat["tazminat_id"] ?>" <?php if ($tazminat["tazminat_id"] == $dosyagetir["tazminat_id"]) {
                        echo 'selected=""';
                    } ?>>
                    <?php echo $tazminat["tazminat_ad"] ?></option>

                <?php } ?>


            </select>
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div style="display: block;" class="form-group tazminat-secondary">

        <div class="input-group">
            <label>Diğer Tazminat </label>
            <input type="text" name="dosya_tazmindiger"
            class="form-control tazminat-secondary-input <?php if ($_SESSION["user"]["user_role"] == 1) {
                echo "allow-all";
            } ?>"
            value="<?php echo htmlspecialchars($dosyagetir["dosya_tazmindiger"]) ?>">
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->


    <div class="form-group ">

        <div class="input-group">
            <label>Kaza Tarihi </label>
            <input type="text" placeholder="gg/aa/yyyy" name="dosya_hasartarih"
            class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                echo "allow-all";
            } ?>" onfocus="(this.type='date')"
            value="<?php if ($dosyagetir["dosya_hasartarih"] != "") {
                echo date("d-m-Y", strtotime(htmlspecialchars($dosyagetir["dosya_hasartarih"])));
            }  ?>">
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->

    <div class="form-group ">

        <div class="input-group">
            <label>Dosya Geliş Tarihi</label>
            <input type="text" name="dosya_gelistarih" placeholder="gg/aa/yyyy"
            class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                echo "allow-all";
            } ?>" onfocus="(this.type='date')"
            value="<?php if ($dosyagetir["dosya_gelistarih"] != "") {
                echo date("d-m-Y", strtotime(htmlspecialchars($dosyagetir["dosya_gelistarih"])));
            } ?>">
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group ">

        <div class="input-group">
            <label>Gelir Durumu</label>
            <input type="number" min="0" step="0.25" name="dosya_gelir" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                echo "allow-all";
            } ?>"
            value="<?php echo htmlspecialchars($dosyagetir["dosya_gelir"]) ?>">
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group ">

        <div class="input-group">
            <label>Kusur durumu</label>
            <input type="text" name="dosya_kusur" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                echo "allow-all";
            } ?>"
            value="<?php echo htmlspecialchars($dosyagetir["dosya_kusur"]) ?>">
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->




    <div class="form-group ">

        <div class="input-group">
            <label>Maluliyet oranı</label>
            <input type="text" name="dosya_maluliyet" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                echo "allow-all";
            } ?>"
            value="<?php echo htmlspecialchars($dosyagetir["dosya_maluliyet"]) ?>">
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group ">

        <div class="input-group">
            <label>Muhtemel Tazminat </label>
            <input type="text" name="dosya_muhtemel" class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
                echo "allow-all";
            } ?>"
            value="<?php echo htmlspecialchars($dosyagetir["dosya_muhtemel"]) ?>">
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->




</div>
<!-- /.col-md-6 -->
</div>
</div>
<!-- /.row -->

</section>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1>Dosya Ek Bilgileri</h1><br>

            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>

<!--  =====  Dosya Detay Bilgileri =====  -->

<section class="content dosya-inputs-content mt-4">
    <div class="row " style="width:100% ">
        <div class="dosya-inputs-wrap">
            <div class="row details-row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">




                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                    href="#custom-tabs-four-home" role="tab"
                                    aria-controls="custom-tabs-four-home" aria-selected="true">DETAYLAR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab"
                                    aria-controls="custom-tabs-four-profile" aria-selected="false">EKSİK
                                EVRAK</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="custom-tabs-four-tahsilat-tab" data-toggle="pill"
                                href="#custom-tabs-four-tahsilat" role="tab"
                                aria-controls="custom-tabs-four-tahsilat"
                                aria-selected="true">TAHSİLATLAR</a>
                            </li>

                            <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                                <li class="nav-item">
                                    <a class="nav-link " id="custom-tabs-four-hatirlatma-tab" data-toggle="pill"
                                    href="#custom-tabs-four-hatirlatma" role="tab"
                                    aria-controls="custom-tabs-four-hatirlatma"
                                    aria-selected="true">HATIRLATMALAR</a>
                                </li>
                            <?php } ?>

                        </ul>




                    </div>



                    <div class="card-body">



                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">




                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-home-tab"
                                    data-toggle="pill" href="#custom-content-below-home" role="tab"
                                    aria-controls="custom-content-below-home"
                                    aria-selected="true">Gelişme</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-profile-tab"
                                    data-toggle="pill" href="#custom-content-below-profile" role="tab"
                                    aria-controls="custom-content-below-profile"
                                    aria-selected="false">Adli Tıp</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-messages-tab"
                                    data-toggle="pill" href="#custom-content-below-messages" role="tab"
                                    aria-controls="custom-content-below-messages"
                                    aria-selected="false">Ceza</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-settings-tab"
                                    data-toggle="pill" href="#custom-content-below-settings" role="tab"
                                    aria-controls="custom-content-below-settings"
                                    aria-selected="false">Manevi</a>
                                </li>
                            </ul>






                            <div class="tab-content" id="custom-content-below-tabContent">


                                <div class="tab-pane fade show active" id="custom-content-below-home"
                                role="tabpanel" aria-labelledby="custom-content-below-home-tab">


                                <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                                    <textarea name="gelisme_detay" style="resize: none;"
                                    class="table-text <?php if ($_SESSION["user"]["user_role"] == 1) {
                                        echo "allow-all";
                                    } ?>" cols="50" rows="3"
                                    placeholder="Detay ekleyebilirsiniz..."></textarea>


                                <?php } ?>


                                <div style="position: relative;" class="dosyaek-metin2 ">


                                    <?php


                                    $dosyaek1 = $set->dosyadetaygoster("gelisme", $_GET["id"], "*");

                                    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


                                        $time = strtotime($dosyaekgetir["gelisme_zaman"]);
                                        $stamp = date("d-m-Y", $time);


                                        if ($dosyaekgetir["gelisme_detay"] != null) { ?>




                                            <div class="descript-detay mb-2"
                                            style="display: flex;justify-content: flex-start;">
                                            <?php if ($_SESSION["user"]["user_role"] != 4) { ?>

                                                <button type="button" class="descript-delete-detay"
                                                data-id="<?php echo $dosyaekgetir["gelisme_id"] ?>"
                                                data-table="gelisme"
                                                style="color: red;padding:0 .5em;margin-right:.5em"><i
                                                class="fas fa-times"></i></button>

                                            <?php } ?>
                                            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>
                                            <div style="cursor: pointer;" class="descript-update-detay"
                                            data-id="<?php echo $dosyaekgetir["gelisme_id"] ?>"
                                            data-table="gelisme">

                                            <?php
                                            $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
                                            $user = $set->tablelist("user", ["*"], $userstamp);
                                            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ' . htmlspecialchars($dosyaekgetir["gelisme_detay"]);
                                            }
                                            ?>


                                        </div>
                                        <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>


                                            <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
                                            class="content">


                                            <textarea class="table-text allow-all" rows="3" cols="70"
                                            style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["gelisme_detay"]))  ?></textarea>
                                            <p><button type="button"
                                                class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                                                <button type="button"
                                                class="cancel btn btn-sm btn-outline-primary">İptal</button>
                                            </p>

                                        </div>
                                    <?php } ?>
                                </div>

                            <?php } ?>


                        <?php } ?>

                    </div>

                </div>
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                aria-labelledby="custom-content-below-profile-tab">


                <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                    <textarea name="adlitip_detay" style="resize: none;"
                    class="table-text <?php if ($_SESSION["user"]["user_role"] == 1) {
                        echo "allow-all";
                    } ?>" cols="50" rows="3"
                    placeholder="Detay ekleyebilirsiniz..."></textarea>


                <?php } ?>

                <div style="position:relative" class="dosyaek-metin2">

                    <?php


                    $dosyaek1 = $set->dosyadetaygoster("adlitip", $_GET["id"], "*");

                    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {

                        $time = strtotime($dosyaekgetir["adlitip_zaman"]);
                        $stamp = date("d-m-Y", $time);



                        if ($dosyaekgetir["adlitip_detay"] != null) { ?>


                            <div class="descript-detay mb-2"
                            style="display: flex;justify-content: flex-start;">
                            <?php if ($_SESSION["user"]["user_role"] != 4) { ?>

                                <button type="button" class="descript-delete-detay"
                                data-id="<?php echo $dosyaekgetir["adlitip_id"] ?>"
                                data-table="adlitip"
                                style="color: red;padding:0 .5em;margin-right:.5em"><i
                                class="fas fa-times"></i></button>

                            <?php } ?>
                            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>

                            <div style="cursor: pointer;" class="descript-update-detay"
                            data-id="<?php echo htmlspecialchars($dosyaekgetir["adlitip_id"]) ?>"
                            data-table="adlitip">
                            <?php
                            $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
                            $user = $set->tablelist("user", ["*"], $userstamp);
                            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ' . htmlspecialchars($dosyaekgetir["adlitip_detay"]);
                            }  ?>


                        </div>
                        <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                            <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
                            class="content">


                            <textarea class="table-text allow-all" rows="3" cols="70"
                            style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["adlitip_detay"]))  ?></textarea>
                            <p><button type="button"
                                class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                                <button type="button"
                                class="cancel btn btn-sm btn-outline-primary">İptal</button>
                            </p>

                        </div>
                    <?php } ?>
                </div>



            <?php } ?>




        <?php } ?>

    </div>

</div>
<div class="tab-pane fade" id="custom-content-below-messages"
role="tabpanel" aria-labelledby="custom-content-below-messages-tab">

<?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>

    <textarea name="ceza_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Detay ekleyebilirsiniz..."></textarea>


<?php } ?>

<div style="position: relative;" class="dosyaek-metin2">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("ceza", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {



        $time = strtotime($dosyaekgetir["ceza_zaman"]);
        $stamp = date("d-m-Y", $time);

        if ($dosyaekgetir["ceza_detay"] != null) { ?>



            <div class="descript-detay mb-2"
            style="display: flex;justify-content: flex-start;">
            <?php if ($_SESSION["user"]["user_role"] != 4) { ?>

                <button type="button" class="descript-delete-detay"
                data-id="<?php echo $dosyaekgetir["ceza_id"] ?>"
                data-table="ceza"
                style="color: red;padding:0 .5em;margin-right:.5em"><i
                class="fas fa-times"></i></button>

            <?php } ?>
            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>

            <div style="cursor: pointer;" class="descript-update-detay"
            data-id="<?php echo $dosyaekgetir["ceza_id"] ?>"
            data-table="ceza">

            <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
            $user = $set->tablelist("user", ["*"], $userstamp);
            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ' . htmlspecialchars($dosyaekgetir["ceza_detay"]);
            } ?>

        </div>

        <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
            <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
            class="content">


            <textarea class="table-text allow-all" rows="3" cols="70"
            style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["ceza_detay"]))  ?></textarea>
            <p><button type="button"
                class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                <button type="button"
                class="cancel btn btn-sm btn-outline-primary">İptal</button>
            </p>

        </div>
    <?php } ?>
</div>

<?php } ?>
<?php } ?>

</div>

</div>
<div class="tab-pane fade" id="custom-content-below-settings"
role="tabpanel" aria-labelledby="custom-content-below-settings-tab">

<?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>

    <textarea name="manevi_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Detay ekleyebilirsiniz..."></textarea>


<?php } ?>


<div class="dosyaek-metin2">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("manevi", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


        $time = strtotime($dosyaekgetir["manevi_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["manevi_detay"] != null) { ?>


            <div class="descript-detay mb-2"
            style="display: flex;justify-content: flex-start;">
            <?php if ($_SESSION["user"]["user_role"] != 4) { ?>

                <button type="button" class="descript-delete-detay"
                data-id="<?php echo $dosyaekgetir["manevi_id"] ?>"
                data-table="manevi"
                style="color: red;padding:0 .5em;margin-right:.5em"><i
                class="fas fa-times"></i></button>

            <?php } ?>
            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>
            <div style="cursor: pointer;" class="descript-update-detay"
            data-id="<?php echo $dosyaekgetir["manevi_id"] ?>"
            data-table="manevi">

            <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
            $user = $set->tablelist("user", ["*"], $userstamp);
            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ' . htmlspecialchars($dosyaekgetir["manevi_detay"]);
            } ?>

        </div>

        <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
            <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
            class="content">


            <textarea class="table-text allow-all" rows="3" cols="70"
            style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["manevi_detay"]))  ?></textarea>
            <p><button type="button"
                class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                <button type="button"
                class="cancel btn btn-sm btn-outline-primary">İptal</button>
            </p>

        </div>

    <?php } ?>
</div>

<?php } ?>

<?php } ?>

</div>

</div>

</div>
</div>


<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
aria-labelledby="custom-tabs-four-profile-tab">

<div class="detail-wrapper mb-2">

    <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>


        <select class="js-example-basic-multiple form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
            echo "allow-all";
        } ?>"
        name="evrak_id[]" multiple="multiple">


        <?php

        $get = $set->tablelist("evrak");

        while ($getir = $get->fetch(PDO::FETCH_ASSOC)) { ?>

            <option value="<?php echo $getir["evrak_id"] ?>">
                <?php echo $getir["evrak_ad"]; ?></option>


            <?php } ?>
        </select>






    <?php } ?>

</div>

<div class="dosyaek-metin2">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("eksikevrak", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


        $time = strtotime($dosyaekgetir["eksikevrak_zaman"]);
        $stamp = date("d-m-Y", $time);

        ?>

        <div class="descript-detay mb-2"
        style="display: flex;justify-content: flex-start;">
        <?php if ($_SESSION["user"]["user_role"] != 4) { ?>

            <button type="button" class="descript-delete-detay"
            data-id="<?php echo $dosyaekgetir["eksikevrak_id"] ?>"
            data-table="eksikevrak"
            style="color: red;padding:0 .5em;margin-right:.5em"><i
            class="fas fa-times"></i></button>

        <?php } ?>
        <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>

        <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];


        $user = $set->tablelist("user", ["*"], $userstamp);

        while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {

            echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ';
        }

        $evraklar = unserialize($dosyaekgetir["evrak_id"]);

        ?>
        <span class="bg-warning px-2 mr-2">Eksik Evraklar</span>
        <div style="cursor: pointer;" class="update-evrak"
        data-table="eksikevrak"
        data-id="<?php echo $dosyaekgetir["evrak_id"]  ?>">
        <?php




        foreach ($evraklar as $value) {

            $getir = $set->tablelist("evrak");
            while ($evrakgetir = $getir->fetch(PDO::FETCH_ASSOC)) {

                if ($evrakgetir["evrak_id"] == $value) {

                    echo $evrakyazdir = "-" . $evrakgetir["evrak_ad"] . "-";
                }
            }
        } ?>

    </div>




    <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
        <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:2em;border-radius:5px;background:#fff"
        class="content">


        <select data-id="<?php echo $dosyaekgetir["eksikevrak_id"] ?>" 
        class="js-example-basic-multiple form-control  <?php if ($_SESSION["user"]["user_role"] == 1) {
            echo "allow-all";
        } ?>"
        name="evrak_id2[]" multiple="multiple">


        <?php

        $get = $set->tablelist("evrak");

        while ($getir = $get->fetch(PDO::FETCH_ASSOC)) { ?>

            <option value="<?php echo $getir["evrak_id"] ?>"
                <?php


                foreach ($evraklar as $value) {

                    if ($getir["evrak_id"] == $value) {

                        echo "selected";
                    }
                }
                ?>>

                <?php echo $getir["evrak_ad"]  ?>

            </option>


        <?php } ?>
    </select>


    <p class="mt-2">
        <button type="button"
        class="update-button btn btn-sm btn-outline-success">Güncelle</button>
        <button type="button"
        class="cancel btn btn-sm btn-outline-primary">İptal</button>
    </p>

</div>

<?php } ?>
</div>



<?php } ?>
</div>

</div>

<div class="tab-pane fade" id="custom-tabs-four-tahsilat" role="tabpanel"
aria-labelledby="custom-tabs-four-tahsilat-tab">
<div class="detail-wrapper">


    <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>

        <label>Tarih</label>
        <input type="text" name="tahsilatlar_tarih" placeholder="gg/aa/yyyy"
        onfocus="(this.type='date')"
        class="form-control mb-2 <?php if ($_SESSION["user"]["user_role"] == 1) {
            echo "allow-all";
        } ?> '>">

        <label>Tahsilat Tipi</label>
        <input type="text" name="tahsilatlar_tip"
        class="form-control mb-2 <?php if ($_SESSION["user"]["user_role"] == 1) {
            echo "allow-all";
        } ?> '>">


        <label>Tutar</label>
        <input type="number" name="tahsilatlar_tutar" step="0.25"
        class="form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
            echo "allow-all";
        } ?> '>">

        <textarea name="tahsilatlar_detay" style="resize: none;"
        class="table-text <?php if ($_SESSION["user"]["user_role"] == 1) {
            echo "allow-all";
        } ?> '>" cols="50" rows="3"
        placeholder="Bilgi girişi yapabilirsiniz..."></textarea>
        <p><small style="color: red">**Açıklama girilmesi zorunludur.Aksi halde
        kaydınız görüntülenmez</small></p>

    <?php } ?>


</div>
<div class="dosyaek-metin2">


    <?php

    $dosyaek1 = $set->dosyadetaygoster("tahsilatlar", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {



        $time = strtotime($dosyaekgetir["tahsilatlar_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["tahsilatlar_detay"] != null  || $dosyaekgetir["tahsilatlar_tip"] || $dosyaekgetir["tahsilatlar_tutar"]) { ?>


            <div class="descript-detay mb-2"
            style="display: flex;justify-content: flex-start;">
            <?php if ($_SESSION["user"]["user_role"] != 4) { ?>

                <button type="button" class="descript-delete-detay"
                data-id="<?php echo $dosyaekgetir["tahsilatlar_id"] ?>"
                data-table="tahsilatlar"
                style="color: red;padding:0 .5em;margin-right:.5em"><i
                class="fas fa-times"></i></button>
            <?php } ?>
            <span class="bg-success px-2 mx-2"><?php echo $stamp ?></span>
            <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
            $user = $set->tablelist("user", ["*"], $userstamp);
            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ';
            } ?>


            <span class="bg-warning px-2 mx-2">Tahs. Tarihi</span> <b>


                <?php

                if ($dosyaekgetir["tahsilatlar_tarih"] == "") { ?>


                    <span style="color: red">--Tarih Yok--</span>

                <?php } else {


                    echo date("d-m-Y", strtotime(htmlspecialchars($dosyaekgetir["tahsilatlar_tarih"])));
                } ?></b>

                <span class="bg-warning px-2 mx-2">Tahs.
                Tipi</span><b><?php echo htmlspecialchars($dosyaekgetir["tahsilatlar_tip"]) ?></b>

                <span
                class="bg-warning px-2 mx-2">Tutar</span><b><?php echo htmlspecialchars($dosyaekgetir["tahsilatlar_tutar"]) ?>TL</b>

                <span class="bg-primary px-2 mx-2">Açıklama</span>
                <div style="cursor: pointer;" class="descript-update-detay"
                data-id="<?php echo $dosyaekgetir["tahsilatlar_id"] ?>"
                data-table="tahsilatlar">

                <?php echo htmlspecialchars($dosyaekgetir["tahsilatlar_detay"]) ?>

            </div>
            <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
                class="content">


                <textarea class="table-text allow-all" rows="3" cols="70"
                style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["tahsilatlar_detay"]))  ?></textarea>
                <p><button type="button"
                    class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                    <button type="button"
                    class="cancel btn btn-sm btn-outline-primary">İptal</button>
                </p>

            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php } ?>

</div>

</div>
<?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>

    <div class="tab-pane fade show" id="custom-tabs-four-hatirlatma" role="tabpanel"
    aria-labelledby="custom-tabs-four-hatirlatma-tab">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-content-below-tahkim-tab"
            data-toggle="pill" href="#custom-content-below-tahkim" role="tab"
            aria-controls="custom-content-below-tahkim"
            aria-selected="true">Tahkim</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-below-itiraz-tab"
            data-toggle="pill" href="#custom-content-below-itiraz" role="tab"
            aria-controls="custom-content-below-itiraz"
            aria-selected="false">İtiraz</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-below-temyiz-tab"
            data-toggle="pill" href="#custom-content-below-temyiz" role="tab"
            aria-controls="custom-content-below-temyiz"
            aria-selected="false">Temyiz</a>
        </li>
                                            <!--  <li class="nav-item">
            <a class="nav-link" id="custom-content-below-icra-tab"
            data-toggle="pill" href="#custom-content-below-icra" role="tab"
            aria-controls="custom-content-below-icra"
            aria-selected="false">İcra</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" id="custom-content-below-adli-tab"
            data-toggle="pill" href="#custom-content-below-adli" role="tab"
            aria-controls="custom-content-below-adli" aria-selected="false">Adli
        Tıp</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-content-below-diger-tab"
        data-toggle="pill" href="#custom-content-below-diger" role="tab"
        aria-controls="custom-content-below-diger"
        aria-selected="false">Diğer</a>
    </li>
</ul>
<div class="tab-content mt-2" id="custom-content-below-tabContent">
    <div class="tab-pane fade  show active" id="custom-content-below-tahkim"
    role="tabpanel" aria-labelledby="custom-content-below-tahkim-tab">
    <div class="detail-wrapper">




        <textarea name="hatirlattahkim_detay" style="resize: none;"
        class="table-text allow-all" cols="50" rows="3"
        placeholder="Açıklama giriniz..."></textarea>



    </div>
    <div class="dosyaek-metin2">


        <?php


        $dosyaek1 = $set->dosyadetaygoster("hatirlattahkim", $_GET["id"], "*");

        while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


            $time = strtotime($dosyaekgetir["hatirlattahkim_zaman"]);
            $stamp = date("d-m-Y", $time);


            if ($dosyaekgetir["hatirlattahkim_detay"] != null) { ?>



                <div class="descript-detay mb-2"
                style="display: flex;justify-content: flex-start;">

                <button type="button" class="descript-delete-detay"
                data-id="<?php echo $dosyaekgetir["hatirlattahkim_id"] ?>"
                data-table="hatirlattahkim"
                style="color: red;padding:0 .5em;margin-right:.5em"><i
                class="fas fa-times"></i></button>

                <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>

                <div style="cursor: pointer;" class="descript-update-detay"
                data-id="<?php echo $dosyaekgetir["hatirlattahkim_id"] ?>"
                data-table="hatirlattahkim">

                <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
                $user = $set->tablelist("user", ["*"], $userstamp);
                while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                    echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ' . htmlspecialchars($dosyaekgetir["hatirlattahkim_detay"]);
                }  ?>
            </div>
            <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
                class="content">


                <textarea class="table-text allow-all" rows="3" cols="70"
                style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["hatirlattahkim_detay"]))  ?></textarea>
                <p><button type="button"
                    class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                    <button type="button"
                    class="cancel btn btn-sm btn-outline-primary">İptal</button>
                </p>

            </div>
        <?php } ?>
    </div>

<?php } ?>

<?php } ?>




</div>

</div>

<div class="tab-pane fade" id="custom-content-below-itiraz" role="tabpanel"
aria-labelledby="custom-content-below-itiraz-tab">

<div class="detail-wrapper">



    <textarea name="hatirlatitiraz_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Açıklama giriniz..."></textarea>




</div>
<div class="dosyaek-metin2">

    <?php


    $dosyaek1 = $set->dosyadetaygoster("hatirlatitiraz", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {

        $time = strtotime($dosyaekgetir["hatirlatitiraz_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["hatirlatitiraz_detay"] != null) { ?>


            <div class="descript-detay mb-2"
            style="display: flex;justify-content: flex-start;">


            <button type="button" class="descript-delete-detay"
            data-id="<?php echo $dosyaekgetir["hatirlatitiraz_id"] ?>"
            data-table="hatirlatitiraz"
            style="color: red;padding:0 .5em;margin-right:.5em"><i
            class="fas fa-times"></i></button>

            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>
            <div style="cursor: pointer;" class="descript-update-detay"
            data-id="<?php echo $dosyaekgetir["hatirlatitiraz_id"] ?>"
            data-table="hatirlatitiraz">
            <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
            $user = $set->tablelist("user", ["*"], $userstamp);
            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ' . htmlspecialchars($dosyaekgetir["hatirlatitiraz_detay"]);
            } ?>

        </div>
        <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
            <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
            class="content">


            <textarea class="table-text allow-all" rows="3" cols="70"
            style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["hatirlatitiraz_detay"]))  ?></textarea>
            <p><button type="button"
                class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                <button type="button"
                class="cancel btn btn-sm btn-outline-primary">İptal</button>
            </p>

        </div>
    <?php } ?>
</div>

<?php } ?>

<?php } ?>

</div>

</div>
<div class="tab-pane fade" id="custom-content-below-temyiz" role="tabpanel"
aria-labelledby="custom-content-below-temyiz-tab">
<div class="detail-wrapper">


    <textarea name="hatirlattemyiz_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Açıklama giriniz..."></textarea>




</div>
<div class="dosyaek-metin2">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("hatirlattemyiz", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {



        $time = strtotime($dosyaekgetir["hatirlattemyiz_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["hatirlattemyiz_detay"] != null) { ?>


            <div class="descript-detay mb-2"
            style="display: flex;justify-content: flex-start;">

            <button type="button" class="descript-delete-detay"
            data-id="<?php echo $dosyaekgetir["hatirlattemyiz_id"] ?>"
            data-table="hatirlattemyiz"
            style="color: red;padding:0 .5em;margin-right:.5em"><i
            class="fas fa-times"></i></button>

            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>
            <div style="cursor: pointer;" class="descript-update-detay"
            data-id="<?php echo $dosyaekgetir["hatirlattemyiz_id"] ?>"
            data-table="hatirlattemyiz">
            <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
            $user = $set->tablelist("user", ["*"], $userstamp);
            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ' . htmlspecialchars($dosyaekgetir["hatirlattemyiz_detay"]);
            } ?>

        </div>
        <?php if ($_SESSION["user"]["user_role"] == 5) { ?>
            <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
            class="content">


            <textarea class="table-text allow-all" rows="3" cols="70"
            style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["hatirlattemyiz_detay"]))  ?></textarea>
            <p><button type="button"
                class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                <button type="button"
                class="cancel btn btn-sm btn-outline-primary">İptal</button>
            </p>

        </div>
    <?php } ?>
</div>

<?php } ?>

<?php } ?>

</div>

</div>

<div class="tab-pane fade" id="custom-content-below-adli" role="tabpanel"
aria-labelledby="custom-content-below-adli-tab">


<div class="detail-wrapper">




    <label>Hatırlatma Tarihi</label>
    <input type="text" name="hatirlatadli_tarih"
    placeholder="gg/aa/yyyy" onfocus="(this.type='date')"
    class="form-control mb-2 allow-all">

    <textarea name="hatirlatadli_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Açıklama giriniz..."></textarea>
    <p><small style="color: red">**Tarih ve açıklama alanı boş
    olmamalıdır.Aksi halde kaydınız görüntülenmez</small>
</p>





</div>
<div class="dosyaek-metin2">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("hatirlatadli", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


        $time = strtotime($dosyaekgetir["hatirlatadli_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["hatirlatadli_detay"] != null) { ?>


            <div class="descript-detay mb-2"
            style="display: flex;justify-content: flex-start;">


            <button type="button" class="descript-delete-detay"
            data-id="<?php echo $dosyaekgetir["hatirlatadli_id"] ?>"
            data-table="hatirlatadli"
            style="color: red;padding:0 .5em;margin-right:.5em"><i
            class="fas fa-times"></i></button>

            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>
            <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
            $user = $set->tablelist("user", ["*"], $userstamp);
            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ';
            }  ?>
            <span class="bg-warning px-2 mr-2">Hatırlatma Tar.</span><b>
                <?php

                if ($dosyaekgetir["hatirlatadli_tarih"] == "") { ?>


                    <span style="color: red">--Hatırlatmanın ayarlanabilmesi
                    için tarih giriniz!--</span>

                <?php } else {

                    echo date("d-m-Y", strtotime(htmlspecialchars($dosyaekgetir["hatirlatadli_tarih"])));
                } ?></b>

                <span class="bg-primary px-2 mx-2">Açıklama</span>
                <div style="cursor: pointer;" class="descript-update-detay"
                data-id="<?php echo $dosyaekgetir["hatirlatadli_id"] ?>"
                data-table="hatirlatadli">
                <?php echo htmlspecialchars($dosyaekgetir["hatirlatadli_detay"]) ?>

            </div>
            <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
                class="content">


                <textarea class="table-text allow-all" rows="3" cols="70"
                style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["hatirlatadli_detay"]))  ?></textarea>
                <p><button type="button"
                    class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                    <button type="button"
                    class="cancel btn btn-sm btn-outline-primary">İptal</button>
                </p>

            </div>
        <?php } ?>
    </div>

<?php } ?>

<?php } ?>

</div>

</div>
<div class="tab-pane fade" id="custom-content-below-diger" role="tabpanel"
aria-labelledby="custom-content-below-diger-tab">

<div class="detail-wrapper">


    <label>Hatırlatma Tarih</label>
    <input type="text" name="hatirlatdiger_tarih"
    placeholder="gg/aa/yyyy" onfocus="(this.type='date')"
    class="form-control mb-2 allow-all">

    <textarea name="hatirlatdiger_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Açıklama giriniz..."></textarea>
    <p><small style="color: red">**Tarih ve açıklama alanı boş
    olmamalıdır.Aksi halde kaydınız görüntülenmez</small>
</p>




</div>
<div class="dosyaek-metin2">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("hatirlatdiger", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


        $time = strtotime($dosyaekgetir["hatirlatdiger_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["hatirlatdiger_detay"] != "") { ?>


            <div class="descript-detay mb-2"
            style="display: flex;justify-content: flex-start;">

            <button type="button" class="descript-delete-detay"
            data-id="<?php echo $dosyaekgetir["hatirlatdiger_id"] ?>"
            data-table="hatirlatdiger"
            style="color: red;padding:0 .5em;margin-right:.5em"><i
            class="fas fa-times"></i></button>

            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>

            <?php $userstamp = ["user_id" => $dosyaekgetir["user_id"]];
            $user = $set->tablelist("user", ["*"], $userstamp);
            while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
                echo '<span style="background:#d4d8dd;margin:0 5px;padding:0 3px">' . ucwords_tr($getuser["user_name"]) . '</span> ';
            }  ?>

            <span class="bg-warning px-2 mr-2">Hatırlatma Tar.</span><b>

                <?php
                if ($dosyaekgetir["hatirlatdiger_tarih"] == "") { ?>


                    <span style="color: red">--Hatırlatmanın ayarlanabilmesi
                    için tarih giriniz!--</span>

                <?php } else {

                    echo date("d-m-Y", strtotime(htmlspecialchars($dosyaekgetir["hatirlatdiger_tarih"])));
                } ?></b>

                <span class="bg-primary px-2 mx-2">Açıklama</span>
                <div style="cursor: pointer;" class="descript-update-detay"
                data-id="<?php echo $dosyaekgetir["hatirlatdiger_id"] ?>"
                data-table="hatirlatdiger">
                <?php echo htmlspecialchars($dosyaekgetir["hatirlatdiger_detay"]) ?>

            </div>

            <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>
                <div style="box-shadow:5px 10px 8px #888888;width: 40%;position: absolute;display: none;top:10%;left: 30%;padding:0 2em;border-radius:5px;background:#fff"
                class="content">


                <textarea class="table-text allow-all" rows="3" cols="70"
                style="resize: none;"><?php echo trim(htmlspecialchars($dosyaekgetir["hatirlatdiger_detay"]))  ?></textarea>
                <p><button type="button"
                    class="update-button btn btn-sm btn-outline-success">Güncelle</button>
                    <button type="button"
                    class="cancel btn btn-sm btn-outline-primary">İptal</button>
                </p>

            </div>
        <?php } ?>
    </div>

<?php } ?>

<?php } ?>

</div>

</div>
</div>

</div>
<?php } ?>
</div>

</div>

</div>

</div>
</div>
</div>



<input type="hidden" id="dosya-id" name="dosya_id" value="<?php echo $id ?>">


<?php

$date = new DateTime();


?>
<input type="hidden" id="dosya-update" name="dosya_update" value="<?php echo $date->getTimestamp(); ?>">




</section>
<section class=" dosya-inputs-submit my-5 mx-4">
    <a href="dosya" class="btn btn-outline-primary mr-2">Geri</a>



    <button class="btn bg-gradient-success" type="submit" name="dosyaguncelle">Güncelle</button>



</form>
</section>
</div>

<?php require_once "footer.php";

?>
<script type="text/javascript">
    $(function() {



        $("#tazminat").change(function() {

            var val = $(this).val();


            if (val != 7) {
                $(".tazminat-secondary-input").val(" ");
                $(".tazminat-secondary").css("display", "none");





            } else {

                $(".tazminat-secondary").css("display", "block");


            };


        }).change();



        $("#dosyadurum").change(function() {

            var val = $(this).val();
            if (val != 7) {


                $(".dosyadurum-secondary").css("display", "none");
                $(".dosyadurum-secondary-input").val(" ");


            } else {

                $(".dosyadurum-secondary").css("display", "block");

            };
        }).change();


        $("#davali").change(function() {

            var val = $(this).val();

            if (val != 36) {

                $(".davali-secondary").css("display", "none");
                $(".davali-secondary-input").val(" ");



            } else {

                $(".davali-secondary").css("display", "block");
            };
        }).change();


        $("#magdur").change(function() {

            var val = $(this).val();
            if (val != 4) {

                $(".magdur-secondary").css("display", "none");
                $(".magdur-secondary-input").val(" ");


            } else {


                $(".magdur-secondary").css("display", "block");
            };
        }).change();


        $(".descript-detay").on("click", ".descript-delete-detay", function() {



            var id = $(this).attr("data-id");
            var table = $(this).attr("data-table");

            Swal.fire({
                title: 'Silmek istediğinizden emin misiniz?',

                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sil',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {


                    $.ajax({

                        type: "post",
                        url: "config/ajax.php",
                        data: {
                            "detay-id": id,
                            "delete-table": table


                        },
                        success: function(response) {
                            if (window.location.href.indexOf("update") == -1) {


                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Başarıyla Silindi',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            } else {

                                location.reload();



                            }


                        }

                    })
                }
            });




        })


        $(".descript-detay").on("click", ".update-evrak", function() {


            $(this).next("div.content").toggle();
            $(".cancel").click(function() {

                $("div.content").hide();

            });
            $("div.content").on("click", ".update-button", function() {


                var selected = $(this).parent().siblings("select").val();
                var id = $(this).parent().siblings("select").attr(
                    "data-id");
              

                $.ajax({

                    type: "post",
                    url: "config/ajax.php",
                    data: {
                        "data-id": id,
                        "selected": selected


                    },
                    success: function(response) {
                        if (window.location.href.indexOf("update") == -1) {


                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Güncelleme Başarılı',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {

                            location.reload();



                        }


                    }


                })
            })


        });

        $(".descript-detay").on("click", ".descript-update-detay", function() {


            $(this).next("div.content").toggle();
            $(".cancel").click(function() {

                $("div.content").hide();

            });

            $("div.content").on("click", ".update-button", function() {


                var description = $(this).parent().siblings("textarea").val();
                var id = $(this).parent().parent().siblings(".descript-update-detay").attr(
                    "data-id");
                var table = $(this).parent().parent().siblings(".descript-update-detay").attr(
                    "data-table");




                $.ajax({

                    type: "post",
                    url: "config/ajax.php",
                    data: {
                        "detay-id": id,
                        "table": table,
                        "detay": description


                    },
                    success: function(response) {
                        if (window.location.href.indexOf("update") == -1) {


                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Güncelleme Başarılı',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {

                            location.reload();



                        }


                    }


                })
            })



        })

    });


<?php if ($_GET["update"] == "ok") { ?>

    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Güncelleme Başarılı',
        showConfirmButton: false,
        timer: 1500
    })
<?php } elseif ($_GET["update"] == "no") { ?>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Güncelleme Başarısız',
        showConfirmButton: false,
        timer: 1500

    })

<?php } ?>
</script>
</body>

</html>