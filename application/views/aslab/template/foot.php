<!-- offset area end -->
    <!-- jquery latest version -->
    <!-- <script src="<?php echo base_url('assets/js/vendor/jquery-2.2.4.min.js')?>"></script> -->
    <!-- bootstrap 4 js -->
    <script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/owl.carousel.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/metisMenu.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.slicknav.min.js')?>"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="<?php echo base_url('assets/js/line-chart.js')?>"></script>
    <!-- all pie chart -->
    <script src="<?php echo base_url('assets/js/pie-chart.js')?>"></script>
    <!-- others plugins -->
    <script src="<?php echo base_url('assets/js/plugins.js')?>"></script>
    <script src="<?php echo base_url('assets/js/scripts.js')?>"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            var myVar = setInterval (function(){ ShowCurrentTime() },1000);
            function ShowCurrentTime() {
                $.ajax({
                    url:"<?php echo base_url('trobleshoot/total_troble')?>",
                    method:"POST",
                    data:{employee_id:'New'},  
                    dataType:"json",
                    success:function(data){
                        $('#notifNew').html(data.total);
                        // document.getElementById("notif").value = data.total;
                        // console.log($('#notifNew').val());
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            //edit data hotspot
            $(document).on('click', '.view_data_hotspot', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('hotspot/tampil_hotspot')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#NIM').val(data.NIM);  
                        $('#password').val(data.password);
                        $('#NIM').attr('readonly','true'); 
                        $('#insert').val("Perbarui");
                        $('#exampleModalLong').modal('show');
                    }
                });
            });

            $(document).on('click', '.add_data_hotspot', function(){
                $('#NIM').val('');  
                $('#nama').val('');
                $('#password').val('');
                $('#NIM').removeAttr('readonly'); 
                $('#insert').val("Simpan");
                
            });

            //edit data troubleshooting
            $(document).on('click', '.view_data_troble', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('trobleshoot/tampil_troble')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_id').val(data.idPenanganan);  
                        $('#Jenis').val(data.Jenismslh);
                        $('#Pelapor').val(data.Pelapor);  
                        $('#Lapor').val(data.tgllapor);
                        // $('#Perbaikan').val(data.tgperbaikan);  
                        // $('#Teknisi').val(data.Teknisi);
                        $('#Description').val(data.Deskripsi);  
                        if (data.status=='Done') {
                            $('#done').addClass("hiddenButton");
                        }else{
                            $('#done').removeClass("hiddenButton");
                        }
                        $('#insert').val("Perbarui");
                        $('#modalTroble').modal('show');
                    }
                });
            });

            //edit data troubleshooting
            $(document).on('click', '.add_data_troble', function(){
                $('#employee_id').val('');  
                $('#Jenis').val('');
                $('#Pelapor').val('');  
                $('#Lapor').val('');
                // $('#Perbaikan').val('');  
                // $('#Teknisi').val('');
                $('#Description').val('');   
                $('#done').addClass("hiddenButton");
                $('#insert').val("Simpan");
            });

            //edit data anggota
            $(document).on('click', '.view_data_anggota', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('anggota/tampil_anggota')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_id').val(data.IdDaftar_a);  
                        $('#NIM').val(data.NIM);
                        $('#Nama').val(data.Nama);  
                        $('#Semester').val(data.Semester);
                        $('#Tempat').val(data.tmptlahir);  
                        $('#Lahir').val(data.tgllahir);
                        $('#jk').val(data.Jk);
                        $('#Alamat').val(data.Alamat);  
                        $('#insert').val("Perbarui");
                        $('#modalTroble').modal('show');
                    }
                });
            });
            $(document).on('click', '.tambah_anggota', function(){
                $('#employee_id').val('');  
                $('#NIM').val('');
                $('#Nama').val('');  
                $('#Semester').val('');
                $('#Tempat').val('');  
                $('#Lahir').val('');
                $('#jk').val('');
                $('#Alamat').val('');
                $('#insert').val("Simpan");
            });

            //edit data inventaris
            $(document).on('click', '.view_data_inventaris', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('inventaris/tampil_inventaris')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_id').val(data.idbarang);  
                        $('#Nama').val(data.Namabrg);  
                        $('#Jumlah').val(data.Jumlhbrg);
                        $('#Stok').val(data.Stok);   
                        $('#lokasi').val(data.lokasi);  
                        $('#Desc').val(data.Deskripsi);
                        $('#insert').val("Perbarui");
                        $('#modalInventaris').modal('show');
                    }
                });
            });

            $(document).on('click', '.tambah_inventaris', function(){
                $('#employee_id').val('');  
                $('#Nama').val('');  
                $('#Jumlah').val('');
                $('#Stok').val('');   
                $('#lokasi').val('');  
                $('#Desc').val('');
                $('#insert').val("Simapn");
                
            });

            //edit data jadwal
            $(document).on('click', '.view_data_jadwal', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('jadwal/tampil_jadwal')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_id').val(data.idjadwal);  
                        $('#Aslab').val(data.idAslab);  
                        $('#Jadwal').val(data.Jadwal);
                        $('#Sift').val(data.shift); 
                        $('#Lokasi').val(data.lokasi); 
                        $('#cencel').removeClass("hiddenButton");  
                        $('#insert').val("Perbarui Jadwal");
                    }
                });
            });

            $(document).on('click', '.add_data_jadwal', function(){
                $('#employee_id').val('');  
                $('#Aslab').val('');  
                $('#Jadwal').val('');
                $('#Sift').val(''); 
                $('#Lokasi').val('Kampus 1'); 
                $('#cencel').addClass("hiddenButton");
                $('#insert').val("Simpan Jadwal");
                
            });
        });
    </script>