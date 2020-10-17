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
    $curl = curl("https://lookup.binlist.net/".$bin);
    $json = json_decode($curl);
    $cardBrand = $json->brand ? $json->brand : "not found";
    $cardType = $json->type ? $json->type : "not found";
    $cardScheme = $json->scheme ? ucwords($json->scheme) : "not found";
    $countryCode = $json->country->alpha2 ? $json->country->alpha2 : "not found";
    $countryName = $json->country->name ? $json->country->name : "not found";
    $countryLat = $json->country->latitude ? $json->country->latitude : "not found";
    $countryLong = $json->country->longitude ? $json->country->longitude : "not found";
    $cardName = $json->bank->name ? $json->bank->name : "not found";
    $url = $json->bank->url ? $json->bank->url : "not found";
    $phone = $json->bank->phone ? $json->bank->phone : "not found";
    $cardCity = $json->bank->city ? $json->bank->city : "not found";

echo "\nNama Bank : $cardName";
echo "\nJenis Brand : $cardBrand";
echo "\nTipe Kartu : $cardType";
echo "\nScheme Kartu : $cardPrepaid";
echo "\nNama Negara : $countryName";
echo "\nKode Negara : $countryCode";
echo "\nNama Kota : $cardCity";
echo "\nPeta : Lat = $countryLat | Long = $countryLong";
echo "\nURL : $url";
echo "\nNomor Telp : $phone";
echo "\n\n";
?>