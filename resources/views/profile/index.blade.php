<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{!! asset('js/new.js') !!}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{$user->name}}'s profile</title>
  </head>
  <body>
    <div class="jumbotron text-center">
      <h1>Welcome to {{$user->name}}'s profile</h1>
    </div>
    <div class="container">
      <input type="hidden" name="id" id="id" value="{{$user->id}}">
      <table class="table table-hover">
        <tbody>
          <tr>
            <td><b>Name</b></td>
            <td>{{$user->name}}</td>
          </tr>
          <tr>
            <td><b>Points</b></td>
            <td>{{$user->points}}</td>
          </tr>
          <tr>
            <td><b>Email</b></td>
            <td>{{$user->email}}</td>
          </tr>
        </tbody>
      </table>
      @if(Session::get('id') === $user->id)
      <a href="{{$user->id}}/edit" class="btn btn-info btn-block" role="button" name="edit">Edit</a>
      @endif
    </div>
  </body>
</html>
