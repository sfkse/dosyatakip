</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed" <?php if ($_SESSION["user"]["user_role"] == 5) {

                                                                                echo 'id="yonetici"';
                                                                            } elseif ($_SESSION["user"]["user_role"] == 1 || $_SESSION["user"]["user_role"] == 4) {

                                                                                echo 'id="calisan"';
                                                                            }

                                                                            ?>>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>





            <div class="navbar-nav ml-auto">

                <?php




                $tahkim = $set->tablelist("hatirlattahkim");
                $temyiz = $set->tablelist("hatirlattemyiz");
                // $icra = $set->tablelist("hatirlaticra");
                $itiraz = $set->tablelist("hatirlatitiraz");
                $adli = $set->tablelist("hatirlatadli");
                $diger = $set->tablelist("hatirlatdiger");




                $current = time();

                $days_always = 60 * 60 * 24 * 15;  // 15 gün boyunca hergün ikaz


                /*---15 günde bir ikaz---*/
                while ($getir = $tahkim->fetch(PDO::FETCH_ASSOC)) {


                    $time = strtotime($getir["hatirlattahkim_zaman"]);

                    $due1 = $days_always + $time;

                    if ($current >= $due1 - (60 * 60 * 24 * 8) && $current < $due1 - (60 * 60 * 24 * 5) && $getir["hatirlattahkim_status"] == 0 && $getir["hatirlattahkim_detay"] != null) {

                        $id1[] = "hatirlattahkim_id";
                        $id_value1[] = $getir["hatirlattahkim_id"];



                        $table_name1[] = "hatirlattahkim";

                        $duedate1[] = $due1;
                    } else if ($current >= $due1 - (60 * 60 * 24 * 5) && $current <= $due1 + (60 * 60 * 24) && $getir["hatirlattahkim_detay"] != null && $getir["hatirlattahkim_status"] == 0) {

                        $id2[] = "hatirlattahkim_id";
                        $id_value2[] = $getir["hatirlattahkim_id"];


                        $table_name2[] = "hatirlattahkim";
                        $duedate2[] = $due1;
                    } else if ($current > $due1 + (60 * 60 * 24) && $getir["hatirlattahkim_detay"] != null && $getir["hatirlattahkim_status"] == 0) {

                        $id3[] = "hatirlattahkim_id";
                        $id_value3[] = $getir["hatirlattahkim_id"];


                        $table_name3[] = "hatirlattahkim";
                        $duedate3[] = $due1;
                    }
                }


                while ($getir1 = $temyiz->fetch(PDO::FETCH_ASSOC)) {


                    $time = strtotime($getir1["hatirlattemyiz_zaman"]);


                    $due2 = $days_always + $time;


                    if ($current < $due2 - (60 * 60 * 24 * 15) &&  $getir1["hatirlattemyiz_status"] == 0 && $getir1["hatirlattemyiz_detay"] != null) {

                        $id1[] = "hatirlattemyiz_id";
                        $id_value1[] = $getir1["hatirlattemyiz_id"];


                        $table_name1[] = "hatirlattemyiz";
                        $duedate1[] = $due2;
                    } else if ($current >= $due2 - (60 * 60 * 24 * 15) && $current <= $due2 + (60 * 60 * 24) && $getir1["hatirlattemyiz_status"] == 0   && $getir1["hatirlattemyiz_detay"] != null) {


                        $id2[] = "hatirlattemyiz_id";
                        $id_value2[] = $getir1["hatirlattemyiz_id"];



                        $table_name2[] = "hatirlattemyiz";
                        $duedate2[] = $due2;
                    } else if ($current > $due2 + (60 * 60 * 24) && $getir1["hatirlattemyiz_status"] == 0   && $getir1["hatirlattemyiz_detay"] != null) {


                        $id3[] = "hatirlattemyiz_id";
                        $id_value3[] = $getir1["hatirlattemyiz_id"];



                        $table_name3[] = "hatirlattemyiz";
                        $duedate3[] = $due2;
                    }
                }

                /*---15 gün boyunca ikaz---*/
                // while ($getir2 = $icra->fetch(PDO::FETCH_ASSOC)) {


                //     $time = strtotime($getir2["hatirlaticra_zaman"]);


                //     $due3 = $days_always + $time;

                //     if ($current < $due3 - (60 * 60 * 24 * 5) && $getir2["hatirlaticra_status"] == 0   && $getir2["hatirlaticra_detay"] != null) {

                //         $id1[] = "hatirlaticra_id";
                //         $id_value1[] = $getir2["hatirlaticra_id"];


                //         $table_name1[] = "hatirlaticra";
                //         $duedate1[] = $due3;
                //     } else if ($current >= $due3 - (60 * 60 * 24 * 3) && $current <= $due3 + (60 * 60 * 24) && $getir2["hatirlaticra_status"] == 0   && $getir2["hatirlaticra_detay"] != null) {


                //         $id2[] = "hatirlaticra_id";
                //         $id_value2[] = $getir2["hatirlaticra_id"];


                //         $table_name2[] = "hatirlaticra";
                //         $duedate2[] = $due3;
                //     } else if ($current > $due3 + (60 * 60 * 24) && $getir2["hatirlaticra_status"] == 0   && $getir2["hatirlaticra_detay"] != null) {


                //         $id3[] = "hatirlaticra_id";
                //         $id_value3[] = $getir2["hatirlaticra_id"];


                //         $table_name3[] = "hatirlaticra";
                //         $duedate3[] = $due3;
                //     }
                // }

                /*---Her gün ikaz---*/
                while ($getir3 = $itiraz->fetch(PDO::FETCH_ASSOC)) {


                    $time = strtotime($getir3["hatirlatitiraz_zaman"]);


                    $due4 = (60 * 60 * 24 * 10) + $time;

                    if ($current < $due4 - (60 * 60 * 24 * 10)  && $getir3["hatirlatitiraz_status"] == 0   && $getir3["hatirlatitiraz_detay"] != null) {

                        $id1[] = "hatirlatitiraz_id";
                        $id_value1[] = $getir3["hatirlatitiraz_id"];



                        $table_name1[] = "hatirlatitiraz";
                        $duedate1[] = $due4;
                    } else if ($current >= $due4 - (60 * 60 * 24 * 10)  && $current <= $due4 + (60 * 60 * 24) && $getir3["hatirlatitiraz_status"] == 0   && $getir3["hatirlatitiraz_detay"] != null) {

                        $id2[] = "hatirlatitiraz_id";
                        $id_value2[] = $getir3["hatirlatitiraz_id"];


                        $table_name2[] = "hatirlatitiraz";
                        $duedate2[] = $due4;
                    } else if ($current > $due4 + (60 * 60 * 24)  && $getir3["hatirlatitiraz_status"] == 0   && $getir3["hatirlatitiraz_detay"] != null) {

                        $id3[] = "hatirlatitiraz_id";
                        $id_value3[] = $getir3["hatirlatitiraz_id"];


                        $table_name3[] = "hatirlatitiraz";
                        $duedate3[] = $due4;
                    }
                }
                /*---belirlenen zamanda hatırlat---*/
                while ($getir4 = $adli->fetch(PDO::FETCH_ASSOC)) {


                    $notiftime1 = strtotime($getir4["hatirlatadli_tarih"]);



                    if ($current >= $notiftime1 - (60 * 60 * 24 * 5) && $current < $notiftime1 - (60 * 60 * 24 * 3) && $getir4["hatirlatadli_tarih"] != 0  && $getir4["hatirlatadli_status"] == 0   && $getir4["hatirlatadli_detay"] != null) {

                        $id1[] = "hatirlatadli_id";
                        $id_value1[] = $getir4["hatirlatadli_id"];


                        $table_name1[] = "hatirlatadli";
                        $duedate1[] = $notiftime1;
                    } else if ($current >= $notiftime1 - (60 * 60 * 24 * 3)  && $current <= $notiftime1 + (60 * 60 * 24) && $getir4["hatirlatadli_tarih"] != 0  && $getir4["hatirlatadli_status"] == 0   && $getir4["hatirlatadli_detay"] != null) {

                        $id2[] = "hatirlatadli_id";
                        $id_value2[] = $getir4["hatirlatadli_id"];


                        $table_name2[] = "hatirlatadli";
                        $duedate2[] = $notiftime1;
                    } else if ($current > $notiftime1 + (60 * 60 * 24)  && $getir4["hatirlatadli_status"] == 0 && $getir4["hatirlatadli_tarih"] != 0   && $getir4["hatirlatadli_detay"] != null) {

                        $id3[] = "hatirlatadli_id";
                        $id_value3[] = $getir4["hatirlatadli_id"];


                        $table_name3[] = "hatirlatadli";
                        $duedate3[] = $notiftime1;
                    }
                }
                /*---belirlenen zamanda hatırlat---*/
                while ($getir5 = $diger->fetch(PDO::FETCH_ASSOC)) {


                    $notiftime2 = strtotime($getir5["hatirlatdiger_tarih"]);



                    if ($current >= $notiftime2  && $current <= $notiftime2 + (60 * 60 * 24) && $getir5["hatirlatdiger_tarih"] != 0 && $getir5["hatirlatdiger_status"] == 0   && $getir5["hatirlatdiger_detay"] != null) {

                        $id2[] = "hatirlatdiger_id";
                        $id_value2[] = $getir5["hatirlatdiger_id"];


                        $table_name2[] = "hatirlatdiger";
                        $duedate2[] = $notiftime2;
                    } else if ($current > $notiftime2 + (60 * 60 * 24)  && $getir5["hatirlatdiger_status"] == 0 && $getir5["hatirlatdiger_tarih"] != 0  && $getir5["hatirlatdiger_detay"] != null) {

                        $id3[] = "hatirlatdiger_id";
                        $id_value3[] = $getir5["hatirlatdiger_id"];


                        $table_name3[] = "hatirlatdiger";
                        $duedate3[] = $notiftime2;
                    }
                }
                /*print_r($id_value3);
                exit();*/

                if (count($id_value1) > 0 && $_SESSION["user"]["user_role"] == 5) { ?>

                <a href="index" class="btn btn-gradient bg-warning mr-3">
                    <i class="fas fa-exclamation-triangle"></i>

                    Yaklaşan aktivite
                </a>

                <?php }



                if (count($id_value2) > 0 && $_SESSION["user"]["user_role"] == 5) { ?>



                <a href="index" style="background: #ed7600" class="btn text-dark btn-gradient mr-3">
                    <i class="fas fa-exclamation-circle"></i>
                    Kritik süre
                </a>



                <?php }
                if (count($id_value3) > 0 && $_SESSION["user"]["user_role"] == 5) { ?>



                <a href="index" class="btn btn-gradient bg-danger mr-3">
                    <i class="fas fa-exclamation-circle"></i>
                    Süre Doldu
                </a>



                <?php } ?>




            </div>





        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index" class="brand-link">
                <div class="object-container">
                    <!-- <object type="image/svg+xml" data="media/oz_hukuk.svg" class="logo-svg profile-user-img  bg-light img-fluid"> --></object>
                </div>
                <div class="brand-container"> <span class="brand-text info font-weight-light">Demo Dosya
                        Takip</span></div>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="info mx-auto">
                        <a href="profile" class="d-block">Hoşgeldiniz,
                            <?php echo ucwords_tr($_SESSION["user"]["user_name"]) ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview ">
                            <a href="index" class="nav-link">
                                <i class="fas fa-chart-line"></i>
                                <p>
                                    Ana Sayfa

                                </p>
                            </a>

                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="dosya" class="nav-link">
                                <i class="fas fa-gavel"></i>
                                <p>
                                    Dosyalar

                                </p>
                            </a>

                        </li>
                        <?php if ($_SESSION["user"]["user_role"] == 5) { ?>

                        <li class="nav-item has-treeview ">
                            <a href="user" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Kullanıcılar

                                </p>
                            </a>

                        </li>

                        <?php } ?>
                        <li class="nav-item has-treeview ">
                            <a href="profile" class="nav-link">
                                <i class="fas fa-user"></i>
                                <p>
                                    Profil

                                </p>
                            </a>

                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="logout" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>
                                    Çıkış

                                </p>
                            </a>

                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>