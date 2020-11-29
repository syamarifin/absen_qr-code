<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SIUJAR - ITB asia malang</title>
    <link rel="icon" href="<?php echo base_url('assets/images/lg1_logo.png')?>" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/icon/favicon.ico')?>">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/themify-icons.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/metisMenu.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/slicknav.min.css')?>">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    
    <!-- others css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/typography.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/default-css.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css')?>">
    <!-- modernizr css -->
    <script src="<?php echo base_url('assets/js/jquery.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/vendor/modernizr-2.8.3.min.js')?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
    <link href="<?php echo base_url('assets/BootStrapDateTimePickerExample/DatePicker/bootstrap-datepicker.css')?>" rel="stylesheet" />
    <script src="<?php echo base_url('assets/BootStrapDateTimePickerExample/DatePicker/bootstrap-datepicker.js')?>"></script>


    
    <script type="text/javascript">
    $(document).ready(function() {
      $(".monthGl").datepicker({ format: 'yyyy-mm-dd', autoclose: true, todayBtn: 'linked' });
      $(".monthJadwal").datepicker({ format: 'DD, yyyy-mm-dd', autoclose: true, todayBtn: 'linked' });
      // $(".monthJadwal").datepicker({ format: 'mm-yyyy', viewMode: "months", minViewMode: "months", autoclose: true, todayBtn: 'linked' })
      var path = window.location.pathname;
      var page = path.split("/").pop();
      var pagePaging = path.split("/");
      console.log(pagePaging[4]);
      if (page == 'dashboard') {
        $("#dash").addClass("active");
        $("#aslab").removeClass("active");
        $("#absen").removeClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }else if (page == 'view_hotspotKabid' || page =='simpan_hotspotKabid') {
        $("#dash").removeClass("active");
        $("#aslab").removeClass("active");
        $("#absen").removeClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").addClass("active");
      }else if (page == 'view_trobleKabid' || page =='simpan_trobleKabid') {
        $("#dash").removeClass("active");
        $("#aslab").removeClass("active");
        $("#absen").removeClass("active");
        $("#trobel").addClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }else if (page == 'view_anggotaKabid' || page =='simpan_anggotaKabid') {
        $("#dash").removeClass("active");
        $("#aslab").removeClass("active");
        $("#absen").removeClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").addClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }else if (page == 'view_absensiKabid' || pagePaging[4]=='view_absensiKabid') {
        $("#dash").removeClass("active");
        $("#aslab").removeClass("active");
        $("#absen").addClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }else if (page == 'view_aslabKabid' || pagePaging[4]=='view_aslabKabid') {
        $("#dash").removeClass("active");
        $("#aslab").addClass("active");
        $("#absen").removeClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }else if (page == 'view_inventarisKabid' || page =='simpan_inventarisKabid') {
        $("#dash").removeClass("active");
        $("#aslab").removeClass("active");
        $("#absen").removeClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").addClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }else if (page == 'view_jadwalKabid') {
        $("#dash").removeClass("active");
        $("#aslab").removeClass("active");
        $("#absen").removeClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").addClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }else{
        $("#dash").removeClass("active");
        $("#aslab").removeClass("active");
        $("#absen").removeClass("active");
        $("#trobel").removeClass("active");
        $("#anggota").removeClass("active");
        $("#inventaris").removeClass("active");
        $("#jadwal").removeClass("active");
        $("#pinjam").removeClass("active");
        $("#hots").removeClass("active");
      }
        
    });
  </script>
  <script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }
    
    
    
    function confirmation(){
        var result = confirm("Are you sure to delete?");
        if(result){
            return true;
        }else{
            return false;
        }
    }

    function confirmationApprove(){
        var result = confirm("Are you sure to registered account hotspot?");
        if (result) {
            return true;
        }else{
            return false;
        }
    }
  </script>