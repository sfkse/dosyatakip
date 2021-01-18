<?php

require_once "header.php";
require_once "navbar.php";

if ($_SESSION["user"]["user_role"] == 4) {

    header("Location:index");
    exit;
}


if (isset($_POST["dosyaekle"])) {


    $get = $set->dosyaekle("dosya", $_POST);
} elseif (isset($_GET["id"])) {

    $dosya = $set->registerlist("dosya", $_GET["id"]);
    $dosyagetir = $dosya->fetch(PDO::FETCH_ASSOC);


}

if ($_GET["register"] == "ok") {

    header("refresh:1;url=dosya");
}

?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 px-3" style="display: flex;justify-content:space-between;">
                    <h1>Dosya Ekle</h1><br>


                    <a href="dosya" class="btn btn-outline-primary mr-2 float-right">Geri</a>
                </div>
                <div class="col-sm-8 mt-2">
                    <h6 style="color: red"><em>** Bu bölüm sadece yeni dosya eklemek içindir.Kayıt işlemi
                        gerçekleştikten sonra herhangi bir bilgi değişikliği yapmak veya eklediğiniz dosyanın
                        detaylarını incelemek için "Dosyalar" sayfasından bu dosyanının detaylarına
                    ulaşabilirsiniz</em></h6>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content dosya-inputs-content">
        <div class="row dosya-inputs-row">
            <div class="dosya-inputs-wrap">
                <div class="dosya-inputs">
                    <form action="dosyaekle" method="post">
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Dosya Durumu</label>



                                <select name="durum_id" id="dosyadurum" class="form-control allow-all">
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
                        <div style="display: none;" class="form-group dosyadurum-secondary">

                            <div class="input-group">
                                <label>Diğer Durumlar </label>
                                <input type="text" name="dosya_durumdiger" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_durumdiger"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->


                        <div class="form-group ">

                            <div class="input-group">
                                <label>Dosya No </label>
                                <input type="text" name="dosya_no" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_no"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="form-group ">

                            <div class="input-group">
                                <label>Dava No </label>
                                <input type="text" name="dosya_davano" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_davano"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="form-group ">

                            <div class="input-group">
                                <label>Müvekkil</label>
                                <input type="text" name="dosya_muvekkil" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_muvekkil"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Davalı </label>

                                <select name="sigorta_id" id="davali" class="form-control allow-all">
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

                        <div style="display: none;" class="form-group davali-secondary">

                            <div class="input-group">
                                <label>Diğer Sigorta </label>
                                <input type="text" name="dosya_sgrtdiger" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_sgrtdiger"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>İlgili Avukat</label>
                                <select class="form-control mb-2 allow-all" name="user_id">

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
                                <select class="form-control mb-2 allow-all" name="user_id2">

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
                                <select class="form-control mb-2 allow-all" name="iller_id">

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
                                <select name="magdur_id" id="magdur" class="form-control allow-all">
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

                        <div style="display: none;" class="form-group magdur-secondary">

                            <div class="input-group">
                                <label>Diğer </label>
                                <input type="text" name="dosya_konumdiger" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_konumdiger"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Tazminat Türü </label>
                                <select name="tazminat_id" id="tazminat" class="form-control allow-all">
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
                        <div style="display: none;" class="form-group tazminat-secondary">

                            <div class="input-group">
                                <label>Diğer Tazminat </label>
                                <input type="text" name="dosya_tazmindiger" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_tazmindiger"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->


                        <div class="form-group ">

                            <div class="input-group">
                                <label>Kaza Tarihi </label>
                                <input type="text" name="dosya_hasartarih" placeholder="gg/aa/yyyy"
                                onfocus="(this.type='date')" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_hasartarih"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="form-group ">

                            <div class="input-group">
                                <label>Dosya Geliş Tarihi</label>
                                <input type="text" name="dosya_gelistarih" placeholder="gg/aa/yyyy"
                                onfocus="(this.type='date')" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_gelistarih"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Gelir Durumu</label>
                                <input type="number" name="dosya_gelir" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_gelir"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Kusur durumu</label>
                                <input type="text" name="dosya_kusur" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_kusur"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->




                        <div class="form-group ">

                            <div class="input-group">
                                <label>Maluliyet oranı</label>
                                <input type="text" name="dosya_maluliyet" class="form-control allow-all"
                                value="<?php echo htmlspecialchars($dosyagetir["dosya_maluliyet"]) ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Muhtemel Tazminat </label>
                                <input type="text" name="dosya_muhtemel" class="form-control allow-all"
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
                        <h6 style="color: red"><em>** Bu bölüm sadece yeni dosya eklemek içindir.Kayıt işlemi
                            gerçekleştikten sonra herhangi bir bilgi değişikliği yapmak veya eklediğiniz dosyanın
                            detaylarını incelemek için "Dosyalar" sayfasından bu dosyanının detaylarına
                        ulaşabilirsiniz</em></h6>
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
                                    <li class="nav-item">
                                        <a class="nav-link " id="custom-tabs-four-hatirlatma-tab" data-toggle="pill"
                                        href="#custom-tabs-four-hatirlatma" role="tab"
                                        aria-controls="custom-tabs-four-hatirlatma"
                                        aria-selected="true">HATIRLATMALAR</a>
                                    </li>

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

                                        <textarea name="gelisme_detay" style="resize: none;"
                                        class="table-text allow-all" cols="50" rows="3"
                                        placeholder="Bilgi girişi yapabilirsiniz..."></textarea>
                                        <div class="dosyaek-metin">


                                            <?php


                                            $dosyaek1 = $set->dosyadetaygoster("gelisme", $_GET["id"], "*");

                                            while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


                                                $time = strtotime($dosyaekgetir["gelisme_zaman"]);
                                                $stamp = date("d-m-Y", $time);


                                                if ($dosyaekgetir["gelisme_detay"] != null) { ?>



                                                    <p>
                                                        <span
                                                        class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo '<span style="background:#e8eaed;mx-1">' . $_SESSION["user"]["user_name"] . '</span>' . htmlspecialchars($dosyaekgetir["gelisme_detay"]) ?>
                                                    </p>

                                                <?php } ?>

                                            <?php } ?>


                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                                    aria-labelledby="custom-content-below-profile-tab">


                                    <textarea name="adlitip_detay" style="resize: none;"
                                    class="table-text allow-all" cols="50" rows="3"
                                    placeholder="Bilgi girişi yapabilirsiniz..."></textarea>
                                    <div class="dosyaek-metin">

                                        <?php


                                        $dosyaek1 = $set->dosyadetaygoster("adlitip", $_GET["id"], "*");

                                        while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {

                                            $time = strtotime($dosyaekgetir["adlitip_zaman"]);
                                            $stamp = date("d-m-Y", $time);

                                            if ($dosyaekgetir["adlitip_detay"] != null) { ?>


                                                <p>
                                                    <span
                                                    class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo htmlspecialchars($dosyaekgetir["adlitip_detay"]) ?>
                                                </p>

                                            <?php } ?>

                                        <?php } ?>

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="custom-content-below-messages"
                                role="tabpanel" aria-labelledby="custom-content-below-messages-tab">


                                <textarea name="ceza_detay" style="resize: none;"
                                class="table-text allow-all" cols="50" rows="3"
                                placeholder="Bilgi girişi yapabilirsiniz..."></textarea>
                                <div class="dosyaek-metin">
                                    <?php


                                    $dosyaek1 = $set->dosyadetaygoster("ceza", $_GET["id"], "*");

                                    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {



                                        $time = strtotime($dosyaekgetir["ceza_zaman"]);
                                        $stamp = date("d-m-Y", $time);

                                        if ($dosyaekgetir["ceza_detay"] != null) { ?>


                                            <p>
                                                <span
                                                class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo htmlspecialchars($dosyaekgetir["ceza_detay"]) ?>
                                            </p>

                                        <?php } ?>
                                    <?php } ?>

                                </div>

                            </div>
                            <div class="tab-pane fade" id="custom-content-below-settings"
                            role="tabpanel" aria-labelledby="custom-content-below-settings-tab">


                            <textarea name="manevi_detay" style="resize: none;"
                            class="table-text allow-all" cols="50" rows="3"
                            placeholder="Bilgi girişi yapabilirsiniz..."></textarea>
                            <div class="dosyaek-metin">
                                <?php


                                $dosyaek1 = $set->dosyadetaygoster("manevi", $_GET["id"], "*");

                                while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


                                    $time = strtotime($dosyaekgetir["manevi_zaman"]);
                                    $stamp = date("d-m-Y", $time);


                                    if ($dosyaekgetir["manevi_detay"] != null) { ?>


                                        <p>
                                            <span
                                            class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo htmlspecialchars($dosyaekgetir["manevi_detay"]) ?>
                                        </p>

                                    <?php } ?>
                                <?php } ?>

                            </div>

                        </div>

                    </div>
                </div>


                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                aria-labelledby="custom-tabs-four-profile-tab">

                <div class="detail-wrapper  mb-2">


                    <select class="js-example-basic-multiple form-control" name="evrak_id[]" multiple="multiple">
                       

                     <?php

                     $get = $set->tablelist("evrak");

                     while ($getir = $get->fetch(PDO::FETCH_ASSOC)) { ?>

                        <option value="<?php echo $getir["evrak_id"] ?>">
                            <?php echo $getir["evrak_ad"]; ?></option>


                        <?php } ?>
                    </select>



                </div>
                <div class="dosyaek-metin">
                    <?php


                    $dosyaek1 = $set->dosyadetaygoster("eksikevrak", $_GET["id"], "*");
                    ?>

                </div>

            </div>

            <div class="tab-pane fade" id="custom-tabs-four-tahsilat" role="tabpanel"
            aria-labelledby="custom-tabs-four-tahsilat-tab">
            <div class="detail-wrapper">
                <label>Tarih</label>
                <input type="text" name="tahsilatlar_tarih" placeholder="gg/aa/yyyy"
                onfocus="(this.type='date')" class="form-control mb-2 allow-all">

                <label>Tahsilat Tipi</label>
                <input type="text" name="tahsilatlar_tip"
                class="form-control mb-2 allow-all">


                <label>Tutar</label>
                <input type="number" min="0" name="tahsilatlar_tutar" step="0.25"
                class="form-control allow-all">

                <textarea name="tahsilatlar_detay" style="resize: none;"
                class="table-text allow-all" cols="50" rows="3"
                placeholder="Bilgi girişi yapabilirsiniz..."></textarea>
                <p><small style="color: red">**Açıklama girilmesi zorunludur.Aksi halde
                kaydınız görüntülenmez</small></p>
            </div>
            <div class="dosyaek-metin">


                <?php

                $dosyaek1 = $set->dosyadetaygoster("tahsilatlar", $_GET["id"], "*");

                while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {



                    $time = strtotime($dosyaekgetir["tahsilatlar_zaman"]);
                    $stamp = date("d-m-Y", $time);


                    if ($dosyaekgetir["tahsilatlar_detay"] != "") { ?>


                        <p>
                            <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>



                            <span class="bg-warning px-2 mr-2">Tahs. Tarihi</span>
                            <b><?php echo date("d-m-Y", strtotime(htmlspecialchars($dosyaek1ekgetir["tahsilatlar_tarih"]))) ?></b>

                            <span class="bg-warning px-2 mx-2">Tahs.
                            Tipi</span><b><?php echo htmlspecialchars($dosyaekgetir["tahsilatlar_tip"]) ?></b>

                            <span
                            class="bg-warning px-2 mx-2">Tutar</span><b><?php echo htmlspecialchars($dosyaekgetir["tahsilatlar_tutar"]) ?>TL</b>

                            <span
                            class="bg-primary px-2 mx-2">Açıklama</span><?php echo htmlspecialchars($dosyaekgetir["tahsilatlar_detay"]) ?>
                        </p>
                    <?php } ?>

                <?php } ?>

            </div>

        </div>

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
                <!-- <li class="nav-item">
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
            <div class="dosyaek-metin">


                <?php


                $dosyaek1 = $set->dosyadetaygoster("hatirlattahkim", $_GET["id"], "*");

                while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


                    $time = strtotime($dosyaekgetir["hatirlattahkim_zaman"]);
                    $stamp = date("d-m-Y", $time);


                    if ($dosyaekgetir["hatirlattahkim_detay"] != null) { ?>



                        <p>
                            <span
                            class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo htmlspecialchars($dosyaekgetir["hatirlattahkim_detay"]) ?>
                        </p>

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
        <div class="dosyaek-metin">

            <?php


            $dosyaek1 = $set->dosyadetaygoster("hatirlatitiraz", $_GET["id"], "*");

            while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {

                $time = strtotime($dosyaekgetir["hatirlatitiraz_zaman"]);
                $stamp = date("d-m-Y", $time);


                if ($dosyaekgetir["hatirlatitiraz_detay"] != null) { ?>


                    <p>
                        <span
                        class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo htmlspecialchars($dosyaekgetir["hatirlatitiraz_detay"]) ?>
                    </p>

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
    <div class="dosyaek-metin">
        <?php


        $dosyaek1 = $set->dosyadetaygoster("hatirlattemyiz", $_GET["id"], "*");

        while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {



            $time = strtotime($dosyaekgetir["hatirlattemyiz_zaman"]);
            $stamp = date("d-m-Y", $time);


            if ($dosyaekgetir["hatirlattemyiz_detay"] != null) { ?>


                <p>
                    <span
                    class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo htmlspecialchars($dosyaekgetir["hatirlattemyiz_detay"]) ?>
                </p>

            <?php } ?>

        <?php } ?>

    </div>

</div>
<!-- <div class="tab-pane fade" id="custom-content-below-icra" role="tabpanel"
aria-labelledby="custom-content-below-icra-tab">

<div class="detail-wrapper">
    <textarea name="hatirlaticra_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Açıklama giriniz..."></textarea>
</div>
<div class="dosyaek-metin">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("hatirlaticra", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


        $time = strtotime($dosyaekgetir["hatirlaticra_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["hatirlaticra_detay"] != null) { ?>


            <p>
                <span
                class="bg-success px-2 mr-2"><?php echo $stamp ?></span><?php echo htmlspecialchars($dosyaekgetir["hatirlaticra_detay"]) ?>
            </p>

        <?php } ?>

    <?php } ?>

</div>

</div> -->
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
    olmamalıdır.Aksi halde kaydınız görüntülenmez</small></p>
</div>
<div class="dosyaek-metin">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("hatirlatadli", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


        $time = strtotime($dosyaekgetir["hatirlatadli_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["hatirlatadli_detay"] != "") { ?>


            <p>
                <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>

                <span class="bg-warning px-2 mr-2">Hatırlatma Tar.</span><b>
                    <?php echo htmlspecialchars($dosyaekgetir["hatirlatadli_tarih"]) ?></b>

                    <span
                    class="bg-primary px-2 mx-2">Açıklama</span><?php echo htmlspecialchars($dosyaekgetir["hatirlatadli_detay"]) ?>
                </p>

            <?php } ?>

        <?php } ?>

    </div>

</div>
<div class="tab-pane fade" id="custom-content-below-diger" role="tabpanel"
aria-labelledby="custom-content-below-diger-tab">

<div class="detail-wrapper">

    <label>Hatırlatma Tarihi</label>



    <input type="text" name="hatirlatdiger_tarih"
    placeholder="gg/aa/yyyy" onfocus="(this.type='date')"
    class="form-control mb-2 allow-all">

    <textarea name="hatirlatdiger_detay" style="resize: none;"
    class="table-text allow-all" cols="50" rows="3"
    placeholder="Açıklama giriniz..."></textarea>
    <p><small style="color: red">**Tarih ve açıklama alanı boş
    olmamalıdır.Aksi halde kaydınız görüntülenmez</small></p>

</div>
<div class="dosyaek-metin">
    <?php


    $dosyaek1 = $set->dosyadetaygoster("hatirlatdiger", $_GET["id"], "*");

    while ($dosyaekgetir = $dosyaek1->fetch(PDO::FETCH_ASSOC)) {


        $time = strtotime($dosyaekgetir["hatirlatdiger_zaman"]);
        $stamp = date("d-m-Y", $time);


        if ($dosyaekgetir["hatirlatdiger_detay"] != "") { ?>


            <p>
                <span class="bg-success px-2 mr-2"><?php echo $stamp ?></span>

                <span class="bg-warning px-2 mr-2">Hatırlatma
                    Tar.</span><b><?php


                    echo htmlspecialchars($dosyaekgetir["hatirlatdiger_tarih"]) ?></b>

                    <span
                    class="bg-primary px-2 mx-2">Açıklama</span><?php echo htmlspecialchars($dosyaekgetir["hatirlatdiger_detay"]) ?>
                </p>

            <?php } ?>

        <?php } ?>

    </div>

</div>
</div>
</div>

</div>
</div>
</div>

</div>

</div>
</div>
</div>



</section>
<section class=" dosya-inputs-submit my-5 mx-4">


    <?php

    $date = new DateTime();

    ?>
    <input type="hidden" name="dosya_update" value="<?php echo $date->getTimestamp(); ?>">

    <a href="dosya" class="btn btn-outline-primary mr-2 ">Geri</a>
    <button class="btn bg-gradient-success" type="submit" name="dosyaekle">Kaydet</button>

</form>
</section>
</div>

<?php require_once "footer.php";

?>
<script type="text/javascript">
    $(function() {



        $("#tazminat").change(function() {

            var val = $(this).val();


            if (val == 7) {

                $(".tazminat-secondary").css("display", "block");


            } else {
                $(".tazminat-secondary").css("display", "none");


            };


        }).change();


        $("#dosyadurum").change(function() {

            var val = $(this).val();
            if (val == 7) {

                $(".dosyadurum-secondary").css("display", "block");

            } else {
                $(".dosyadurum-secondary").css("display", "none");
            };
        }).change();


        $("#davali").change(function() {

            var val = $(this).val();
            if (val == 36) {

                $(".davali-secondary").css("display", "block");

            } else {
                $(".davali-secondary").css("display", "none");
            };
        }).change();


        $("#magdur").change(function() {

            var val = $(this).val();
            if (val == 4) {

                $(".magdur-secondary").css("display", "block");

            } else {
                $(".magdur-secondary").css("display", "none");
            };
        }).change()



    })
</script>
<script type="text/javascript">
    <?php if ($_GET["register"] == "ok") { ?>

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Kayıt Başarılı',
            showConfirmButton: false,
            timer: 1500
        })
    <?php } elseif ($_GET["register"] == "no") { ?>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Kayıt Başarısız',
            showConfirmButton: false,
            timer: 1500
        })
    <?php } ?>
</script>


</body>

</html>