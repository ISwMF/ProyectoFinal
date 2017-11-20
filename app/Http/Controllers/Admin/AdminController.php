<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\report;

class AdminController extends Controller {

  public function auth(){
    if (null !== session('name')) {
      if (session('permission') > 1) {
        $users = User::all();
        return view('admin.index', ['users' => $users]);
      }else{
        return redirect('/');
      }
    }else{
      return redirect('/');
    }
  }

  public function authtoEditReport($id){
    if (null !== session('name')) {
      if (session('permission') > 2) {
        $report = report::find($id);
        return view('editreport.index', ['report' => $report]);
      }else{
        return redirect('/');
      }
    }else{
      return redirect('/');
    }
  }
}
