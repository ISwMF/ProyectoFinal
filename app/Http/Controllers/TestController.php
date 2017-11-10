<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\report;
use App\favorite;
use App\comment;
use Socialite;

if (isset($_GET['vote'])) {
  echo "Hola";
}

class TestController extends Controller{

  public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $userup = new User;
        $userup->name = $user->getName();
        $userup->email = $user->getEmail();
        $userup->password = "00000";
        $userup->save();
        return redirect('/');
    }
    public function updateprofile(Request $request){
      $user = User::find(session('id'));
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();
      session(['name' => $request->name]);
      session(['name' => $request->name]);
      return redirect('/');
    }
    public function updatepassword(Request $request){
      $user = User::find(session('id'));
      if (Hash::check($request->oldpassword, $user->password)) {
        $user->password = bcrypt($request->newpassword);
        $user->save();
        return redirect('/');
      }else{
        echo "Incorrect!";
      }
    }
    public function addfavorite(Request $request){
      $favorite = new favorite;
      $favorite->id_user = $request->session()->get('id');
      $favorite->id_report = $request->id_report;
      $favorite->save();
    }
    public function removefavorite(Request $request){
      $favorite = favorite::where('id_report', $request->id_report)->where('id_user', $request->session()->get('id'))->delete();
    }
    public function addcomment(Request $request){
      $comment = new comment;
      $comment->id_user = $request->session()->get('id');
      $comment->id_report = $request->id_report;
      $comment->description = $request->description;
      $comment->save();
      return response()->json(['sucess'=>'Added comment']);
    }

  public function votereport(Request $request){
    $points = $request->input('vote');
    $id_report = $request->input('id');
    $report = report::find($id_report);
    $report->points= $points;
    $reporter = User::find($request->reporter);
    if ($request->what == "-") {
      $reporter->points = $reporter->points - 1;
      $reporter->save();
    }elseif ($request->what == "+") {
      $reporter->points = $reporter->points + 1;
      $reporter->save();
    }
  }

  public function votecomment(Request $request){
    $points = $request->input('vote');
    $id_comment = $request->input('id');
    $comment = comment::find($id_comment);
    $comment->points= $points;
    $comment->save();
  }
  public function viewprofile($id){
    $user = User::find($id);
    $user->report;
    return view('profile.index', ['user'=> $user]);
  }
    public function reportView($id){
      $report = report::find($id);
      $report->user;
      $comments = comment::where('id_report', $id)->get();
      $favorite = favorite::where('id_report', $id)->where('id_user', session('id'))->get();
      //dd($favorite);
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
    public function voteup(){
      return View::make('greeting')->with('post', 'post');
    }
    public function editView(){
      return view('edit.index');
    }
    public function loginView(){
      return view('log.index');
    }
    public function registerView(){
      return view('reg.index');
    }
    public function exitView(){
      session()->flush();
      return redirect('/');
    }
    public function newpostView(){
      //echo "hola";
      return view('report.index');
    }
    public function reportAuthView(Request $request){
      $report = new report;
      $report->id_user = $request->session()->get('id');
      $report->title = $request->title;
      $report->URL = $request->url;
      $report->description = $request->description;
      $report->save();
      echo "Your news has been uploaded";
      echo "<h3><a href=\"/\">Continue</a></h3>";
    }

    public function signin (Request $request){
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
      return redirect('/');
    }

    public function authView(Request $request){
      $user = User::where('email',$request->email)->first();
      if (isset($user)) {
        if (Hash::check($request->password, $user->password)) {
          session(['id' => $user->id]);
          session(['name' => $user->name]);
          session(['points' => $user->points]);
          session(['permission' => $user->permission]);
          session(['email' => $user->email]);
          session(['created_at' => $user->created_at]);
          session(['updated_at' => $user->updated_at]);
          return redirect('/');
        }else{
          echo "Your password is incorrect";
        }
      }else {
        echo "Your email is incorrect";
      }


    }

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
