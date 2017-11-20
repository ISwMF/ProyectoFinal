<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset('css/app.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/link.css')!!}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{!! asset('js/new.js') !!}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{$report->title}}</title>
  </head>
  <body>
    <div class="container">
      @if(Session::has('name'))
      <div class="top-right links">
        <a href="/">Home</a>
        <a href="/profile/{{Session::get('id')}}">Profile</a>
        <a href="/newpost/">Post a new notice</a>
        <a href="/exit">Log Out</a>
      </div>
      @endif
      <h1>{{$report->title}}</h1>
      <div class="row">
        <div class="col-sm-9">
          <hr><b>Post by:</b> <a href="/profile/{{$report->user->id}}">{{$report->user->name}}</a></hr>
        </div>

        @if(Session::has('name') && !isset($favorite[0]))
        <div class="col-sm-3" id="favorite">
          <button type="button" name="buttonfavorite" id="buttonfavorite" class="btn btn-warning btn-block" onclick="addtofavorite({{$report->id}})">Add to favorites</button>
        </div>
        @elseif(Session::has('name') && isset($favorite[0]))
        <div class="col-sm-3" id="favorite">
          <button type="button" name="buttonunfavorite" id="buttonunfavorite" class="btn btn-warning btn-block" onclick="removefavorite({{$report->id}})">Remove from favorites</button>
        </div>
        @endif
      </div>
      <div class="row">
        <div class="col-sm-8">

        </div>
        <div class="col-sm-4">
          <div class="btn-group btn-group-justified">
            @if(Session::get('permission') > 3)
            <a href="#" class="btn btn-danger">Delete this</a>
            @endif
            @if(Session::get('permission')   > 2)
            <a href="{{$report->id}}/edit" class="btn btn-info">Edit this</a>
            @endif
          </div>
        </div>
      </div>
    <div id="report_description">
      {{$report->description}}
    </div>
    <br>
    <br>
    <input class="btn btn-info" type="button" onClick="parent.location='{{$report->URL}}'" value="Open URL" formtarget="_blank">
    <br>
    <br>
    <div class="points" id="points" name="points">
      <h4>Points: {{$report->points}}</h4>
    </div>

    @if(Session::has('name') && $report->user->id != Session::get('id'))
      <script type="text/javascript">
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
      </script>

      <button class="btn btn-success btn-submit" type="button" name="voteup" id="voteup" onclick="voteup({{$report->id}}, {{$report->user->id}})">Vote Up</button>
      <button class="btn btn-success btn-submit" type="button" name="votedown" id="votedown" onclick="votedown({{$report->id}}, {{$report->user->id}})">Vote Down</button>
      <div class="greeting" id="greeting" name="greeting">
      </div>
    @endif
    <br>
    @if(Session::has('name'))
    <div class="row">
      <div class="col-sm-3">
        <div align="center">
          <h4>Sponsor</h4>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Make a comment</div>
          <textarea rows="2" class="form-control" name="commentdescription" id="commentdescription"></textarea>
          <div class="panel-body" id="message" name="message">
            <button type="button" class="btn btn-info" name="button" onclick="sendcomment({{$report->id}}, commentdescription.value)">Send comment</button>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div align="center">
          <h4>Sponsor</h4>
        </div>
      </div>
    </div>
    @endif

    <div class="panel-group">
      @foreach($comments as $comment)
      <div class="panel panel-info">
        <div class="panel-heading" >
          <div class="row">
            @if(Session::has('name') && $comment->user->id != Session::get('id'))
            <div class="col-sm-1 col-xs-4">
              <div  class="btn-group btn-group-sm">
                <input type="button" name="voteupcomment{{$comment->id}}" id="voteupcomment{{$comment->id}}" value="+" class="btn btn-info " onclick="voteupcomment({{$comment->id}})">
                <input type="button" name="votedowncomment{{$comment->id}}" id="votedowncomment{{$comment->id}}" value="--" class="btn btn-info " onclick="votedowncomment({{$comment->id}})">
              </div>
            </div>
            @elseif(Session::has('name') && $comment->user->id == Session::get('id'))
            <div class="col-sm-1 col-xs-4">

            </div>
            @endif
            <div class="col-sm-9 col-xs-4">
              <p><b>{{$comment->user->name}} commented</b> | {{$comment->created_at}}</p>
            </div>
            <div class="col-sm-1 col-xs-4" id="pointscomment{{$comment->id}}" name="pointscomment{{$comment->id}}">
              <b>Points: {{$comment->points}}</b>
            </div>
            @if(Session::has('name') && $comment->user->id == Session::get('id'))
            <div class="col-sm-1 col-xs-4" align="right">
              <button type="button" onclick="deleteComment({{$comment->id}})" name="deleteComment{{$comment->id}}" id="deleteComment{{$comment->id}}" class="btn btn-danger btn-block" >X</button>
            </div>
            @endif

          </div>

        </div>
        <div class="panel-body">{{$comment->description}}</div>
      </div>
      @endforeach
    </div>
  </div>
  </body>
</html>
