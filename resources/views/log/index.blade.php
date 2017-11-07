  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
  <body>
    <h1>Log in</h1>
    <div class="container">
      {!! Form::open(['action' => 'TestController@authView']) !!}
      <div class="form-group">
        {!!Form::label('email', 'E-Mail Address')!!}
        {!!Form::text('email', '', ['placeholder' => 'example@example.com','required','class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('password', 'Password')!!}
        {!!Form::password('password', ['placeholder' => '*******', 'class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::submit('Click to login', ['class' => 'btn btn-default'])!!}
      </div>
      {!! Form::close() !!}
    </div>
  </body>
</html>
