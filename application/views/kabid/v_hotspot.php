<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/head.php');
?>
<script type="text/javascript">
    function validasi_input(form){
        if (form.NIM.value == ""){
            alert("NIM anda masih kosong!");
            form.NIM.focus();
            return (false);
        }
        if (form.password.value == ""){
            alert("Password anda masih kosong!");
            form.password.focus();
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
                            <li class="settings-btn">
                                <i class="ti-settings"></i>
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
                                <li><span>Hotspot</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="<?php echo base_url('assets/images/author/avatar.png')?>" alt="avatar">
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

            <div class="modal fade" id="exampleModalLong">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pendaftar Baru</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" onsubmit="return validasi_input(this)" action="<?php echo base_url('hotspot/simpan_hotspot')?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">NIM</label>
                                <input class="form-control form-control-sm" type="text" placeholder="No Induk Mahasiswa" id="NIM" name="NIM">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">Password</label>
                                <input class="form-control form-control-sm" type="password" placeholder="Password" id="password" name="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button id="form_submit" class="btn btn-outline-primary btn-sm" type="submit">Simpan</button> -->
                            <input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-outline-primary btn-sm" />
                            <!-- <a href="#" aria-expanded="true"><i class="ti-bookmark-alt"></i><span>Rekap Absensi </span></a> -->
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
                                    <h4 class="header-title" style="text-align: center;">Data Pendaftaran Hotspot</h4>
                                    <!-- <button type="button" class="btn btn-outline-primary btn-sm" style="margin-bottom: 10px;" data-toggle="modal" data-target="#exampleModalLong">Pendaftar Baru</button> -->
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-uppercase bg-primary">
                                                    <tr class="text-white">
                                                        <th scope="col" style="width: 100px;">ID</th>
                                                        <th scope="col">NIM</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Password</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Status</th>
                                                        <!-- <th scope="col" style="width: 100px;">action</th> -->
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $no = 1;
                                                    foreach($hotspot as $u){ 
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $u->idDaftar_h ?></th>
                                                        <td><?php echo $u->NIM ?></td>
                                                        <td><?php echo $u->nama ?></td>
                                                        <td><?php echo $u->password ?></td>
                                                        <td><?php echo $u->tglldftr ?></td>
                                                        <td><?php echo $u->status ?></td>
                                                        <!-- <td>
                                                            <button type="submit" name="view" value="edit" id="<?php echo $u->idDaftar_h ?>" class="btn btn-sm btn-primary view_data_hotspot" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                            <a href="<?php echo base_url('hotspot/delete_data_hotspot/'); echo $u->idDaftar_h; ?>" onclick="confirmation();" class="btn btn-sm btn-danger " style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
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
