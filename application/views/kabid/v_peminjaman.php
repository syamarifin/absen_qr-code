<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/head.php');
?>
<script type="text/javascript">
    function validasi_input(form){
        if (form.NIM.value == ""){
            alert("NIM Peminjam masih kosong!");
            form.NIM.focus();
            return (false);
        }
        if (form.Nama.value == ""){
            alert("Nama Peminjam masih kosong!");
            form.Nama.focus();
            return (false);
        }
        if (form.Keperluan.value == ""){
            alert("Keperluan Peminjaman masih kosong!");
            form.Keperluan.focus();
            return (false);
        }

        if (form.FromDone.value == ""){
            // alert("Nama anggota masih kosong!");
            form.FromDone.focus();
            return (false);
        }

        if (form.UntilDone.value == ""){
            // alert("Nama anggota masih kosong!");
            form.UntilDone.focus();
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
                                    <span id="notifNew"> </span>
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
                                <li><span>Inventaris</span></li>
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
            <div class="modal fade" id="modalPeminjaman">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Peminjaman Baru</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" onsubmit="return validasi_input(this)" action="<?php echo base_url('peminjaman/simpan_peminjamanKabid')?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">NIM</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="No Induk Mahasiswa" id="NIM" name="NIM" onkeypress="return hanyaAngka(event)" >
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Nama</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Nama Mahasiswa" id="Nama" name="Nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Keperluan</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Keperluan" id="Keperluan" name="Keperluan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="employee_id" id="employee_id" />
                            <input type="submit" name="insert" id="insert" value="Add Barang" class="btn btn-outline-primary btn-sm" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>

                        <!-- Modal laporan rekap absensi -->
            <div class="modal fade" id="modalLaporanDone">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laporan</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" onsubmit="return validasi_input(this)" action="<?php echo base_url('peminjaman/printPinjamRekap')?>">
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
                                    <h4 class="header-title" style="text-align: center;">Data Peminjaman</h4>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#new" class="nav-link active" data-toggle="tab">New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#done" class="nav-link" data-toggle="tab">Done</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="new">
                                            <br>
                                            <button type="button" class="btn btn-outline-primary btn-sm add_data_pinjam" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalPeminjaman">Tambah Baru</button>
                                            <!-- <a href="<?php echo base_url('peminjaman/printPinjamRekap');?>" class="btn btn-outline-primary btn-sm " style="margin-bottom: 10px;">Cetak ke PDF</a> -->
                                            <div class="single-table">
                                                <div class="table-responsive">
                                                    <table class="table text-center">
                                                        <thead class="text-uppercase bg-primary">
                                                            <tr class="text-white">
                                                                <th scope="col" style="width: 100px;">ID</th>
                                                                <th scope="col">NIM</th>
                                                                <th scope="col">Nama</th>
                                                                <th scope="col">Keperluan</th>
                                                                <th scope="col">Tgl Pinjam</th>
                                                                <!-- <th scope="col">Penerima</th> -->
                                                                <th scope="col">ITEM</th>
                                                                <th scope="col" style="width: 150px;">action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php 
                                                            $no = 1;
                                                            foreach($hotspot as $u){ 
                                                            ?>
                                                            <tr>
                                                                <th><?php echo $u->idPinjam  ?></th>
                                                                <td><?php echo $u->NIM ?></td>
                                                                <td><?php echo $u->Nama_peminjam ?></td>
                                                                <td><?php echo $u->keperluan ?></td>
                                                                <td><?php echo $u->tglPinjam ?></td>
                                                                <!-- <td><?php echo $u->penerima ?></td> -->
                                                                <td><?php echo $u->totItem ?></td>
                                                                <td>
                                                                    <a href="<?php echo base_url('peminjaman/pengembalianKabid/'); echo $u->idPinjam; ?>" class="btn btn-sm btn-info " title="Pengembalian" style="padding: 5px 7px"><i class="fa fa-mail-reply" ></i></a>
                                                                    <button type="submit" name="view" value="edit" id="<?php echo $u->idPinjam ?>" class="btn btn-sm btn-primary view_data_pinjam" title="Edit" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                                    <a href="<?php echo base_url('peminjaman/delete_pinjam/'); echo $u->idPinjam; ?>" class="btn btn-sm btn-danger " title="Delete" style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
                                                                    <a href="<?php echo base_url('peminjaman/add_peminjamanKabid/'); echo $u->idPinjam; ?>" class="btn btn-sm btn-info " title="Edit Detail" style="padding: 5px 7px"><i class="fa fa-file-text"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="done">
                                            <br>
                                            <button type="button" class="btn btn-outline-primary btn-sm " style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalLaporanDone">Cetak ke PDF</button>
                                            <div class="single-table">
                                                <div class="table-responsive">
                                                    <table class="table text-center">
                                                        <thead class="text-uppercase bg-primary">
                                                            <tr class="text-white">
                                                                <th scope="col" style="width: 100px;">ID</th>
                                                                <th scope="col">NIM</th>
                                                                <th scope="col">Nama</th>
                                                                <th scope="col">Keperluan</th>
                                                                <th scope="col">Tgl Pinjam</th>
                                                                <th scope="col">Tgl Kembali</th>
                                                                <th scope="col">Penerima</th>
                                                                <th scope="col">ITEM</th>
                                                                <!-- <th scope="col" style="width: 100px;">action</th> -->
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php 
                                                            $no = 1;
                                                            foreach($hotspotDone as $u){ 
                                                            ?>
                                                            <tr>
                                                                <th><?php echo $u->idPinjam  ?></th>
                                                                <td><?php echo $u->NIM ?></td>
                                                                <td><?php echo $u->Nama_peminjam ?></td>
                                                                <td><?php echo $u->keperluan ?></td>
                                                                <td><?php echo $u->tglPinjam ?></td>
                                                                <td><?php echo $u->tglKembali ?></td>
                                                                <td><?php echo $u->penerima ?></td>
                                                                <td><?php echo $u->totItem ?></td>
                                                                <!-- <td>
                                                                    <button type="submit" name="view" value="edit" id="<?php echo $u->idPinjam ?>" class="btn btn-sm btn-primary view_data_pinjam" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                                    <a href="<?php echo base_url('inventaris/delete_pinjam/'); echo $u->idPinjam; ?>" class="btn btn-sm btn-info " style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
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
