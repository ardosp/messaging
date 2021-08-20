<?php

include_once("../../include/fungsi.php");

$kodeOrder      = $_POST['kodeOrder'];
$namaNasabah    = $_POST['namaNasabah'];
$tglOrderStart  = dateSQL($_POST['tglOrderStart']);
$tglOrderEnd    = dateSQL($_POST['tglOrderEnd']);
$statusDaftar   = $_POST['statusDaftar'];

$query="SELECT  d.userId,d.smsId,c.*,a.* from [192.168.1.73].ITDept.dbo.book_regAplikasi a
        left join [192.168.1.73].ITDept.dbo.book2_direct_aplikasi b on b.regid=a.RegId
        left join [192.168.1.73].ITDept.dbo.book2_cust_personal c on c.regid=b.regid
        left join [192.168.1.73].andromaf.dbo.andro_custuser d on d.noHp=c.cust_hp1
        where a.sts_orderinternal=2 and a.deletests=0 and b.aplikasiid is not null 
        and (c.regid='$kodeOrder' or '$kodeOrder'='')
        and (c.cust_namalengkap like '%$namaNasabah%' or '%$namaNasabah%'='')
        and (a.OrderDate between '$tglOrderStart' and '$tglOrderEnd' or '$tglOrderStart'='' and '$tglOrderEnd'='')
        ";
echo $query;

$exec = mssql_query($query);

$result = array();
while ($data = mssql_fetch_assoc($exec)) {
    $result[] = $data;
}



?>

<style>
    .col-sm{
        /* background-color: #517de5; */
        padding: 7px;
        border: 1px solid #232323;
        /* border-bottom: 1px solid #929292; */
    }
    .detail-order tr td{
            padding: 7px;
    }
</style>

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
                    <input type="hidden" name="h_kodeorder" value="">
                    <input type="hidden" name="h_nohp" value="">
                    <input type="hidden" name="h_userid" value="">
                    <!-- <input type="text" name="h_smsid" value=""> -->
                    <table border='0' class="">
                        <tr>
                            <td>Kode Order</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td id="kodeorder-group" class="td-group">
                                <input type="text" class="form-control " name='md_kodeorder' id='md_kodeorder' autocomplete="on" style="width: 140px;" placeholder="" readonly>
                            </td>  
                        </tr>  
                        <tr>
                            <td>Nama Nasabah</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td id="namanasabah-group" class="td-group">
                                <input type="text" class="form-control " name='md_namanasabah' id='md_namanasabah' autocomplete="on" style="width: 140px;" placeholder="" readonly>
                            </td>  
                        </tr>   
                        <tr>
                            <td>Username</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td id="username-group" class="td-group">
                                <input type="text" class="form-control " name='md_username' id='md_username' autocomplete="on" style="width: 140px;" placeholder="" readonly>
                            </td>  
                        </tr>  
                        <tr>
                            <td style="padding-top:8px;">Status SMS Order User</td>
                            <td style="padding-top:8px;">&nbsp;:&nbsp;</td>
                            <td id="username-group" class="td-group" style="padding-top:6px;">
                                <span name="statusSms" id="statusSms"></span>
                            </td>  
                        </tr> 
                        <tr>
                            <td style="padding-top:11px;">Tanggal Terkirim</td>
                            <td style="padding-top:11px;">&nbsp;:&nbsp;</td>
                            <td id="username-group" class="td-group" style="padding-top:6px;">
                                <!-- <input type="text" name="sendingDateTime" id="sendingDateTime" value=''> -->
                                <span name="sendingDateTime" id="sendingDateTime"></span>
                            </td>  
                        </tr>             
                        
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    
                    
                    </table>
                    
                </div>
                <div class="modal-footer">
                <?php
                
                
                ?>
                <button type="submit" class="btn btn-primary btn_create" style="display: none;">Create User</button>
                
                <button type="button" class="btn btn-danger btn_reset" style="display: none;">Reset Password</button>
                
                    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Order -->
