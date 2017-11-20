function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function addtofavorite(){
  var a = arguments[0];
  $.ajax({
     type:'POST',
     url:'/addfavorite',
     data:{id_report:a},
     success:function(data){
       $("#favorite").empty();
       $('#favorite').html('<button type=\"button\" name=\"buttonunfavorite\" id=\"buttonunfavorite\" class=\"btn btn-warning\" onclick=\"removefavorite('+a+')\">Remove from favorites</button>');
     }
  });
}
function removefavorite(){
  var a = arguments[0];
  $.ajax({
     type:'POST',
     url:'/removefavorite',
     data:{id_report:a},
     success:function(data){
       $("#favorite").empty();
       $('#favorite').html('<button type=\"button\" name=\"buttonfavorite\" id=\"buttonfavorite\" class=\"btn btn-warning\" onclick=\"addtofavorite('+a+')\">Add to favorites</button>');
     }
  });
}
function sendcomment(){
  var a = arguments[0];
  var b = arguments[1];
  if (b == "") {
    alert('Your comments can\'t be empty');
  }
  else{
    $.ajax({
       type:'POST',
       url:'/sendcomment',
       data:{id_report:a , description:b},
       success:function(data){
         $("#message").html(data.sucess);
         $("#commentdescription").prop('readonly', true);
       }
    });
  }
}

function voteup(){
  var a = arguments[0];
  var b = arguments[1];
  var c = $("#points").text();
  var d = "";
  for (var i = 0; i < c.length; i++) {
    if (c.charAt(i)=="1" || c.charAt(i)=="2" || c.charAt(i)=="3" || c.charAt(i)=="4"
    || c.charAt(i)=="5" || c.charAt(i)=="6" || c.charAt(i)=="7" || c.charAt(i)=="8"
    || c.charAt(i)=="9" || c.charAt(i)=="0" || c.charAt(i)=="-") {
      d = d + c.charAt(i);
    }
  }
  d = parseInt(d);
  d = d + 1;
  $.ajax({
     type:'POST',
     url:'/votereport',
     data:{vote:d , id:a, reporter:b, what:"+"},
     success:function(data){
       $('#points').empty();
       $('#points').html('<h4>Points: '+ d +'</h4>');
       $("#voteup").prop('disabled', true);
       $("#votedown").prop('disabled', false);
     }
  });
}
function votedown(){
  var a = arguments[0];
  var b = arguments[1];
  var c = $("#points").text();
  var d = "";
  for (var i = 0; i < c.length; i++) {
    if (c.charAt(i)=="1" || c.charAt(i)=="2" || c.charAt(i)=="3" || c.charAt(i)=="4"
    || c.charAt(i)=="5" || c.charAt(i)=="6" || c.charAt(i)=="7" || c.charAt(i)=="8"
    || c.charAt(i)=="9" || c.charAt(i)=="0" || c.charAt(i)=="-") {
      d = d + c.charAt(i);
    }
  }
  d = parseInt(d);
  d = d - 1;
  $.ajax({
     type:'POST',
     url:'/votereport',
     data:{vote:d , id:a, reporter:b, what:"-"},
     success:function(data){
       $('#points').empty();
       $('#points').html('<h4>Points: '+ d +'</h4>');
       $("#votedown").prop('disabled', true);
       $("#voteup").prop('disabled', false);

     }
  });
}
function voteupcomment(){
  var a = arguments[0];
  var c = $( "#pointscomment" + a ).text();
  var d = "";
  for (var i = 0; i < c.length; i++) {
    if (c.charAt(i)=="1" || c.charAt(i)=="2" || c.charAt(i)=="3" || c.charAt(i)=="4"
    || c.charAt(i)=="5" || c.charAt(i)=="6" || c.charAt(i)=="7" || c.charAt(i)=="8"
    || c.charAt(i)=="9" || c.charAt(i)=="0" || c.charAt(i)=="-") {
      d = d + c.charAt(i);
    }
  }
  d = parseInt(d);
  d = d + 1;
  $.ajax({
     type:'POST',
     url:'/votecomment',
     data:{vote:d , id:a},
     success:function(data){
       $('#pointscomment'+ a).empty();
       $('#pointscomment'+ a).html('<b>Points: '+ d +'</b>');
       $("#voteupcomment"+ a).prop('disabled', true);
       $("#votedowncomment"+ a).prop('disabled', false);
     }
  });
}
function votedowncomment(){
  var a = arguments[0];
  var c = $( "#pointscomment" + a ).text();
  var d = "";
  for (var i = 0; i < c.length; i++) {
    if (c.charAt(i)=="1" || c.charAt(i)=="2" || c.charAt(i)=="3" || c.charAt(i)=="4"
    || c.charAt(i)=="5" || c.charAt(i)=="6" || c.charAt(i)=="7" || c.charAt(i)=="8"
    || c.charAt(i)=="9" || c.charAt(i)=="0" || c.charAt(i)=="-") {
      d = d + c.charAt(i);
    }
  }
  d = parseInt(d);
  d = d - 1;
  $.ajax({
     type:'POST',
     url:'/votecomment',
     data:{vote:d , id:a},
     success:function(data){
       $('#pointscomment'+ a).empty();
       $('#pointscomment'+ a).html('<b>Points: '+ d +'</b>');
       $("#votedowncomment"+ a).prop('disabled', true);
       $("#voteupcomment"+ a).prop('disabled', false);
     }
  });
}

function deleteComment(){
  var a = arguments[0];
  $.ajax({
     type:'POST',
     url:'/deleteComment',
     data:{id:a},
     success:function(data){
       $("#deleteComment"+ a).prop('disabled', true);
     }
  });
}
