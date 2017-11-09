<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{!! asset('js/new.js') !!}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{$report->title}}</title>
  </head>
  <body>
    <div class="container">


    <h1>{{$report->title}}</h1>
    <hr><b>Post by:</b> {{$report->user->name}}</hr>
    <br>
    <br>

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

    @if(Session::has('name'))
      <script type="text/javascript">
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
      </script>

      <button class="btn btn-success btn-submit" type="button" name="voteup" id="voteup" onclick="voteup({{$report->id}}, {{$report->points}})">Vote Up</button>
      <button class="btn btn-success btn-submit" type="button" name="votedown" id="votedown" onclick="votedown({{$report->id}}, {{$report->points}})">Vote Down</button>
      <div class="greeting" id="greeting" name="greeting">
      </div>
    @endif
    <br>
    <div class="panel-group">
      @foreach($comments as $comment)
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="row">
            @if(Session::has('name'))
            <div class="col-sm-1 col-xs-4">
              <div  class="btn-group btn-group-sm">
                <input type="button" name="voteupcomment{{$comment->id}}" id="voteupcomment{{$comment->id}}" value="+" class="btn btn-info " onclick="voteupcomment({{$comment->id}})">
                <input type="button" name="votedowncomment{{$comment->id}}" id="votedowncomment{{$comment->id}}" value="--" class="btn btn-info " onclick="votedowncomment({{$comment->id}})">
              </div>
            </div>
            @endif
            <div class="col-sm-9 col-xs-4">
              <p><b>{{$comment->user->name}} commented</b> | {{$comment->created_at}}</p>
            </div>
            <div class="col-sm-2 col-xs-4" id="pointscomment{{$comment->id}}" name="pointscomment{{$comment->id}}">
              <b>Points: {{$comment->points}}</b>
            </div>

          </div>

        </div>
        <div class="panel-body">{{$comment->description}}</div>
      </div>
      @endforeach
    </div>
  </div>
  </body>
</html>
