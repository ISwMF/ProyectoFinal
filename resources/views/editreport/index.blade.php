<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit news</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset('css/app.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/link.css')!!}">
    <script type="text/javascript" src="{!! asset('js/apiReport.js') !!}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container" >
      <h1>Edit news</h1>
      @if(Session::has('name'))
        <div class="top-right links">
          <a href="/">Home</a>
          <a href="/profile/{{Session::get('id')}}">Profile</a>
          <a href="/exit">Log Out</a>
        </div>
      @endif
      <div class="form-group">
        <label for="title">Title</label>
        <input placeholder="Some title" value="{{$report->title}}" required class="form-control" name="titleupdt" type="text" id="titleupdt">
      </div>
      <div class="form-group">
        <label for="url">URL</label>
        <input placeholder="https://www.example.com" value="{{$report->URL}}" required class="form-control" name="url" type="text" id="url">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea placeholder="Some description" required class="form-control" name="description" cols="50" rows="10" id="description">{{$report->description}}</textarea>
      </div>
      <div class="form-group" id="response">
        <input class="btn btn-default" type="submit" value="Click to update" onclick="updateReport({{$report->id}}, titleupdt.value, url.value, description.value)">
      </div>
    </div>
  </body>
</html>
