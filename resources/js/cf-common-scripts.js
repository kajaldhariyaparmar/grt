// Begin ready function.
$(function(){

    // Begin Crowdfunding JS

    // Begin Mobile donate smoth scroll
    $(".cf-mobile-donate-scroll").on('click', function(event) { 
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash; 
          $('html, body').animate({
            scrollTop: $(hash).offset().top - 30
          }, 500, function(){
          });
        }
    }); // End Mobile donate smoth scroll

    // Show More Supporters
    $("li.cf-supporter-block").slice(0, 4).show();
    $("#cfShowMoreSupporters").on('click', function (e) {
        e.preventDefault();
        $("li.cf-supporter-block:hidden").slice(0, 4).slideDown();
        if ($("li.cf-supporter-block:hidden").length == 0) {
            $(".cf-suppoter-show-more").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top -95
        }, 1000);
    });// End Show More Supporters

    // Crowdfunding gift aid fields show hide
    $('#cfGiftAid').on('change', function(){
        if($(this).is(":checked")) {
            $('.cf-giftaid-homeaddress').addClass('active');
            $('.cf-ga-required').prop("required", true);
        } else {
            $('.cf-giftaid-homeaddress').removeClass('active');
            $('.cf-ga-required').prop("required", false);

        }
    });// End crowdfunding gift aid fields show hide

    // Edit CF Campaign Banner 
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.cf-edit-campaign-banner-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".cf-edit-campaign-banner").on('change', function(){
        readURL(this);
    });
    $(".cf-edit-campaign-banner-upload").on('click', function() {
       $(".cf-edit-campaign-banner").click();
    });// End Edit CF Campaign Banner

    // Sign up group name input show hide
    $(function() {
        $(".cf-selectaccounttype").on('change', function(){
            $('.cf-account-type').hide();
            $('.' + $(this).val()).show();
        });
    }).change();// End sign up group name input show hide












});// End ready function

// Window load function
$(window).on("load", function() {
    // Home slider
    if($('#homeSlider').length){
        $('#homeSlider').flexslider({
            animation: "slide",
            slideshow: true,
            controlNav: false,
            customDirectionNav: $(".slider-custom-navigation a"),
            start: function(slider){
                $('body').removeClass('loading');
            }
            ,
            animationLoop: true
        });
    };// End home slider

    // Guide slider 
    if($('#caseStudiesSlider').length){
        $('#caseStudiesSlider').flexslider({
            animation: "slide",
            slideshow: true,
            smoothHeight: true,
            controlNav: false,
            customDirectionNav: $(".cs-custom-navigation a"),
            start: function(slider){
                $('body').removeClass('loading');
            }
            ,
            animationLoop: true
        });
    };// End Guide slider 

});// End window load function


$(window).scroll(function(event) {


});


