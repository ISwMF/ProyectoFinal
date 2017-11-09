$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
function votar(){
  var x = document.getElementById("vote_up_button").disabled;
  var y = document.getElementById("vote_down_button").disabled;
  if (x) {
    document.getElementById("vote_up_button").disabled = false;
  }else {
    document.getElementById("vote_up_button").disabled = true;
  }
  if (y) {
    document.getElementById("vote_down_button").disabled = false;
  }else{
    document.getElementById("vote_down_button").disabled = true;
  }
}

function voteup(){
  var a = arguments[0];
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
     data:{vote:d , id:a},
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
     data:{vote:d , id:a},
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
