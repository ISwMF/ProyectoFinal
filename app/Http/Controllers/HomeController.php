<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\report;
use App\User;

class HomeController extends Controller {

  public function view(){
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
    return view('index', ['reports' => $reports]);
  }

}
