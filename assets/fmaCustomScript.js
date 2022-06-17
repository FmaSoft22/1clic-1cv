$(document).ready(function(){
    $('.menu_item').mouseenter(function(){
        $(this).children('.sub_menu').slideDown();
        $(this).siblings('.menu_item').children('.sub_menu').slideUp();
    });
    $('.menu_item').mouseleave(function(){
        $(this).children('.sub_menu').slideUp();
    });
    setInterval(function(){
        $('.items').toggleClass('border-animate-items');
        $('#download_icon').animate({
            'top':'15px'
        },'slow','linear').animate({'top':'0px'},'slow');
        $('.downloadCv').toggleClass('changeBackground').animate({
            'top':'10px'
        },'slow','linear').animate({'top':'0px'},'slow');
        //  $('.profile_container').animate({'width':'250px','height':'250px'},'slow').animate({  'width':'200px','height':'200px'},'slow');
    },3000);

    setInterval(function(){
        animateIntro();
    },8000);
    function animateIntro(){
        let intro = $('.intro');
        let introContent = intro.attr('data-anim');
        let arrayIntroContent = introContent.split(',');
        let initialValue = parseInt(intro.attr('data-initial'));
        let init = initialValue + 1;
        let tag = $('#tag_content');
        if(parseInt(initialValue) === (arrayIntroContent.length-1)){
            init = 0;
        }
        let nextDisplay = arrayIntroContent[init];
        tag.slideUp();
        tag.text(nextDisplay);
        tag.slideDown();
        intro.attr('data-initial',init);
    }
});
