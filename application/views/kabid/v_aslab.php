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
        if (form.Telp.value == ""){
            alert("No Telp anda masih kosong!");
            form.Telp.focus();
            return (false);
        }
        if (form.Tempat.value == ""){
            alert("Tempat lahir anda masih kosong!");
            form.Tempat.focus();
            return (false);
        }
        if (form.Nama.value == ""){
            alert("Nama anda masih kosong!");
            form.Nama.focus();
            return (false);
        }
        if (form.jk.value == ""){
            alert("Jenis kelamin anda masih kosong!");
            form.jk.focus();
            return (false);
        }
        if (form.Lahir.value == ""){
            alert("Tanggal Lahir anda masih kosong!");
            form.Lahir.focus();
            return (false);
        }
        if (form.Email.value == ""){
            alert("Email anda masih kosong!");
            form.Email.focus();
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
                                <input type="text" name="search" id="search" placeholder="Search by name" required>
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
                                <li><span>Aslab</span></li>
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
            <div class="modal fade" id="modalTroble">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Anggota Baru</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" onsubmit="return validasi_input(this)" action="<?php echo base_url('aslab/simpan_aslab')?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">NIM</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="No Induk Mahasiswa" id="NIM" name="NIM" onkeypress="return hanyaAngka(event)">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label for="example-text-input-sm" class="col-form-label">No Telp</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Phone" id="Telp" name="Telp" onkeypress="return hanyaAngka(event)" >
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
                                <label for="example-text-input-sm" class="col-form-label">Email</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Email" id="email" name="email">
                            </div>
                            <!-- <div class="form-group" style="margin-bottom: 0rem;">
                                <label for="example-text-input-sm" class="col-form-label">Alamat</label>
                                <textarea class="form-control form-control-sm" id="Alamat" name="Alamat" rows="3" cols="50"></textarea>
                            </div> -->
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
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title" style="text-align: center;">Data Aslab</h4>
                                    <button type="button" class="btn btn-outline-primary btn-sm add_data_aslab" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalTroble">Tambah Baru</button>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-uppercase bg-primary">
                                                    <tr class="text-white">
                                                        <th scope="col" style="width: 100px;">ID</th>
                                                        <th scope="col">NIM</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Tempat Tanggal Lahir</th>
                                                        <th scope="col">Jenis Kelamin</th>
                                                        <th scope="col">NO Telp</th>
                                                        <th scope="col">Username</th>
                                                        <th scope="col">Password</th>
                                                        <th scope="col">image</th>
                                                        <th scope="col" style="width: 100px;">action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $no = 1;
                                                    foreach($hotspot['rows'] as $u){ 
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $u->idAslab ?></th>
                                                        <td><?php echo $u->NIM ?></td>
                                                        <td><?php echo $u->nama ?></td>
                                                        <td><?php echo $u->tempatLahir.", ".$u->tglLahir     ?></td>
                                                        <td><?php echo $u->jk ?></td>
                                                        <td><?php echo $u->noTelp ?></td>
                                                        <td><?php echo $u->username ?></td>
                                                        <td><?php echo $u->pass ?></td>
                                                        <td><img style="width: 100px;" src="<?php echo base_url().'assets/imgProffile/'. $u->profileImg ?>"></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a href="<?php echo base_url('aslab/download_qr_code/'); echo $u->idAslab; ?>"class="dropdown-item " style="padding: 5px 7px" title="unduh QR-Code"><i class="fa fa-qrcode"></i> Unduh Qr-Code</a>
                                                                    <button type="submit" name="view" value="edit" id="<?php echo $u->idAslab ?>" class="dropdown-item view_data_aslab" style="padding: 5px 7px"><i class="fa fa-edit"></i> Edit</button>
                                                                    <a href="<?php echo base_url('aslab/delete_data_aslabKabid/'); echo $u->idAslab; ?>" onclick="return confirmation();" class="dropdown-item " style="padding: 5px 7px" title="hapus aslab"><i class="fa fa-trash"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                            
                                                        </td>
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
