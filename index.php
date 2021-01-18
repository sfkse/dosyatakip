<?php

require_once "header.php";
require_once "navbar.php";
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><em>Panelinize Hoşgeldiniz...</em></h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php if ($_SESSION["user"]["user_role"] != 4) { ?>
    <!-- Main content -->
    <div class="content mt-2">
        <div class="container-fluid">

            <?php if ($_SESSION["user"]["user_role"] == 5) { ?>



            <div>
                <h4>İstatistikler</h4>
            </div>
            <div class="row mb-5">

                <div class="col-md-4">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-success">


                            <h5>Dosya Durumları</h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">

                                <?php


                                        $get = $set->tablelist("durum");

                                        while ($getir = $get->fetch(PDO::FETCH_ASSOC)) { ?>



                                <li class="nav-item p-2">



                                    <?php echo $getir["durum_ad"] ?>
                                    <span class="float-right badge text-md bg-success">

                                        <?php

                                                    $durum = $set->durumlar($getir["durum_id"]);


                                                    if ($durum == 0) {

                                                        echo "-";
                                                    } else {

                                                        echo  $durum;
                                                    } ?>


                                    </span>

                                </li>


                                <?php } ?>






                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <!-- /.col -->


            </div>

            <?php } ?>
            <div>
                <h4>Hatırlatmalar</h4>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Süresi Yaklaşan İşler</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body hatirlatmalar1" style="height: 300px">

                            <?php


                                if ($_SESSION["user"]["user_role"] == 1) {


                                    $role = ["user_id" => $_SESSION["user"]["user_id"]];

                                    $cols = ["dosya_id", "user_id"];

                                    $role_based = $set->tablelist("dosya", $cols, $role);

                                    $count1 = $role_based->rowCount();

                                    if ($count1) {
                                        while ($files = $role_based->fetch(PDO::FETCH_ASSOC)) {
                                            $dosya_id[] = $files["dosya_id"];
                                        }

                                        $getir1 = $set->alert($table_name1, $id1, $id_value1, $duedate1, $dosya_id);
                                    }
                                } elseif ($_SESSION["user"]["user_role"] == 5) {

                                    $getir1 = $set->alert($table_name1, $id1, $id_value1, $duedate1);
                                }

                                ?>







                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                    <div class="card">
                        <div style="background: #ed7600" class="card-header">
                            <h3 class="card-title">Kritik Süre Kalan İşler</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body hatirlatmalar2" style="height: 300px;">

                            <?php

                                if ($_SESSION["user"]["user_role"] == 1) {


                                    $role = ["user_id" => $_SESSION["user"]["user_id"]];

                                    $cols = ["dosya_id", "user_id"];

                                    $role_based = $set->tablelist("dosya", $cols, $role);
                                    $count2 = $role_based->rowCount();

                                    if ($count2) {
                                        while ($files = $role_based->fetch(PDO::FETCH_ASSOC)) {
                                            $dosya_id[] = $files["dosya_id"];
                                        }

                                        $getir2 = $set->alert($table_name2, $id2, $id_value2, $duedate2, $dosya_id);
                                    }
                                } elseif ($_SESSION["user"]["user_role"] == 5) {
                                    $getir2 = $set->alert($table_name2, $id2, $id_value2, $duedate2);
                                }

                                ?>








                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Süresi Dolan İşler</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body hatirlatmalar3" style="height: 300px;">

                            <?php

                                if ($_SESSION["user"]["user_role"] == 1) {


                                    $role = ["user_id" => $_SESSION["user"]["user_id"]];

                                    $cols = ["dosya_id", "user_id", "dosya_muvekkil"];

                                    $role_based = $set->tablelist("dosya", $cols, $role);
                                    $count3 = $role_based->rowCount();

                                    if ($count3) {
                                        while ($files = $role_based->fetch(PDO::FETCH_ASSOC)) {
                                            $dosya_id[] = $files["dosya_id"];
                                        }

                                        $getir3 = $set->alert($table_name3, $id3, $id_value3, $duedate3, $dosya_id);
                                    }
                                } elseif ($_SESSION["user"]["user_role"] == 5) {
                                    $getir3 = $set->alert($table_name3, $id3, $id_value3, $duedate3);
                                }

                                ?>






                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">45 gün boyunca işlem yapılmayanlar</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body hatirlatmalar4" style="height: 300px;">

                            <?php
                                $cols = ["dosya_no", "dosya_zaman", "dosya_id", "dosya_update", "user_id", "user_id2"];

                                if ($_SESSION["user"]["user_role"] == 1) {

                                    $role = ["user_id" => $_SESSION["user"]["user_id"]];
                                    $untouched = $set->tablelist("dosya", $cols, $role);
                                } elseif ($_SESSION["user"]["user_role"] == 5) {
                                    $untouched = $set->tablelist("dosya", $cols);
                                }




                                $row = 0;

                                while ($dosyagetir = $untouched->fetch(PDO::FETCH_ASSOC)) {

                                    if (time() >= $dosyagetir["dosya_update"] + (60 * 60 * 24 * 46)) {

                                        $row++;
                                ?>

                            <p><a href="dosyaduzenle?id=<?php echo $dosyagetir["dosya_id"] ?>">Dosya No:
                                    <?php echo $dosyagetir["dosya_no"] ?>- Eklenme Tarihi:
                                    <?php echo date("d-m-Y", strtotime($dosyagetir["dosya_zaman"])) ?> </a></p>


                            <?php }
                                }
                                if ($row == 0) {

                                    echo '<p style="text-align: center;position: relative;top: 40%"><em class="text-muted">Gösterilecek sonuç yok</em></p>';
                                } ?>





                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <?php } ?>
</div>
<!-- /.content-wrapper -->



<?php

require_once "footer.php";
?>

<script type="text/javascript">
$(function() {

    $('div.hatirlatmalar1').css("overflow-y", "auto");
    $('div.hatirlatmalar2').css("overflow-y", "auto");
    $('div.hatirlatmalar3').css("overflow-y", "auto");
    $('div.hatirlatmalar4').css("overflow-y", "auto");

    $("body").on("click", ".update-status", function() {

        var id = $(this).attr("id");
        var table = $(this).attr("data-table");

        Swal.fire({
            title: 'Hatırlatmayı kapatmak istediğinizden emin misiniz?',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {



                $.ajax({


                    type: "post",
                    url: "config/ajax.php",
                    data: {
                        "update": id,
                        "table": table

                    },
                    success: function(response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Hatırlatma kapatıldı',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        // alert(response);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);


                    }

                })
            }
        });



    });

    $("body").on("click", ".reset-timer", function() {


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mx-2'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Hatırlatmayı ertelemek istiyor musunuz?',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ertele',
            cancelButtonText: 'Hayır',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                var id = $(this).attr("id");
                var table = $(this).attr("data-table");
                var detail = $(this).siblings(".hatirlatma-link").children(".hatirlat-detay")
                    .text();

                window.location = "ertele?id=" + id + "&table=" + table + "&detail=" + detail;

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {

                var id = $(this).attr("id");
                var table = $(this).attr("data-table");
                $.ajax({


                    type: "post",
                    url: "config/ajax.php",
                    data: {
                        "update": id,
                        "table": table

                    },
                    success: function(response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Hatırlatma kapatıldı',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        // alert(response);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);


                    }

                })
            }
        })




    })

})
</script>
</body>

</html>