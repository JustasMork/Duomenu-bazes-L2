
$(document).ready(function(){

    $('.js-checkbox-switch').click(function(){
        console.log('clicked');
        if($(this).prop('checked')){
            $('input[name="'+$(this).attr('data-name')+'"]').val(1);
        }else{
            $('input[name="'+$(this).attr('data-name')+'"]').val(0);
        }
    });


});