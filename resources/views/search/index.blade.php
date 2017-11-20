<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{!! asset('css/app.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/link.css')!!}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>
  <body>
    <div class="container">
      @if(Session::has('name'))
      <div class="top-right links">
          <a href="/">Home</a>
          <a href="/newpost/">Post a new notice</a>
          <a href="/exit">Log Out</a>
        </div>
      @endif
      <br><br><br>
      <h2>Search</h2>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1">Titles</a></li>
        <li><a data-toggle="tab" href="#menu2">URL</a></li>
        <li><a data-toggle="tab" href="#menu3">Name</a></li>
        <li><a data-toggle="tab" href="#menu4">Email</a></li>
      </ul>

      <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active">
          <h3>Searching as title</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Description</th>
                <th>Points</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reportsTitles as $reportTitle)
              <tr>
                <td><b>{{$reportTitle->title}}</b></td>
                <td>{{$reportTitle->URL}}</td>
                <td>{{$reportTitle->description}}</td>
                <td>{{$reportTitle->points}}</td>
                <td><a href="/news/{{$reportTitle->id}}">GO</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div id="menu2" class="tab-pane fade">
          <h3>Searching as URL</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Description</th>
                <th>Points</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reportsURLs as $reportURL)
              <tr>
                <td>{{$reportURL->title}}</td>
                <td><b>{{$reportURL->URL}}</b></td>
                <td>{{$reportURL->description}}</td>
                <td>{{$reportURL->points}}</td>
                <td><a href="/news/{{$reportURL->id}}">GO</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div id="menu3" class="tab-pane fade ">
          <h3>Searching as name</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Points</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($usersNames as $userName)
              <tr>
                <td><b>{{$userName->name}}</b></td>
                <td>{{$userName->email}}</td>
                <td>{{$userName->points}}</td>
                <td><a href="/profile/{{$userName->id}}">GO</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div id="menu4" class="tab-pane fade">
          <h3>Searching as Email</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Points</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($usersEmails as $userEmail)
              <tr>
                <td>{{$userEmail->name}}</td>
                <td><b>{{$userEmail->email}}</b></td>
                <td>{{$userEmail->points}}</td>
                <td><a href="/profile/{{$userEmail->id}}">GO</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
