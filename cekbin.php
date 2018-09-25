<?php
error_reporting(0);
echo "\nMasukkan BIN      : ";
$six = trim(fgets(STDIN, 1024));
  // Insert CURL
  function curl($url, $var = null) {
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_TIMEOUT, 25);
      if ($var != null) {
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
      }
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($curl);
      curl_close($curl);
      return $result;
  }
  // Enam digit Formula
  function defineNUM($bin) {
      return substr($bin,0,6);
  }
  // JSON DATA
    $bin = defineNUM($six);
    $curl = curl("https://idsystem404.000webhostapp.com/api/api-cekinfobin.php?bin=".$bin);
    $json = json_decode($curl);
    $cardBrand = $json->brand ? $json->brand : "TIDAK ADA";
    $cardType = $json->type ? $json->type : "TIDAK ADA";
    $cardPrepaid = $json->prepaid ? $json->prepaid : "TIDAK ADA";
    $countryCode = $json->country->alpha2 ? $json->country->alpha2 : "TIDAK ADA";
    $countryName = $json->country->name ? $json->country->name : "TIDAK ADA";
    $countryLat = $json->country->latitude ? $json->country->latitude : "TIDAK ADA";
    $countryLong = $json->country->longitude ? $json->country->longitude : "TIDAK ADA";
    $cardName = $json->bank->name ? $json->bank->name : "TIDAK ADA";
    $url = $json->bank->url ? $json->bank->url : "TIDAK ADA";
    $phone = $json->bank->phone ? $json->bank->phone : "TIDAK ADA";
    $cardCity = $json->bank->city ? $json->bank->city : "TIDAK ADA";

echo "\nNama Bank : $cardName";
echo "\nJenis Brand : $cardBrand";
echo "\nTipe Kartu : $cardType";
echo "\nJenis Prepaid : $cardPrepaid";
echo "\nNama Negara : $countryName";
echo "\nKode Negara : $countryCode";
echo "\nNama Kota : $cardCity";
echo "\nPeta : Lat = $countryLat | Long = $countryLong";
echo "\nURL : $url";
echo "\nNomor Telp : $phone";
echo "\n\n";
?>