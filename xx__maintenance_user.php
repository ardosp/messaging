<?php

include_once("../../include/fungsi.php");

$query="SELECT  d.userId,c.*,a.* from [192.168.1.73].ITDept.dbo.book_regAplikasi a
        left join [192.168.1.73].ITDept.dbo.book2_direct_aplikasi b on b.regid=a.RegId
        left join [192.168.1.73].ITDept.dbo.book2_cust_personal c on c.aplikasiid=b.aplikasiid
        left join [192.168.1.73].andromaf.dbo.andro_custuser d on d.noHp=c.cust_hp1
        where a.sts_orderinternal=2 and a.deletests=0 and b.aplikasiid is not null
        ";



$exec = mssql_query($query);

$result = array();
while ($data = mssql_fetch_assoc($exec)) {
    $result[] = $data;
}



?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maintenance User</title>

  <!-- jQuery -->
  <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-ui-1.8.16.custom.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- <script type="text/javascript" src="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/css/bootstrap.min.js"></script> -->

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
  </style>

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

              &nbsp;
              <span class="fs-4" style="color:#517de5; font-weight:600;">Maintenance User</span>
          </a>

          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="padding-left:20px;">
              <li>
                  <button type="button" class="btn btn-outline-success me-2" style="display: flex;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                      </svg> &nbsp;
                      <strong>Create New User</strong>
                  </button>
              </li>
          </ul>
      </div>
    </div>
    
  </header>


  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
  </button> -->

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel"><strong>Details User</strong></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form class="" action="" method="post" id="f_create_user">
                  <div class="modal-body">
                      <input type="text" name="h_kodeorder" value="">
                      <input type="text" name="h_nohp" value="">
                      <table border='0' class="">
                          <tr>
                              <td>Kode Order</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="kodeorder-group" class="td-group">
                                  <input type="text" class="form-control " name='md_kodeorder' id='md_kodeorder' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="" >
                              </td>  
                          </tr>  
                          <tr>
                              <td>Nama Nasabah</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="namanasabah-group" class="td-group">
                                  <input type="text" class="form-control " name='md_namanasabah' id='md_namanasabah' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="" >
                              </td>  
                          </tr>   
                          <tr>
                              <td>Username</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="username-group" class="td-group">
                                  <input type="text" class="form-control " name='md_username' id='md_username' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="" >
                              </td>  
                          </tr>               
                          
                          <tr>
                              <td>&nbsp;</td>
                          </tr>
                      
                      
                      </table>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create User</button>
                  
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  
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
                                  <input type="text" class="form-control " name='kodeorder' id='kodeorder' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="">
                              </td>  
                            </tr>  
                            <tr>
                              <td>Nama Nasabah</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="namanasabah-group" class="td-group">
                                  <input type="text" class="form-control " name='namanasabah' id='namanasabah' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="">
                              </td>  
                            </tr>
                            <tr>
                              <td>Tanggal Order</td>
                              <td>&nbsp;:&nbsp;</td>
                              <td id="tglOrder-group" class="td-group">
                                  <input type="text" class="form-control " name='tglOrder' id='tglOrder' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="">
                              </td>  
                            </tr>                
                            
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td >
                              <!-- <a href="#" class="btn btn-primary">
                              Search
                              </a> -->

                              <!-- <input type="submit" class="btn btn-primary" name="submit" value="Search"> -->

                              <button class="btn btn-primary btn-sm" type="submit" name="button" id="cari" style=""><i class="glyphicon glyphicon-search"> </i> <b>Cari</b></button>
                              </td>  
                            </tr>    
                        
                        </table>
                    </form>
                </div>
                <div class="col-6 col-md-4">
                
                </div>
            </div>
        </div>

        <div class="bdr">
          <table class="table table-bordered " style="text-align: center;background-color:#fff;">
              <tr class="card-header" style="background-color: #517de5; color:#fff;">
                <th style="width: 1px;">No</th>
                <th style="width: 50px;">Kode Order</th>
                <th style="width: 150px;">Nama Nasabah</th>
                <th style="width: 120px;">Nomor Handphone (Username)</th>
                <th style="width: 100px;">Email</th>
                <th style="width: 80px;">Tgl Order</th>
                <th style="width: 20px;">Action</th>
              </tr>
            <?php 
              $no = 1;
              // while ($row = mssql_fetch_assoc($exec)) {
              foreach ($result as $row) {
                  
            ?>
              <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row['RegId'] ?></td>
                <td><?php echo $row['cust_namalengkap'] ?></td>
                <td>
                    <?php echo $row['cust_hp1'] ?> 
                </td>
                <td><?php echo $row['cust_email'] ?></td>
                <td><?php echo dateSQLKaco($row['OrderDate']) ?></td>
                
                <td>
                <?php if ($row['userId'] != null || $row['userId'] != '') { ?>

                  <button type="button" name="btn_open" id="btn_open" class="btn btn-warning btn-sm btn_open position-relative" style="display: flex;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="<?php echo $row[''] ?>" data-kodeorder="<?php echo $row['RegId'] ?>" data-namanasabah="<?php echo $row['cust_namalengkap'] ?>" data-nohp="<?php echo $row['cust_hp1'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    &nbsp;<b>Edit</b>
                    
                  </button>


                <?php } else { ?>
                  
                  <button type="button" name="btn_open" id="btn_open" class="btn btn-warning btn-sm btn_open position-relative" style="display: flex;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="<?php echo $row[''] ?>" data-kodeorder="<?php echo $row['RegId'] ?>" data-namanasabah="<?php echo $row['cust_namalengkap'] ?>" data-nohp="<?php echo $row['cust_hp1'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    &nbsp;<b>Edit</b>
                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                      <span class="visually-hidden">New alerts</span>
                    </span>
                  </button>

                <?php } ?>
                  
                </td>
              </tr>
            <?php 
              $no++;
              } 
            ?>
          </table>
        </div>

        <br>
    </div>
    
  </main>



  <script src="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function(){

      /** --------------------- 
        * Searching
        * --------------------- */
      $( "form#f_cari" ).on( "submit", function( event ) {
        event.preventDefault();
        
        let textsearch = $("input[name='textsearch']").val();

        console.log(textsearch);
        alert(textsearch);
        // $.ajax({
        //     type: "POST",
        //     url   : "module/messaging/script.php",
        //     data  : { 
        //       action:'search.sentitem',
        //       textsearch: textsearch
        //     },
        //     dataType    : 'json',
        //     beforeSend: function() {
        //         HoldOn.open({
        //             theme: "sk-circle",
        //             message: "SAVING... ",
        //             backgroundColor: "#000",
        //             textColor: "#fff"
        //         });      
        //     }
        // })
        // .done(function( data ) {
        //     HoldOn.close();
            
        //     console.log(data);

        //     if (data.status_code==0) {

        //       Swal.fire({
        //           title: 'Oops...',
        //           text: 'Gagal!',
        //           icon: 'error'
        //       });

        //     } else {
              
        //       Swal.fire({
        //           title: 'Success!',
        //           text: 'Berhasil!'+data.status_desc,
        //           icon: 'success',
        //           confirmButtonText: 'Okay'
                  
        //       }).then(function(url){
        //           // location.reload();
        //       });
        //     }
        // });
        

        
      });

      /**
        * Modal Open user
        */
        $("button[name='btn_open']").on("click", function(e){
            e. preventDefault();

            // alert($(this).closest('tr').find('.btn_open').attr("data-kodeorder"));

            let kodeorder = $(this).closest('tr').find('.btn_open').attr("data-kodeorder");
            let namanasabah = $(this).closest('tr').find('.btn_open').attr("data-namanasabah");
            let nohp = $(this).closest('tr').find('.btn_open').attr("data-nohp");
            //  alert(nohp);
            $("input[name='md_kodeorder']").val(kodeorder);
            $("input[name='md_namanasabah']").val(namanasabah);
            $("input[name='md_username']").val(nohp);
            $("input[name='h_kodeorder']").val(kodeorder);
            $("input[name='h_nohp']").val(nohp);
            getBranch(kodeorder);
        });

      /**
        * Create user
        */
      $( "form#f_create_user" ).on( "submit", function( event ) {
        event.preventDefault();
        let namanasabah = $("#md_namanasabah").val();
        let nohp = $("#md_username").val();

        // alert(namanasabah+'_'+nohp);

        $.ajax({
            type: "POST",
            url   : "module/messaging/script.php",
            data  : { 
              action:'create.user',
              namanasabah: namanasabah,
              nohp: nohp
            },
            dataType    : 'json',
            beforeSend: function() {
                HoldOn.open({
                    theme: "sk-circle",
                    message: "SAVING... ",
                    backgroundColor: "#000",
                    textColor: "#fff"
                });      
            }
        })
        .done(function( data ) {
            HoldOn.close();
            
            console.log(data);

            if (data.status_code==0) {

              Swal.fire({
                  title: 'Oops...',
                  text: 'Gagal!',
                  icon: 'error'
              });

            } else {
              
              Swal.fire({
                  title: 'Success!',
                  text: 'Berhasil!'+data.status_desc,
                  icon: 'success',
                  confirmButtonText: 'Okay'
                  
              }).then(function(url){
                  // location.reload();
              });
            }
        });
      });

    });

    /**
    * Menampilkan daftar cabang pada dropdown 
    */
    function getBranch(kodeorder) {
      // mdl_branch = $("#branchModalPlusEdit")

      // field_drop_branchs = mdl_branch.find("#fmdl_branchs:last-child")
      // field_drop_branchs.children("option").remove()
      // branch_options = "<option value=\"\"> -- Pilih -- </option>"
      // field_drop_branchs.append(branch_options)

      alert(kodeorder);

      $.ajax({
         queue: true,
         cache: false,
         type: 'POST',
         url: 'module/messaging/script.php?action=get.kodeorder',
         data: {
            'kodeorder': kodeorder
         },
         beforeSend: function() {
            HoldOn.open({
               theme: "sk-dot",
               message: "PLEASE WAIT... ",
               backgroundColor: "#fcf7f7",
               textColor: "#000"
            });
         },
         success: function(response) {
            // console.log(response)
            respParse = parseJson(response);
            if (respParse) {
               if (respParse.status_code == 1) {
                  for (i = 0; i < respParse.results.length; i++) {
                     branch_options = "<option value=\"" + respParse.results[i].branchid + "\">" + respParse.results[i].branchname + "</option>"
                     field_drop_branchs.append(branch_options)
                  }
                  field_drop_branchs.val(kodeorder);
               } else {

               }
            } else {

            }
            HoldOn.close()
         }
      });
    }

  </script>
    
</body>
</html>
