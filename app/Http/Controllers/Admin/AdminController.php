<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

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
}
