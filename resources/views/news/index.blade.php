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
    <h1>{{$report->title}}</h1>
    <hr><b>Post by:</b> {{$report->user->name}}</hr>
    <br>
    <br>
    <input type="button" onClick="parent.location='{{$report->URL}}'" value="Open URL" formtarget="_blank">
    <div id="report_description">
      {{$report->description}}
    </div>
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
  </body>
</html>
