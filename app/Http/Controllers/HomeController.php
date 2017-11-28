<?php

namespace App\Http\Controllers;

require_once('TwitterAPIExchange.php');
use Illuminate\Http\Request;
use App\report;
use App\User;
use App\Http\Controllers\TwitterAPIExchange;

class HomeController extends Controller {

  public function view(){
    $settings = array(
    'oauth_access_token' => "2608308186-23K1fHRVMqs41obomcr9ziqjBCpxNJR06F5mAwB",
    'oauth_access_token_secret' => "Hz7F3627y8ACOrlHEvHcFO1lM80tyLQVrZhQkE96DQlub",
    'consumer_key' => "crtzMkueEbRAHKmGw3pBY8RBn",
    'consumer_secret' => "tietXGYrJLf5BhhgrjQUH5PUTDNm7fWsgwqpdXWxltBiCXZBew"
    );

    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name=bbcmundo&count=1';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange($settings);
    $var = $twitter->setGetfield($getfield)
      ->buildOauth($url, $requestMethod)
      ->performRequest();
    $pos = strpos($var, "\"id\"");
    $pos = $pos + 5;
    $a = 0;
    $id = "";
    for ($i=0; $a < 2; $i++) {
      if ($var[$pos + $i] === '"' || $var[$pos + $i] === ',') {
        $a = $a + 1;
      }else{
        $id = $id . ($var[$pos + $i]);
      }
    }
    $url = "https://twitter.com/bbcmundo/status/". $id;

    $reports = report::all();
    $length = count($reports);
    for($i=0;$i<($length-1);$i++){
      for($j=$i+1;$j<$length;$j++){
        if($reports[$i]->points < $reports[$j]->points){
            $variableauxiliar=$reports[$i];
            $reports[$i]=$reports[$j];
            $reports[$j]=$variableauxiliar;
        }
      }
    }
    for ($i=0; $i < count($reports) ; $i++) {
      $reports[$i]->user;
    }
    return view('index', ['reports' => $reports, 'urlTwitter' => $url]);

  }

}
