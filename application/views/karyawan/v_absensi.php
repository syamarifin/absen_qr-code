<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/head.php');
?>
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
                        <!-- <div class="search-box pull-left">
                            <form action="">
                                <input type="text" name="search" id="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div> -->
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
                                <li><span>Rekap Absensi</span></li>
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

            <div class="modal fade" id="modalFilterAbsen">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Filter Absensi by</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">Nama</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Nama" id="Nama" name="Nama">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">Tanggal</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm monthGl" id="Tanggal" name="Tanggal" readonly aria-describedby="inputGroupPrepend" required="">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="filter" id="filter" value="Filter" class="btn btn-outline-primary btn-sm" />
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
                                    <h4 class="header-title" style="text-align: center;">Data Rekap Absensi</h4>
                                    <button type="button" class="btn btn-outline-primary btn-sm" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalFilterAbsen"><i class="ti-search"></i> Filter</button>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-uppercase bg-primary">
                                                    <tr class="text-white">
                                                        <th scope="col" style="width: 100px;">No</th>
                                                        <th scope="col">Id Aslab</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Tanggal</th>
                                                        <th scope="col">Masuk</th>
                                                        <th scope="col">Keluar</th>
                                                        <!-- <th scope="col" style="width: 100px;">action</th> -->
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $no=0;
                                                    foreach($hotspot as $u){ 
                                                        $no++;
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $no ?></th>
                                                        <td><?php echo $u->idAslab ?></td>
                                                        <td><?php echo $u->nama ?></td>
                                                        <td><?php echo $u->tgl ?></td>
                                                        <td><?php echo $u->a_in ?></td>
                                                        <td><?php echo $u->a_out ?></td>
                                                        <!-- <td><img style="width: 100px;" src="<?php echo base_url().'assets/QR_Code/'. $u->Qr_Code ?>"></td> -->
                                                        <!-- <td>
                                                            <button type="submit" name="view" value="edit" id="<?php echo $u->IdDaftar_a ?>" class="btn btn-sm btn-primary view_data_anggota" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                            <a href="<?php echo base_url('anggota/delete_data_anggotaKabid/'); echo $u->IdDaftar_a; ?>" onclick="confirmation();" class="btn btn-sm btn-danger " style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
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
