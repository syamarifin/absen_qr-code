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

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    
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
                        $('#nama').val(data.nama); 
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
                        $('#insert').val("Perbarui");
                        $('#modalTroble').modal('show');
                    }
                });
            });

            $(document).on('click', '.add_data_troble', function(){
                $('#employee_id').val('');  
                $('#Jenis').val('');
                $('#Pelapor').val('');  
                $('#Lapor').val('');
                // $('#Perbaikan').val('');  
                // $('#Teknisi').val('');
                $('#Description').val('');
                $('#insert').val("Simpan");
            });

            $(document).on('click', '.done_data_troble', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('trobleshoot/tampil_troble')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_idDone').val(data.idPenanganan);  
                        // $('#JenisD').val(data.Jenismslh);
                        // $('#PelaporD').val(data.Pelapor);  
                        // $('#LaporD').val(data.tgllapor);  
                        $('#insertD').val("Done");
                        $('#modalTrobleDone').modal('show');
                    }
                });
            });

            //edit data anggota
            $(document).on('click', '.view_data_aslab', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('aslab/tampil_aslab')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_id').val(data.idAslab);  
                        $('#NIM').val(data.NIM);
                        $('#NIM' ).prop("readonly", true );
                        $('#Nama').val(data.nama);  
                        $('#Telp').val(data.noTelp);
                        $('#Tempat').val(data.tempatLahir);  
                        $('#Lahir').val(data.tglLahir);
                        $('#jk').val(data.jk);
                        $('#email').val(data.username);  
                        $('#insert').val("Perbarui");
                        $('#modalTroble').modal('show');
                    }
                });
            });

            $(document).on('click', '.add_data_aslab', function(){
                $('#employee_id').val('');  
                $('#NIM').val('');
                $('#Nama').val('');  
                $('#Telp').val('');
                $('#Tempat').val('');  
                $('#Lahir').val('');
                $('#jk').val('');
                $('#email').val('');
                $('#NIM' ).prop("readonly", false );
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

            $(document).on('click', '.add_data_inventaris', function(){
                $('#employee_id').val('');  
                $('#Nama').val('');  
                $('#Jumlah').val('');
                $('#Stok').val('');   
                $('#lokasi').val('');  
                $('#Desc').val('');
                $('#insert').val("Simpan");
                
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
                        $('#lokasi').val(data.lokasi);
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
                $('#lokasi').val('Kampus 1');
                $('#cencel').addClass("hiddenButton");
                $('#insert').val("Simpan Jadwal");
                
            });

            //edit data peminjam
            $(document).on('click', '.view_data_pinjam', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('peminjaman/tampil_peminjam')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_id').val(data.idPinjam);  
                        $('#NIM').val(data.NIM);  
                        $('#Nama').val(data.Nama_peminjam);  
                        $('#Keperluan').val(data.keperluan);
                        $('#insert').val("Perbarui");
                        $('#modalPeminjaman').modal('show');
                    }
                });
            });

            $(document).on('click', '.view_data_pinjamDtl', function(){
                //$('#dataModal').modal();
                var employee_id = $(this).attr("id");
                $.ajax({
                 url:"<?php echo base_url('peminjaman/tampil_peminjamDtl')?>",
                 method:"POST",
                 data:{employee_id:employee_id},  
                 dataType:"json",
                    success:function(data){
                        $('#employee_id').val(data.idDtl);  
                        $('#Id').val(data.idbarang);   
                        $('#Nama').val(data.Namabrg);
                        $('#quantity').val(data.JumlhBrg);
                        $('#insert').val("Perbarui");
                        $('#modalPeminjaman').modal('show');
                    }
                });
            });

            $(document).on('click', '.add_data_pinjam', function(){
                $('#employee_id').val('');  
                $('#NIM').val('');  
                $('#Nama').val('');
                $('#insert').val("Add Barang");
                
            });
        });
    </script>