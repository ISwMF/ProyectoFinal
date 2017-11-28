<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset('css/app.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/link.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/inputSearch.css')!!}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>News</title>
  </head>
  <body>
    <div class="container">
      <h1>NEWS</h1>
      @if(Session::has('name'))
        <p>Welcome {{Session::get('name')}} </p>
        <div class="top-right links">
          @if(Session::get('permission') > 1)
          <a href="admin">Administrator</a>
          @endif
          <a href="profile/{{Session::get('id')}}">Profile</a>
          <a href="newpost/">Post a new notice</a>
          <a href="exit">Log Out</a>
        </div>
        <div class="search">
          {!! Form::open(['action' => 'UserController@search']) !!}
            {!!Form::text('search', '', ['placeholder' => 'Search','', 'class' => ''])!!}
          {!! Form::close() !!}
        </div>
      @else
        <div class="top-right links">
          <a href="log/">Login</a>
          <a href="reg/">Register</a>
        </div>
      @endif
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Show last tweet</button>
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">BBC tweet</h4>
            </div>
            <div class="modal-body" align="center">
              <blockquote class="twitter-tweet" data-lang="es">
                <p lang="es" dir="ltr">
                <a href="{{$urlTwitter}}">Tweet</a>
              </blockquote>
              <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
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
