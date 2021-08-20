$(document).ready(function() {
    /** --------------------- 
     * Modal Open user
     * --------------------- */
    $("button[name='btn_open']").on("click", function(e) {
        e.preventDefault();
        $('.btn_reset').css('display', 'none');
        $('.btn_create').css('display', 'none');


        // alert($(this).closest('tr').find('.btn_open').attr("data-kodeorder"));

        let kodeorder = $(this).closest('tr').find('.btn_open').attr("data-kodeorder");
        let namanasabah = $(this).closest('tr').find('.btn_open').attr("data-namanasabah");
        let nohp = $(this).closest('tr').find('.btn_open').attr("data-nohp");
        let custpersonid = $(this).closest('tr').find('.btn_open').attr("data-custpersonid");
        //  alert(nohp);
        $("input[name='md_kodeorder']").val(kodeorder);
        $("input[name='md_namanasabah']").val(namanasabah);
        $("input[name='md_username']").val(nohp);
        $("input[name='h_kodeorder']").val(kodeorder);
        $("input[name='h_nohp']").val(nohp);
        getKodeOrder(kodeorder, custpersonid, nohp);


        // let param_smsid = $("input[name='h_smsid']").val();
        // if (param_smsid != '') {
        //     getDataSMS(param_smsid);

        // }
    });

    /** --------------------- 
     * Create user
     * --------------------- */
    $("form#f_create_user").on("submit", function(event) {
        event.preventDefault();
        let namanasabah = $("#md_namanasabah").val();
        let nohp = $("#md_username").val();

        // alert(namanasabah+'_'+nohp);

        $.ajax({
                type: "POST",
                url: "module/messaging/script.php",
                data: {
                    action: 'create.user',
                    namanasabah: namanasabah,
                    nohp: nohp
                },
                dataType: 'json',
                beforeSend: function() {
                    HoldOn.open({
                        theme: "sk-circle",
                        message: "Processing...",
                        backgroundColor: "#000",
                        textColor: "#fff"
                    });
                }
            })
            .done(function(data) {
                HoldOn.close();

                console.log(data);

                if (data.status_code == 0) {

                    Swal.fire({
                        title: 'Oops...',
                        text: 'Gagal!',
                        icon: 'error'
                    });

                } else {

                    Swal.fire({
                        title: 'Success!',
                        text: 'Berhasil!' + data.status_desc,
                        icon: 'success',
                        confirmButtonText: 'Okay'

                    }).then(function(url) {
                        // location.reload();
                        $('.modal').modal('hide');
                    });
                }
            });
    });

    /** --------------------- 
     * Reset User
     * --------------------- */
    $("form#f_create_user button.btn_reset").on("click", function(event) {
        event.preventDefault();
        let ini = $(this);
        let namanasabah = $("#md_namanasabah").val();
        let nohp = $("#md_username").val();
        let h_userid = $("input[name='h_userid']").val();

        // alert(namanasabah+'_'+nohp+'_'+h_userid);

        $.ajax({
                type: "POST",
                url: "module/messaging/script.php",
                data: {
                    action: 'reset.user',
                    namanasabah: namanasabah,
                    nohp: nohp,
                    userid: h_userid
                },
                dataType: 'json',
                beforeSend: function() {
                    HoldOn.open({
                        theme: "sk-circle",
                        message: "Processing...",
                        backgroundColor: "#000",
                        textColor: "#fff"
                    });
                }
            })
            .done(function(data) {
                HoldOn.close();

                console.log(data);

                if (data.status_code == 0) {

                    Swal.fire({
                        title: 'Oops...',
                        text: 'Gagal!',
                        icon: 'error'
                    });

                } else {

                    Swal.fire({
                        title: 'Success!',
                        text: 'Berhasil!' + data.status_desc,
                        icon: 'success',
                        confirmButtonText: 'Okay'

                    }).then(function(url) {
                        // location.reload();
                        $('.modal').modal('hide');
                        //   ini.closest('tr').find('.regid').text(data.status_desc);
                        //   $("input[name='h_userid']").val(userid);
                    });
                }
            });
    });

    /** --------------------- 
     * Modal data order
     * --------------------- */
    $("a[name='link_modalorder']").on("click", function(e) {
        e.preventDefault();
        $("input[name='h_customer_personal']").val('');
        $("input[name='h_jaminan']").val('');
        $("input[name='h_ecommerce']").val('');
        $("input[name='h_aplikasiid']").val('');

        let kodeorder = $(this).closest('tr').find('.link_modalorder').attr("data-kodeorder");
        $("input[name='h_regid']").val(kodeorder);
        // alert(kodeorder);

        $.ajax({
                type: "POST",
                url: "module/messaging/script.php",
                data: {
                    action: 'cek.dataorder',
                    kodeorder: kodeorder
                },
                dataType: 'json',
                beforeSend: function() {
                    HoldOn.open({
                        theme: "sk-dot",
                        message: "Please Wait... ",
                        backgroundColor: "#000",
                        textColor: "#fff"
                    });
                }
            })
            .done(function(data) {
                HoldOn.close();

                console.log(data);

                if (data.status_code == 0) {

                    Swal.fire({
                        title: 'Oops...',
                        text: 'Gagal!',
                        icon: 'error'
                    });

                } else {

                    let datapersonal = data.data_personal;
                    let datajaminan = data.data_jaminan;
                    let dataecommerce = data.data_ecommerce;
                    let aplikasiid = data.aplikasiid;
                    $("input[name='h_aplikasiid']").val(aplikasiid);

                    /** Data Personal */
                    if (datapersonal != '' && datapersonal != null) {
                        $("input[name='h_customer_personal']").val(datapersonal);
                        $('.btn_transfer1').addClass('disabled');
                        $('.status-text1').text('Data Tersimpan').removeClass('text-danger').addClass('text-success').css('font-weight', 'bold');
                    } else {
                        $('.btn_transfer1').removeClass('disabled');
                        $('.status-text1').text('Belum Disimpan').removeClass('text-success').addClass('text-danger').css('font-weight', 'bold');
                    }

                    /** Data Jaminan */
                    if (datajaminan != '' && datajaminan != null) {
                        // console.log('ok');
                        $("input[name='h_jaminan']").val(datajaminan);
                        $('.btn_transfer2').addClass('disabled');
                        $('.status-text2').text('Data Tersimpan').removeClass('text-danger').addClass('text-success').css('font-weight', 'bold');
                    } else {
                        // console.log('tidak');
                        $('.btn_transfer2').removeClass('disabled');
                        $('.status-text2').text('Belum Disimpan').removeClass('text-success').addClass('text-danger').css('font-weight', 'bold');
                    }

                    /** Data Ecommerce */
                    if (dataecommerce != '' && dataecommerce != null) {
                        $("input[name='h_ecommerce']").val(dataecommerce);
                        $('.btn_transfer3').addClass('disabled');
                        $('.status-text3').text('Data Tersimpan').removeClass('text-danger').addClass('text-success').css('font-weight', 'bold');
                    } else {
                        $('.btn_transfer3').removeClass('disabled');
                        $('.status-text3').text('Belum Disimpan').removeClass('text-success').addClass('text-danger').css('font-weight', 'bold');
                    }



                    // Swal.fire({
                    //     title: 'Success!',
                    //     text: 'Berhasil!'+data.status_desc,
                    //     icon: 'success',
                    //     confirmButtonText: 'Okay'

                    // }).then(function(url){
                    //     // location.reload();
                    //     // $('.modal').modal('hide');

                    //     $("input[name='h_customer_personal']").val(data.data_personal);
                    //     $("input[name='h_jaminan']").val(data.data_jaminan);
                    //     $("input[name='h_ecommerce']").val(data.data_ecommerce);
                    // });
                }
            });

    });

    /**
     * Button Transfer Data
     */
    /** Customer Personal */
    $("button.btn_transfer1").on("click", function(e) {
        e.preventDefault();
        // alert('transfer 1');
        let regid = $("input[name='h_regid']").val();
        let aplikasiid = $("input[name='h_aplikasiid']").val();

        // alert (regid+'_'+aplikasiid);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Transfer it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "module/messaging/script.php",
                    data: {
                        action: 'transfer.data.jaminan',
                        regid: regid,
                        aplikasiid: aplikasiid
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        HoldOn.open({
                            theme: "sk-bounce",
                            message: "Processing...",
                            backgroundColor: "#000",
                            textColor: "#fff"
                        });
                    }
                })
                .done(function(data) {
                    HoldOn.close();

                    console.log(data);

                    if (data.status_code == 0) {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Gagal!',
                            icon: 'error'
                        });
                    } else {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Berhasil!' + data.status_desc,
                            icon: 'success',
                            confirmButtonText: 'Okay'

                        }).then(function(url) {
                            $('.modal').modal('hide');
                            location.reload();
                        });
                    }
                });
            
            }
        });
    });
    
    /** Jaminan */
    $("button.btn_transfer2").on("click", function(e) {
        e.preventDefault();
        // alert('transfer 2');
        let regid = $("input[name='h_regid']").val();
        let aplikasiid = $("input[name='h_aplikasiid']").val();

        // alert (regid+'_'+aplikasiid);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Transfer it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "module/messaging/script.php",
                    data: {
                        action: 'transfer.data.jaminan',
                        regid: regid,
                        aplikasiid: aplikasiid
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        HoldOn.open({
                            theme: "sk-bounce",
                            message: "Processing...",
                            backgroundColor: "#000",
                            textColor: "#fff"
                        });
                    }
                })
                .done(function(data) {
                    HoldOn.close();

                    console.log(data);

                    if (data.status_code == 0) {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Gagal!',
                            icon: 'error'
                        });
                    } else {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Berhasil!' + data.status_desc,
                            icon: 'success',
                            confirmButtonText: 'Okay'

                        }).then(function(url) {
                            $('.modal').modal('hide');
                            location.reload();
                        });
                    }
                });
            }
        });
    });
    
    /** Ecommerce */
    $("button.btn_transfer3").on("click", function(e) {
        e.preventDefault();
        // alert('transfer 3');
        let regid = $("input[name='h_regid']").val();
        let aplikasiid = $("input[name='h_aplikasiid']").val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Transfer it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // alert (regid+'_'+aplikasiid);
                $.ajax({
                    type: "POST",
                    url: "module/messaging/script.php",
                    data: {
                        action: 'transfer.data.ecommerce',
                        regid: regid,
                        aplikasiid: aplikasiid
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        HoldOn.open({
                            theme: "sk-bounce",
                            message: "Processing...",
                            backgroundColor: "#000",
                            textColor: "#fff"
                        });
                    }
                })
                .done(function(data) {
                    HoldOn.close();
        
                    console.log(data);
        
                    if (data.status_code == 0) {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Gagal!',
                            icon: 'error'
                        });
                    } else {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Berhasil!' + data.status_desc,
                            icon: 'success',
                            confirmButtonText: 'Okay'
        
                        }).then(function(url) {
                            $('.modal').modal('hide');
                            location.reload();
                        });
                    }
                });
            }
        });
        
    });


});

