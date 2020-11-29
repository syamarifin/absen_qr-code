<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/headDash.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/QR_Code/style.css')?>">
<script type="text/javascript" src="<?php echo base_url('assets/QR_Code/main.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/QR_Code/llqrcode.js')?>"></script>
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
                                <input type="text" name="search" placeholder="Search by date" required>
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

            <!-- Modal laporan rekap absensi -->
            <div class="modal fade" id="modalAbsensi">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Absent</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" action="<?php echo base_url('absensi/proses_absensi')?>">
                        <div class="modal-body" style="text-align: center;">
                            <input type="hidden" name="id_aslab" id="id_aslab" />
                            <input type="hidden" name="nama_aslab" id="nama_aslab" />
                            <input type="submit" name="insert" id="insert" value="Absen Masuk" class="btn btn-outline-primary btn-sm" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row mt-5">
                    <!-- latest news area start -->
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title" style="text-align: center;">SCAN QR-CODE UNTUK ABSEN</h4>
                                <div class="exhcange-rate row">
                                    <div class="col-xl-6">
                                        <div style="display:none" id="result"></div>
                                        <div class="selector" id="webcamimg" onclick="setwebcam()" align="left" ></div>
                                        <div class="selector" id="qrimg" onclick="setimg()" align="right" ></div>
                                        <center id="mainbody"><div id="outdiv"></div></center>
                                        <canvas id="qr-canvas" width="800" height="600"></canvas>
                                    </div>
                                    <div class="col-xl-6">
                                        <h4 class="header-title" style="text-align: center;">REKAP ABSENSI</h4>
                                        <div class="single-table">
                                            <div class="table-responsive">
                                                <table class="table text-center">
                                                    <thead class="text-uppercase bg-primary">
                                                        <tr class="text-white">
                                                            <th scope="col" style="width: 100px;">No</th>
                                                            <!-- <th scope="col">Nama</th> -->
                                                            <th scope="col">Tanggal</th>
                                                            <th scope="col">Masuk</th>
                                                            <th scope="col">Keluar</th>
                                                            <!-- <th scope="col" style="width: 100px;">action</th> -->
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php 
                                                        $no=0;
                                                        foreach($hotspot['rows'] as $u){ 
                                                            $no++;
                                                        ?>
                                                        <tr>
                                                            <th><?php echo $no ?></th>
                                                            <!-- <td><?php echo $u->nama ?></td> -->
                                                            <td><?php echo $u->tgl ?></td>
                                                            <td><?php echo $u->a_in ?></td>
                                                            <td><?php echo $u->a_out ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                    // Tampilkan link-link paginationnya
                                                    echo $hotspot['pagination'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- latest news area end -->
                </div>
                <!-- row area start-->
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
    <!-- Qr-Code -->
    <script type="text/javascript">load();</script>
    <!-- <script src="<?php echo base_url('assets/QR_Code/jquery-1.11.2.min.js')?>"></script> -->
    <!-- Qr-Code End -->
    <?php
            include('template/foot.php');
        ?>
</body>

</html>
