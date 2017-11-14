<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\report;
use App\comment;
use App\favorite;

class ReportController extends Controller {

  public function reportView($id){
    $report = report::find($id);
    $report->user;
    $comments = comment::where('id_report', $id)->get();
    $favorite = favorite::where('id_report', $id)->where('id_user', session('id'))->get();
    $length = count($comments);
    for($i=0;$i<($length-1);$i++){
      for($j=$i+1;$j<$length;$j++){
        if($comments[$i]->points < $comments[$j]->points){
            $variableauxiliar=$comments[$i];
            $comments[$i]=$comments[$j];
            $comments[$j]=$variableauxiliar;
        }
      }
    }
    for ($i=0; $i < $length ; $i++) {
        $comments[$i]->user;
    }
    return view('news.index', ['report'=> $report, 'comments' => $comments, 'favorite' => $favorite]);
  }

  public function uploadReport(Request $request){
    $report = new report;
    $report->id_user = $request->session()->get('id');
    $report->title = $request->title;
    $report->URL = $request->url;
    $report->description = $request->description;
    $report->save();
    echo "Your news has been uploaded";
    echo "<h3><a href=\"/\">Continue</a></h3>";
  }

  public function deleteReport(Request $request){
    report::destroy($request->id);
    echo "Your report has been removed, congratulations";
    echo "<h3><a href=\"/profile/".$request->session()->get('id')."\">Back</a></h3>";
  }
}
