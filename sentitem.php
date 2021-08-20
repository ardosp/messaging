<?php

function curl($url) {
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);      
  return $output;
}

$curl = curl("http://192.168.1.101/api/otepe/");

// mengubah JSON menjadi array
$data = json_decode($curl, TRUE);

// var_dump($data);

json_encode($data);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring OTP</title>

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-ui-1.8.16.custom.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">

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
  <!-- border-top-left-radius: 8px;border-top-right-radius: 8px; -->
    <header class="p-3 mb-3 border-bottom border-top" style="background-color: #fff;">
      <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
            <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg> -->
            
          </a>
          
          <svg xmlns="http://www.w3.org/2000/svg" style="fill:#517de5;" width="35" height="27" fill="currentColor" class="bi bi-inboxes-fill" viewBox="0 0 16 16">
            <path d="M4.98 1a.5.5 0 0 0-.39.188L1.54 5H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0A.5.5 0 0 1 10 5h4.46l-3.05-3.812A.5.5 0 0 0 11.02 1H4.98zM3.81.563A1.5 1.5 0 0 1 4.98 0h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 10H1.883A1.5 1.5 0 0 1 .394 8.686l-.39-3.124a.5.5 0 0 1 .106-.374L3.81.563zM.125 11.17A.5.5 0 0 1 .5 11H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0 .5.5 0 0 1 .5-.5h5.5a.5.5 0 0 1 .496.562l-.39 3.124A1.5 1.5 0 0 1 14.117 16H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .121-.393z"/>
          </svg>
          &nbsp;
          <span class="fs-4" style="color:#517de5; font-weight:600;">Sent Items</span>

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
                        <td>Text</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="textsearch-group" class="td-group">
                            <input type="text" class="form-control " name='textsearch' id='textsearch' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="ex: send messages">
                        </td>  
                      </tr>                
                      
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td >
                          <button class="btn btn-primary btn-sm" type="submit" name="button" id="cari" style=""><i class="glyphicon glyphicon-search"> </i> <b>Cari</b></button>
                        </td>  
                      </tr>    
                      
                    </table>
                  </form>
                </div>
                <div class="col-6 col-md-4">
                  <table>
                      <tr>
                          <th>
                                
                          </th>
                      </tr>
                      <tr>
                          <td>
                          </td>
                      </tr>
                  </table>
                </div>
              </div>
          </div>

        <!-- <div class="card"> -->
          <!-- <h5 class="card-header">Featured</h5> -->
          <!-- <div class="card-body"> -->
            <div class="bdr">
              <table class="table table-bordered " style="text-align: center;background-color:#fff;">
                  <tr class="card-header" style="background-color: #517de5; color:#fff;">
                    <th style="width: 1px;">No</th>
                    <th style="width: 90px;">SenderID</th>
                    <th style="width: 150px;">Tgl Insert DB</th>
                    <th style="width: 150px;">Tgl Kirim</th>
                    <th style="width: 150px;">Nomor Tujuan</th>
                    <th >Text SMS</th>
                    <th style="width: 150px;">Status</th>
                    <!-- <th style="width: 100px;">Action</th> -->
                  </tr>
                <?php 
                  $no = 1;
                  foreach ($data['data'] as $row) {
                ?>
                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $row['SenderID'] ?></td>
                    <td><?php echo $row['InsertIntoDB'] ?></td>
                    <td><?php echo $row['SendingDateTime'] ?></td>
                    <td><?php echo $row['DestinationNumber'] ?></td>
                    <td><?php echo $row['TextDecoded'] ?></td>
                    <td><?php echo $row['Status'] ?></td>
                    <!-- <td>
                      <button type="button" class="btn btn-success btn-sm" style="display: flex;" value="<?php echo $row['Id'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor-fill" viewBox="0 0 16 16">
                          <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
                        </svg> &nbsp;<b>Resend</b>
                      </button>
                      
                    </td> -->
                  </tr>
                <?php 
                  $no++;
                  } 
                ?>
              </table>
            </div>

            
            <br>
            
          <!-- </div> -->
        <!-- </div> -->
      </div>
      


    </main>
    

    <!-- <div class="col-lg-8 mx-auto p-3 py-md-5">
      
    </div> -->


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

      });
    </script>
      
  </body>
</html>
