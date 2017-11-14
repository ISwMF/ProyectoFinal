<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset('css/app.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/link.css')!!}">
    <title>News</title>
  </head>
  <body>
    <div class="container">

      <h1>NEWS</h1>
      @if(Session::has('name'))
        <p>Welcome {{Session::get('name')}} </p>
        <div class="top-right links">
          <a href="profile/{{Session::get('id')}}">Profile</a>
          <a href="newpost/">Post a new notice</a>
          <a href="exit">Log Out</a>
        </div>
      @else

      <div class="top-right links">
        <a href="log/">Login</a>
        <a href="reg/">Register</a>
      </div>
      @endif

      <div id='news'>
        @foreach($reports as $report)
        <hr>
          <h3><a href="news/{{$report->id}}"> {{$report->title}}</a></h3>
          <font size=2> Posted by: {{$report->user->name}} </font>
          <br>
          <font size=2> Date: {{$report->created_at}} </font>
          <p> Points: {{$report->points}}</p>
        </hr>
        @endforeach
      </div>
    </div>
  </body>
</html>
