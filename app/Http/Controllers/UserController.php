<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\report;
use App\comment;
use App\favorite;
use Socialite;

class UserController extends Controller {

  public function viewProfile($id){
    $user = User::find($id);
    $reports = report::where('id_user', $id)->get();
    return view('profile.index', ['user'=> $user, 'reports' =>$reports]);
  }

  public function viewSignIn(){
    return view('reg.index');
  }

  public function signIn (Request $request){
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();
    return redirect('/');
  }

  public function redirectToProvider() {
    return Socialite::driver('facebook')->redirect();
  }

  public function handleProviderCallback() {
    $user = Socialite::driver('facebook')->user();
    $userup = new User;
    $userup->name = $user->getName();
    $userup->email = $user->getEmail();
    $userup->password = "00000";
    $userup->save();
    return redirect('/');
  }

  public function viewLogin(){
    return view('log.index');
  }

  public function logIn(Request $request){
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

  public function viewEdit(){
    return view('edit.index');
  }

  public function updateProfile(Request $request){
    $user = User::find(session('id'));
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();
    session(['name' => $request->name]);
    session(['name' => $request->name]);
    return redirect('/');
  }

  public function updatePassword(Request $request){
    $user = User::find(session('id'));
    if (Hash::check($request->oldpassword, $user->password)) {
      $user->password = bcrypt($request->newpassword);
      $user->save();
      return redirect('/');
    }else{
      echo "Incorrect!";
    }
  }

  public function postReport(){
    return view('report.index');
  }

  public function voteReport(Request $request){
    $points = $request->input('vote');
    $id_report = $request->input('id');
    $report = report::find($id_report);
    $report->points= $points;
    $report->save();
    $reporter = User::find($request->reporter);
    if ($request->what == "-") {
      $reporter->points = $reporter->points - 1;
      $reporter->save();
    }elseif ($request->what == "+") {
      $reporter->points = $reporter->points + 1;
      $reporter->save();
    }
  }

  public function addComment(Request $request){
    $comment = new comment;
    $comment->id_user = $request->session()->get('id');
    $comment->id_report = $request->id_report;
    $comment->description = $request->description;
    $comment->save();
    return response()->json(['sucess'=>'Added comment']);
  }

  public function deleteComment(Request $request){
    comment::destroy($request->id);
  }

  public function voteComment(Request $request){
    $points = $request->input('vote');
    $id_comment = $request->input('id');
    $comment = comment::find($id_comment);
    $comment->points= $points;
    $comment->save();
  }

  public function addFavorite(Request $request){
    $favorite = new favorite;
    $favorite->id_user = $request->session()->get('id');
    $favorite->id_report = $request->id_report;
    $favorite->save();
  }

  public function removeFavorite(Request $request){
    $favorite = favorite::where('id_report', $request->id_report)->where('id_user', $request->session()->get('id'))->delete();
  }

  public function exit(){
    session()->flush();
    return redirect('/');
  }

}
