
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Wecome mr. Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset('css/app.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/link.css')!!}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{!! asset('js/apiUser.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/apiReport.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/new.js') !!}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>
  <body>
    <div class="container">
      <h1>Welcome {{session('name')}}</h1>
      <div class="top-right links">
        <a href="/">Home</a>
        <a href="/profile/{{Session::get('id')}}">Profile</a>
        <a href="/newpost/">Post a new notice</a>
        <a href="/exit">Log Out</a>
      </div>
      <h2>User Panel</h2>
      <p>Here you can create, update and delete users. If you have problems refresh the page (press F5).</p>
      <div class="panel-group">
        @if(Session::get('permission') > 1)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1">Create User</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body" id="newuser" name="newuser">
              <div class="form-group">
                <label for="name">Name</label>
                <input placeholder="Jhon Doe" required class="form-control" name="namenewuser" type="text" id="namenewuser">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input placeholder="example@example.com" required class="form-control" name="emailnewuser" type="text" id="emailnewuser">
              </div>
              <div class="form-group">
                <label for="newpassword">Password</label>
                <input placeholder="******" required class="form-control" name="newpassword" type="password" value="" id="newpassword">
              </div>
              <div class="form-group">
                <input class="btn btn-info btn-block" type="submit" value="Create User" onclick="saveUser(namenewuser.value, emailnewuser.value, newpassword.value)">
              </div>
            </div>
          </div>
        </div>
        @endif
        @if(Session::get('permission') > 2)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse2">Update User</a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body" id="updateuser" name="updateuser">
              <label for="sel1">Select a user:</label>
              <div class="row-fluid">
                <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="selectuser" name="selectuser">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}} / {{$user->email}}</option>
                  @endforeach
                </select>
              </div>
              <br>
              <button class="btn btn-info btn-block" type="button" name="tryUpload" id="tryUpload" onclick="getUser(selectuser.value)">Get user</button>
              <div class="" id="showignUser" name="showignUser">
              </div>
            </div>
          </div>
        </div>
        @endif
        @if(Session::get('permission') > 3)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse3">Delete User</a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body" id="updateuser" name="updateuser">
              <label for="sel1">Select a user:</label>
              <div class="row-fluid">
                <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="selectusertodelete" name="selectusertodelete">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}} / {{$user->email}}</option>
                  @endforeach
                </select>
              </div>
              <br>
              <button class="btn btn-info btn-block" type="button" name="tryDelete" id="tryDelete" onclick="takeDecision(selectusertodelete.value)">Get user</button>
              <div class="" id="deletethis">
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
      <h2>News panel</h2>
      <p>In this panel you can only create news, If you need to delete or modify, go directly to the news page</p>
      <div class="panel-group">
        @if(Session::get('permission') > 1)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse4">Create News</a>
            </h4>
          </div>
          <div id="collapse4" class="panel-collapse collapse">
            <div class="panel-body" id="createnews" name="createnews">
              <p>You need to choose a user who owns the news</p>
              <label for="sel1">Select a user:</label>
              <div class="row-fluid">
                <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="selectuserasowner" name="selectuserasowner">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}} / {{$user->email}}</option>
                  @endforeach
                </select>
              </div>
              <br>
              <button class="btn btn-info" type="button" name="selectownreport" id="selectownreport" onclick="getOwnerUser(selectuserasowner.value)">Get user</button>
              <div class="" id="showreportatributes">
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </body>
</html>
