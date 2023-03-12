<?php
require("vendor/autoload.php");
ini_set('memorylimit', '-1');
$string = file_get_contents("./city.list.json");
$json_cities = json_decode($string, true);
$eg_cities = [];
foreach ($json_cities as $element) {

    if ($element["country"] === "EG") {
        array_push($eg_cities, $element);
    }

}


if (isset($_POST["cityid"])) {
   
  
    $data = guzz();
    $d = date("F j Y ");
    $t = date("g:i a");
    echo"<div style='border: 2px solid red;width:600px;text-align:center; border-radius:10px;'><h1>guzzel</h1>";     
    echo "<h1>  CITY:{$data['name']}</h1>";
    echo "<h1>{$t}</h1>";
    echo "<h1>{$d}</h1>";
    echo "<h1>wind speed={$data['wind']['speed']}km/h</h1>";
    echo "<h1>status:{$data['weather'][0]['description']}</h1>";
    echo "<h1>humidity {$data['main']['humidity']}%</h1>";
    "</div>";


$data2=curl();
$d = date("F j Y ");
$t = date("g:i a");
echo"<div style='border: 2px solid red;width:600px;text-align:center; border-radius:10px;'><h1>curl</h1>";     
echo "<h1>  CITY:{$data2['name']}</h1>";
echo "<h1>{$t}</h1>";
echo "<h1>{$d}</h1>";
echo "<h1>wind speed={$data2['wind']['speed']}km/h</h1>";
echo "<h1>status:{$data2['weather'][0]['description']}</h1>";
echo "<h1>humidity {$data2['main']['humidity']}%</h1>";
"</div>";



}

require_once("./views/home.php");

function curl(){
    $apikey = "7e9cb4b8035b5ccae3295c8a7d9e5f0e";
    $cityid = $_POST["cityid"];
    $apiurl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityid . "&appid=" . $apikey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $apiurl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $response = curl_exec($ch);
    curl_close($ch);
     $data = json_decode($response, true);
     return $data;
}

function guzz(){
    $apikey = "7e9cb4b8035b5ccae3295c8a7d9e5f0e";
    $cityid = $_POST["cityid"];
    $apiurl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityid . "&appid=" . $apikey;

    $client= new \GuzzleHttp\client();
    $response=$client->get($apiurl);
    $data =json_decode($response->getBody(),true);
    return $data;

}