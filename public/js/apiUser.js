function saveUser(){
  var a = arguments[0];
  var b = arguments[1];
  var c = arguments[2];
  $.ajax({
     type:'POST',
     url:'/api/user',
     data:{name:a, email:b, password:c},
     success:function(data){
       $("#newuser").empty();
       $("#newuser").html(data.sucess);
     }
  });
}

function getUser(){
  var a = arguments[0];
  $.ajax({
     type:'GET',
     url:'/api/user/' + a,
     success:function(data){
       var options;
       for (var i = 1; i < 5; i++) {
         if (i == data.permission) {
           options = options + "<option selected>"+ i +"</option>";
         }else {
           options = options + "<option>"+ i +"</option>";
         }
       }
       $("#showignUser").html("<br>" +
         "<input type=\"hidden\" name=\"showid\" id=\"showid\" value=\""+data.id+"\">" +
         "<div class=\"form-group\">" +
         "<label for=\"showname\">Name:</label>" +
         "<input type=\"text\" class=\"form-control\" name=\"showname\" id=\"showname\" value=\""+data.name+"\"></input>" +
         "</div>" +
         "<div class=\"form-group\">" +
         "<label for=\"showpoints\">Points:</label>" +
         "<input type=\"text\" class=\"form-control\" name=\"showpoints\" id=\"showpoints\" value=\""+data.points+"\"></input>" +
         "</div>" +
         "<div class=\"form-group\">" +
         "<label for=\"showemail\">Email:</label>" +
         "<input type=\"text\" class=\"form-control\" name=\"showemail\" id=\"showemail\" value=\""+data.email+"\"></input>" +
         "</div>" +
         "<div class=\"form-group\">" +
         "<label for=\"showpermission\">Permission: </label>" +
         "<select class=\"form-control\" id=\"showpermission\">" +
         options +
         "</select>" +
         "</div>" +
         "<button class=\"btn btn-info btn-block\" value=\"Update user\" onclick=\"updateUser(showid.value, showname.value, showpoints.value, showpermission.value, showemail.value)\">Update user</button>"
       );
     }
  });
}

function updateUser(){
  var a = arguments[0];
  var b = arguments[1];
  var c = arguments[2];
  var d = arguments[3];
  var e = arguments[4];
  $.ajax({
     type:'PUT',
     url:'/api/user/'+a,
     data:{name:b, points:c, permission:d, email:e},
     success:function(data){
       $("#showignUser").empty();
       $("#showignUser").html("<br><h3><b>"+data.sucess+"</b></h3>");
       $("$tryUpload")prop('disabled', true);
     }
  });
}

function takeDecision(){
  var a = arguments[0];
  $("#deletethis").html("<br><h3><b>This user will be removed, are you sure?</b></h3>" +
  "<button class=\"btn btn-danger\" onclick=\"deleteUser("+ a +")\">Delete</button>");
}

function deleteUser(){
  var a = arguments[0];
  $.ajax({
     type:'DELETE',
     url:'/api/user/'+a,
     success:function(data){
       $("#deletethis").empty();
       $("#deletethis").html("<br><h3><b>"+data.sucess+"</b></h3>");
       $("#tryDelete").prop('disabled', true);
     }
  });
}
