<?php

require_once "config/class.crud.php";
require_once "header.php";

if (isset($_POST["evrak"])) {
	
	print_r($_POST["evrak_id"]);
}
?>
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<div style="width: 500px;margin: auto;">

<form method="post" >
	<select class="js-example-basic-multiple form-control <?php if ($_SESSION["user"]["user_role"] == 1) {
		echo "allow-all";
	} ?>"
	name="evrak_id[]" multiple="multiple">

	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
</select>
<button type="submit" name="evrak">gönder</button>
</form>
</div>
<?php

include "footer.php";
?>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2({

			placeholder: 'Evrak Seçiniz'
		});

	});
</script>