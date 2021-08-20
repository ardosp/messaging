<?php

/**
 * MENGAMBIL DATA DARI REST API 101
 */
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
  <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="<?php echo HOSTNAME(); ?>/js/jquery-ui-1.8.16.custom.min.js"></script>
  <!-- Sweetalert -->
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo hostname(); ?>/plugins/sweetalert/sweetalert2.css">
  <script type="text/javascript" src="<?php echo hostname(); ?>/plugins/sweetalert/sweetalert.min.js"></script> -->

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
    
  </style>

  <!-- Custom styles for this template -->
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/custom/headers.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/custom/starter-template.css" rel="stylesheet">
  
  
  
</head>
<body style="background: #fff;">
  
  <header class="p-3 mb-3 border-bottom border-top" style="background-color: #517de5;">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        
        <svg xmlns="http://www.w3.org/2000/svg" style="fill:#fff;" width="35" height="27" fill="currentColor" class="bi bi-chat-quote-fill" viewBox="0 0 16 16">
          <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z"/>
        </svg>
        &nbsp;
        <span class="fs-4" style="color:#fff; font-weight:600;">Create SMS</span>
        
      </div>
    </div>
  </header>
  

  <main>

    <div class="container-xxl" >
      <div class="p-3 mb-3 border-bottom border-top " style="background-color: #fff;border-right: 1px solid #dee2e6 !important; border-left: 1px solid #dee2e6 !important; border-radius:8px;">
        <div class="row" style="padding:15px;">
          <div class="col-md-8">
            <form name="sms_form" id="sms_form" method="POST" >
              <table border='0' class="">
                <tr>
                    <td>Jenis SMS</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td id="jenis-group" class="td-group">
                        <input type="text" class="form-control " name='jenis' id='jenis' maxlength="14" autocomplete="on" style="width: 140px;" value="Personal SMS" readonly>
                    </td>  
                </tr>      
                <tr>
                    <td>Penerima SMS</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td id="penerima-group" class="td-group">
                        <!-- <input type="text" class="form-control " name='penerima' id='penerima' maxlength="14" autocomplete="on" style="width: 140px;" placeholder="ex: 0858xxx"> -->

                        <div class="input-group " style="padding-top:5px;padding-bottom:5px;">
                          <span class="input-group-text" id="basic-addon1">+62</span>
                          <input type="text" class="form-control" name='penerima' id='penerima' oninput="this.value=this.value.replace(/[^0-9]/g,'');"  maxlength="11" placeholder="Nomor Handphone" aria-label="Nomor Handphone" aria-describedby="basic-addon1">
                        </div>
                    </td>  
                </tr>           
                <tr>
                    <td>Text SMS</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td id="sendtext-group" class="td-group">
                        <textarea name="textsms" id="textsms" cols="50" rows="8" style="resize: none;"></textarea>
                        
                    </td>  
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <div>
                            <div><span id="remaining">160</span>&nbsp;Character<span class="cplural">s</span> Remaining</div>
                            <div>Total&nbsp;<span id="textsmss">1</span>&nbsp;Message<span class="mplural">s</span>&nbsp;<span id="total">0</span>&nbsp;Character<span class="tplural">s</span></div>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td >
                        
                        <button type="submit" name="btn_send" id="btn_send" class="btn btn-primary" style="display: flex;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor-fill" viewBox="0 0 16 16">
                            <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
                            </svg> &nbsp;
                            <b>Send SMS</b>
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
    </div>
    
  </main>
  

  <!-- <div class="col-lg-8 mx-auto p-3 py-md-5">
    testing
  </div> -->


  <script src="<?php echo hostname(); ?>/plugins/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
  <script>
      
    $(document).ready(function()
    {
      
      /** --------------------- 
       * Submit Form
       * --------------------- */
      $( "form#sms_form" ).on( "submit", function( event ) {
        event.preventDefault();
        // console.log( $( this ).serialize() );
        // alert('testtt');
        let penerima = $("input[name='penerima']").val();
        let textsms = $('textarea#textsms').val();

        if (penerima === '' || penerima == null) {
          Swal.fire({
            title: 'Oops...',
            text: 'No penerima tidak boleh kosong!',
            icon: 'error',
            confirmButtonText: 'Okay'
          });
        } else {
          // console.log(penerima);
          // console.log(textsms);
          $.ajax({
              type: "POST",
              url   : "module/messaging/script.php",
              data  : { 
                action:'send.sms',
                penerima: penerima, 
                textsms: textsms 
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
              // log data to the console so we can see
              console.log(data);
              // alert( "Data Saved: " + data.status_desc );

              if ( data.status_code==0) {

                Swal.fire({
                    title: 'Oops...',
                    text: 'Gagal mengirim SMS!',
                    icon: 'error'
                });

              } else {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                });

                Toast.fire({
                  icon: 'success',
                  title: data.status_desc,
                  // background: '#E1E8EB'
                }).then(function(){
                    // location.reload();
                });

                // Swal.fire({
                //     title: 'Success!',
                //     text: 'SMS kamu berhasil dikirim ke .'+data.status_desc,
                //     icon: 'success',
                //     confirmButtonText: 'Okay'
                    
                // }).then(function(url){
                //     location.reload();
                // });
              }
          });
        } 

        
      });


      /** --------------------- 
       * Text Counter
       * --------------------- */
      part1Count = 160;
      part2Count = 145;
      part3Count = 152;
  
      $('#textsms').keyup(function(){
          var chars = $(this).val().length;
              textsmss = 0;
              remaining = 0;
              total = 0;
          if (chars <= part1Count) {
              textsmss = 1;
              remaining = part1Count - chars;
          } else if (chars <= (part1Count + part2Count)) {
              textsmss = 2;
              remaining = part1Count + part2Count - chars;
          } else if (chars > (part1Count + part2Count)) {
              moreM = Math.ceil((chars - part1Count - part2Count) / part3Count) ;
              remaining = part1Count + part2Count + (moreM * part3Count) - chars;
              textsmss = 2 + moreM;
          }
          $('#remaining').text(remaining);
          $('#textsmss').text(textsmss);
          $('#total').text(chars);
          if (remaining > 1) $('.cplural').show();
              else $('.cplural').hide();
          if (textsmss > 1) $('.mplural').show();
              else $('.mplural').hide();
          if (chars > 1) $('.tplural').show();
              else $('.tplural').hide();
      });
      $('#textsms').keyup();
    });
  </script>

    
</body>
</html>
