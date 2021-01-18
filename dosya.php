<?php require_once "header.php";
require_once "navbar.php";

if ($_SESSION["user"]["user_role"] == 4) {


    $role = ["user_id2" => $_SESSION["user"]["user_id"]];
    $getir = $set->tablelist("dosya", ["*"], $role, "order by dosya_id desc");
} else {


    $col = ["*"];
    $getir = $set->tablelist("dosya", $col, null, "order by dosya_id desc");
}
// elseif ($_SESSION["user"]["user_role"] == 1) {


//     $role = ["user_id" => $_SESSION["user"]["user_id"]];
//     $getir = $set->tablelist("dosya", ["*"], $role, "order by dosya_id desc");
// }


if (isset($_GET["del_id"])) {

    $details = ["gelisme", "adlitip", "ceza", "manevi", "hatirlattahkim", "hatirlatitiraz", "hatirlattemyiz", "hatirlaticra", "hatirlatdiger", "hatirlatadli", "eksikevrak", "tahsilatlar"];

    $dosya_id = [$_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"], $_GET["del_id"]];

    $set->deletedetails($details, $dosya_id);

    $set->delete("dosya", $_GET["del_id"]);
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dosyalar</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if ($_SESSION["user"]["user_role"] == 5 || $_SESSION["user"]["user_role"] == 1) { ?>

                            <a href="dosyaekle"><button type="submit" class="btn bg-gradient-success  float-right">+
                                    Dosya Ekle</button></a>

                            <?php } ?>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x: auto;">



                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Dosya No</th>
                                        <th>Dosya Durumu</th>
                                        <th>Sor. Avukat</th>
                                        <th>Bölge Sor.</th>
                                        <th>Müvekkil</th>
                                        <th>Dava No</th>
                                        <th>İl</th>
                                        <th>Geliş Tarihi</th>
                                        <th>Geliş Tarihi(Ay Bazında)</th>
                                        <th>Davalı</th>
                                        <th>Mağdur. Konumu</th>
                                        <th>Taz. Türü</th>
                                        <th>Eklenme Zamanı</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($dosya = $getir->fetch(PDO::FETCH_ASSOC)) { ?>


                                    <tr>
                                        <td class="option-btn">
                                            <a href="dosyaduzenle?id=<?php echo  $dosya["dosya_id"] ?>"><button
                                                    class="btn btn-sm bg-gradient-primary mr-1"><i
                                                        class="fas fa-search"></i></button></a>

                                            <?php if ($_SESSION["user"]["user_role"] == 5) { ?>

                                            <button type="button" data-id="<?php echo $dosya["dosya_id"] ?>  "
                                                data-table="dosya"
                                                data-table-detail='gelisme, adlitip, ceza, manevi, hatirlattahkim, hatirlatitiraz, hatirlattemyiz, hatirlaticra, hatirlatdiger, hatirlatadli, eksikevrak, tahsilatlar'
                                                class="btn btn-sm bg-gradient-danger filedelete"><i
                                                    class="fas fa-trash-alt"></i></button>

                                            <?php } ?>
                                        </td>

                                        <td><?php echo htmlspecialchars(strip_tags($dosya["dosya_no"])) ?></td>
                                        <td><?php

                                                if ($dosya["durum_id"] == 7) {
                                                    echo ucwords_tr($dosya["dosya_durumdiger"]);
                                                } else {


                                                    $get = $set->tablelist("durum");

                                                    while ($durumgetir = $get->fetch(PDO::FETCH_ASSOC)) {

                                                        if ($durumgetir["durum_id"] == $dosya["durum_id"]) {

                                                            echo $durumgetir["durum_ad"];
                                                        }
                                                    }
                                                }


                                                ?>
                                        </td>
                                        <td><?php

                                                $get = $set->tablelist("user");

                                                while ($durumgetir = $get->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($durumgetir["user_id"] == $dosya["user_id"] && $durumgetir["user_status"] == 1) {

                                                        echo ucwords_tr(htmlspecialchars($durumgetir["user_name"]));
                                                    }
                                                }
                                                ?>
                                        </td>
                                        <td><?php

                                                $get = $set->tablelist("user");

                                                while ($durumgetir = $get->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($durumgetir["user_id"] == $dosya["user_id2"] && $durumgetir["user_status"] == 1) {

                                                        echo  ucwords_tr(htmlspecialchars($durumgetir["user_name"]));
                                                    }
                                                }
                                                ?>
                                        </td>
                                        <td><?php echo ucwords_tr(htmlspecialchars($dosya["dosya_muvekkil"])) ?></td>
                                        <td><?php echo htmlspecialchars(strip_tags($dosya["dosya_davano"])) ?></td>




                                        <td><?php

                                                $get = $set->tablelist("iller");

                                                while ($durumgetir = $get->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($durumgetir["iller_id"] == $dosya["iller_id"]) {

                                                        echo $durumgetir["iller_ad"];
                                                    }
                                                }
                                                ?></td>
                                        <?php

                                            if ($dosya["dosya_gelistarih"] == "") { ?>

                                        <td><?php echo " "; ?></td>



                                        <?php } else { ?>

                                        <td>
                                            <?php echo date("d-m-Y", strtotime(htmlspecialchars($dosya["dosya_gelistarih"]))) ?>

                                        </td>
                                        <?php } ?>
                                        <?php

                                            if ($dosya["dosya_gelistarih"] == "") { ?>

                                        <td><?php echo " "; ?></td>



                                        <?php } else { ?>

                                        <td>
                                            <?php echo date("m-Y", strtotime(htmlspecialchars($dosya["dosya_gelistarih"]))) ?>

                                        </td>
                                        <?php } ?>

                                        <td><?php
                                                if ($dosya["sigorta_id"] == 36) {
                                                    echo ucwords_tr($dosya["dosya_sgrtdiger"]);
                                                } else {
                                                    $get = $set->tablelist("sigorta");

                                                    while ($durumgetir = $get->fetch(PDO::FETCH_ASSOC)) {

                                                        if ($durumgetir["sigorta_id"] == $dosya["sigorta_id"]) {

                                                            echo $durumgetir["sigorta_ad"];
                                                        }
                                                    }
                                                }


                                                ?></td>
                                        <td><?php


                                                $get = $set->tablelist("magdur");

                                                while ($durumgetir = $get->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($durumgetir["magdur_id"] == $dosya["magdur_id"]) {

                                                        echo $durumgetir["magdur_konum"];
                                                    }
                                                }
                                                ?></td>
                                        <td><?php

                                                $get = $set->tablelist("tazminat");

                                                while ($durumgetir = $get->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($durumgetir["tazminat_id"] == $dosya["tazminat_id"]) {

                                                        echo $durumgetir["tazminat_ad"];
                                                    }
                                                }


                                                ?></td>
                                        <td data-sort="<?php echo strtotime($dosya["dosya_zaman"]) ?>">

                                            <?php echo date("d-m-Y H:i:s", strtotime($dosya["dosya_zaman"])) ?>
                                        </td>

                                    </tr>

                                    <?php } ?>


                                </tbody>
                                <tfoot>
                                    <tr class="sort">
                                        <th></th>
                                        <th>Dosya No</th>
                                        <th>Dosya Durumu</th>
                                        <th>Sor. Avukat</th>
                                        <th>Bölge Sor.</th>
                                        <th>Müvekkil</th>
                                        <th>Dava No</th>
                                        <th>İl</th>
                                        <th>Geliş Tarihi</th>
                                        <th>Geliş Tarihi(Ay Bazında)</th>
                                        <th>Davalı</th>
                                        <th>Mağdur. Konumu</th>
                                        <th>Taz. Türü</th>
                                        <th>Eklenme Zamanı</th>

                                    </tr>
                                </tfoot>
                            </table>



                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>




<?php require_once "footer.php" ?>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
        "order": [
            [13, "desc"]
        ],
        language: {
            url: "lang/lang.json"
        },

        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }

    });

    $("body").on("click", ".filedelete", function() {

        var id = $(this).attr("data-id");
        var table = $(this).attr("data-table");
        var data = $(".filedelete").attr("data-table-detail");
        var str = data.split(",");

        var new_str = JSON.stringify(str);
        var del_details = JSON.stringify([id, id, id, id, id, id, id, id, id, id,
            id, id
        ]);


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
                        "del": id,
                        "table": table,
                        "detail_table": new_str,
                        "detail_ids": del_details

                    },
                    success: function(response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Dosya silindi',
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



    })
})
</script>

</body>

</html>