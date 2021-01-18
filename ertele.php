<?php

require_once "header.php";
require_once "navbar.php";
if ($_SESSION["user"]["user_role"] == 4) { 

	header("location:/");
	exit();
}

if (isset($_GET["table"])) {

	$id=$_GET["id"];
	$table=$_GET["table"];
	$detay=$_GET["detail"];
}

if (isset($_POST["hatirlatmaguncelle"])) {
	
	$id=$_POST["table_id"];
	$table=$_POST["table_name"];
	$value=$_POST["hatirlatma_ertele"];
	$detay=$_POST["hatirlatma_detay"];
	$set->hatirlatmaertele($table,$id,$value,$detay);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	
	<!-- Main content -->
	<div class="content mt-2">
		<div class="container-fluid pt-5">

			<a href="/" class="btn  btn-outline-primary mr-2">Geri</a>
			
			<div class="row my-5">

				<div class="col-md-4">
					<!-- Widget: user widget style 2 -->
					<div class="card card-widget widget-user-2">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-info">


							<h5>Hatırlatma Ertele</h5>
						</div>
						<div class="card-footer p-3">

							<form method="post">
								<label>Tarih ve açıklamayı güncelleyebilirsiniz</label>

								<input type="text" placeholder="gg/aa/yyyy" onfocus="(this.type='date')" name="hatirlatma_ertele" class="form-control allow-all">
								<input type="text" name="hatirlatma_detay" class="form-control allow-all mt-1" value="<?php echo $detay ?>">
								<input type="hidden" name="table_name" value="<?php echo $table ?>">
								<input type="hidden" name="table_id" value="<?php echo $id ?>">

								<button type="submit" name="hatirlatmaguncelle" class="btn btn-success mt-2 float-right">Güncelle</button>
							</form>
						</div>
						<!-- /.widget-user -->
					</div>
					<!-- /.col -->


				</div>



			</div>
		</div>

	</div>

</div>


<?php require_once "footer.php" ?>
<script type="text/javascript">
	
	<?php if ($_GET["hatirlat"]=="ok") {?>

		Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: 'Güncelleme Başarılı',
			showConfirmButton: false,
			timer: 1500
		});
		setTimeout(function(){

			window.location="/";
		}, 1600);
	<?php } else if ($_GET["hatirlat"] == "error") { ?>
		Swal.fire({
			position: 'top-end',
			icon: 'error',
			title: 'Güncelleme Başarısız',
			showConfirmButton: false,
			timer: 1600
		})

	<?php }else if ($_GET["hatirlat"] == "null") {

		?>
		Swal.fire({
			position: 'top-end',
			icon: 'error',
			title: 'Tarih giriniz',
			showConfirmButton: false,
			timer: 1600
		})
		setTimeout(function(){
			window.history.back();
		}, 1600);
	<?php } ?>

</script>