<div class="modal fade" id="modalOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalOrderLabel"><strong>Details Order</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" action="" method="post" id="f_detail_order">
                <div class="modal-body">
                custpersonid<input type="text" name="h_customer_personal" id="h_customer_personal" value=""><br>
                jaminanid<input type="text" name="h_jaminan" id="h_jaminan" value=""><br>
                cust_ecommerceid<input type="text" name="h_ecommerce" id="h_ecommerce" value=""><br>
                regid<input type="text" name="h_regid" id="h_regid" value=""><br>
                aplikasiid<input type="text" name="h_aplikasiid" id="h_aplikasiid" value="">
                
                    <div class="alert alert-info">
                        <strong>Informasi!</strong> Pengecekan dan Transfer Data dari Preorder ke Bookregaplikasi.
                    </div>
                    <table border='0' class="detail-order">
                        <tr>
                            <td>1.</td>
                            <td>DATA CUSTOMER PERSONAL</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td >
                                <!-- <span class="text-success"><b>Data Tersimpan</b></span> -->
                                <span class="status-text1"></span>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <button type="button" class="btn btn-primary btn_transfer1 disabled" style="">Transfer Data</button>
                            </td>
                        </tr>  
                        <tr>
                            <td>2.</td>
                            <td>DATA JAMINAN</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td >
                                <!-- <span class="text-success"><b>Data Tersimpan</b></span> -->
                                <span class="status-text2"></span>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <button type="button" class="btn btn-primary btn_transfer2 disabled" style="">Transfer Data</button>
                            </td>
                        </tr>   
                        <tr>
                            <td>3.</td>
                            <td>DATA E-COMMERCE</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td >
                                <!-- <span class="text-success"><b>Data Tersimpan</b></span> -->
                                <span class="status-text3"></span>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <button type="button" class="btn btn-primary btn_transfer3 disabled" style="">Transfer Data</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    
                    </table>
                    
                </div>
                <div class="modal-footer">
                
                    <button type="submit" class="btn btn-primary btn_create" style="display: none;">Create User</button>
                    
                    <button type="button" class="btn btn-danger btn_reset" style="display: none;">Reset Password</button>
                    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
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
            <th style="width: 80px;">Email</th>
            <th style="width: 100px;">Status SMS Order User</th>
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
            <td class="regid">
                <a href="" name="link_modalorder" class="link_modalorder" data-bs-toggle="modal" data-bs-target="#modalOrder" data-kodeorder="<?php echo $row['RegId'] ?>">
                    <?php echo $row['RegId'] ?>
                </a>
                
            </td>
            <td style="text-align: left;"><?php echo $row['cust_namalengkap'] ?></td>
            <td>
            <?php if ($row['userId'] == null || $row['userId'] == '') { ?>
                <div style="display:inline-block;">
                <?php echo $row['cust_hp1'] ?> 
                <span class="badge bg-danger">not registered</span>
                </div>
                <?php } else { ?>
                <span class="text-success"> <?php echo $row['cust_hp1'] ?> </span>
                <?php } ?>
            </td>
            <td><?php echo $row['cust_email'] ?></td>
            <td >
                <?php //echo $row['smsId'] 
                if ($row['smsId'] != null || $row['smsId'] != '') {
                    echo "Terkirim";
                    // ." (".$row['smsId'].")";
                } 
                ?>
            </td>
            <td><?php echo dateSQLKaco($row['OrderDate']) ?></td>
            
            <td>
            <?php if ($row['smsId'] != null || $row['smsId'] != '') { ?>

                <button type="button" name="btn_open" id="btn_open" class="btn btn-warning btn-sm btn_open position-relative" style="display: flex;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="<?php echo $row[''] ?>" data-kodeorder="<?php echo $row['RegId'] ?>" data-namanasabah="<?php echo $row['cust_namalengkap'] ?>" data-nohp="<?php echo $row['cust_hp1'] ?>" data-custpersonid="<?php echo $row['custpersonid'] ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
                &nbsp;<b>Create/Reset User</b>
                
                </button>


            <?php } else { ?>
                
                <button type="button" name="btn_open" id="btn_open" class="btn btn-warning btn-sm btn_open position-relative" style="display: flex;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="<?php echo $row[''] ?>" data-kodeorder="<?php echo $row['RegId'] ?>" data-namanasabah="<?php echo $row['cust_namalengkap'] ?>" data-nohp="<?php echo $row['cust_hp1'] ?>" data-custpersonid="<?php echo $row['custpersonid'] ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
                &nbsp;<b>Create/Reset User</b>
                <!-- <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span> -->
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


<script src="<?php echo hostname(); ?>/module/messaging/hasilcari.js">
    

</script>