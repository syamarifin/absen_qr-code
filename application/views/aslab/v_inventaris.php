<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/head.php');
?>
<script type="text/javascript">
    function validasi_input(form){
        if (form.Nama.value == ""){
            alert("Nama anggota masih kosong!");
            form.Nama.focus();
            return (false);
        }
        if (form.Jumlah.value == ""){
            alert("Jumlah masih kosong!");
            form.Jumlah.focus();
            return (false);
        }
        if (form.lokasi.value == ""){
            alert("Lokasi Inventaris masih kosong!");
            form.lokasi.focus();
            return (false);
        }
        if (form.Stok.value == ""){
            alert("Stok Inventaris masih kosong!");
            form.Stok.focus();
            return (false);
        }
        if (form.Desc.value == ""){
            alert("Description masih kosong!");
            form.Desc.focus();
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
                                <input type="text" name="search" id="search" placeholder="Search by name inventaris" required>
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

            <div class="modal fade" id="modalInventaris">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Inventaris Baru</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" onsubmit="return validasi_input(this)" action="<?php echo base_url('inventaris/simpan_inventaris')?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Nama</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Nama Barang" id="Nama" name="Nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Jumlah</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="jumlah barang" id="Jumlah" name="Jumlah" onkeypress="return hanyaAngka(event)" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Lokasi</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Lokasi" id="lokasi" name="lokasi">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Stok</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="Stok barang" id="Stok" name="Stok" onkeypress="return hanyaAngka(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">Description</label>
                                <textarea class="form-control form-control-sm" id="Desc" name="Desc" rows="4" cols="50" required></textarea>
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
                                    <h4 class="header-title" style="text-align: center;">Data Inventaris</h4>
                                    <button type="button" class="btn btn-outline-primary btn-sm tambah_inventaris" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modalInventaris">Tambah Baru</button>
                                    <!-- <a href="<?php echo base_url('inventaris/printInventarisRekap');?>" class="btn btn-outline-primary btn-sm " style="margin-bottom: 10px;">Cetak ke PDF</a> -->
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-center">
                                                <thead class="text-uppercase bg-primary">
                                                    <tr class="text-white">
                                                        <th scope="col" style="width: 100px;">ID</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Stok</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Lokasi</th>
                                                        <th scope="col" style="width: 100px;">action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $no = 1;
                                                    foreach($hotspot['rows'] as $u){ 
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $u->idbarang ?></th>
                                                        <td><?php echo $u->Namabrg ?></td>
                                                        <td><?php echo $u->Jumlhbrg ?></td>
                                                        <td><?php echo (($u->Stok+$u->diKembalikan)-$u->diPinjam) ?></td>
                                                        <td><?php echo $u->Deskripsi ?></td>
                                                        <td><?php echo $u->lokasi ?></td>
                                                        <td>
                                                            <button type="submit" name="view" value="edit" id="<?php echo $u->idbarang ?>" class="btn btn-sm btn-primary view_data_inventaris" style="padding: 5px 7px"><i class="fa fa-edit"></i></button>
                                                            <a href="<?php echo base_url('inventaris/download_qr_code/'); echo $u->idbarang; ?>" class="btn btn-sm btn-info " style="padding: 5px 7px"><i class="fa fa-qrcode"></i></a>
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
