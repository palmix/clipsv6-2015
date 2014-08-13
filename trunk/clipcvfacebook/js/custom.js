$(document).ready( function(){

var lis = $('#topmenu li ');
var contents = $('.content div ');

$(lis).on('click' , function(){
    var div_id = "#" + $(this).attr('id') + 'div' ;
    $(contents).next().siblings().slideUp(1000);
    $(div_id).slideDown(1000);
      
     });

});

