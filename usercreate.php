<?php
require_once "header.php";


require_once "navbar.php";
if ($_SESSION["user"]["user_role"] != 5) {

  header("Location:index");
  exit;
}
if (isset($_POST["usercreate"])) {



  if ($_POST["user_password"] != $_POST["user_password_1"]) {


    header("Location:usercreate?pass=same");
  } else {


    $set->usercreate("user", $_POST);
  }
}
if (isset($_GET["id"])) {

  $id = $_GET["id"];
  $getusers = $set->registerlist("user", $id);

  $listuser = $getusers->fetch(PDO::FETCH_ASSOC);
}

if ($_GET["register"] == "ok") {

  header("refresh:1;url=user");
}



?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kullanıcı Ekle
                    </h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content dosya-inputs-content">
        <div class="row dosya-inputs-row">
            <div class="dosya-inputs-wrap">
                <div class="dosya-inputs">
                    <form action="usercreate" method="post" role="form">
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Kullanıcı Adı*</label>

                                <input type="text" class="form-control" name="user_name"
                                    value="<?php echo htmlspecialchars($listuser["user_name"]) ?>" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group ">

                            <div class="input-group">
                                <label>E-mail*</label>

                                <input type="mail" class="form-control" name="user_mail"
                                    value="<?php echo htmlspecialchars($listuser["user_mail"]) ?>" required="">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Şifre*</label>
                                <input type="password" class="form-control" name="user_password" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Şifre Tekrar*</label>
                                <input type="password" class="form-control" name="user_password_1" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="form-group ">

                            <div class="input-group">
                                <label>Yetki*</label>
                                <select name="user_role" class="form-control" required>

                                    <?php

                  if ($listuser["user_role"] == 5) { ?>

                                    <option value="5">Yönetici</option>
                                    <option value="4">Bölge Sorumlusu</option>
                                    <option value="1">Avukat</option>

                                    <?php  } else if ($listuser["user_role"] == 4) { ?>

                                    <option value="4">Bölge Sorumlusu</option>
                                    <option value="1">Avukat</option>
                                    <option value="5">Yönetici</option>

                                    <?php   } else if ($listuser["user_role"] == 1) { ?>

                                    <option value="1">Avukat</option>
                                    <option value="5">Yönetici</option>
                                    <option value="4">Bölge Sorumlusu</option>


                                    <?php  } else { ?>

                                    <option value="5">Yönetici</option>
                                    <option value="4">Bölge Sorumlusu</option>
                                    <option value="1">Avukat</option>

                                    <?php } ?>


                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Durum*</label>
                                <select name="user_status" class="form-control" required>

                                    <?php

                  if ($listuser["user_status"] == 1) { ?>

                                    <option value="1">Aktif</option>
                                    <option value="2">Devre Dışı</option>

                                    <?php  } else { ?>
                                    <option value="2">Devre Dışı</option>
                                    <option value="1">Aktif</option>

                                    <?php   } ?>

                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">
                            <button class="btn bg-gradient-success float-right" type="submit"
                                name="usercreate">Kaydet</button>
                            <a href="user" class="btn btn-outline-primary mr-2 float-right">Geri</a>

                        </div>
                    </form>
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
        <!-- /.row -->
    </section>
</div>

<?php require_once "footer.php";
?>

<script type="text/javascript">
<?php if ($_GET["register"] == "ok") { ?>

Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Kayıt Başarılı',
    showConfirmButton: false,
    timer: 1500
});
/*    var url = 'user';
$(location).prop('href', url); */
<?php } else if ($_GET["update"] == "no") { ?>
Swal.fire({
    position: 'top-end',
    icon: 'error',
    title: 'Kayıt Başarısız',
    showConfirmButton: false,
    timer: 1500
})
<?php } elseif ($_GET["pass"] == "same") { ?>
Swal.fire({
    position: 'top-end',
    icon: 'error',
    title: 'Şifreler eşleşmiyor',
    showConfirmButton: false,
    timer: 1500
})
<?php } elseif ($_GET["user"] == "same") { ?>
Swal.fire({
    position: 'top-end',
    icon: 'error',
    title: 'Bu mail adresi kayıtlı',
    showConfirmButton: false,
    timer: 1500
})
<?php } ?>
</script>
</body>

</html>