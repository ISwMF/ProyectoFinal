<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
    }
    </style>
  </head>
  <body>
    <h1>NEWS</h1>
    <?php

    ?>
    @if(Session::has('name'))
      <p>Welcome {{Session::get('name')}} </p>

      <div class="top-right links">
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
  </body>
</html>
