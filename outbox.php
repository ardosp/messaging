<?php

function curl($url) {
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);      
  return $output;
}

$curl = curl("http://192.168.1.101/api/otepe/outbox");

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
    
    <header class="p-3 mb-3 border-bottom border-top" style="background-color: #fff;">
      <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          
          <svg xmlns="http://www.w3.org/2000/svg" style="fill:#517de5;" width="40" height="32" fill="currentColor" class="bi bi-mailbox2" viewBox="0 0 16 16">
            <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9v1z"/>
            <path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4zM8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8V7zm-3.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157z"/>
          </svg>
          &nbsp;
          <span class="fs-4" style="color:#517de5; font-weight:600;">Outbox SMS</span>
          
        </div>
      </div>
    </header>
    

    <main>

      <div class="container-xxl" >
          <!-- <div class="p-3 mb-3 border-bottom border-top" style="background-color: #fff; border-right: 1px solid #dee2e6 !important; border-left: 1px solid #dee2e6 !important; border-radius:8px;">
          
              <div class="row" style="padding:15px;">
                <div class="col-md-8">
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
                        <a href="#" class="btn btn-primary">
                          Search
                        </a>
                      </td>  
                    </tr>    
                    
                  </table>
                </div>
                <div class="col-6 col-md-4">
                  
                </div>
              </div>
            
          </div> -->
        
          <!-- SELECT InsertIntoDB, SendingDateTime, Text, DestinationNumber, TextDecoded, ID, SenderID, DeliveryReport, Retries, Status from outbox -->
          <div class="bdr">
            <table class="table table-bordered " style="text-align: center;background-color:#fff;">
                <tr class="card-header" style="background-color: #517de5; color:#fff;">
                  <th style="width: 1px;">No</th>
                  <th style="width: 90px;">SenderID</th>
                  <th style="width: 100px;">Tgl Insert DB</th>
                  <th style="width: 100px;">Tgl Kirim</th>
                  <th style="width: 100px;">Nomor Tujuan</th>
                  <th style="width: 220px;">Text SMS</th>
                  <th style="width: 100px;">DeliveryReport</th>
                  <th style="width: 70px;">Retries</th>
                  <th style="width: 100px;">Status</th>
                  <!-- <th style="width: 70px;">Action</th> -->
                </tr>
              <?php 
                $no = 1;
                if ($data['status_code']==1) {
                  foreach ($data['data'] as $row) {
              ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $row['SenderID'] ?></td>
                      <td><?php echo $row['InsertIntoDB'] ?></td>
                      <td><?php echo $row['SendingDateTime'] ?></td>
                      <td><?php echo $row['DestinationNumber'] ?></td>
                      <td><?php echo $row['TextDecoded'] ?></td>
                      <td><?php echo $row['DeliveryReport'] ?></td>
                      <td><?php echo $row['Retries'] ?></td>
                      <td><?php echo $row['Status'] ?></td>
                      <!-- <td>
                        <button type="button" class="btn btn-success btn-sm" style="display: flex;" value="<?php echo $row['ID'] ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor-fill" viewBox="0 0 16 16">
                            <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
                          </svg> &nbsp;<b>Resend</b>
                        </button>
                      </td> -->
                    </tr>
              <?php 
                  $no++;
                  } 
                }
                else {
              ?>
                  <tr >
                    <td colspan="10" style="text-align: left;">Data tidak ditemukan.</td>
                  </tr>
              <?php
                }
              ?>
            </table>
          </div>
            
      </div>
      


    </main>
    

    <!-- <div class="col-lg-8 mx-auto p-3 py-md-5">
      
    </div> -->


    <script src="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
