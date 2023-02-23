// Begin ready function.
$(function(){
    // // Begin Phone Nav
    function checkWidth() {
        var windowSize = $(window).width();
        if (windowSize < 991) {
            // Begin Phone Nav
            $(".phone-nav, .mobile-menu-backdrop, .nav-container ul li a").click(function(){
                //$(".main-nav-wrap").slideToggle(400);
                $("body").toggleClass('mobile-menu-open');
                $(this).toggleClass('open');
            }); // End Phone Nav   
        }
          
    };
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth); 


    // Donation amount active
    $(document).on('click', 'li.campaign-donate-amount, li.campaign-donate-other-amount-li', function(){
        $('li.campaign-donate-amount, li.campaign-donate-other-amount-li').removeClass("active");
        $(this).addClass("active");
    });
    $(document).on('click', 'li.campaign-donate-amount', function(){
        $('input[type="number"].other-amount').val(''); 
    });


   // Campaign checkout gift aid custom design add active class
    $(".gift-aid-box ul li").on('click', function(){
        $('.gift-aid-box ul li').removeClass("active");
        $(this).addClass("active");
    });// End campaign checkout gift aid custom design add active class

});// End ready function


// Window load function
$(window).on("load", function() {

    // Home banner slider
    if($('#homeSlider').length){
        $('#homeSlider').flexslider({
            animation: "slide",
            slideshow: false,
            controlNav: true,
            directionNav: false,
            start: function(slider){
                $('body').removeClass('loading');
            }
            ,
            animationLoop: true
        });
    };// End home banner slider


});// End window load function



