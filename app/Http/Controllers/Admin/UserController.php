<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller {

    public function index()  {
      $users = User::all();
      return $users;
    }

    public function store(Request $request) {
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
      return $user;
    }

    public function show($id) {
      $user = User::find($id);
      return $user;
    }

    public function update(Request $request, $id) {
      $user = User::find($id);
      $user->name = $request->name;
      $user->points = $request->points;
      $user->permission = $request->permission;
      $user->email = $request->email;
      $user->save();
      return $user;
    }

    public function destroy($id) {
      User::destroy($id);
      return response()->json([
        'sucess' => 'Destroyed'
      ]);
    }
}
