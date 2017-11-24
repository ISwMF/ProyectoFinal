function opentoEdit(){
  var a = arguments[0];
  $("#descriptionof" + a).empty();
  $("#descriptionof" + a).html("<textarea rows=\"2\" class=\"form-control\" id=\"changingdescription\"></textarea>" +
  "<br>" +
  "<button class=\"btn btn-info\" onClick=\"editCommentasAdmin("+ a +", changingdescription.value)\">Send</button>"
  );
}

function deleteCommentasAdmin(){
  var a = arguments[0];
  var b = arguments[1];
  $.ajax({
     type:'DELETE',
     url:'/api/comment/'+a,
     success:function(data){
       window.location.href = "/news/"+b;
     }
  });
}

function editCommentasAdmin(){
  var a = arguments[0];
  var b = arguments[1];
  $.ajax({
     type:'PUT',
     url:'/api/comment/'+a,
     data:{description:b},
     success:function(data){
       $("#descriptionof" + a).empty();
       $("#descriptionof" + a).html(
         "<div class=\"row\">" +
         "<div class=\"col-sm-10\">" + b + "</div>" +
         "<div align=\"right \" class=\"col-sm-2\">" +
         "<div class=\"btn-group\">" +
         "<button type=\"button\" name=\"button\" class=\"btn btn-info btn-sm\" onclick=\"opentoEdit(" + a + ")\">Edit</button>" +
         "<button type=\"button\" name=\"button\" class=\"btn btn-danger btn-sm\">Delete</button>" +
         "</div>" +
         "</div>" +
         "</div>");
     }
  });
}
