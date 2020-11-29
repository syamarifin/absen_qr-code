<!doctype html>
<html class="no-js" lang="en">
<?php
    include('template/headDash.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/QR_Code/style.css')?>">
<script type="text/javascript" src="<?php echo base_url('assets/QR_Code/mainKembali.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/QR_Code/llqrcode.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        const formatter = new Intl.NumberFormat( {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
        })
        var quantitiy=0;
           $('.quantity-right-plus').click(function(e){
                
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                // var price = (document.getElementById('<%=lblPrice.ClientID%>').innerHTML);
                // var totalPrice =Number(price.replace(/[^0-9\.]+/g, ""));
                var quantity    = parseInt($('#quantity').val());

                var stok        = parseInt($('#Stokbrg').val());
                console.log(stok);
                
                // If is not undefined
                    if(quantity<stok){
                        $('#quantity').val(quantity + 1);
                    }
                    // $('#NIM').val(quantity + 1);
                    // document.getElementById('<%=lblPrice.ClientID%>').innerHTML=formatter.format(totalPrice+priceDefault);
                    // console.log(totalPrice);
                  
                    // Increment
                
            });

             $('.quantity-left-minus').click(function(e){
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                // var quantity = parseInt(document.getElementById('<%=txtQyt.ClientID%>').value);
                
                // If is not undefined
              
                    // Increment
                    if(quantity>1){
                        $('#quantity').val(quantity - 1);
                    // var price = (document.getElementById('<%=lblPrice.ClientID%>').innerHTML);
                    // var totalPrice =Number(price.replace(/[^0-9\.]+/g, ""));
                    // document.getElementById('<%=txtQyt.ClientID%>').value=quantity - 1;
                    // document.getElementById('<%=lblPrice.ClientID%>').innerHTML=formatter.format(totalPrice-priceDefault);
                    }
            });
            
        });
</script>
<style type="text/css">
    .center{
        width: 150px;
        margin: 40px auto;
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

            <!-- Modal penerima pengembalian barang -->
            <div class="modal fade" id="modalKembali">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Pengembalian</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" class="needs-validation" action="<?php echo base_url('peminjaman/terima_pengembalian')?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="example-text-input-sm" class="col-form-label">Penerima</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Penerima" id="Penerima" name="Penerima">
                            </div>
                            <!-- <div class="center">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number btn-sm quantity-left-minus" data-type="minus" data-field="quant[1]">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="quantity" id="quantity" class="form-control input-number form-control-sm" style="text-align: center;" value="1" min="1" max="10">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number btn-sm quantity-right-plus" data-type="plus" data-field="quant[1]">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_barang" id="id_barang" />
                            <input type="hidden" name="jml" id="jml" />
                            <input type="submit" name="insert" id="insert" value="Terima" class="btn btn-outline-primary btn-sm" />
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
                                <h4 class="header-title" style="text-align: center;">SCAN QR-CODE BARANG UNTUK PENGEMBALIAN</h4>
                                <div class="exhcange-rate row">
                                    <div class="col-xl-6">
                                        <div style="display:none" id="result"></div>
                                        <div class="selector" id="webcamimg" onclick="setwebcam()" align="left" ></div>
                                        <div class="selector" id="qrimg" onclick="setimg()" align="right" ></div>
                                        <center id="mainbody"><div id="outdiv"></div></center>
                                        <canvas id="qr-canvas" width="800" height="600"></canvas>
                                    </div>
                                    <div class="col-xl-6">
                                        <h4 class="header-title" style="text-align: center;">PEMINJAM</h4>
                                        <?php foreach($hotspotHdr as $u){ ?>
                                            <div class="form-group">
                                                <label for="example-text-input-sm" class="col-form-label">NIM</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="No Induk Mahasiswa" id="NIM" name="NIM" readonly value="<?php echo $u->NIM ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-text-input-sm" class="col-form-label">Nama Mahasiswa</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Nama Mahasiswa" id="Nama" name="Nama" readonly value="<?php echo $u->Nama_peminjam ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-text-input-sm" class="col-form-label">Tanggal Pinjam</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Tanggal Pinjam" id="tgl" name="tgl" readonly value="<?php echo $u->tglPinjam ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-xl-12">
                                        <h4 class="header-title" style="text-align: center;">Detail</h4>
                                        <div class="single-table">
                                            <div class="table-responsive">
                                                <table class="table text-center">
                                                    <thead class="text-uppercase bg-primary">
                                                        <tr class="text-white">
                                                            <th scope="col" style="width: 100px;">ID</th>
                                                            <th scope="col">Id Barang</th>
                                                            <th scope="col">Nama Barang</th>
                                                            <th scope="col">Jumlah</th>
                                                            <th scope="col" style="width: 100px;">action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php 
                                                        $no = 1;
                                                        foreach($hotspot as $u){ 
                                                        ?>
                                                        <tr>
                                                            <th><?php echo $u->idPinjam  ?></th>
                                                            <td><?php echo $u->idbarang ?></td>
                                                            <td><?php echo $u->Namabrg ?></td>
                                                            <td><?php echo $u->JumlhBrg ?></td>
                                                            <td>
                                                                <!-- <button type="submit" name="view" value="edit" id="<?php echo $u->idDtl ?>" class="btn btn-sm btn-primary view_data_pinjamDtl" style="padding: 5px 7px"><i class="fa fa-edit"></i></button> -->
                                                                <a href="<?php echo base_url('peminjaman/delete_pinjam_dtl/'); echo $u->idDtl; ?>" class="btn btn-sm btn-danger " style="padding: 5px 7px"><i class="fa fa-trash"></i></a>
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
