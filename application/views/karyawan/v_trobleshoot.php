<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/head.php');
?>
<script type="text/javascript">
    function validasi_input(form){
        if (form.Jenis.value == ""){
            alert("Jenis troubleshooting masih kosong!");
            form.Jenis.focus();
            return (false);
        }
        if (form.Lapor.value == ""){
            alert("Tanggal lapor masih kosong!");
            form.Lapor.focus();
            return (false);
        }if (form.Pelapor.value == ""){
            alert("Pelapor masih kosong!");
            form.Pelapor.focus();
            return (false);
        }
        if (form.Teknisi.value == ""){
            alert("Teknisi penanggung jawab masih kosong!");
            form.Teknisi.focus();
            return (false);
        }
        if (form.Description.value == ""){
            alert("Description masih kosong!");
            form.Description.focus();
            return (false);
        }
    }
</script>
</head>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php
            include('template/sidebar.php');
        ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="">
                                <input type="text" name="search" id="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li>
                                <i class="ti-bell">
                                    <span id="notifNew"></span>
                                </i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="<?php echo base_url('auth/dashboard')?>">Home</a></li>
                                <li><span>Troubleshooting</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="<?php echo base_url('assets/imgProffile/');echo $this->session->userdata('imgProfile')?>" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('nama')?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url('auth/ProfilUser')?>">Profil</a>
                                <a class="dropdown-item" href="<?php echo base_url('auth/logout')?>">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->

            <div class="modal fade" id="modalTroble">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Baru</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" onsubmit="return validasi_input(this)" action="<?php echo base_url('trobleshoot/simpan_troble')?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Jenis</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Jenis Masalah" id="Jenis" name="Jenis">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Tanggal Lapor</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm monthGl" id="Lapor" name="Lapor" readonly aria-describedby="inputGroupPrepend" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Teknisi</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Teknisi" id="Teknisi" name="Teknisi">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Tanggal Perbaikan</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm monthGl" id="Perbaikan" name="Perbaikan" readonly aria-describedby="inputGroupPrepend" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">Pelapor</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Pelapor" id="Pelapor" name="Pelapor">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">Description</label>
                                <textarea class="form-control form-control-sm" id="Description" name="Description" rows="4" cols="50">
                                </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="employee_id" id="employee_id" />
                            <input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-outline-primary btn-sm" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalLaporan">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laporan</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" action="<?php echo base_url('trobleshoot/printTroubleNew')?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">From</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm monthGl" id="From" name="From" readonly aria-describedby="inputGroupPrepend" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Until</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm monthGl" id="Until" name="Until" readonly aria-describedby="inputGroupPrepend" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="insert" id="insert" value="Cetak PDF" class="btn btn-outline-primary btn-sm" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalLaporanDone">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laporan</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" action="<?php echo base_url('trobleshoot/printTroubleDone')?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">From</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm monthGl" id="FromDone" name="FromDone" readonly aria-describedby="inputGroupPrepend" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Until</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm monthGl" id="UntilDone" name="UntilDone" readonly aria-describedby="inputGroupPrepend" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="insert" id="insert" value="Cetak PDF" class="btn btn-outline-primary btn-sm" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Done</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                                            <h4 class="header-title" style="text-align: center;">Data Troubleshooting</h4>
                                            <button type="button" class="btn btn-outline-primary btn-sm add_data_troble" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalTroble">Tambah Baru</button>
                                            <!-- <a href="<?php echo base_url('trobleshoot/printTrouble'); ?>" class="btn btn-outline-primary btn-sm" style="margin-bottom: 10px;">Cetak ke PDF</a> -->
                                            <div class="single-table">
                                                <div class="table-responsive">
                                                    <table class="table text-center">
                                                        <thead class="text-uppercase bg-primary">
                                                            <tr class="text-white">
                                                                <th scope="col" style="width: 100px;">ID</th>
                                                                <th scope="col">Jenis</th>
                                                                <th scope="col">Pelapor</th>
                                                                <th scope="col">Tanggal Lapor</th>
                                                                <!-- <th scope="col">Tanggal Perbaikan</th>
                                                                <th scope="col">Teknisi</th> -->
                                                                <th scope="col">Description</th>
                                                                <th scope="col" style="width: 100px;">action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php 
                                                            $no = 1;
                                                            foreach($hotspot as $u){ 
                                                            ?>
                                                            <tr>
                                                                <th><?php echo $u->idPenanganan ?></th>
                                                                <td><?php echo $u->Jenismslh ?></td>
                                                                <td><?php echo $u->Pelapor ?></td>
                                                                <td><?php echo $u->tgllapor ?></td>
                                                                <!-- <td><?php echo $u->tgperbaikan ?></td>
                                                                <td><?php echo $u->Teknisi ?></td> -->
                                                                <td><?php echo $u->Deskripsi ?></td>
                                                                <td>
                                                                    
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <button type="submit" name="view" value="edit" id="<?php echo $u->idPenanganan ?>" class="dropdown-item view_data_troble" style="padding: 5px 7px"><i class="fa fa-edit"></i> Edit</button>
                                                                            <a href="<?php echo base_url('trobleshoot/delete_data_troble/'); echo $u->idPenanganan; ?>" onclick="return confirmation();" class="dropdown-item " style="padding: 5px 7px"><i class="fa fa-trash"></i> Delete</a>
                                                                            <a href="<?php echo base_url('trobleshoot/view_trobleDone/'); echo $u->idPenanganan; ?>" class="dropdown-item " style="padding: 5px 7px"><i class="fa fa-check-square-o"></i> Done</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                                            <button type="button" class="btn btn-outline-primary btn-sm add_data_troble" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalLaporanDone">Cetak ke PDF</button>
                                            <div class="single-table">
                                                <div class="table-responsive">
                                                    <table class="table text-center">
                                                        <thead class="text-uppercase bg-primary">
                                                            <tr class="text-white">
                                                                <th scope="col" style="width: 100px;">ID</th>
                                                                <th scope="col">Jenis</th>
                                                                <th scope="col">Pelapor</th>
                                                                <th scope="col">Tanggal Lapor</th>
                                                                <th scope="col">Tanggal Perbaikan</th>
                                                                <th scope="col">Teknisi</th>
                                                                <th scope="col">Description</th>
                                                                <!-- <th scope="col" style="width: 100px;">action</th> -->
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php 
                                                            $no = 1;
                                                            foreach($hotspotDone as $u){ 
                                                            ?>
                                                            <tr>
                                                                <th><?php echo $u->idPenanganan ?></th>
                                                                <td><?php echo $u->Jenismslh ?></td>
                                                                <td><?php echo $u->Pelapor ?></td>
                                                                <td><?php echo $u->tgllapor ?></td>
                                                                <td><?php echo $u->tgperbaikan ?></td>
                                                                <td><?php echo $u->Teknisi ?></td>
                                                                <td><?php echo $u->Deskripsi ?></td>
                                                                <!-- <td>
                                                                    <button type="submit" name="view" value="edit" id="<?php echo $u->idPenanganan ?>" class="btn btn-sm btn-primary view_data_troble" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                                    <a href="<?php echo base_url('trobleshoot/delete_data_trobleKabid/'); echo $u->idPenanganan; ?>" onclick="return confirmation();" class="btn btn-sm btn-danger " style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
                                                                </td> -->
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sales report area end -->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2020. All right reserved. Template by <a href="https://asia.ac.id/">Institut Asia Malang</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <?php
        include('template/foot.php');
    ?>
</body>

</html>
