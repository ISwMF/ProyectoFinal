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
  var b = arguments[1] + 1;
  $.ajax({
     type:'POST',
     url:'/ajaxRequest2',
     data:{voteup:b , id:a},
     success:function(data){
       $('#points').empty();
       $('#points').html('<h4>Points: '+ b +'</h4>');
       $("#voteup").prop('disabled', true);
       $("#greeting").html(data.sucess);
     }
  });
}
function votedown(){
  var a = arguments[0];
  var b = arguments[1] - 1;
  $.ajax({
     type:'POST',
     url:'/ajaxRequest',
     data:{votedown:b , id:a},
     success:function(data){
       $('#points').empty();
       $('#points').html('<h4>Points: '+ b +'</h4>');
       $("#votedown").prop('disabled', true);
       $("#greeting").html(data.sucess);
     }
  });
}
