$('document').
ready(
    function(){
        var id_ujian = $('#id_ujian').html();
        var id_peserta = $('#id_peserta').html();
       
        var data = "id_ujian="+id_ujian+"&id_peserta="+id_peserta;
        $.ajax({
            type : "POST",
            url : "library/ajax/php/exam.php?req=soal",
            data : data,
            success : 
            
            function(data){
                var dataSoal = JSON.parse(data);
                    function tampilSoal(no){
                        $('#no-soal').html(no);
                        if(no==1){
                            $('#previous').hide();
                        }else{
                               $('#previous').show();
                        }
                        var n_soal = Object.keys(dataSoal.soal);
                        var jml = n_soal.length;
                        
                        if(no==jml){
                            $('#next').removeClass('btn-prev-next');
                                $('#next').addClass('btn-selesai');
                                    $('#next').html('Selesai <i class="fa fa-check"></i>');
                                    $('#next').attr("data-finish","true");

                        }else{
                            $('#next').removeClass('btn-selesai');
                                $('#next').addClass('btn-prev-next');
                                    $('#next').html('<span class="ntx">Next</span> <i class="fa fa-arrow-circle-right"></i>');
                                    $('#next').attr("data-finish","false");
                        }

                        var soal    = dataSoal.soal[no];
                        var opsi_a  = dataSoal.a[no];
                        var opsi_b  = dataSoal.b[no];
                        var opsi_c  = dataSoal.c[no];
                        var opsi_d  = dataSoal.d[no];
                        var opsi_e  = dataSoal.e[no];
                        var tipe = dataSoal.tipe[no];
                        $('#reset_jawaban').hide();
                        $('#soal').html(soal);
                        

                       
                        if(tipe == "pg" ){
                                $('#isian').hide();
                                if(opsi_a!=''){
                                    $('#pilihan-a').show();
                                    $('#opsi-a').html(opsi_a);
                                }
                                if(opsi_b!=''){
                                    $('#pilihan-b').show();
                                    $('#opsi-b').html(opsi_b);
                                }
                                if(opsi_c!=''){
                                    $('#pilihan-c').show();
                                    $('#opsi-c').html(opsi_c);
                                }
                                if(opsi_d!=''){
                                    $('#pilihan-d').show();
                                    $('#opsi-d').html(opsi_d);
                                }
                                if(opsi_e!=''){
                                    $('#pilihan-d').show();
                                    $('#opsi-e').html(opsi_e);
                                }
                                var currentJwb = $('#jawaban-'+no).html();
                   
                        if(currentJwb!= 0){
                        $('#reset_jawaban').show(function(){
                                $(this).fadeIn();
                        });
                        
                        var Fjwb;
                      
                            if(currentJwb == 1){
                                    Fjwb = "a";
                            }else if(currentJwb == 2){
                                    Fjwb = "b";
                            }else if(currentJwb == 3){
                                    Fjwb = "c";
                            }else if(currentJwb == 4){
                                    Fjwb = "d";
                            }else if(currentJwb == 5){
                                    Fjwb = "e";
                            }
                        $('input[name=pilihan]').prop('checked',false);
                        $('#radio-'+Fjwb).prop("checked",true);
                        
                        }else{
                            $('#reset_jawaban').hide(function(){
                            });
                            $('input[name=pilihan]').prop('checked',false);
                        }
                                
                        }else if(tipe == "isian"){
                            
                            $('#isian').show();
                            $('#pilihan-a').hide();
                            $('#pilihan-b').hide();
                            $('#pilihan-c').hide();
                            $('#pilihan-d').hide();
                            $('#pilihan-e').hide();

                        var currentJwb = $('#jawaban-'+no).html();

                        $('#input-isian').val('');
                        $('#label-change-isian').html('');
                        if(currentJwb!=0){
                        $('#input-isian').val(currentJwb);
                        }
                        

                        }else{
                            $('#isian').hide();
                            $('#pilihan-a').hide();
                            $('#pilihan-b').hide();
                            $('#pilihan-c').hide();
                            $('#pilihan-d').hide();
                            $('#pilihan-e').hide();
                        }

                    }
            tampilSoal(1); 
            
            $('#next,#finish').
            click(function(){
                var df = $(this).attr("data-finish");
                if(df!='true'){
                    var no = $("#no-soal").html();
                   
                        tampilSoal(++no);
                        $('.nomor-soal-active').removeClass("nomor-soal-active");
                        $('#list-nomor-'+no).addClass("nomor-soal-active");
                        $('#no-soal').html(no);
                }else{
                    new swal({
                        title: "Anda Yakin?",
                        text: "Anda yakin ingin mengakhiri ujian?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            var url = "../process/"+id_ujian;
                            window.location=url;
                        } else {
                            swal("Submit Ujian dibatalkan, silahkan lanjutkan pengerjaan!");
                        }
                      });
                }
            });

            $('#previous').
            click(function(){
                    var no = $("#no-soal").html();
                   
                        tampilSoal(--no);
                        $('.nomor-soal-active').removeClass("nomor-soal-active");
                        $('#list-nomor-'+no).addClass("nomor-soal-active");
                        $('#no-soal').html(no);
                        
            });
            $('.nomor-soal').click(function(){
                var nomor = $(this).attr("data-next");
                $('#no-soal').html(nomor);
                tampilSoal(nomor);
                $('.nomor-soal-active').removeClass("nomor-soal-active");
                $(this).addClass("nomor-soal-active");
            });

            $('#input-isian').
            change(function(){
                $('#label-change-isian').html('<span class="text-secondary" style="font-size:10pt">Memperbaharui jawaban ... </span>');
                var jwb = $(this).val();
                if(jwb == ""){
                    jwb = 0;
                }
                var no = $("#no-soal").html();
                $.ajax({
                    type : "POST",
                    url : "library/ajax/php/exam.php?req=jwb",
                    data : "jwb="+jwb+"&no="+no+"&id_ujian="+id_ujian,
                    success : 
                    function(data){
                        if(data == 1){
                        $('#label-change-isian').html('<span class="text-success" style="font-size:10pt">Berhasil memperbaharui jawaban ...</span>');
                        $('#jawaban-'+no).html(jwb);
                        $('#list-nomor-'+no).removeClass('nomor-soal');
                        $('#list-nomor-'+no).addClass('nomor-soal-answered');
                    }else{
                        $('#label-change-isian').html('<span class="text-danger" style="font-size:10pt">Gagal memperbaharui jawaban ...</span>');
                        console.log(data);
                    }
                    }
                });    
            });


            $('#reset_jawaban').
            click(function(){
                $('#label-change-isian').html('<span class="text-secondary" style="font-size:10pt">Memperbaharui jawaban ... </span>');
                var jwb = 0;
                var no = $("#no-soal").html();
                $.ajax({
                    type : "POST",
                    url : "library/ajax/php/exam.php?req=jwb",
                    data : "jwb="+jwb+"&no="+no+"&id_ujian="+id_ujian,
                    success : 
                    function(data){
                        if(data == 1){
                        $('#list-nomor-'+no).removeClass('nomor-soal-answered');
                        $('#list-nomor-'+no).addClass('nomor-soal');
                        $('#jawaban-'+no).html(0);
                        $('input[name=pilihan]').prop('checked',false);
                        $('#reset_jawaban').fadeOut();
                    }else{
                        console.log(data);
                    }
                    }
                });    
            });

            $('input[name=pilihan]').
            click(function(){
            var jwb = $(this).val();
            var no = $("#no-soal").html();
            $.ajax({
                type : "POST",
                url : "library/ajax/php/exam.php?req=jwb",
                data : "jwb="+jwb+"&no="+no+"&id_ujian="+id_ujian,
                success : 
                function(data){
                    if(data == 1){
                    $('#reset_jawaban').show(function(){
                    });
                    $('#jawaban-'+no).html(jwb);
                    $('#list-nomor-'+no).removeClass('nomor-soal');
                    $('#list-nomor-'+no).addClass('nomor-soal-answered');
                }else{
                    $(this).prop('checked',false);
                    console.log(data);
                }
                }
            });

            });
            }
          });

         



        }
        
    );

    function parseDate(input) {
        var parts = input.match(/(\d+)/g);
        // new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
        return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
      }
    function habis_waktu(){
        new swal({
            title: "Waktu Ujian Habis",
            text: "Upps tampaknya waktu ujianmu sudah habis",
            icon: "warning",
          });
          setInterval(function(){
                var id_ujian = $('#id_ujian').html();
                window.location="../process/"+id_ujian;
          },3000);
          
    }
    function countDown(a) {
        var d = new Date(a);
        var g  = d.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' });
        var e = new Date(g).getTime();
       
        var
            s = setInterval(function () {
                if(document.body.scrollTop > 400 ){
                    $('.card-timer').addClass('card-timer-scrolled');
                    }else if(document.body.scrollTop < 400){
                    $('.card-timer').removeClass('card-timer-scrolled');
                    }
                var a = new Date(),
                    c = a.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }),
                    r = new Date(c).getTime();
                    t = e - r,
                    l = (Math.floor(t / 864e5), Math.floor((t % 864e5) / 36e5)),
                    n = Math.floor((t % 36e5) / 6e4),
                    o = Math.floor((t % 6e4) / 1e3);
                ($('#timer').html(l + ":" + n + ":" + o)), t < 0 && (clearInterval(s), (document.getElementById("timer").innerHTML = "<b style='red'>WAKTU HABIS</b>"), habis_waktu());
            }, 1e3);
    }
    var waktui = $('#batas_waktu').val();
    countDown(waktui);