/**
 * Mendapatkan kode order
 */
function getKodeOrder(kodeorder, custpersonid, nohp) {

    // alert(kodeorder);
    //   let sss = '';

    $.ajax({
        queue: true,
        cache: false,
        type: 'POST',
        dataType: 'json',
        url: 'module/messaging/script.php?action=get.kodeorder',
        data: {
            'kodeorder': kodeorder,
            'custpersonid': custpersonid,
            'nohp': nohp
        },
        beforeSend: function() {
            HoldOn.open({
                theme: "sk-dot",
                message: "Please Wait...",
                backgroundColor: "#000",
                textColor: "#fcf7f7"
            });
        },
        success: function(response) {
            // console.log(response);
            // console.log(response.results);

            let userid = response.results[0].userId;
            let smsid = response.results[0].smsId;
            let sendingDateTime = response.sendingDateTime;
            let statusSms = response.status;

            $("input[name='h_userid']").val(userid);
            // $("input[name='h_smsid']").val(smsid);
            $("[name='sendingDateTime']").text(sendingDateTime);
            $("[name='statusSms']").text(statusSms);


            if (userid == null || userid == '') {
                // alert('2');
                $('.btn_create').show();

            } else {
                $('.btn_reset').show();

            }


            HoldOn.close()
        }
    });

    //   return sss;
}

/**
 * GET DATA SMS 101
 */
function getDataSMS(param_smsid) {
    alert(param_smsid);
}