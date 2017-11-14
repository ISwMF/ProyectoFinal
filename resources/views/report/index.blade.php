<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>New report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset('css/app.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/link.css')!!}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h1>New report</h1>
      @if(Session::has('name'))
        <div class="top-right links">
          <a href="/">Home</a>
          <a href="/profile/{{Session::get('id')}}">Profile</a>
          <a href="/exit">Log Out</a>
        </div>
      @endif
      {!! Form::open(['action' => 'ReportController@uploadReport']) !!}
      <div class="form-group">
        {!!Form::label('title', 'Title')!!}
        {!!Form::text('title', '', ['placeholder' => 'Some title','required', 'class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('url', 'URL')!!}
        {!!Form::text('url', '', ['placeholder' => 'https://www.example.com','required','class' => 'form-control'])!!}
      </div>
      <div class="form-group">
        {!!Form::label('description', 'Description')!!}
        {!!Form::textarea('description', '', ['placeholder' => 'Some description','required','class' => 'form-control'])!!}
      </div>

      <div class="form-group">
        {!!Form::submit('Click to post', ['class' => 'btn btn-default'])!!}
      </div>
      {!! Form::close() !!}
    </div>
  </body>
</html>
