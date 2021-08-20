<?php

// include_once("../../include/fungsi.php");

// $query="SELECT  d.userId,d.smsId,c.*,a.* from [192.168.1.73].ITDept.dbo.book_regAplikasi a
//         left join [192.168.1.73].ITDept.dbo.book2_direct_aplikasi b on b.regid=a.RegId
//         left join [192.168.1.73].ITDept.dbo.book2_cust_personal c on c.aplikasiid=b.aplikasiid
//         left join [192.168.1.73].andromaf.dbo.andro_custuser d on d.noHp=c.cust_hp1
//         where a.sts_orderinternal=2 and a.deletests=0 and b.aplikasiid is not null
//         ";
// echo $query;

// $exec = mssql_query($query);

// $result = array();
// while ($data = mssql_fetch_assoc($exec)) {
//     $result[] = $data;
// }



?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maintenance User</title>

  <!-- jQuery -->
  <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-1.7.2.min.js"></script>
  <!-- <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-ui-1.8.16.custom.min.js"></script> -->
  <!-- Bootstrap core CSS -->
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- <script type="text/javascript" src="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/css/bootstrap.min.js"></script> -->
  <link rel="stylesheet" href="<?php echo HOSTNAME(); ?>/module/hrd/presensi/css/bootstrap-datepicker.css">
  
  <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/module/hrd/presensi/js/bootstrap-datepicker.min.js"></script>  

  <!-- Sweetalert2 -->
  <script type="text/javascript" src="<?php echo hostname(); ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- HoldOn loading animation -->
  <link rel="stylesheet" href="<?php echo HOSTNAME(); ?>/css/HoldOn.min.css">
  <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/css/HoldOn.min.js"></script>
  <!-- Validate -->
  <script type="text/javascript" src="<?php echo hostname(); ?>/plugins/jquery.validate.min.js"></script>

  <style>
    *{
      font-size:12px;
    }
    .btn {
      height: inherit !important;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
    .bdr {border-radius: 8px;overflow:hidden;}
    table tr th, table tr td {
      vertical-align: middle;
    }
    .form-control2 {
        display: block;
        width: 100%;
        /* height: 34px;
        padding: 6px 12px;
        font-size: 14px; */
        padding: 3px 5px;
        font-size: 12px;
        height: auto;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
  </style>

  <script>
    $(document).ready(function(){
    
      $('#f_cari .input-daterange').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        clearBtn: true,
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
      });
    
    });
  </script>

  <!-- Custom styles for this template -->
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/custom/headers.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/custom/starter-template.css" rel="stylesheet">
  <!-- Icons -->
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-icons-1.5.0/fonts/bootstrap-icons.woff" rel="stylesheet">
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-icons-1.5.0/fonts/bootstrap-icons.woff2" rel="stylesheet">
  
  
</head>
<body style="background: #fff;">
<!-- #E8F0F2 -->
  <header class="p-3 mb-3 border-bottom border-top" style="background-color: #fff;">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a  class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg xmlns="http://www.w3.org/2000/svg" style="fill:#517de5;" width="35" height="27" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
              <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
              <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
              </svg>

              <!-- <svg xmlns="http://www.w3.org/2000/svg" style="fill:#517de5;" width="35" height="27" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
              <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              </svg> -->
              &nbsp;
              <span class="fs-4" style="color:#517de5; font-weight:600;">Monitoring User</span>
          </a>

          <!-- <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="padding-left:20px;">
              <li>
                  <button type="button" class="btn btn-outline-success me-2" style="display: flex;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                      </svg> &nbsp;
                      <strong>Create New User</strong>
                  </button>
              </li>
          </ul> -->
      </div>
    </div>
    
  </header>


  
  <main>

    <div class="container-xxl" >
        <div class="p-3 mb-3 border-bottom border-top" style="background-color: #fff; border-right: 1px solid #dee2e6 !important; border-left: 1px solid #dee2e6 !important; border-radius:8px;">
            <div class="row" style="padding:15px;">
                <div class="col-md-8">
                    <form class="" action="" method="post" id="f_cari">
                        <table border='0' class="">
                            <tr>
                              <td>Kode Order</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="kodeorder-group" class="td-group">
                                  <input type="text" class="form-control " name='term_kodeorder' id='term_kodeorder' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="">
                              </td>  
                            </tr>  
                            <tr>
                              <td>Nama Nasabah</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="namanasabah-group" class="td-group">
                                  <input type="text" class="form-control " name='term_namanasabah' id='term_namanasabah' autocomplete="on" style="width: 140px;" placeholder="">
                              </td>  
                            </tr>
                            <tr>
                              <td>Tanggal Order</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="namanasabah-group" class="td-group">
                                  <!-- <input type="text" class="form-control " name='term_tglorder' id='term_tglorder' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="">
                                  input-daterange -->
                                  <div class="input-daterange input-group" id="datepicker" >
                                      <input type="text" class="input-sm form-control" name="tglorder_start" id="tglorder_start" style="width: 20px;" />
                                      <span class="input-group-addon">&nbsp;-&nbsp;</span>
                                      <input type="text" class="input-sm form-control" name="tglorder_end" id="tglorder_end" />
                                  </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Status User</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="status-group" class="td-group">
                                  <select name="term_status" id="term_status" class="form-control2">
                                    <option value="">-- All --</option>
                                    <option value="1">Terdaftar</option>
                                    <option value="0">Belum Terdaftar</option>
                                  </select>
                              </td>  
                            </tr>                
                            
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td>

                              <button class="btn btn-primary btn-sm" type="submit" name="button" id="cari" style="padding-left:10px; padding-right:12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg> <b>Cari</b>
                              </button>
                              </td>  
                            </tr>    
                        
                        </table>
                    </form>
                </div>
                <div class="col-6 col-md-4">
                
                </div>
            </div>
        </div>

        <div id="hasil_cari">
          <!-- Tabel hasil pencarian -->
        </div>

        <br>
    </div>
    
  </main>



  <script src="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function(){

      $("input[name='term_kodeorder']").on('input', function(e) {
          $(this).val($(this).val().replace(/[^0-9]/g, ''));
      });

      /** --------------------- 
        * Searching
        * --------------------- */
      // $( "form#f_cari" ).on( "submit", function( event ) {
      //   event.preventDefault();
        
      //   let textsearch = $("input[name='textsearch']").val();

      //   console.log(textsearch);
      //   alert(textsearch);
      //   // $.ajax({
      //   //     type: "POST",
      //   //     url   : "module/messaging/script.php",
      //   //     data  : { 
      //   //       action:'search.sentitem',
      //   //       textsearch: textsearch
      //   //     },
      //   //     dataType    : 'json',
      //   //     beforeSend: function() {
      //   //         HoldOn.open({
      //   //             theme: "sk-circle",
      //   //             message: "SAVING... ",
      //   //             backgroundColor: "#000",
      //   //             textColor: "#fff"
      //   //         });      
      //   //     }
      //   // })
      //   // .done(function( data ) {
      //   //     HoldOn.close();
            
      //   //     console.log(data);

      //   //     if (data.status_code==0) {

      //   //       Swal.fire({
      //   //           title: 'Oops...',
      //   //           text: 'Gagal!',
      //   //           icon: 'error'
      //   //       });

      //   //     } else {
              
      //   //       Swal.fire({
      //   //           title: 'Success!',
      //   //           text: 'Berhasil!'+data.status_desc,
      //   //           icon: 'success',
      //   //           confirmButtonText: 'Okay'
                  
      //   //       }).then(function(url){
      //   //           // location.reload();
      //   //       });
      //   //     }
      //   // });
        
      // });


      $("form#f_cari").on("submit", function(e) {
          e.preventDefault();
 
          let kodeOrder    = $("#term_kodeorder").val();
          let namaNasabah  = $("#term_namanasabah").val();
          let tglOrderStart = $("#tglorder_start").val();
          let tglOrderEnd = $("#tglorder_end").val();
          let statusDaftar = $("#term_status").val();
          
          // alert(kodeOrder+'_'+namaNasabah+'_'+tglOrderStart+'_'+tglOrderEnd);
          
          $.ajax({
              type: "POST",
              url: "module/messaging/monitor_hasil_cari.php",
              datatype: "php",
              data: {
                kodeOrder: kodeOrder,
                namaNasabah: namaNasabah,
                tglOrderStart: tglOrderStart,
                tglOrderEnd: tglOrderEnd,
                statusDaftar: statusDaftar
              },
              cache: false,
              beforeSend: function() {
                  HoldOn.open({
                      theme: "sk-bounce",
                      message: "Searching...",
                      backgroundColor: "#000",
                      textColor: "#fff"
                  });
                          
              },
              // success: function(html) {
              //     HoldOn.close();
              //     $("#hasilcari").html(html);
              // }
          })
          .done(function( data ) {
              HoldOn.close();
              $("#hasil_cari").html(data);
          });
          
      });


      // /** --------------------- 
      //   * Modal Open user
      //   * --------------------- */
      // $("button[name='btn_open']").on("click", function(e){
      //     e. preventDefault();
      //     $('.btn_reset').css('display','none');
      //     $('.btn_create').css('display','none');


      //     // alert($(this).closest('tr').find('.btn_open').attr("data-kodeorder"));

      //     let kodeorder = $(this).closest('tr').find('.btn_open').attr("data-kodeorder");
      //     let namanasabah = $(this).closest('tr').find('.btn_open').attr("data-namanasabah");
      //     let nohp = $(this).closest('tr').find('.btn_open').attr("data-nohp");
      //     let custpersonid = $(this).closest('tr').find('.btn_open').attr("data-custpersonid");
      //     //  alert(nohp);
      //     $("input[name='md_kodeorder']").val(kodeorder);
      //     $("input[name='md_namanasabah']").val(namanasabah);
      //     $("input[name='md_username']").val(nohp);
      //     $("input[name='h_kodeorder']").val(kodeorder);
      //     $("input[name='h_nohp']").val(nohp);
      //     getKodeOrder(kodeorder,custpersonid);
      // });

      // /** --------------------- 
      //   * Create user
      //   * --------------------- */
      // $("form#f_create_user").on( "submit", function( event ) {
      //   event.preventDefault();
      //   let namanasabah = $("#md_namanasabah").val();
      //   let nohp = $("#md_username").val();

      //   // alert(namanasabah+'_'+nohp);

      //   $.ajax({
      //       type: "POST",
      //       url   : "module/messaging/script.php",
      //       data  : { 
      //         action:'create.user',
      //         namanasabah: namanasabah,
      //         nohp: nohp
      //       },
      //       dataType    : 'json',
      //       beforeSend: function() {
      //           HoldOn.open({
      //               theme: "sk-circle",
      //               message: "SAVING... ",
      //               backgroundColor: "#000",
      //               textColor: "#fff"
      //           });      
      //       }
      //   })
      //   .done(function( data ) {
      //       HoldOn.close();
            
      //       console.log(data);

      //       if (data.status_code==0) {

      //         Swal.fire({
      //             title: 'Oops...',
      //             text: 'Gagal!',
      //             icon: 'error'
      //         });

      //       } else {
              
      //         Swal.fire({
      //             title: 'Success!',
      //             text: 'Berhasil!'+data.status_desc,
      //             icon: 'success',
      //             confirmButtonText: 'Okay'
                  
      //         }).then(function(url){
      //             // location.reload();
      //         });
      //       }
      //   });
      // });

      // /** --------------------- 
      //   * Reset User
      //   * --------------------- */
      // $("form#f_create_user button.btn_reset").on( "click", function( event ) {
      //   event.preventDefault();
      //   let namanasabah = $("#md_namanasabah").val();
      //   let nohp = $("#md_username").val();
      //   let h_userid = $("input[name='h_userid']").val();

      //   alert(namanasabah+'_'+nohp+'_'+h_userid);

      //   $.ajax({
      //       type: "POST",
      //       url   : "module/messaging/script.php",
      //       data  : { 
      //         action:'reset.user',
      //         namanasabah: namanasabah,
      //         nohp: nohp
      //       },
      //       dataType    : 'json',
      //       beforeSend: function() {
      //           HoldOn.open({
      //               theme: "sk-circle",
      //               message: "PROCESSING... ",
      //               backgroundColor: "#000",
      //               textColor: "#fff"
      //           });      
      //       }
      //   })
      //   .done(function( data ) {
      //       HoldOn.close();
            
      //       console.log(data);

      //       // if (data.status_code==0) {

      //       //   Swal.fire({
      //       //       title: 'Oops...',
      //       //       text: 'Gagal!',
      //       //       icon: 'error'
      //       //   });

      //       // } else {
              
      //       //   Swal.fire({
      //       //       title: 'Success!',
      //       //       text: 'Berhasil!'+data.status_desc,
      //       //       icon: 'success',
      //       //       confirmButtonText: 'Okay'
                  
      //       //   }).then(function(url){
      //       //       // location.reload();
      //       //   });
      //       // }
      //   });
      // });


    });

    // /**
    // * Mendapatkan kode order
    // */
    // function getKodeOrder(kodeorder,custpersonid) {
      
    //   // alert(kodeorder);

    //   $.ajax({
    //      queue: true,
    //      cache: false,
    //      type: 'POST',
    //      dataType: 'json',
    //      url: 'module/messaging/script.php?action=get.kodeorder',
    //      data: {
    //         'kodeorder': kodeorder,
    //         'custpersonid': custpersonid
    //      },
    //      beforeSend: function() {
    //         HoldOn.open({
    //            theme: "sk-dot",
    //            message: "PLEASE WAIT... ",
    //            backgroundColor: "#fcf7f7",
    //            textColor: "#000"
    //         });
    //      },
    //      success: function(response) {
    //         // console.log(response);
    //         // alert(response.results[0].userId);
    //         // console.log(response.results);

    //         let userid = response.results[0].userId;
    //         // let custpersonid = response.results[0].custpersonid;
            
    //         $("input[name='h_userid']").val(userid);

    //         if (userid == null || userid=='') {
    //           // alert('2');
    //           $('.btn_create').show();
              
    //         } else {
    //           $('.btn_reset').show();

    //         }


    //         HoldOn.close()
    //      }
    //   });
    // }

  </script>
    
</body>
</html>
