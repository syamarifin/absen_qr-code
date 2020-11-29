<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/head.php');
?>
<style type="text/css">
    .hiddenButton {
        visibility: hidden;
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
                            <!-- <form action="">
                                <input type="text" name="search" id="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form> -->
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
                                <li><span>Jadwal</span></li>
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

            <div class="main-content-inner">
                <!-- sales report area start -->
                <!-- <div class="sales-report-area mt-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" onsubmit="return validasi_input(this)">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="example-text-input-sm" class="col-form-label">Aslab</label>
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" required name="Aslab" id="Aslab">
                                                    <option value="" disabled diselected>-- Pilih Aslab --</option>
                                                    <?php                                
                                                    foreach ($dd_aslab as $row) {  
                                                      echo "<option value='".$row->idAslab."'>".$row->nama."</option>";
                                                      }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="example-text-input-sm" class="col-form-label">Jadwal</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm monthJadwal" id="Jadwal"name="Jadwal" value="<?php echo date('l, Y-m-d'); ?>" readonly aria-describedby="inputGroupPrepend" required="">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="example-text-input-sm" class="col-form-label">Sift</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Jadwal Sift" id="Sift" name="Sift">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="example-text-input-sm" class="col-form-label">Lokasi</label>
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" required name="lokasi" id="lokasi">
                                                    <option value="Kampus 1">Kampus 1</option>
                                                    <option value="Kampus 2">Kampus 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="hidden" name="employee_id" id="employee_id" />
                                            <input type="submit" name="insert" id="insert" value="Simpan Jadwal" class="btn btn-outline-primary btn-sm" />
                                            <input type="submit" name="cencel" id="cencel" value="Batal" class="btn btn-outline-primary btn-sm hiddenButton add_data_jadwal" />
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title" style="text-align: center;">Data Jadwal</h4>
                                    
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-uppercase bg-primary">
                                                    <tr class="text-white">
                                                        <!-- <th scope="col" style="width: 100px;">No</th>
                                                        <th scope="col">ID AsLab</th>
                                                        <th scope="col">Nama</th> -->
                                                        <th scope="col">Jadwal</th>
                                                        <th scope="col">Lokasi</th>
                                                        <th scope="col">Shift</th>
                                                        <!-- <th scope="col" style="width: 100px;">action</th> -->
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $no = 1;
                                                    foreach($hotspot['rows'] as $u){ 
                                                    ?>
                                                    <tr>
                                                        <!-- <th><?php echo $u->idjadwal ?></th>
                                                        <td><?php echo $u->idAslab ?></td>
                                                        <td><?php echo $u->nama ?></td> -->
                                                        <td><?php echo $u->Jadwal ?></td>
                                                        <td><?php echo $u->lokasi ?></td>
                                                        <td><?php echo $u->shift ?></td>
                                                        <!-- <td>
                                                            <button type="submit" name="view" value="edit" id="<?php echo $u->idjadwal ?>" class="btn btn-sm btn-primary view_data_jadwal" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                            <a href="<?php echo base_url('jadwal/delete_data_jadwal/'); echo $u->idjadwal; ?>" onclick="return confirmation();" class="btn btn-sm btn-danger " style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
                                                        </td> -->
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
