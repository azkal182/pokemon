<?php
include('/bin/support.php');


function color($color = "default" , $text)
    {
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
            'purple'    => '1;35',
            'nevy'      => '1;36',
            'white'     => '1;0',
        );
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }

function curl($url, $fields = null, $headers = null) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  if ($fields !== null) {
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  }
  if ($headers !== null) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  }
  $result = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  return array($result, $httpcode);
  }

function getotp() {
  $secret = '83415d06-ec4e-11e6-a41b-6c40088ab51e';
  $headers = array();
  $headers[] = 'Content-Type: application/json';
  $headers[] = 'X-AppVersion: 3.48.2';
  $headers[] = "X-Uniqueid: ac94e5d0e7f3f" . rand(111, 999);
  $headers[] = 'X-Location: id_ID';
  ulang:
   echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
   $number = trim(fgets(STDIN));
   $login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $number . '"}', $headers);
   $logins = json_decode($login[0]);
   if ($logins->success == true) {
       otp:
           echo "[+] Masukin Kode OTP Kamu Disini : ";
           $otp = trim(fgets(STDIN));
           $data1 = '{"scopes":"gojek:customer:transaction gojek:customer:readonly","grant_type":"password","login_token":"' . $logins->data->login_token . '","otp":"' . $otp . '","client_id":"gojek:cons:android","client_secret":"' . $secret . '"}';
           $verif = curl('https://api.gojekapi.com/v3/customers/token', $data1, $headers);
           $verifs = json_decode($verif[0]);
           if ($verifs->success == true) {
               $token = $verifs->data->access_token;
               $headers[] = 'Authorization: Bearer ' . $token;
               $live = "token-akun.txt";
               $fopen1 = fopen($live, "a+");
               $fwrite1 = fwrite($fopen1, "Token Kamu : " . $token . "
  Nomor GoJek Kamu : " . $number . "
  ");
               fclose($fopen1);
               echo "
  ";
               echo "Token Kamu : " . $token . "
  ";
               echo "Token Berhasil Disimpan Di File " . $live . "
  ";
               echo "
  ";
           } else {
               echo "
  ";
               echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!
  ";
               echo "
  ";
               goto otp;
           }
       } else {
           echo "
  ";
           echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!
  ";
           echo "
  ";
           goto ulang;
       }
}



function ceker(){
  //echo color("green","[+] Token GOJEK Kamu Disini : ");
  //$token = trim(fgets(STDIN));
  $token = "ae31ae63-c76d-4fba-8bf9-d6c68ecd55a7";
  $secret = ''.$token.'';
  $header = array();
  $header[] = 'Content-Type: application/json';
  $header[] = 'X-AppVersion: 3.46.2';
  $header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
  $header[] = 'X-Location: id_ID';
  $header[] ='Authorization: Bearer '.$token;
  $header[] = 'pin:'.$pin.'';
  //CHECKER DETAIL AKUN
  $info = curl('https://api.gojekapi.com/v1/chat/profile', null, $header);
      $verifs = json_decode($info[0]);
           $akun = $verifs->data->name;
           $nope = $verifs->data->phone;
     echo "\n";
     echo color("yellow","nama : ".$akun." \n");
     echo color("yellow","nomer : 0".$nope." \n\n");
  //CHECKER SALDO GOPAY
  $detail = curl('https://api.gojekapi.com/wallet/profile/detailed', null, $header);
           $saldoo = json_decode($detail[0]);
                  $saldo = $saldoo->data->balance;
                      echo color("yellow","Sisa Saldo Gopay = $saldo \n\n");
  //CHECKER VOUCHER YANG ADA
  $detail_voucher = curl('https://api.gojekapi.com/gopoints/v3/wallet/vouchers?limit=10&page=1', null, $header);
       $vouchers = json_decode($detail_voucher[0]);
       $total_voucher = $vouchers->voucher_stats->total_vouchers;
       $nama_voucher = $vouchers->data[0]->title;

       if ($vouchers->success == true) {
       echo "";
       echo color("blue","Kamu Punya " . $total_voucher . " Voucher GOJEK");
       echo " \n";
       }
       for ($i = 0; $i < $total_voucher; $i++) {
         $batas_voucher = $vouchers->data[$i + 1]->expiry_date;
         $nama_voucher1 = $vouchers->data[$i + 1]->title;


         echo color("green", $i + 1 . "] Voucher " . $vouchers->data[$i]->title . "\n");
         echo color("yellow", "    kadaluarsa " . $vouchers->data[$i]->expiry_date . "\n");
         //echo $i + 1 . "\n";
       }

       //fo ($i = 0;$i < $total_voucher )





}




 ?>
