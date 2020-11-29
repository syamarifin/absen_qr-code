<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/head.php');
?>
<script type="text/javascript">
    function validasi_input(form){
        if (form.NIM.value == ""){
            alert("NIM masih kosong!");
            form.NIM.focus();
            return (false);
        }
        if (form.Nama.value == ""){
            alert("Nama anggota masih kosong!");
            form.Nama.focus();
            return (false);
        }
        if (form.Semester.value == ""){
            alert("Semester masih kosong!");
            form.Semester.focus();
            return (false);
        }
        if (form.Tempat.value == ""){
            alert("Tempat lahir masih kosong!");
            form.Tempat.focus();
            return (false);
        }
        if (form.Alamat.value == ""){
            alert("Alamat masih kosong!");
            form.Alamat.focus();
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
                                <li><span>Anggota Baru</span></li>
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

            <div class="modal fade" id="modalTroble">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Anggota Baru</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" onsubmit="return validasi_input(this)" action="<?php echo base_url('anggota/simpan_anggota')?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">NIM</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="No Induk Mahasiswa" id="NIM" name="NIM" onkeypress="return hanyaAngka(event)">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">Semester</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Semester (dalam angka)" id="Semester" name="Semester" onkeypress="return hanyaAngka(event)" >
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">Tempat Lahir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" id="Tempat" name="Tempat" placeholder="Tempat Lahir">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">Nama</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Nama" id="Nama" name="Nama">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">Jenis Kelamin</label>
                                        <select class="form-control form-control-sm" name="jk" id="jk">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm monthGl" id="Lahir" name="Lahir" readonly aria-describedby="inputGroupPrepend" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="ti-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0rem;">
                                <label for="example-text-input-sm" class="col-form-label">Nama</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Email" id="email" name="email">
                            </div>
                            <div class="form-group" style="margin-bottom: 0rem;">
                                <label for="example-text-input-sm" class="col-form-label">Alamat</label>
                                <textarea class="form-control form-control-sm" id="Alamat" name="Alamat" rows="3" cols="50"></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 0rem;">
                                <label for="example-text-input-sm" class="col-form-label">Image</label>
                                <input type="file" name="imgProfil" accept="image/*"/>
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

            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title" style="text-align: center;">Data Anggota</h4>
                                    <button type="button" class="btn btn-outline-primary btn-sm add_data_anggota" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalTroble">Tambah Baru</button>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-uppercase bg-primary">
                                                    <tr class="text-white">
                                                        <th scope="col" style="width: 100px;">ID</th>
                                                        <th scope="col">NIM</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Semester</th>
                                                        <th scope="col">Tempat Tanggal Lahir</th>
                                                        <th scope="col">Jenis Kelamin</th>
                                                        <th scope="col">Alamat</th>
                                                        <th scope="col">Image</th>
                                                        <th scope="col" style="width: 100px;">action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $no = 1;
                                                    foreach($hotspot as $u){ 
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $u->IdDaftar_a ?></th>
                                                        <td><?php echo $u->NIM ?></td>
                                                        <td><?php echo $u->Nama ?></td>
                                                        <td><?php echo $u->Semester ?></td>
                                                        <td><?php echo $u->tmptlahir.", ".$u->tgllahir ?></td>
                                                        <td><?php echo $u->Jk ?></td>
                                                        <td><?php echo $u->Alamat ?></td>
                                                        <td><img style="width: 100px;" src="<?php echo base_url().'assets/imgProffile/'. $u->img ?>"></td>
                                                        <td>
                                                            <button type="submit" name="view" value="edit" id="<?php echo $u->IdDaftar_a ?>" class="btn btn-sm btn-primary view_data_anggota" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                            <a href="<?php echo base_url('anggota/delete_data_anggota/'); echo $u->IdDaftar_a; ?>" onclick="return confirmation();" class="btn btn-sm btn-danger " style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
                                                        </td>
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
