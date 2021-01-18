<?php require_once "header.php";

require_once "navbar.php";
if ($_SESSION["user"]["user_role"] != 5) {

    header("Location:index");
    exit;
}
$usercol = ["user_name", "user_mail"];

$get = $set->tablelist("user");


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kullanıcılar</h1>
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
                            <a href="usercreate"><button type="submit" class="btn btn-success float-right">+ Kullanıcı
                                    Ekle</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Eklenme Zamanı</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>E-mail</th>
                                        <th>Yetki</th>
                                        <th>Durum</th>
                                        <th>Seçenekler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($getusers = $get->fetch(PDO::FETCH_ASSOC)) { ?>

                                    <tr>
                                        <td data-sort="<?php echo strtotime($getusers["user_time"]) ?>">
                                            <?php echo date("d-m-Y H:i:s", strtotime($getusers["user_time"])) ?>
                                        </td>
                                        <td> <?php echo ucwords_tr(htmlspecialchars($getusers["user_name"])) ?></td>
                                        <td> <?php echo htmlspecialchars($getusers["user_mail"]) ?></td>

                                        <td>


                                            <?php

                                                if ($getusers["user_role"] == 5) { ?>

                                            <span>Yönetici</span>

                                            <?php } elseif ($getusers["user_role"] == 1) { ?>

                                            <span>Avukat</span>


                                            <?php } elseif ($getusers["user_role"] == 4) { ?>

                                            <span>Bölge Sorumlusu</span>


                                            <?php } ?>



                                        </td>

                                        <td>
                                            <?php

                                                if ($getusers["user_status"] == 1) { ?>

                                            <span class="bg-success px-3 py-1">Aktif</span>

                                            <?php } elseif ($getusers["user_status"] == 2) { ?>

                                            <span class="bg-danger px-3 py-1">Devre Dışı</span>


                                            <?php } ?>

                                        </td>
                                        <td>
                                            <a href="userupdate?id=<?php echo $getusers["user_id"] ?>"><button
                                                    class="btn btn-sm bg-gradient-primary"><i
                                                        class="fas fa-search"></i></button></a>



                                            <button type="button" data-id="<?php echo $getusers["user_id"] ?>  "
                                                data-table="user" class="btn btn-sm bg-gradient-danger delete"><i
                                                    class="fas fa-trash-alt"></i></button>


                                        </td>
                                    </tr>



                                    <?php } ?>

                                </tbody>

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
$("#example1").DataTable({
    "order": [
        [0, "desc"]
    ],
    "responsive": true,
    "autoWidth": false,
    language: {
        url: "lang/lang.json"
    }

});


var table = $('#tablo').DataTable({
    pageLength: 25
});

$('#tablo_filter input').keyup(function() {
    table
        .search(
            jQuery.fn.DataTable.ext.type.search.string(this.value)
        )
        .draw();
});
$(function() {

    $("body").on("click", ".delete", function() {

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
                        "del": id,
                        "table": table

                    },
                    success: function(response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Kullanıcı silindi',
                            showConfirmButton: false,
                            timer: 1500
                        })
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