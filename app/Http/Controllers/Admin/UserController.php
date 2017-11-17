<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;

class UserController extends Controller {

    public function index()  {

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
      return new UserResource(User::find($id));
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
