 <!-- Main Footer -->
 <footer class="main-footer">

     <!-- Default to the left -->
     <strong>Designed by <a href="https://orendateknoloji.com" target="_blank">OrendaTeknoloji </a>&nbsp;Demo Dosya
         Takip <?php echo date("Y") ?> |
     </strong> Tüm hakları saklıdır.
 </footer>
 </div>
 <!-- ./wrapper -->

 <!-- REQUIRED SCRIPTS -->

 <!-- jQuery -->
 <script src="plugins/jquery/jquery.min.js"></script>
 <!-- jquery UI -->
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <!-- Bootstrap 4 -->
 <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- SweetAlert2 -->
 <!-- <script src="plugins/sweetalert2/sweetalert2.min.js"></script> -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <!-- AdminLTE App -->
 <script src="dist/js/adminlte.min.js"></script>
 <script src="plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <!-- Select2 -->
 <script src="plugins/select2/js/select2.full.min.js"></script>
 <!-- Date Picker UI -->
 <script src="plugins/i18n/datepicker-tr.js"></script>


 <script src="dist/js/demo.js"></script>
 <!-- page script -->
 <script>
$(function() {

    var x = $("body").attr("id");
    if (x == "calisan") {

        $("select").attr("disabled", "''");
        $("input,textarea").attr("readonly", "''");
        $(".allow-all").removeAttr("readonly");
        $(".allow-all").removeAttr("disabled");

    } else if (x == "yonetici") {

        $("input,select,textarea").removeAttr("readonly");
        $("select").removeAttr("disabled");

    }

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({

            placeholder: 'Evrak Seçiniz'
        });

    });
});
 </script>