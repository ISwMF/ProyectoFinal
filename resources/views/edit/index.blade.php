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
  </head>
  <body>
    @if(true)
    <div class="container">
      <h1>Edit profile</h1>
      {!!Form::open(['action' => 'TestController@updateprofile'])!!}
      <div class="form-group">
        {!!Form::label('name', 'Name')!!}
        {!!Form::text('name', Session::get('name'), ['placeholder' => Session::get('name'),'class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('email', 'Email')!!}
        {!!Form::text('email', Session::get('email'), ['placeholder' => Session::get('email'),'class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::submit('Update profile', ['class' => 'btn btn-info btn-block'])!!}
      </div>
      {!!Form::close()!!}
      <br><br>
      <h1>Edit password</h1>
      {!!Form::open(['action' => 'TestController@updatepassword'])!!}
      <div class="form-group">
        {!!Form::label('oldpassword', 'Old Password')!!}
        {!!Form::password('oldpassword', ['placeholder' => '******','required','class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('newpassword', 'New Password')!!}
        {!!Form::password('newpassword', ['placeholder' => '','required','class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::submit('Update password', ['class' => 'btn btn-info btn-block'])!!}
      </div>
      {!!Form::close()!!}
    </div>
    @endif
  </body>
</html>
