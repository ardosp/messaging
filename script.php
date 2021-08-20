<?php 
require_once "../../include/fungsi.php";
$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];
$user_nik = $_SESSION['nik'];

switch ($action) {
    /**
     * SEARCH SENT ITEMS
     */
    case "search.sentitem":
        $textsearch = $_POST['textsearch'];


        $url = "http://192.168.1.101/api/otepe/searchSentItem";
        $par = array("textsearch" => $textsearch                        
                    );
                    
        $encode_par = json_encode($par);
        echo request_curl($url,"POST",$encode_par);

        break;

    /**
     * SEND SMS
     */
    case "send.sms":
        $prefix = '+62';
        $nopel = $_POST['penerima'];
        $pesan = $_POST['textsms'];
        $IdUpload	= date('ymdHis').'-'.$_SESSION['nik'];

        // $encode = json_decode($_POST['jsnRqs'],true);
        $url = "http://192.168.1.101/api/otepe/sendMessage";
        $par = array("user"         => $user_nik,
                        "nopel"    => $prefix.$nopel,
                        "pesan"    => $pesan,
                        "IdUpload" => $IdUpload
                        
                    );
                    
        $encode_par = json_encode($par);
        echo request_curl($url,"POST",$encode_par);



        // $replay['status_code'] = 1;
        // $replay['status_desc'] = 'Pesan Terkirim';
        // $replay['results'] = $pesan;

        // echo json_encode($replay);
        break;

    /**
     * CREATE USER & SEND SMS GENERATED PASSWORD TO USER
     */
    case "create.user":
        // echo 'tes';
        $namaUser = $_POST['namanasabah'];
        $noHp = $_POST['nohp'];

        /** Random Generated Password */
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
        
            return $random_string;
        }

        $generatedPassword = generate_string($permitted_chars, 6);
        $md5Password = md5($generatedPassword);

        /** Query */
        $query = "INSERT INTO [192.168.1.73].andromaf.dbo.andro_custuser (userName,noHp,password,createUser,createDate) 
        VALUES ('$namaUser','$noHp','$md5Password','$user_nik',getDate())";

        // echo $query;

        if (mssql_query($query)) {
            /** Send SMS */
            $pesan = "User anda ".$noHp.". Kata sandi anda ".$generatedPassword.". Pihak PT MULTINDO AUTO FINANCE tidak akan meminta kata sandi Anda.";

            $url = "http://192.168.1.101/api/otepe/sendMessageUser";
            $par = array("user"  => $user_nik,
                        "nopel"  => $noHp,
                        "pesan"  => $pesan
                        );
                        
            $encode_par = json_encode($par);
            // echo request_curl($url,"POST",$encode_par);
            $result = request_curl($url,"POST",$encode_par);

            // print_r($result);
            
            $resultDecode = json_decode($result, true);
            $smsId = $resultDecode['smsId'];

            // $queryInsertSmsId = "INSERT INTO [192.168.1.73].andromaf.dbo.andro_custuser (smsId,lastUser,lastDate) 
            // VALUES ('$smsId','$user_nik',getDate())";

            $queryInsertSmsId = "UPDATE [192.168.1.73].andromaf.dbo.andro_custuser SET smsId = '$smsId', lastUser = '$user_nik', lastDate = getDate() WHERE noHp = '$noHp'";

            mssql_query($queryInsertSmsId);

            // $result['query'] = $queryInsertSmsId;





            // function curl($url) {
            //     $ch = curl_init(); 
            //     curl_setopt($ch, CURLOPT_URL, $url);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            //     $output = curl_exec($ch); 
            //     curl_close($ch);      
            //     return $output;
            // }
            
            // $curl = curl("http://192.168.1.101/api/otepe/");
            
            // // mengubah JSON menjadi array
            // $data = json_decode($curl, TRUE);
            
            // // var_dump($data);
            echo $result;
        }

        break;

    /**
     * RESET USER PASSWORD & SEND SMS GENERATED PASSWORD TO USER
     */
    case "reset.user":
        $namaUser = $_POST['namanasabah'];
        $noHp = $_POST['nohp'];
        $userId = $_POST['userid'];
        // echo $namaUser.'_'.$noHp.'_'.$userId;

        /** Random Generated Password */
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
        
            return $random_string;
        }

        $generatedPassword = generate_string($permitted_chars, 6);
        $md5Password = md5($generatedPassword);


        if (mssql_query($query)) {
            /** Send SMS */
            $pesan = "Kata sandi berhasil direset. Kata sandi baru anda ".$generatedPassword.". Pihak PT MULTINDO AUTO FINANCE tidak akan meminta kata sandi Anda.";

            $url = "http://192.168.1.101/api/otepe/sendMessageUser";
            $par = array("user"  => $user_nik,
                        "nopel"  => $noHp,
                        "pesan"  => $pesan
                        );
                        
            $encode_par = json_encode($par);
            // echo request_curl($url,"POST",$encode_par);
            $result = request_curl($url,"POST",$encode_par);

            $resultDecode = json_decode($result, true);
            $smsId = $resultDecode['smsId'];
            // var_dump($result);

            /** Update Query */
            $queryInsertSmsId = "UPDATE [192.168.1.73].andromaf.dbo.andro_custuser SET smsId='$smsId', password='$md5Password', changePassUse='$user_nik', changePassDate=getDate(), lastUser='$user_nik', lastDate=getDate() WHERE userId = '$userId'";

            mssql_query($queryInsertSmsId);
            // echo $queryInsertSmsId;

            echo $result;
            
        }

        break;

    /**
     * GET KODEORDER AND GET STATUS SENDING SMS
     */
    case "get.kodeorder":
        $replay = array();
        $row_result = array();
        $smsid = '';

        $kodeorder    = $_POST['kodeorder'];
        $custpersonid = $_POST['custpersonid'];
        $nohp         = $_POST['nohp'];

        
        $sql = "SELECT  d.userId,d.smsId,c.custpersonid,c.cust_namalengkap from [192.168.1.73].ITDept.dbo.book_regAplikasi a
                left join [192.168.1.73].ITDept.dbo.book2_direct_aplikasi b on b.regid=a.RegId
                left join [192.168.1.73].ITDept.dbo.book2_cust_personal c on c.regid=b.regid
                left join [192.168.1.73].andromaf.dbo.andro_custuser d on d.noHp=c.cust_hp1
                where a.regid='$kodeorder' and a.sts_orderinternal=2 and a.deletests=0 and b.aplikasiid is not null and custpersonid='$custpersonid'";
        
        $exec = mssql_query($sql);
        // echo $sql;

        if (mssql_num_rows($exec) > 0) {
            while ($hsl = mssql_fetch_assoc($exec)) {
                $column = array();
                $column['userId'] = $hsl['userId'];
                $column['custpersonid'] = $hsl['custpersonid'];
                $column['smsId'] = $hsl['smsId'];
                array_push($row_result, $column);

                $smsid = $hsl['smsId'];
            }
        }

        /**GET DATA SMS */
        $url = "http://192.168.1.101/api/otepe/dataSentSms";
        $par = array("user"  => $user_nik,
                    "nopel"  => $nohp,
                    "smsid"  => $smsid
                    );
                    
        $encode_par = json_encode($par);
        // echo request_curl($url,"POST",$encode_par);
        $result = request_curl($url,"POST",$encode_par);

        
        $decode = json_decode($result, true);

        $count = count($row_result);
        if ($count > 0) {
            $replay['status_code'] = 1;
            $replay['status_desc'] = "Success";
            $replay['total_result'] = $count;
            $replay['results'] = $row_result;
            $replay['sendingDateTime'] = $decode['sendingDateTime'] == '' ? '-' : $decode['sendingDateTime'];
            $replay['status'] = $decode['status'] == '' ? '-' : $decode['status'];
        } else {
            $replay['status_code'] = 2;
            $replay['status_desc'] = "Data tidak ditemukan";
        }
        echo json_encode($replay);
        break;

    /**
     * CEK DATA ORDER BEFORE TRANSFER DATA
     */
    case "cek.dataorder":
        $replay = array();
        $kodeorder = $_POST['kodeorder'];

        $query_personal = "SELECT custpersonid from [192.168.1.73].ITDept.dbo.book2_cust_personal where regid='$kodeorder'";
        $exec_personal = mssql_query($query_personal);
        $res_personal = mssql_fetch_assoc($exec_personal);

        $query_jaminan = "SELECT jaminanid from [192.168.1.73].ITDept.dbo.book2_jaminan where regId='$kodeorder'";
        $exec_jaminan = mssql_query($query_jaminan);
        $res_jaminan = mssql_fetch_assoc($exec_jaminan);

        $query_ecommerce = "SELECT cust_ecommerceid from [192.168.1.73].ITDept.dbo.book2_cust_ecommerce where regId='$kodeorder'";
        $exec_ecommerce = mssql_query($query_ecommerce);
        $res_ecommerce = mssql_fetch_assoc($exec_ecommerce);

        $query_directapp = "SELECT aplikasiid,regid from [192.168.1.73].ITDept.dbo.book2_direct_aplikasi where regid='$kodeorder'";
        $exec_directapp = mssql_query($query_directapp);
        $res_directapp = mssql_fetch_assoc($exec_directapp);
        

        if (mssql_num_rows($exec_personal) > 0) {
            $replay['status_code'] = 1;
            $replay['status_desc'] = "Success";
            $replay['data_personal'] = $res_personal['custpersonid'];
            $replay['data_jaminan'] = $res_jaminan['jaminanid'];
            $replay['data_ecommerce'] = $res_ecommerce['cust_ecommerceid'];
            $replay['aplikasiid'] = $res_directapp['aplikasiid'];
        } else {
            $replay['status_code'] = 2;
            $replay['status_desc'] = "Data tidak ditemukan";
        }
        echo json_encode($replay);
        break;

    /**
     * TRANSFER/SAVE DATA NASABAH FROM PREORDER
     */
    case "transfer.data.cust":
        $replay = array();
        $RegId      = $_POST['regid'];
        $aplikasiid = $_POST['aplikasiid'];

        $query_cust = "if not exists (select custpersonid from [192.168.1.73].ITDept.dbo.book2_cust_personal where regid=" . $RegId . ")
            begin 
                INSERT into [192.168.1.73].ITDept.dbo.book2_cust_personal
                (regid,cust_namalengkap,cust_jnsidentitas,cust_noidentitas,
                cust_email,cust_hp1,cust_whatsapp,cust_akun_fb,cust_akun_ig,
                cust_domisili_alamat,cust_domisili_rt,cust_domisili_rw,cust_domisili_kel,cust_domisili_kec,
                cust_domisili_kabkota,cust_domisili_prov,cust_domisili_kodepos,cust_domisili_sandidati,
                pekerjaanid_namacorp,pekerjaanid_lama_th,pekerjaanid_lama_bl,deletests,createdate,createuser) 
                        
                select
                " . $RegId . " regid,cust_namalengkap,1 cust_jnsidentitas,cust_noidentitas,
                cust_email,cust_nohp,cust_nowa,cust_akun_fb,cust_akun_ig,
                cust_alamat,cust_rt,cust_rw,cust_kelurahan,cust_kecamatan,
                cust_kabkota,cust_provinsi,cust_kodepos,cust_sandidati,
                pekerjaanid_namacorp,pekerjaanid_lama_th,pekerjaanid_lama_bl,0 deletests,getdate()createdate,'" . $user . "'createuser
                from [192.168.1.73].ITDept.dbo.book2_direct_aplikasi where aplikasiid=" . $aplikasiid . "
            end";
        $exec_cust = mssql_query($query_cust);
            
        if ($exec_cust) {
            $replay['status_code'] = 1;
            $replay['status_desc'] = "Success";
        } else {
            $replay['status_code'] = 2;
            $replay['status_desc'] = "Data tidak ditemukan";
        }
        echo json_encode($replay);
        break;

    case "transfer.data.jaminan":
        $replay     = array();
        $RegId      = $_POST['regid'];
        $aplikasiid = $_POST['aplikasiid'];

        $query_insertjaminan = "
            if not exists (select jaminanid from [192.168.1.73].ITDept.dbo.book2_jaminan where regId=" . $RegId . ")
            begin
                insert into [192.168.1.73].ITDept.dbo.book2_jaminan (regid,type_jaminanid,status_jaminan)
                select " . $RegId . " regid,type_jaminanid,status_jaminan from [192.168.1.73].ITDept.dbo.book2_jaminan_preorder where aplikasiid=" . $aplikasiid . "
            end
        ";
        $exec_insertjaminan = mssql_query($query_insertjaminan);
        
        // $replay['query'] = $query_insertjaminan;

        if ($exec_insertjaminan) {
            $replay['status_code'] = 1;
            $replay['status_desc'] = "Success";
        } else {
            $replay['status_code'] = 2;
            $replay['status_desc'] = "Data tidak ditemukan";
        }
        echo json_encode($replay);
        break;

    case "transfer.data.ecommerce":
        $replay     = array();
        $RegId      = $_POST['regid'];
        $aplikasiid = $_POST['aplikasiid'];

        $query_insertecommerce = "
            if not exists (select cust_ecommerceid from [192.168.1.73].ITDept.dbo.book2_cust_ecommerce where regId=" . $RegId . ")
            begin
                insert into [192.168.1.73].ITDept.dbo.book2_cust_ecommerce (ecommerceid,regid,namaaccount)
                select ecommerceid," . $RegId . " regid,namaaccount from [192.168.1.73].ITDept.dbo.book2_cust_ecommerce_preorder where aplikasiid=" . $aplikasiid . "
            end
        ";
        $exec_insertecommerce = mssql_query($query_insertecommerce);
        

        if ($exec_insertecommerce) {
            $replay['status_code'] = 1;
            $replay['status_desc'] = "Success";
        } else {
            $replay['status_code'] = 2;
            $replay['status_desc'] = "Data tidak ditemukan";
        }
        echo json_encode($replay);
        break;

}