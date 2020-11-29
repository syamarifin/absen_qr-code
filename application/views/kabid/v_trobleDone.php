<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/headDash.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/QR_Code/style.css')?>">
<script type="text/javascript" src="<?php echo base_url('assets/QR_Code/mainTrouble.js')?>"></script>
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
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
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
            <div class="main-content-inner">
                <div class="row mt-5">
                    <!-- latest news area start -->
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title" style="text-align: center;">SCAN QR-CODE ASLAB UNTUK DONE TROUBLESHOOT</h4>
                                <div class="exhcange-rate mt-5">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label for="example-text-input-sm" class="col-form-label">Solusi</label>
                                                <div class="input-group">
                                                    <textarea class="form-control form-control-sm" id="solusi" name="solusi" rows="4" cols="50"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div style="display:none" id="result"></div>
                                            <div class="selector" id="webcamimg" onclick="setwebcam()" align="left" ></div>
                                            <div class="selector" id="qrimg" onclick="setimg()" align="right" ></div>
                                            <center id="mainbody"><div id="outdiv"></div></center>
                                            <canvas id="qr-canvas" width="800" height="600"></canvas>
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
