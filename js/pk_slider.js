$(document).ready(function () {
    var totalElements = 0;
    $('.slider').each(function(){
        totalElements++;
    });
    if(totalElements == 1){
        $(".next").hide();
        $(".prev").hide();
    }
    if($('body').find('.slider_container').length && $('body').find('.slider').length)
        processElement($('.slider:first'));
    
    $('.next').click(function () {
        var $nextElement = $('.slider_container').find('.current').next();
        $('.slider_container').find('.current').removeClass('current').hide();
        $nextElement.addClass('current').show();
        
        if ($nextElement.length == 0) {
            $nextElement = $('.slider:first');
            $('.slider:first').addClass('current').show();
        }
        processElement($nextElement);
    });
    
    $('.prev').click(function () {
        var $prevElement = $('.slider_container').find('.current').prev();
        $('.slider_container').find('.current').removeClass('current').hide();
        $prevElement.addClass('current').show();
        
        if ($prevElement.length == 0) {
            $prevElement = $('.slider:last');
            $('.slider:last').addClass('current').show();
        }
        processElement($prevElement);
    });
    
    function processElement($element) {
        if ($element.hasClass('imageClass')) {
            console.log('image');
            $('.videoClass').each(function(){
                $(this).get(0).pause();
            });
            var $bodyImgUrl = $element.find('.image_bg').attr('attr-url');
            $('body').css('background-image', "url('" + $bodyImgUrl + "')");
        } else {
            console.log('video');
            $element.find('.videoClass')[0].play();
            $('body').css('background-image', 'none');
        }
    }
});
