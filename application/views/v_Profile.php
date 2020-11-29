<!doctype html>
<html class="no-js" lang="en">
<?php
    if ($this->session->userdata('jabatan')=="KABID") {
        include('kabid/template/head.php');
    }else if ($this->session->userdata('jabatan')=="KARYAWAN") {
        include('karyawan/template/head.php');
    }else if ($this->session->userdata('jabatan')=="ASLAB") {
        include('aslab/template/head.php');
    }
?>
<style>
    .circle {
      border-radius: 50%;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>
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

            if ($this->session->userdata('jabatan')=="KABID") {
                include('kabid/template/sidebar.php');
            // }else if ($this->session->userdata('jabatan')=="KARYAWAN") {
            //     include('karyawan/template/sidebar.php');
            }else if ($this->session->userdata('jabatan')=="ASLAB") {
                include('aslab/template/sidebar.php');
            }
            // include('template/sidebar.php');
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
                                <li><span>Profil</span></li>
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

            <div class="modal fade" id="modalSettingPass">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Setting Password</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" onsubmit="return validasi_input(this)" action="<?php echo base_url('auth/simpan_pass')?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <!-- <label for="example-text-input-sm" class="col-form-label">Password Lama</label> -->
                                        <input class="form-control form-control-sm" type="Password" placeholder="Password Lama" id="passOld" name="passOld">
                                    </div>
                                    <hr>
                                    <div class="form-group" style="margin-bottom: 1rem;">
                                        <!-- <label for="example-text-input-sm" class="col-form-label">Password Baru</label> -->
                                        <input class="form-control form-control-sm" type="Password" placeholder="Password Baru" id="passNew" name="passNew">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <!-- <label for="example-text-input-sm" class="col-form-label">Password Baru Lagi</label> -->
                                        <div class="input-group">
                                            <input type="Password" class="form-control form-control-sm" id="passNew2" name="passNew2" placeholder="Password Baru Lagi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="settingPass" id="settingPass" value="Simpan" class="btn btn-outline-primary btn-sm" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- page title area end -->

            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title" style="text-align: center;">Profil User</h4>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <form method="post" class="needs-validation" enctype="multipart/form-data">
                                                <?php 
                                                    foreach($profile as $u){ 
                                                ?>
                                                <div class="form-group">
                                                    <img src="<?php echo base_url('assets/imgProffile/'); echo $u->profileImg ?>" alt="Paris" width="300" height="300" class="center circle">
                                                    <br>
                                                    <input type="file" name="imgProfil" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input-sm" class="col-form-label">Nama</label>
                                                    <input class="form-control form-control-sm" type="text" placeholder="Nama" id="Nama" name="Nama" value="<?php echo $u->nama; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input-sm" class="col-form-label">Tempat Lahir</label>
                                                    <input class="form-control form-control-sm" type="text" placeholder="Tempat Lahir" id="Tempat" name="Tempat" value="<?php echo $u->tempatLahir; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input-sm" class="col-form-label">Tanggal</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm monthGl" id="Tanggal" name="Tanggal" readonly aria-describedby="inputGroupPrepend" required="" value="<?php echo $u->tglLahir; ?>">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input-sm" class="col-form-label">Jenis Kelamin</label>
                                                    <select class="form-control form-control-sm" name="jk" id="jk">
                                                        <option <?php if ( $u->jk=="Laki-Laki") {
                                                            echo "Selected"; } ?> value="Laki-Laki">Laki-Laki</option>
                                                        <option <?php if ( $u->jk=="Perempuan") {
                                                            echo "Selected"; } ?> value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input-sm" class="col-form-label">No Telp</label>
                                                    <input class="form-control form-control-sm" type="text" placeholder="No Telepon" id="NoTelp" name="NoTelp" value="<?php echo $u->noTelp; ?>">
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                                <input type="submit" name="Simpan" id="Simpan" value="Simpan" class="btn btn-outline-primary btn-sm" />
                                                <button type="button" class="btn btn-outline-primary btn-sm"data-toggle="modal" data-target="#modalSettingPass">Setting Password</button>
                                            </form>
                                        </div>
                                        <div class="col-md-3"></div>
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
        if ($this->session->userdata('jabatan')=="KABID") {
            include('kabid/template/foot.php');
        }else if ($this->session->userdata('jabatan')=="KARYAWAN") {
            include('karyawan/template/foot.php');
        }else if ($this->session->userdata('jabatan')=="ASLAB") {
            include('aslab/template/foot.php');
        }
        // include('template/foot.php');
    ?>
</body>

</html>
