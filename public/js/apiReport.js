function getOwnerUser(){
  var a = arguments[0];
  $('#showreportatributes').html("<br><br>"+
    "<div class=\"form-group\">" +
    "<label for=\"newtitle\">Title</label>" +
    "<input placeholder=\"Some title\" required class=\"form-control\" name=\"newtitle\" type=\"text\" id=\"newtitle\">" +
    "</div>" +
    "<div class=\"form-group\">" +
    "<label for=\"newurl\">URL</label>" +
    "<input placeholder=\"https://www.google.com\" required class=\"form-control\" name=\"newurl\" type=\"text\" id=\"newurl\">" +
    "</div>" +
    "<div class=\"form-group\">" +
    "<label for=\"newdescription\">Description</label>" +
    "<textarea class=\"form-control\" rows=\"5\" id=\"newdescription\" name=\"newdescription\"></textarea>" +
    "</div>" +
    "<div class=\"form-group\">" +
    "<input class=\"btn btn-info btn-block\" type=\"submit\" value=\"Create report\" onclick=\"saveReport("+a+", newtitle.value, newurl.value, newdescription.value)\">" +
    "</div>"
  );
}

function saveReport(){
  var a = arguments[0];
  var c = arguments[2];
  var b = arguments[1];
  var d = arguments[3];
  //alert("id_user: "+a + " title: " + b + " link: " + c + " description:" + d);
$.ajax({
     type:'POST',
     url:'/api/report',
     data:{id_user:a, title:b, link:c, description:d},
     success:function(data){
       $("#createnews").empty();
       $("#createnews").html("<br><h3><b>"+data.sucess+"</b></h3>");
     }
  });
}

function updateReport(){
  var a = arguments[0];
  var c = arguments[2];
  var b = arguments[1];
  var d = arguments[3];
  //alert(a + " " + b + " " + c + " " + d);
  $.ajax({
     type:'PUT',
     url:'/api/report/'+a,
     data:{title:b, link:c, description:d},
     success:function(data){
       $("#response").empty();
       $("#response").html("<br><h3><b>"+data.sucess+"</b></h3>");
     }
  });
}
